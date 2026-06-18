<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Feature;
use App\Models\GalleryCategory;
use App\Models\Page;
use App\Models\Room;

class VillaController extends Controller
{
    public function index()
    {
        $gambar = config('villa.images');
        $halaman = Page::findByKey('the-villa');

        // Fitur unggulan villa
        $fiturVilla = Feature::where('page_key', 'villa_features')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($f) => [
                'ikon' => $f->icon ?? 'leaf',
                'label' => $f->title,
            ])
            ->all();

        // Daftar kamar
        $daftarKamar = Room::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($r) => [
                'judul' => $r->title,
                'tipeKasur' => $r->bed_type,
                'deskripsi' => $r->description,
                'fasilitas' => $r->short_description ? explode(',', $r->short_description) : [],
                'foto' => ImageHelper::url($r->image, $gambar['about_small']),
                'altTeks' => $r->image_alt ?? $r->title,
            ])
            ->all();

        // Checklist ruang tamu
        $livingChecklist = $halaman?->content_blocks['living_checklist'] ?? [];
        if (!empty($livingChecklist)) {
            $ceklistRuangan = collect($livingChecklist)->map(function ($item) {
                return is_array($item) ? ($item['item'] ?? '') : $item;
            })->filter()->all();
        } else {
            $ceklistRuangan = Feature::where('page_key', 'living_checklist')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->pluck('title')
                ->all();
            if (empty($ceklistRuangan)) {
                $ceklistRuangan = [
                    'Ruang tamu dan ruang makan konsep terbuka',
                    'Dapur modern dengan peralatan lengkap',
                    'Jendela besar dari lantai hingga langit-langit',
                    'Material kayu jati alami & sentuhan arsitektur Jawa',
                ];
            }
        }

        // Kategori galeri beserta foto-fotonya
        $kategoriGaleri = GalleryCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->with(['images' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->get()
            ->map(fn ($c) => [
                'nama' => $c->name,
                'slug' => $c->slug,
                'daftarFoto' => $c->images->map(fn ($img) => [
                    'src' => ImageHelper::url($img->image),
                    'alt' => $img->alt_text,
                ])->all(),
            ])
            ->all();

        return view('pages.the-villa', [
            'halaman' => $halaman,
            'fiturVilla' => $fiturVilla,
            'daftarKamar' => $daftarKamar,
            'ceklistRuangan' => $ceklistRuangan,
            'kategoriGaleri' => $kategoriGaleri,
        ]);
    }
}