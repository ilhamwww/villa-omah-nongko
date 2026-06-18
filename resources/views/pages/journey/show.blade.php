@php
    $waLink = \App\Helpers\WhatsAppHelper::link();
    $tanggalTerbit = \Carbon\Carbon::parse($artikel['tanggal']);
    $canonical = route('journey.show', $artikel['slug']);

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $artikel['judul'],
        'description' => $artikel['ringkasan'],
        'image' => $artikel['foto'],
        'datePublished' => $tanggalTerbit->toIso8601String(),
        'dateModified' => $tanggalTerbit->toIso8601String(),
        'author' => [
            '@type' => 'Organization',
            'name' => config('villa.identity.site_name'),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => config('villa.identity.site_name'),
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $canonical,
        ],
    ];

    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home.index')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Cerita', 'item' => route('journey.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $artikel['judul'], 'item' => $canonical],
        ],
    ];
@endphp

<x-layouts.app
    :title="$artikel['judul'] . ' — Cerita Omah Nongko'"
    :description="$artikel['ringkasan']"
    :canonical="$canonical"
    :ogImage="$artikel['foto']"
    :schema="$schema"
    footerVariant="light">

    {{-- Schema breadcrumb tambahan --}}
    @push('head')
    @endpush

    {{-- Hero Artikel --}}
    <article>
        <header class="relative">
            <img src="{{ $artikel['foto'] }}" alt="{{ $artikel['altTeks'] }}"
                 fetchpriority="high" width="1600" height="900"
                 class="w-full h-[55vh] min-h-[420px] object-cover">
            <div class="absolute inset-0 bg-black/45"></div>
            <div class="absolute inset-0 flex items-end">
                <div class="container-site pb-12 text-white">
                    <p class="eyebrow text-white/80">{{ $artikel['kategori'] }}</p>
                    <h1 class="mt-3 font-heading text-4xl md:text-5xl lg:text-6xl leading-tight max-w-3xl">{{ $artikel['judul'] }}</h1>
                    <div class="mt-4 text-sm text-white/75">
                        {{ $tanggalTerbit->format('d M Y') }} &middot; {{ $artikel['waktuBaca'] }}
                    </div>
                </div>
            </div>
        </header>

        {{-- Breadcrumb --}}
        <nav class="border-b border-border-light" aria-label="Breadcrumb">
            <div class="container-site py-4">
                <ol class="flex items-center gap-2 text-xs text-text-muted">
                    <li><a href="{{ route('home.index') }}" class="hover:text-text-main">Beranda</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('journey.index') }}" class="hover:text-text-main">Cerita</a></li>
                    <li aria-hidden="true">/</li>
                    <li class="text-text-main truncate max-w-[200px]">{{ $artikel['judul'] }}</li>
                </ol>
            </div>
        </nav>

        {{-- Konten Artikel --}}
        <div class="container-site py-section-md">
            <div class="max-w-3xl mx-auto">
                <div class="prose prose-stone max-w-none prose-headings:font-heading prose-headings:font-normal prose-a:text-olive reveal-slide-up">
                    <p class="text-lg leading-relaxed text-text-muted">{{ $artikel['ringkasan'] }}</p>

                    <h2>Temukan Pengalamannya</h2>
                    <p>{{ $artikel['ringkasan'] }} Di Villa Omah Nongko, setiap momen dirancang untuk mendekatkan Anda dengan keindahan alam dan budaya Yogyakarta yang kaya. Sejak pertama kali tiba, Anda akan merasakan keselarasan antara arsitektur yang penuh perhatian dan alam tropis yang subur.</p>

                    <p>Baik Anda mencari ketenangan maupun petualangan menjelajahi sudut wisata Jogja, villa kami adalah tempat sempurna untuk memulai. Jelajahi <a href="{{ route('the-villa') }}">tentang villa</a> dan lihat <a href="{{ route('gallery') }}">galeri</a> kami untuk melihat apa yang menanti Anda.</p>

                    <h2>Mengapa Tamu Menyukainya</h2>
                    <p>Para tamu kami selalu menyebutkan ruang tamu yang luas dan keramahan staf yang tulus. Detail-detail inilah yang mengubah menginap biasa menjadi kenangan yang tak terlupakan.</p>

                    <blockquote>
                        "Tempat peristirahatan yang tenang, terasa mewah sekaligus sangat menyatu dengan alam."
                    </blockquote>

                    <p>Siap merencanakan kunjungan Anda? Hubungi kami langsung dan kami akan membantu mengatur penginapan yang sempurna untuk Anda.</p>
                </div>

                {{-- CTA WhatsApp --}}
                <div class="mt-10 bg-primary text-white p-8 text-center reveal-scale-up delay-200">
                    <h2 class="font-heading text-2xl text-white">Rencanakan Menginap di Omah Nongko</h2>
                    <p class="mt-2 text-sm text-white/70">Pesan liburan privat Anda di Yogyakarta.</p>
                    <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-outline-light mt-5">
                        Pesan lewat WhatsApp
                        <span class="w-4 h-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title xmlns="">baseline-whatsapp</title><path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg></span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Artikel Terkait --}}
        @if($artikelTerkait->isNotEmpty())
            <section class="py-section-md bg-bg-soft" aria-labelledby="terkait-heading">
                <div class="container-site">
                    <h2 id="terkait-heading" class="font-heading text-3xl mb-8 reveal-slide-up">Artikel Terkait</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($artikelTerkait as $terkait)
                            <article class="group bg-bg-card border border-border-light reveal-slide-up" style="transition-delay: {{ $loop->index * 150 }}ms;">
                                <a href="{{ route('journey.show', $terkait['slug']) }}" class="block overflow-hidden">
                                    <img src="{{ $terkait['foto'] }}" alt="{{ $terkait['altTeks'] }}"
                                         loading="lazy" width="800" height="450"
                                         class="w-full aspect-video object-cover transition-transform duration-500 group-hover:scale-[1.03]">
                                </a>
                                <div class="p-6">
                                    <p class="eyebrow">{{ $terkait['kategori'] }}</p>
                                    <h3 class="mt-2 font-heading text-xl">
                                        <a href="{{ route('journey.show', $terkait['slug']) }}" class="hover:underline decoration-1 underline-offset-4">{{ $terkait['judul'] }}</a>
                                    </h3>
                                    <p class="mt-2 text-sm text-text-muted line-clamp-2">{{ $terkait['ringkasan'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>

    {{-- Breadcrumb JSON-LD --}}
    <script type="application/ld+json">
    {!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES) !!}
    </script>
</x-layouts.app>