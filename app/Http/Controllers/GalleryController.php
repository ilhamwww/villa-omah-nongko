<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\GalleryCategory;
use App\Models\Page;

class GalleryController extends Controller
{
    public function index()
    {
        $halaman = Page::findByKey('gallery');

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

        return view('pages.gallery', [
            'halaman' => $halaman,
            'kategoriGaleri' => $kategoriGaleri,
        ]);
    }
}
