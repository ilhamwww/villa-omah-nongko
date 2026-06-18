<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Feature;
use App\Models\JourneyCategory;
use App\Models\JourneyPost;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class JourneyController extends Controller
{
    private const PER_HALAMAN = 4;

    public function index(Request $request)
    {
        $gambar = config('villa.images');
        $halaman = Page::findByKey('journey');

        // Daftar kategori, dengan "Semua Artikel" di awal
        $daftarKategori = collect([['nama' => 'Semua Artikel', 'slug' => 'all']])
            ->merge(
                JourneyCategory::where('is_active', true)
                    ->orderBy('sort_order')
                    ->get()
                    ->map(fn ($c) => ['nama' => $c->name, 'slug' => $c->slug])
            )
            ->all();

        // Query dasar: artikel yang sudah diterbitkan
        $query = JourneyPost::query()
            ->published()
            ->with('category')
            ->orderByDesc('published_at');

        $kategoriAktif = $request->query('category', 'all');
        if ($kategoriAktif !== 'all') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $kategoriAktif));
        }

        $pencarian = trim((string) $request->query('q', ''));
        if ($pencarian !== '') {
            $query->where(function ($q) use ($pencarian) {
                $q->where('title', 'like', "%{$pencarian}%")
                    ->orWhere('excerpt', 'like', "%{$pencarian}%");
            });
        }

        $semuaArtikel = $query->get()->map(fn ($p) => $this->ubahFormat($p, $gambar));

        $halamanSaatIni = max(1, (int) $request->query('page', 1));
        $artikelPerHalaman = new LengthAwarePaginator(
            $semuaArtikel->forPage($halamanSaatIni, self::PER_HALAMAN)->values(),
            $semuaArtikel->count(),
            self::PER_HALAMAN,
            $halamanSaatIni,
            ['path' => route('journey.index'), 'query' => $request->query()]
        );

        // Artikel populer
        $artikelPopuler = JourneyPost::query()
            ->published()
            ->popular()
            ->with('category')
            ->orderByDesc('published_at')
            ->take(4)
            ->get()
            ->map(fn ($p) => $this->ubahFormat($p, $gambar))
            ->values();

        // Strip fitur di bawah halaman
        $stripFitur = Feature::where('page_key', 'feature_strip')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($f) => [
                'ikon' => $f->icon ?? 'leaf',
                'label' => $f->title,
            ])
            ->all();

        return view('pages.journey.index', [
            'daftarArtikel' => $artikelPerHalaman,
            'daftarKategori' => $daftarKategori,
            'kategoriAktif' => $kategoriAktif,
            'artikelPopuler' => $artikelPopuler,
            'pencarian' => $pencarian,
            'halaman' => $halaman,
            'halamanSaatIni' => $halamanSaatIni,
            'stripFitur' => $stripFitur,
        ]);
    }

    public function show(string $slug)
    {
        $gambar = config('villa.images');

        $model = JourneyPost::query()
            ->published()
            ->with('category')
            ->where('slug', $slug)
            ->first();

        abort_if(! $model, 404);

        $artikel = $this->ubahFormat($model, $gambar);

        // Artikel terkait: kategori yang sama, kecuali yang sedang dibuka
        $modelTerkait = JourneyPost::query()
            ->published()
            ->with('category')
            ->where('journey_category_id', $model->journey_category_id)
            ->where('id', '!=', $model->id)
            ->take(2)
            ->get();

        if ($modelTerkait->count() < 2) {
            $modelTerkait = JourneyPost::query()
                ->published()
                ->with('category')
                ->where('id', '!=', $model->id)
                ->take(2)
                ->get();
        }

        $artikelTerkait = $modelTerkait->map(fn ($p) => $this->ubahFormat($p, $gambar))->values();

        return view('pages.journey.show', [
            'artikel' => $artikel,
            'artikelTerkait' => $artikelTerkait,
        ]);
    }

    /**
     * Mengubah format model JourneyPost menjadi array untuk tampilan.
     */
    private function ubahFormat(JourneyPost $p, array $gambar): array
    {
        return [
            'kategori' => $p->category?->name ?? 'Journey',
            'slugKategori' => $p->category?->slug ?? 'all',
            'judul' => $p->title,
            'slug' => $p->slug,
            'ringkasan' => $p->excerpt,
            'konten' => $p->content,
            'foto' => ImageHelper::url($p->featured_image, $gambar['hero_journey']),
            'altTeks' => $p->featured_image_alt ?? $p->title,
            'tanggal' => optional($p->published_at)->toDateString() ?? now()->toDateString(),
            'waktuBaca' => $p->reading_time . ' menit baca',
            'populer' => $p->is_popular,
        ];
    }
}