@php
    $waLink = \App\Helpers\WhatsAppHelper::link();
    $gambar = config('villa.images');
    $judulHero = $halaman?->hero_title ?: 'Villa Omah Nongko';
    $deskripsiHero = $halaman?->hero_description ?: "Villa Omah Nongko adalah villa privat 5 kamar tidur yang memadukan arsitektur unik dengan kehidupan tropis yang luas. Terletak di Sleman, Yogyakarta, dikelilingi alam yang asri dan sejuk.";
    $fotoHero = $halaman?->hero_image ? asset('storage/' . $halaman?->hero_image) : $gambar['hero_home'];
    $altFotoHero = $halaman?->hero_image_alt ?: 'Villa Omah Nongko dengan taman tropis di Yogyakarta';
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LodgingBusiness',
        'name' => config('villa.identity.site_name'),
        'description' => config('villa.identity.description'),
        'url' => route('home.index'),
        'image' => $fotoHero,
        'telephone' => config('villa.identity.phone'),
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Sleman',
            'addressRegion' => 'Yogyakarta',
            'addressCountry' => 'ID',
        ],
        'amenityFeature' => collect($fasilitas)->map(fn($a) => [
            '@type' => 'LocationFeatureSpecification',
            'name' => $a['label'],
            'value' => true,
        ])->all(),
    ];
@endphp

