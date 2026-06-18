@php
    $gambar = config('villa.images');
    $judulHero = $halaman?->hero_title ?: 'Cerita Perjalanan';
    $deskripsiHero = $halaman?->hero_description ?: 'Cerita dan inspirasi dari Yogyakarta. Temukan pengalaman lokal, tips wisata, kuliner, dan kehidupan villa di Omah Nongko.';
    $fotoHero = $halaman?->hero_image ? asset('storage/'.$halaman?->hero_image) : $gambar['hero_journey'];
    $altFotoHero = $halaman?->hero_image_alt ?: 'Suasana Villa Omah Nongko untuk artikel dan cerita perjalanan Yogyakarta';
    $judulSEO = $halamanSaatIni > 1 ? "Cerita Perjalanan — Halaman {$halamanSaatIni}" : ($halaman?->seo_title ?: 'Cerita Perjalanan — Wisata, Budaya & Villa di Yogyakarta');
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Blog',
        'name' => 'Cerita Perjalanan Omah Nongko',
        'url' => route('journey.index'),
        'description' => 'Cerita dan inspirasi dari Yogyakarta. Temukan pengalaman lokal, tips wisata, kuliner, dan kehidupan villa di Omah Nongko.',
    ];
@endphp

<x-layouts.app
    :title="$judulSEO"
    :description="$halaman?->seo_description ?: 'Cerita dan inspirasi dari Yogyakarta. Temukan pengalaman lokal, tips wisata, kuliner, dan kehidupan villa di Villa Omah Nongko.'"
    :canonical="route('journey.index')"
    :ogImage="$halaman?->og_image ? asset('storage/'.$halaman?->og_image) : $fotoHero"
    :schema="$schema"
    footerVariant="light">

    {{-- Hero --}}
    <x-ui.hero
        :title="$judulHero"
        :description="$deskripsiHero"
        :image="$fotoHero"
        :imageAlt="$altFotoHero" />

    {{-- Daftar Artikel --}}
    <section class="py-section-md" aria-label="Artikel terbaru">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_320px] gap-12 lg:gap-16 items-start">
                {{-- Konten utama --}}
                <div>
                    <div class="flex items-center justify-between mb-8 reveal-slide-up">
                        <h2 class="font-heading text-3xl md:text-4xl">Artikel Terbaru</h2>
                    </div>

                    @if($daftarArtikel->isEmpty())
                        <p class="text-text-muted reveal-fade">Belum ada artikel.</p>
                    @else
                        <div class="space-y-3">
                            @foreach($daftarArtikel as $artikelItem)
                                <div class="reveal-slide-up" style="transition-delay: {{ ($loop->index % 3) * 100 }}ms;">
                                    <x-ui.blog-card :post="$artikelItem" />
                                </div>
                            @endforeach
                        </div>

                        {{-- Navigasi halaman --}}
                        @if($daftarArtikel->hasPages())
                            <nav class="mt-10 flex items-center gap-5 reveal-fade" aria-label="Navigasi halaman">
                                @for($i = 1; $i <= $daftarArtikel->lastPage(); $i++)
                                    <a href="{{ $daftarArtikel->url($i) }}"
                                       class="w-9 h-9 flex items-center justify-center text-sm {{ $i === $daftarArtikel->currentPage() ? 'border border-text-main text-text-main' : 'text-text-muted hover:text-text-main' }}"
                                       @if($i === $daftarArtikel->currentPage()) aria-current="page" @endif>{{ $i }}</a>
                                @endfor
                            </nav>
                        @endif
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="reveal-slide-left delay-200">
                    <x-ui.journey-sidebar
                        :categories="$daftarKategori"
                        :activeCategory="$kategoriAktif"
                        :popular="$artikelPopuler"
                        :search="$pencarian" />
                </div>
            </div>
        </div>
    </section>

    {{-- Strip Fitur (gelap) --}}
    <section class="bg-primary text-white relative overflow-hidden" aria-label="Fasilitas villa">
        <div class="absolute right-10 top-0 w-64 h-64 z-0 pointer-events-none reveal-slide-left delay-300">
            <x-ui.icon name="leaf" class="w-full h-full text-white opacity-[0.08]" />
        </div>
        <div class="container-site py-12 relative z-10">
            <div class="grid grid-cols-3 md:grid-cols-6 gap-y-8 gap-x-4">
                @foreach($stripFitur as $fitur)
                    <div class="flex flex-col items-center text-center reveal-slide-up" style="transition-delay: {{ ($loop->index % 6) * 100 }}ms;">
                        <x-ui.icon :name="$fitur['ikon']" class="w-7 h-7 text-white/85 " />
                        <span class="mt-3 text-xs leading-snug text-white/80">{{ $fitur['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>