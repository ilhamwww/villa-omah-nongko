@php
    $waLink = \App\Helpers\WhatsAppHelper::link();
    $brand = config('villa.identity.brand');
    $secondaryNav = [
        ['label' => 'Tentang Villa', 'url' => route('the-villa')],
        ['label' => 'Info Singkat', 'url' => route('the-villa') . '#quick-facts'],
        ['label' => 'Harga & Ketersediaan', 'url' => $waLink],
        ['label' => 'Ulasan Tamu', 'url' => route('home.index') . '#reviews'],
        ['label' => 'Artikel', 'url' => route('journey.index')],
    ];
@endphp

<div
    x-data="{ scrolled: false, mobileMenu: false }"
    x-on:scroll.window="scrolled = window.scrollY > 60"
>
    <header
        :class="scrolled
            ? 'bg-primary/95 backdrop-blur-sm py-3 shadow-md'
            : 'bg-primary/70 lg:bg-transparent py-4 lg:py-6'"
        class="fixed top-0 left-0 right-0 z-[60] w-full text-white transition-all duration-300"
    >
        <div class="container-site">
            {{-- Baris utama --}}
            <div class="grid grid-cols-[1fr_auto_1fr] items-center">
                {{-- Kiri: hamburger + link --}}
                <div class="flex items-center gap-6">
                    <button
                        type="button"
                        x-on:click="mobileMenu = true"
                        aria-label="Buka menu"
                        class="flex items-center lg:hidden"
                    >
                        <x-ui.icon name="menu" class="w-6 h-6" />
                    </button>

                    <nav class="hidden lg:flex items-center gap-6" aria-label="Navigasi utama kiri">
                        <a href="{{ route('home.index') }}" class="nav-link">Beranda</a>
                        <a href="{{ route('the-villa') }}#suites" class="nav-link">Menginap</a>
                    </nav>
                </div>

                {{-- Tengah: logo --}}
                <a href="{{ route('home.index') }}" class="text-center group">
                    <span class="font-sparkle text-3xl md:text-[34px] leading-none tracking-normal normal-case">
                        {{ $brand }}
                    </span>
                    <span class="block mx-auto mt-0.5 h-px w-16 bg-white/60"></span>
                </a>

                {{-- Kanan: galeri + WhatsApp --}}
                <div class="flex items-center justify-end gap-5">
                    <a href="{{ route('gallery') }}" class="hidden lg:inline nav-link">Galeri</a>

                    <a
                        href="{{ $waLink }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-outline-light hidden sm:inline-flex"
                    >
                        Pesan lewat WhatsApp
                        <span class="w-4 h-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/>
                            </svg>
                        </span>
                    </a>

                    <a
                        href="{{ $waLink }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Pesan lewat WhatsApp"
                        class="sm:hidden"
                    >
                        <span class="block w-6 h-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>

            {{-- Navigasi sekunder --}}
            <nav class="hidden lg:flex justify-center items-center gap-3.5 mt-6" aria-label="Navigasi sekunder">
                @foreach($secondaryNav as $i => $item)
                    <a href="{{ $item['url'] }}" class="nav-link">{{ $item['label'] }}</a>
                    @if($i < count($secondaryNav) - 1)
                        <span class="text-white/50 text-[8px]">•</span>
                    @endif
                @endforeach
            </nav>
        </div>
    </header>

    {{-- Overlay mobile --}}
    <div
        x-show="mobileMenu"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 z-[70] bg-black/50 lg:hidden"
        x-on:click="mobileMenu = false"
    ></div>

    {{-- Menu mobile --}}
    <aside
        x-show="mobileMenu"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        x-cloak
        class="fixed top-0 left-0 bottom-0 z-[80] w-[300px] max-w-[85vw] bg-primary text-white p-8 overflow-y-auto lg:hidden"
    >
        <div class="flex items-center justify-between mb-10">
            <span class="font-sparkle text-3xl normal-case">{{ $brand }}</span>
            <button type="button" x-on:click="mobileMenu = false" aria-label="Tutup menu">
                <x-ui.icon name="close" class="w-6 h-6" />
            </button>
        </div>

        <nav class="flex flex-col gap-5" aria-label="Menu mobile">
            <a href="{{ route('home.index') }}" class="nav-link text-sm">Beranda</a>
            <a href="{{ route('the-villa') }}" class="nav-link text-sm">Tentang Villa</a>
            <a href="{{ route('gallery') }}" class="nav-link text-sm">Galeri</a>
            <a href="{{ route('journey.index') }}" class="nav-link text-sm">Cerita Perjalanan</a>
            <a href="{{ route('home.index') }}#experiences" class="nav-link text-sm">Pengalaman</a>
            <a href="{{ route('home.index') }}#reviews" class="nav-link text-sm">Ulasan Tamu</a>
        </nav>

        <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-outline-light w-full mt-10">
            Pesan lewat WhatsApp
            <x-ui.icon name="whatsapp" class="w-4 h-4" />
        </a>
    </aside>
</div>