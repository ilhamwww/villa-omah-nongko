@php
    $gambar = config('villa.images');
    $judulHero = $halaman?->hero_title ?: 'Galeri';
    $deskripsiHero = $halaman?->hero_description ?: 'Jelajahi keindahan Villa Omah Nongko melalui galeri kami. Setiap sudut dirancang dengan penuh perhatian untuk menyatu dengan alam dan menciptakan momen yang tak terlupakan.';
    $fotoHero = $halaman?->hero_image ? asset('storage/'.$halaman?->hero_image) : $gambar['hero_gallery'];
    $altFotoHero = $halaman?->hero_image_alt ?: 'Galeri foto Villa Omah Nongko dengan kolam dan taman tropis';
    $semuaFoto = collect($kategoriGaleri)->flatMap(fn ($c) => $c['daftarFoto']);
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => 'Galeri — Villa Omah Nongko',
        'url' => route('gallery'),
        'description' => 'Jelajahi keindahan Villa Omah Nongko melalui galeri kami.',
        'mainEntity' => [
            '@type' => 'ImageGallery',
            'image' => $semuaFoto->take(10)->map(fn ($foto) => [
                '@type' => 'ImageObject',
                'contentUrl' => $foto['src'],
                'description' => $foto['alt'],
            ])->all(),
        ],
    ];
@endphp

<x-layouts.app
    :title="$halaman?->seo_title ?: 'Galeri — Villa Omah Nongko'"
    :description="$halaman?->seo_description ?: 'Jelajahi keindahan Villa Omah Nongko melalui galeri kami. Setiap sudut dirancang untuk menyatu dengan alam dan menciptakan momen tak terlupakan.'"
    :ogImage="$halaman?->og_image ? asset('storage/'.$halaman?->og_image) : $fotoHero"
    :schema="$schema"
    footerVariant="light">

    {{-- Hero --}}
    <x-ui.hero
        :title="$judulHero"
        :description="$deskripsiHero"
        :image="$fotoHero"
        :imageAlt="$altFotoHero" />

    <div x-data="{ filter: 'all' }">
        {{-- Filter Bar --}}
        <section class="border-b border-border-light" aria-label="Filter galeri">
            <div class="container-site py-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 reveal-slide-up">
                <div class="flex gap-7 overflow-x-auto scrollbar-hide" role="tablist">
                    <button type="button" role="tab"
                            x-on:click="filter = 'all'"
                            :class="filter === 'all' ? 'text-text-main border-b border-text-main' : 'text-text-muted'"
                            class="pb-1 text-xs whitespace-nowrap transition-colors">Semua</button>
                    @foreach($kategoriGaleri as $kat)
                        <button type="button" role="tab"
                                x-on:click="filter = '{{ $kat['slug'] }}'"
                                :class="filter === '{{ $kat['slug'] }}' ? 'text-text-main border-b border-text-main' : 'text-text-muted'"
                                class="pb-1 text-xs whitespace-nowrap transition-colors">{{ $kat['nama'] }}</button>
                    @endforeach
                </div>
                <button type="button"
                        x-on:click="openLightbox({{ json_encode($semuaFoto->pluck('src')->all()) }}, {{ json_encode($semuaFoto->pluck('alt')->all()) }}, 0)"
                        class="btn-outline-dark shrink-0">
                    Lihat Tayangan Foto
                    <x-ui.icon name="play" class="w-4 h-4" />
                </button>
            </div>
        </section>

        {{-- Bagian Kategori --}}
        @foreach($kategoriGaleri as $kat)
            <section x-show="filter === 'all' || filter === '{{ $kat['slug'] }}'"
                     class="py-section-sm" aria-labelledby="kat-{{ $kat['slug'] }}">
                <div class="container-site">
                    <div class="flex items-end justify-between mb-6 reveal-slide-up">
                        <h2 id="kat-{{ $kat['slug'] }}" class="font-heading text-2xl md:text-3xl">{{ $kat['nama'] }}</h2>
                        <button type="button"
                                x-on:click="openLightbox({{ json_encode(array_column($kat['daftarFoto'], 'src')) }}, {{ json_encode(array_column($kat['daftarFoto'], 'alt')) }}, 0)"
                                class="nav-link text-text-main inline-flex items-center gap-2">
                            Lihat Semua Foto
                            <x-ui.icon name="arrow-right" class="w-4 h-4" />
                        </button>
                    </div>
                    <div class="reveal-scale-up delay-100">
                        <x-ui.gallery-mosaic :images="$kat['daftarFoto']" />
                    </div>
                </div>
            </section>
        @endforeach
    </div>

    {{-- CTA --}}
    <x-ui.cta-section />

    {{-- Lightbox --}}
    <x-ui.lightbox />
</x-layouts.app>