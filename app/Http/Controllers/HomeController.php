<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Experience;
use App\Models\Feature;
use App\Models\Page;
use App\Models\Room;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $gambar = config('villa.images');
        $halaman = Page::findByKey('home');

        // Fakta singkat tentang villa
        $faktaSingkat = Feature::where('page_key', 'quick_facts')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($f) => [
                'ikon' => $f->icon ?? 'leaf',
                'judul' => $f->title,
                'subjudul' => $f->subtitle,
            ])
            ->all();

        // Fasilitas villa
        $fasilitas = Feature::where('page_key', 'amenities')
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

        // Pengalaman yang ditawarkan
        $pengalaman = Experience::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($e) => [
                'judul' => $e->title,
                'deskripsi' => $e->description,
                'ikon' => $e->icon ?? 'leaf',
                'foto' => ImageHelper::url($e->image, $gambar['about_small']),
                'altTeks' => $e->image_alt ?? $e->title,
            ])
            ->all();

        // Ulasan tamu
        $ulasanTamu = Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($t) => [
                'isi' => $t->content,
                'nama' => $t->name,
                'asalNegara' => $t->country_or_role,
                'bintang' => $t->rating,
            ])
            ->all();

        return view('pages.home', [
            'halaman' => $halaman,
            'faktaSingkat' => $faktaSingkat,
            'daftarKamar' => $daftarKamar,
            'fasilitas' => $fasilitas,
            'pengalaman' => $pengalaman,
            'ulasanTamu' => $ulasanTamu,
        ]);
    }
}