@php
    $waLink = \App\Helpers\WhatsAppHelper::link();
    $gambar = config('villa.images');
    $judulHero = $halaman?->hero_title ?: 'Tentang Villa';
    $deskripsiHero = $halaman?->hero_description ?: 'Villa Omah Nongko adalah villa privat 5 kamar tidur yang memadukan arsitektur unik dengan kehidupan tropis yang luas. Dirancang untuk selaras dengan alam sekitarnya, villa ini menawarkan kenyamanan, privasi, dan suasana yang autentik.';
    $fotoHero = $halaman?->hero_image ? asset('storage/'.$halaman?->hero_image) : $gambar['hero_villa'];
    $altFotoHero = $halaman?->hero_image_alt ?: 'Tampak eksterior Villa Omah Nongko dengan kolam dan taman tropis';
    
    // Fallback static if not exists in Page content_blocks
    $fotoAboutLarge = !empty($halaman?->content_blocks['about_large']) ? asset('storage/' . $halaman->content_blocks['about_large']) : $gambar['about_large'];
    $fotoAboutSmall = !empty($halaman?->content_blocks['about_small']) ? asset('storage/' . $halaman->content_blocks['about_small']) : $gambar['about_small'];

    $fotoGaleri = collect($kategoriGaleri)->flatMap(fn ($c) => $c['daftarFoto'])->take(8)->values()->all();
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LodgingBusiness',
        'name' => config('villa.identity.site_name'),
        'description' => 'Villa Omah Nongko adalah villa privat 5 kamar tidur di Yogyakarta yang memadukan arsitektur unik dengan kehidupan tropis yang luas.',
        'url' => route('the-villa'),
        'image' => $fotoHero,
        'numberOfRooms' => 5,
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Sleman',
            'addressRegion' => 'Yogyakarta',
            'addressCountry' => 'ID',
        ],
    ];
@endphp

