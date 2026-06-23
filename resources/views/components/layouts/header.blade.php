@php
    $waLink = \App\Helpers\WhatsAppHelper::link();
    $brand = config('villa.identity.brand');
    $isEn = app()->getLocale() === 'en';
    $secondaryNav = $isEn ? [
        ['label' => 'About The Villa', 'url' => route('the-villa')],
        ['label' => 'Quick Facts', 'url' => route('the-villa') . '#quick-facts'],
        ['label' => 'Rates & Availability', 'url' => $waLink],
        ['label' => 'Guest Reviews', 'url' => route('home.index') . '#reviews'],
        ['label' => 'Articles', 'url' => route('journey.index')],
    ] : [
        ['label' => 'Tentang Villa', 'url' => route('the-villa')],
        ['label' => 'Info Singkat', 'url' => route('the-villa') . '#quick-facts'],
        ['label' => 'Harga & Ketersediaan', 'url' => $waLink],
        ['label' => 'Ulasan Tamu', 'url' => route('home.index') . '#reviews'],
        ['label' => 'Artikel', 'url' => route('journey.index')],
    ];

@endphp

<header
    x-data="{ scrolled: false }"
    x-on:scroll.window="scrolled = window.scrollY > 60"
    :class="scrolled ? 'bg-primary py-3 shadow-md' : 'bg-transparent py-6'"
    class="fixed top-0 left-0 right-0 z-30 text-white transition-all duration-300"
    style="transform: translateZ(0); -webkit-transform: translateZ(0); will-change: transform;">

    <div class="container-site">
        {{-- Baris utama --}}
        <div class="grid grid-cols-[1fr_auto_1fr] items-center">
            {{-- Kiri: hamburger + link --}}
            <div class="flex items-center gap-6">
                <button
                    type="button"
                    x-on:click="mobileMenu = true"
                    aria-label="Buka menu"
                    class="flex items-center lg:hidden">
                    <x-ui.icon name="menu" class="w-6 h-6" />
                </button>
                <nav class="hidden lg:flex items-center gap-6" aria-label="Navigasi utama kiri">
                    <a href="{{ route('home.index') }}" class="nav-link">{{ $isEn ? 'Home' : 'Beranda' }}</a>
                    <a href="{{ route('the-villa') }}#suites" class="nav-link">{{ $isEn ? 'Stay' : 'Menginap' }}</a>
                </nav>
            </div>

            {{-- Tengah: logo --}}
            <a href="{{ route('home.index') }}" class="text-center group">
                <span class="font-sparkle text-3xl md:text-[34px] leading-none tracking-normal normal-case">{{ $brand }}</span>
                <span class="block mx-auto mt-0.5 h-px w-16 bg-white/60"></span>
            </a>

            {{-- Kanan: galeri + WhatsApp --}}
            <div class="flex items-center justify-end gap-5">
                <a href="{{ route('gallery') }}" class="hidden lg:inline nav-link">{{ $isEn ? 'Gallery' : 'Galeri' }}</a>
                
                {{-- Language Dropdown Switcher --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="flex items-center gap-1 text-xs uppercase hover:text-accent focus:outline-none py-1 px-2 border border-white/20 rounded">
                        <span>{{ app()->getLocale() }}</span>
                        <svg class="w-3 h-3 fill-current transition-transform duration-200" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20">
                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-20 bg-primary border border-white/10 rounded shadow-lg py-1 z-50" style="display: none;">
                        <a href="{{ \App\Helpers\LocaleHelper::switchUrl('id') }}" class="block px-3 py-1.5 text-xs text-white hover:bg-white/10 {{ app()->getLocale() === 'id' ? 'font-bold text-accent' : '' }}">
                            ID
                        </a>
                        <a href="{{ \App\Helpers\LocaleHelper::switchUrl('en') }}" class="block px-3 py-1.5 text-xs text-white hover:bg-white/10 {{ app()->getLocale() === 'en' ? 'font-bold text-accent' : '' }}">
                            EN
                        </a>
                    </div>
                </div>

                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-outline-light hidden sm:inline-flex">
                    {{ $isEn ? 'Book via WhatsApp' : 'Pesan lewat WhatsApp' }}
                    <span class="w-4 h-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title xmlns="">baseline-whatsapp</title><path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg></span>
                </a>
                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $isEn ? 'Book via WhatsApp' : 'Pesan lewat WhatsApp' }}" class="sm:hidden">
                    <span class="w-6 h-6"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title xmlns="">baseline-whatsapp</title><path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg></span>
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

{{-- Menu mobile --}}
<div
    x-show="mobileMenu"
    x-transition.opacity
    class="fixed inset-0 z-40 bg-black/50 lg:hidden"
    x-on:click="mobileMenu = false"
    style="display: none;"></div>

<aside
    x-show="mobileMenu"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed top-0 left-0 bottom-0 z-50 w-[300px] max-w-[85vw] bg-primary text-white p-8 overflow-y-auto lg:hidden"
    style="display: none;">

    <div class="flex items-center justify-between mb-10">
        <span class="font-sparkle text-3xl normal-case">{{ $brand }}</span>
        <button type="button" x-on:click="mobileMenu = false" aria-label="Tutup menu">
            <x-ui.icon name="close" class="w-6 h-6" />
        </button>
    </div>

    <nav class="flex flex-col gap-5" aria-label="Menu mobile">
        <a href="{{ route('home.index') }}" class="nav-link text-sm">{{ $isEn ? 'Home' : 'Beranda' }}</a>
        <a href="{{ route('the-villa') }}" class="nav-link text-sm">{{ $isEn ? 'About The Villa' : 'Tentang Villa' }}</a>
        <a href="{{ route('gallery') }}" class="nav-link text-sm">{{ $isEn ? 'Gallery' : 'Galeri' }}</a>
        <a href="{{ route('journey.index') }}" class="nav-link text-sm">{{ $isEn ? 'Journey Stories' : 'Cerita Perjalanan' }}</a>
        <a href="{{ route('home.index') }}#experiences" class="nav-link text-sm">{{ $isEn ? 'Experiences' : 'Pengalaman' }}</a>
        <a href="{{ route('home.index') }}#reviews" class="nav-link text-sm">{{ $isEn ? 'Guest Reviews' : 'Ulasan Tamu' }}</a>
    </nav>

    <div class="flex items-center gap-4 mt-8 pt-6 border-t border-white/10">
        <span class="text-xs text-white/50">{{ $isEn ? 'Language:' : 'Bahasa:' }}</span>
        <div class="flex gap-2">
            <a href="{{ \App\Helpers\LocaleHelper::switchUrl('id') }}" class="px-2.5 py-1 text-xs rounded border {{ app()->getLocale() === 'id' ? 'bg-white text-primary border-white font-bold' : 'border-white/20 text-white/80' }}">ID</a>
            <a href="{{ \App\Helpers\LocaleHelper::switchUrl('en') }}" class="px-2.5 py-1 text-xs rounded border {{ app()->getLocale() === 'en' ? 'bg-white text-primary border-white font-bold' : 'border-white/20 text-white/80' }}">EN</a>
        </div>
    </div>

    <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-outline-light w-full mt-10">
        {{ $isEn ? 'Book via WhatsApp' : 'Pesan lewat WhatsApp' }}
        <x-ui.icon name="whatsapp" class="w-4 h-4" />
    </a>
</aside>