<x-layouts.app :title="$halaman?->seo_title ?: 'Villa Omah Nongko — Villa Tropis Privat di Yogyakarta'"
    :description="$halaman?->seo_description ?: 'Villa privat di Yogyakarta yang memadukan arsitektur unik, kehidupan tropis yang luas, dan taman hijau di Sleman.'" :ogImage="$halaman?->og_image ? asset('storage/' . $halaman?->og_image) : $fotoHero" :schema="$schema" footerVariant="dark">

    {{-- Hero --}}
    <x-ui.hero :title="$judulHero" :description="$deskripsiHero" :image="$fotoHero" :imageAlt="$altFotoHero"
        ctaLabel="Jelajahi Villa" :ctaUrl="route('the-villa')" :isHome="true" />

    {{-- Fakta Singkat --}}
    <section class="bg-bg-soft border-b border-border-light overflow-hidden" aria-label="Fakta singkat">
        <div class="container-site py-8">
            {{-- Mobile: auto-scroll marquee --}}
            <div class="md:hidden relative overflow-hidden marquee-mask">
                <div class="flex w-max gap-8 animate-marquee hover:[animation-play-state:paused]">
                    @foreach($faktaSingkat as $fakta)
                        <div class="shrink-0 min-w-[80px]">
                            <x-ui.feature-item :icon="$fakta['ikon']" :title="$fakta['judul']" :subtitle="$fakta['subjudul']" />
                        </div>
                    @endforeach
                    {{-- duplikat untuk loop mulus --}}
                    @foreach($faktaSingkat as $fakta)
                        <div class="shrink-0 min-w-[80px]" aria-hidden="true">
                            <x-ui.feature-item :icon="$fakta['ikon']" :title="$fakta['judul']" :subtitle="$fakta['subjudul']" />
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Desktop: grid statis --}}
            <div class="hidden md:flex md:justify-center md:gap-16">
                @foreach($faktaSingkat as $fakta)
                    <div class="reveal-slide-up" style="transition-delay: {{ ($loop->index % 7) * 100 }}ms;">
                        <x-ui.feature-item :icon="$fakta['ikon']" :title="$fakta['judul']" :subtitle="$fakta['subjudul']" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Tentang Villa --}}
    <section class="py-section-md md:py-section-lg" aria-labelledby="tentang-heading">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-[0.9fr_1.4fr] gap-12 lg:gap-[72px] items-center">
                <div class="reveal-slide-right">
                    <p class="eyebrow">Tentang Omah Nongko</p>
                    <h2 id="tentang-heading"
                        class="mt-3 font-heading text-3xl md:text-4xl lg:text-[42px] leading-tight">Villa Privat yang
                        Dikelilingi Alam</h2>
                    <p class="mt-5 text-text-muted text-sm md:text-base leading-relaxed">Dibangun dengan filosofi
                        keselarasan antara arsitektur dan alam, Omah Nongko menawarkan tempat peristirahatan yang tenang
                        dengan ruang terbuka, material alami, dan taman tropis yang hijau.</p>
                    <a href="{{ route('the-villa') }}" class="btn-outline-dark mt-7">
                        Pelajari Lebih Lanjut
                        <x-ui.icon name="arrow-right" class="w-4 h-4 btn-icon" />
                    </a>
                </div>
                <div class="relative min-h-[360px] md:min-h-[430px] reveal-scale-up delay-200">
                    <img src="{{ $gambar['about_large'] }}"
                        alt="Eksterior Villa Omah Nongko dengan kolam dan taman tropis hijau" loading="lazy" width="900"
                        height="700" class="w-[72%] ml-auto aspect-[4/3] object-cover">
                    <img src="{{ $gambar['about_small'] }}"
                        alt="Interior living room Villa Omah Nongko dengan material kayu natural" loading="lazy"
                        width="600" height="500"
                        class="absolute left-0 bottom-6 w-[48%] aspect-[4/3] object-cover shadow-photo reveal-slide-up delay-500">
                </div>
            </div>
        </div>
    </section>

    {{-- Kamar & Suite --}}
    <section class="py-section-md bg-bg-soft" aria-labelledby="kamar-heading">
        <div class="container-site">
            <div class="reveal-slide-up">
                <x-ui.section-header eyebrow="Kamar & Suite" heading="Kamar Luas untuk Menginap yang Nyaman"
                    :link="route('the-villa') . '#suites'" linkLabel="Lihat Semua Kamar" />
            </div>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @foreach($daftarKamar as $kamar)
                    <article class="bg-bg-card border border-border-light flex flex-col group reveal-slide-up"
                        style="transition-delay: {{ ($loop->index % 3) * 100 }}ms;">
                        <div class="overflow-hidden relative">
                            <img src="{{ $kamar['foto'] }}" alt="{{ $kamar['altTeks'] }}" loading="lazy" width="600"
                                height="450"
                                class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute top-4 left-4 bg-bg-card/90 backdrop-blur text-[10px] font-semibold uppercase tracking-widest px-3 py-1 text-olive">
                                Kamar 0{{ $loop->iteration }}
                            </div>
                        </div>
                        <div class="p-6 md:p-8 flex flex-col flex-grow">
                            <h3 class="font-heading text-2xl group-hover:text-olive transition-colors">{{ $kamar['judul'] }}</h3>
                            <div class="mt-3 flex items-center gap-2 text-xs text-text-muted">
                                <x-ui.icon name="bed" class="w-4 h-4 text-olive" />
                                <span>{{ $kamar['tipeKasur'] }}</span>
                            </div>
                            <p class="mt-4 text-sm text-text-muted leading-relaxed flex-grow">
                                {{ $kamar['deskripsi'] }}
                            </p>
                            
                            @if(count($kamar['fasilitas']) > 0)
                            <div class="mt-6 flex flex-wrap gap-2">
                                @foreach($kamar['fasilitas'] as $tag)
                                    @if(trim($tag) !== '')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-sm text-[10px] font-medium bg-bg-main border border-border-light text-text-main">
                                        {{ trim($tag) }}
                                    </span>
                                    @endif
                                @endforeach
                            </div>
                            @endif

                            <a href="{{ route('the-villa') }}#suites"
                                class="mt-8 inline-flex items-center gap-2 text-xs font-semibold tracking-widenav uppercase text-text-main hover:opacity-75 group-hover:translate-x-1 transition-transform">
                                Lihat Detail Kamar
                                <x-ui.icon name="arrow-right" class="w-4 h-4" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Keunggulan & Fasilitas --}}
    <section id="amenities" class="py-section-md md:py-section-lg relative overflow-hidden"
        aria-labelledby="fasilitas-heading">
        {{-- Dekorasi daun (desktop saja, tipis di belakang) --}}
        <x-ui.icon name="leaf"
            class="hidden md:block absolute -left-16 bottom-0 w-64 h-64 lg:w-80 lg:h-80 text-olive opacity-[0.04] -z-0 pointer-events-none reveal-slide-right delay-300" />
        <div class="container-site relative">
            <div class="text-center max-w-2xl mx-auto reveal-slide-up">
                <p class="eyebrow">Keunggulan & Fasilitas</p>
                <h2 id="fasilitas-heading" class="mt-3 font-heading text-3xl md:text-4xl lg:text-[42px] leading-tight">
                    Semua yang Anda Butuhkan untuk Menginap Sempurna</h2>
            </div>
            <div class="mt-12 flex flex-wrap justify-center gap-y-10 gap-x-6 md:gap-x-12 max-w-4xl mx-auto">
                @foreach($fasilitas as $item)
                    <div class="w-[calc(50%-12px)] md:w-[180px] reveal-slide-up flex-shrink-0" style="transition-delay: {{ ($loop->index % 4) * 100 }}ms;">
                        <x-ui.feature-item :icon="$item['ikon']" :label="$item['label']" />
                    </div>
                @endforeach
            </div>
            <div class="mt-12 text-center reveal-fade delay-300">
                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-primary">Lihat Semua
                    Fasilitas</a>
            </div>
        </div>
    </section>

    {{-- Pengalaman --}}
    <section id="experiences" class="py-section-md bg-bg-soft" aria-labelledby="pengalaman-heading">
        <div class="container-site">
            <div class="text-center max-w-2xl mx-auto reveal-slide-up">
                <p class="eyebrow">Pengalaman</p>
                <h2 id="pengalaman-heading" class="mt-3 font-heading text-3xl md:text-4xl lg:text-[42px] leading-tight">
                    Dirancang untuk Momen Yogyakarta Anda</h2>
                <p class="mt-4 text-text-muted text-sm md:text-base leading-relaxed">Dari hari santai di taman
                    hingga menjelajahi kekayaan budaya Yogyakarta, kami menciptakan pengalaman yang selalu Anda kenang.</p>
            </div>
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($pengalaman as $item)
                    <article class="text-center reveal-slide-up"
                        style="transition-delay: {{ ($loop->index % 4) * 100 }}ms;">
                        <div class="relative">
                            <img src="{{ $item['foto'] }}" alt="{{ $item['altTeks'] }}" loading="lazy" width="600"
                                height="400" class="w-full aspect-[16/10] object-cover">
                            <span
                                class="absolute left-1/2 -bottom-6 -translate-x-1/2 w-12 h-12 rounded-full bg-bg-card border border-border-light flex items-center justify-center">
                                <x-ui.icon :name="$item['ikon']" class="w-5 h-5 text-olive" />
                            </span>
                        </div>
                        <h3 class="mt-10 font-heading text-xl">{{ $item['judul'] }}</h3>
                        <p class="mt-2 text-sm text-text-muted px-4">{{ $item['deskripsi'] }}</p>
                    </article>
                @endforeach
            </div>
            <div class="mt-14 text-center reveal-fade delay-300">
                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-primary">Jelajahi
                    Pengalaman</a>
            </div>
        </div>
    </section>

    {{-- Ulasan Tamu --}}
    <section id="reviews" class="py-section-md md:py-section-lg" aria-labelledby="ulasan-heading">
        <div class="container-site">
            <div class="text-center max-w-2xl mx-auto reveal-slide-up">
                <p class="eyebrow">Ulasan Tamu</p>
                <h2 id="ulasan-heading" class="mt-3 font-heading text-3xl md:text-4xl lg:text-[42px] leading-tight">
                    Disukai Para Tamu Kami</h2>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-16 max-w-4xl mx-auto">
                @foreach($ulasanTamu as $ulasan)
                    <figure class="reveal-slide-up" style="transition-delay: {{ ($loop->index % 2) * 150 }}ms;">
                        <span class="font-heading text-6xl text-olive/40 leading-none" aria-hidden="true">"</span>
                        <blockquote class="-mt-4 text-text-muted leading-relaxed">{{ $ulasan['isi'] }}</blockquote>
                        <figcaption class="mt-5 flex items-center gap-3">
                            <span class="text-sm font-semibold text-text-main">{{ $ulasan['nama'] }},
                                {{ $ulasan['asalNegara'] }}</span>
                        </figcaption>
                        <div class="mt-2 flex gap-0.5 text-olive" aria-label="{{ $ulasan['bintang'] }} dari 5 bintang">
                            @for($i = 0; $i < $ulasan['bintang']; $i++)
                                <x-ui.icon name="star" class="w-4 h-4" />
                            @endfor
                        </div>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Lokasi & Akses --}}
    <section id="lokasi-akses" class="py-section-md bg-bg-soft" aria-labelledby="lokasi-heading">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.3fr] gap-12 items-center">
                <div class="reveal-slide-right">
                    <p class="eyebrow">Lokasi Kami</p>
                    <h2 id="lokasi-heading" class="mt-3 font-heading text-3xl md:text-4xl leading-tight">Lokasi & Akses Mudah</h2>
                    <p class="mt-5 text-text-muted text-sm md:text-base leading-relaxed">
                        Villa Omah Nongko terletak di Sleman, Yogyakarta, daerah sejuk yang dikelilingi keindahan alam pedesaan. Lokasi kami sangat strategis dan menawarkan kedamaian yang sempurna untuk liburan keluarga maupun reuni.
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

    {{-- Newsletter --}}
    <section class="bg-primary-2 text-white relative overflow-hidden" aria-labelledby="newsletter-heading">
        {{-- Dekorasi daun disembunyikan di mobile agar tidak menabrak teks/form --}}
        <x-ui.icon name="leaf"
            class="hidden md:block absolute right-0 top-0 w-80 h-80 text-white opacity-[0.03] -z-0 pointer-events-none reveal-slide-left delay-300" />
        <div class="container-site py-12 md:py-16 relative">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="reveal-slide-right">
                    <h2 id="newsletter-heading" class="font-heading text-3xl text-white">Dapatkan Info Terbaru</h2>
                    <p class="mt-2 text-sm text-white/70">Dapatkan info terbaru villa, tips wisata, dan penawaran
                        spesial.</p>
                </div>
                <form x-data="{ email: '', terkirim: false }" x-on:submit.prevent="terkirim = true"
                    class="flex flex-col sm:flex-row gap-3 reveal-slide-left delay-200">
                    <label for="newsletter-email" class="sr-only">Alamat email</label>
                    <input x-model="email" id="newsletter-email" type="email" required placeholder="Masukkan email Anda"
                        class="flex-1 bg-transparent border border-white/30 text-white placeholder-white/50 px-4 py-3 text-sm focus:border-white/60 focus:ring-0">
                    <button type="submit" class="btn-outline-light shrink-0"
                        x-text="terkirim ? 'Sudah Berlangganan!' : 'Berlangganan'">Berlangganan</button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.app>