<x-layouts.app
    :title="$halaman?->seo_title ?: 'Tentang Villa — Omah Nongko Yogyakarta'"
    :description="$halaman?->seo_description ?: 'Villa Omah Nongko adalah villa privat 5 kamar tidur yang dirancang selaras dengan alam, menawarkan kenyamanan, privasi, dan suasana autentik di Yogyakarta.'"
    :ogImage="$halaman?->og_image ? asset('storage/'.$halaman?->og_image) : $fotoHero"
    :schema="$schema"
    footerVariant="light">

    {{-- Hero --}}
    <x-ui.hero
        :title="$judulHero"
        :description="$deskripsiHero"
        :image="$fotoHero"
        :imageAlt="$altFotoHero" />

    {{-- Info Singkat --}}
    <section id="quick-facts" class="py-section-md md:py-section-lg" aria-labelledby="intro-heading">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.1fr] gap-12 lg:gap-16 items-center">
                <div class="reveal-slide-right">
                    <h2 id="intro-heading" class="font-heading text-3xl md:text-4xl lg:text-[42px] leading-tight">Villa Privat yang Dikelilingi Alam</h2>
                    <p class="mt-5 text-text-muted text-sm md:text-base leading-relaxed">Dibangun dengan filosofi keselarasan antara arsitektur dan alam, Omah Nongko menawarkan tempat peristirahatan yang tenang dengan ruang terbuka, material alami, dan taman tropis yang hijau.</p>
                    <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-primary mt-7">
                        Pesan lewat WhatsApp
                        <span class="w-4 h-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title xmlns="">baseline-whatsapp</title><path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg></span>
                    </a>
                    <div class="mt-10 grid grid-cols-3 gap-y-8 gap-x-4">
                        @foreach($fiturVilla as $fitur)
                            <div class="reveal-slide-up" style="transition-delay: {{ ($loop->index % 3) * 100 }}ms;">
                                <x-ui.feature-item :icon="$fitur['ikon']" :label="$fitur['label']" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative min-h-[380px] md:min-h-[460px] reveal-scale-up delay-200">
                    <img src="{{ $fotoAboutLarge ?? $fotoHero }}" alt="{{ $altFotoHero }}"
                         loading="lazy" width="900" height="600"
                         class="w-[78%] aspect-[4/3] object-cover">
                    <img src="{{ $fotoAboutSmall }}" alt="Interior living room Villa Omah Nongko"
                         loading="lazy" width="500" height="380"
                         class="absolute right-0 bottom-0 w-[52%] aspect-[4/3] object-cover shadow-photo reveal-slide-up delay-500">
                </div>
            </div>
        </div>
    </section>

    {{-- Galeri Villa dengan tab --}}
    <section class="py-section-md bg-bg-soft" aria-labelledby="galeri-villa-heading"
             x-data="{ tab: 'all', filteredImages: [] }"
             x-init="filteredImages = @js($kategoriGaleri)">
        <div class="container-site">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 reveal-slide-up">
                <h2 id="galeri-villa-heading" class="font-heading text-3xl md:text-4xl">Galeri Villa</h2>
                <div class="flex gap-6 overflow-x-auto scrollbar-hide" role="tablist">
                    <button type="button" role="tab"
                            x-on:click="tab = 'all'"
                            :class="tab === 'all' ? 'text-text-main border-b border-text-main' : 'text-text-muted'"
                            class="pb-1 text-xs uppercase tracking-widenav whitespace-nowrap transition-colors">Semua</button>
                    @foreach($kategoriGaleri as $kategori)
                        <button type="button" role="tab"
                                x-on:click="tab = '{{ $kategori['slug'] }}'"
                                :class="tab === '{{ $kategori['slug'] }}' ? 'text-text-main border-b border-text-main' : 'text-text-muted'"
                                class="pb-1 text-xs uppercase tracking-widenav whitespace-nowrap transition-colors">{{ $kategori['nama'] }}</button>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 reveal-scale-up delay-200 relative min-h-[350px]">
                <div x-show="tab === 'all'"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-300 absolute inset-0"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <x-ui.gallery-mosaic :images="$fotoGaleri" />
                </div>
                @foreach($kategoriGaleri as $kategori)
                    <div x-show="tab === '{{ $kategori['slug'] }}'" x-cloak
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-300 absolute inset-0"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0">
                        <x-ui.gallery-mosaic :images="$kategori['daftarFoto']" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Hidup Selaras dengan Alam --}}
    <section class="py-section-md md:py-section-lg" aria-labelledby="harmoni-heading">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-[0.85fr_1.3fr] gap-12 lg:gap-16 items-center">
                <div class="reveal-slide-right">
                    <h2 id="harmoni-heading" class="font-heading text-3xl md:text-4xl leading-tight">
                        {{ $halaman?->content_blocks['harmoni_title'] ?? 'Hidup Selaras dengan Alam' }}
                    </h2>
                    <p class="mt-5 text-text-muted text-sm md:text-base leading-relaxed">
                        {{ $halaman?->content_blocks['harmoni_description'] ?? 'Ruang tamu dan ruang makan terbuka mengundang keindahan alam masuk, sementara material alami and detail kerajinan tangan menciptakan suasana hangat yang tak lekang oleh waktu.' }}
                    </p>
                    <ul class="mt-7 space-y-4">
                        @foreach($ceklistRuangan as $item)
                            <li class="flex items-center gap-3 text-sm text-text-main reveal-slide-up" style="transition-delay: {{ $loop->index * 70 }}ms;">
                                <span class="w-8 h-8 rounded-full border border-border-light flex items-center justify-center shrink-0">
                                    <x-ui.icon name="check" class="w-4 h-4 text-olive" />
                                </span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="reveal-scale-up delay-200">
                    <img src="{{ !empty($halaman?->content_blocks['harmoni_image']) ? asset('storage/' . $halaman->content_blocks['harmoni_image']) : 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1000&h=625&fit=crop' }}"
                         alt="Ruang tamu terbuka Villa Omah Nongko dengan jendela besar menghadap taman"
                         loading="lazy" width="1000" height="625"
                         class="w-full aspect-[16/10] object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- Tiga Kamar Suite yang Nyaman --}}
    <section id="suites" class="py-section-md bg-bg-soft" aria-labelledby="suite-heading">
        <div class="container-site">
            <div class="text-center max-w-2xl mx-auto reveal-slide-up">
                <p class="eyebrow">Akomodasi</p>
                <h2 id="suite-heading" class="mt-3 font-heading text-3xl md:text-4xl leading-tight">Tiga Kamar Suite yang Nyaman</h2>
                <p class="mt-4 text-text-muted text-sm md:text-base leading-relaxed">
                    Setiap kamar dirancang secara detail untuk istirahat dan relaksasi Anda, dilengkapi fasilitas premium, perpaduan furniture kayu jati alami dengan sentuhan seni batik khas Yogyakarta.
                </p>
            </div>

            <div class="mt-12 space-y-12 max-w-5xl mx-auto">
                @foreach($daftarKamar as $kamar)
                    <div class="bg-bg-card border border-border-light overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-8 items-center reveal-slide-up animate-on-scroll"
                         style="transition-delay: {{ ($loop->index % 3) * 150 }}ms;">
                        <div class="overflow-hidden h-full min-h-[300px] {{ $loop->even ? 'md:order-last' : '' }}">
                            <img src="{{ $kamar['foto'] }}" alt="{{ $kamar['altTeks'] }}"
                                 loading="lazy" width="800" height="600"
                                 class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        </div>
                        <div class="p-8 md:p-10 flex flex-col justify-center">
                            <span class="text-xs font-semibold tracking-widest text-olive uppercase">Kamar 0{{ $loop->iteration }}</span>
                            <h3 class="mt-2 font-heading text-2xl md:text-3xl">{{ $kamar['judul'] }}</h3>
                            <div class="mt-3 flex items-center gap-2 text-xs text-olive font-semibold bg-olive/5 self-start px-3 py-1 rounded-sm">
                                <x-ui.icon name="bed" class="w-4 h-4 text-olive" stroke-width="1.6" />
                                <span>{{ $kamar['tipeKasur'] }}</span>
                            </div>
                            <p class="mt-5 text-sm text-text-muted leading-relaxed">
                                {{ $kamar['deskripsi'] }}
                            </p>

                            @if(count($kamar['fasilitas']) > 0)
                            <div class="mt-6">
                                <h4 class="text-xs font-bold uppercase tracking-wider text-text-main">Fasilitas Kamar:</h4>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach($kamar['fasilitas'] as $tag)
                                        @if(trim($tag) !== '')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs bg-bg-main border border-border-light text-text-muted rounded-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-olive/60"></span>
                                            {{ trim($tag) }}
                                        </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Arsitektur & Lokasi --}}
    <section class="py-section-md md:py-section-lg" aria-labelledby="arsitektur-heading">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-center">
                <div class="reveal-slide-right">
                    <h2 id="arsitektur-heading" class="font-heading text-2xl md:text-3xl">
                        {{ $halaman?->content_blocks['arsitektur_title'] ?? 'Arsitektur' }}
                    </h2>
                    <p class="mt-4 text-text-muted text-sm leading-relaxed">
                        {{ $halaman?->content_blocks['arsitektur_description'] ?? 'Desain arsitektur Omah Nongko terinspirasi dari lengkungan dan tekstur alam tropis. Atap berbentuk daun, ruang terbuka, dan penggunaan elemen alami menciptakan villa yang terasa unik dan sangat menyatu dengan alam sekitarnya.' }}
                    </p>
                </div>
                <div class="reveal-scale-up delay-200">
                    <img src="{{ !empty($halaman?->content_blocks['arsitektur_image']) ? asset('storage/' . $halaman->content_blocks['arsitektur_image']) : 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?w=700&h=500&fit=crop' }}"
                         alt="Arsitektur atap melengkung khas Villa Omah Nongko"
                         loading="lazy" width="700" height="500"
                         class="w-full aspect-[4/3] object-cover">
                </div>
                <div class="reveal-slide-left delay-400">
                    <h2 class="font-heading text-2xl md:text-3xl">Lokasi</h2>
                    <p class="mt-4 text-text-muted text-sm leading-relaxed">Terletak di utara Sleman dan hanya beberapa menit dari kawasan wisata Kaliurang, villa ini menawarkan ketenangan sekaligus dekat dengan yang terbaik dari Yogyakarta — pemandangan Gunung Merapi, kuliner tradisional, dan budaya Jawa yang luhur.</p>
                    <a href="#lokasi-akses" class="btn-outline-dark mt-6">
                        Lihat Detail Peta
                        <x-ui.icon name="arrow-down" class="w-4 h-4" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Lokasi & Akses --}}
    <section id="lokasi-akses" class="py-section-md bg-bg-soft" aria-labelledby="lokasi-heading">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.3fr] gap-12 items-center">
                <div class="reveal-slide-right">
                    <p class="eyebrow">Akses Menuju Villa</p>
                    <h2 id="lokasi-heading" class="mt-3 font-heading text-3xl md:text-4xl leading-tight">Lokasi & Akses Mudah</h2>
                    <p class="mt-5 text-text-muted text-sm md:text-base leading-relaxed">
                        Kami menyediakan area parkir yang luas dan aman untuk kendaraan Anda. Perjalanan menuju villa cukup mudah diakses melalui jalan utama yang beraspal mulus.
                    </p>
                    <div class="mt-6 flex flex-col gap-4">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 flex items-center justify-center shrink-0 w-8 h-8 rounded-full bg-olive/10 text-olive">
                                <x-ui.icon name="pin" class="w-4 h-4" />
                            </span>
                            <div>
                                <h4 class="font-semibold text-text-main text-sm">Alamat Lengkap</h4>
                                <p class="text-xs text-text-muted mt-1 leading-relaxed">{{ config('villa.identity.address') }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ config('villa.identity.google_maps_url') }}" target="_blank" rel="noopener noreferrer" class="btn-primary mt-8 inline-flex items-center gap-2">
                        Buka di Google Maps
                        <x-ui.icon name="arrow-right" class="w-4 h-4" />
                    </a>
                </div>
                <div class="w-full aspect-[16/10] md:aspect-[16/9] shadow-photo overflow-hidden rounded-sm reveal-scale-up delay-200">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.1031010278552!2d110.4226621757488!3d-7.672064275939337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5fe15db5cc91%3A0x7e5dd13e1f2d6e4d!2sVilla%20Omah%20Nongko!5e0!3m2!1sid!2sid!4v1781706799353!5m2!1sid!2sid" 
                            class="w-full h-full border-0" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Bar --}}
    <x-ui.cta-section />

    {{-- Lightbox --}}
    <x-ui.lightbox />
</x-layouts.app>