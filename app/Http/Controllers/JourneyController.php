<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Feature;
use App\Models\JourneyCategory;
use App\Models\JourneyPost;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

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
        $pencarian = mb_substr($pencarian, 0, 100);
        if ($pencarian !== '') {
            $escaped = addcslashes($pencarian, '\%_');
            $like = "%{$escaped}%";
            $query->where(function ($q) use ($like) {
                $q->whereRaw('title LIKE ? ESCAPE ?', [$like, '\\'])
                    ->orWhereRaw('content LIKE ? ESCAPE ?', [$like, '\\']);
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

        $artikelPopuler = JourneyPost::query()
            ->published()
            ->popular()
            ->with('category')
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

    public function show(Request $request, string $slug)
    {
        $gambar = config('villa.images');

        $model = JourneyPost::query()
            ->published()
            ->with('category')
            ->where('slug', $slug)
            ->first();

        abort_if(! $model, 404);

        $this->catatViews($model, $request);

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
     * Menaikkan jumlah views dengan throttle per pengunjung (IP) per artikel.
     * Mencegah inflasi counter dan write DB berlebih pada setiap request.
     */
    private function catatViews(JourneyPost $model, Request $request): void
    {
        $kunci = 'journey_view:' . $model->id . ':' . sha1($request->ip() . '|' . $request->userAgent());

        if (Cache::has($kunci)) {
            return;
        }

        Cache::put($kunci, true, now()->addMinutes(30));

        $model->timestamps = false;
        $model->increment('views_count');
    }

    /**
     * Mengubah format model JourneyPost menjadi array untuk tampilan.
     */
    private function ubahFormat(JourneyPost $p, array $gambar): array
    {
        $ringkasan = Str::limit(strip_tags($p->content), 160);

        return [
            'kategori' => $p->category?->name ?? 'Journey',
            'slugKategori' => $p->category?->slug ?? 'all',
            'judul' => $p->title,
            'slug' => $p->slug,
            'ringkasan' => $ringkasan,
            'konten' => $p->content,
            'foto' => ImageHelper::url($p->featured_image, $gambar['hero_journey']),
            'altTeks' => $p->featured_image_alt ?? $p->title,
            'tanggal' => optional($p->published_at)->toDateString() ?? now()->toDateString(),
            'waktuBaca' => $p->reading_time . ' menit baca',
            'views' => number_format($p->views_count ?? 0, 0, ',', '.'),
            'populer' => $p->is_popular,
        ];
    }
}