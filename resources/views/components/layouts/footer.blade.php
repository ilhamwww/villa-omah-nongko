@props(['variant' => 'light'])

@php
    $waLink = \App\Helpers\WhatsAppHelper::link();
    $brand = config('villa.identity.brand');
    $identity = config('villa.identity');
    $social = config('villa.social');
    $isDark = $variant === 'dark';

    $jelajahi = [
        ['label' => 'Tentang Villa', 'url' => route('the-villa')],
        ['label' => 'Kamar', 'url' => route('the-villa') . '#suites'],
        ['label' => 'Fasilitas', 'url' => route('home.index') . '#amenities'],
        ['label' => 'Pengalaman', 'url' => route('home.index') . '#experiences'],
        ['label' => 'Galeri', 'url' => route('gallery')],
        ['label' => 'Artikel', 'url' => route('journey.index')],
    ];
    $informasi = [
        ['label' => 'Harga & Ketersediaan', 'url' => $waLink],
        ['label' => 'Lokasi', 'url' => $identity['google_maps_url']],
        ['label' => 'Tata Tertib', 'url' => '#'],
        ['label' => 'Pertanyaan Umum', 'url' => '#'],
        ['label' => 'Hubungi Kami', 'url' => 'mailto:' . $identity['email']],
    ];
@endphp

<footer class="{{ $isDark ? 'bg-primary text-white' : 'bg-bg-soft text-text-main border-t border-border-light' }}">
    <div class="container-site py-section-md">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1.2fr] gap-10 lg:gap-16">
            {{-- Brand --}}
            <div>
                <span class="font-sparkle text-4xl normal-case">{{ $brand }}</span>
                <span class="block mt-1 h-px w-16 {{ $isDark ? 'bg-white/50' : 'bg-text-main/40' }}"></span>
                <p class="mt-5 text-sm leading-relaxed {{ $isDark ? 'text-white/70' : 'text-text-muted' }} max-w-xs">
                    {{ $identity['description'] }}
                </p>
                <div class="flex items-center gap-4 mt-6">
                    @foreach($social as $s)
                        <a href="{{ $s['url'] }}" target="_blank" rel="noopener noreferrer"
                           aria-label="{{ $s['label'] }}"
                           class="{{ $isDark ? 'text-white/70 hover:text-white' : 'text-text-muted hover:text-text-main' }} transition-colors">
                            <x-ui.icon :name="$s['icon']" class="w-5 h-5" />
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Jelajahi --}}
            <div>
                <h3 class="eyebrow {{ $isDark ? 'text-white/60' : '' }}">Jelajahi</h3>
                <ul class="mt-5 space-y-3">
                    @foreach($jelajahi as $link)
                        <li>
                            <a href="{{ $link['url'] }}" class="text-sm {{ $isDark ? 'text-white/70 hover:text-white' : 'text-text-muted hover:text-text-main' }} transition-colors">{{ $link['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Hubungi Kami --}}
            <div>
                <h3 class="eyebrow {{ $isDark ? 'text-white/60' : '' }}">Hubungi Kami</h3>
                <ul class="mt-5 space-y-4 text-sm {{ $isDark ? 'text-white/70' : 'text-text-muted' }}">
                    <li class="flex items-start gap-2.5">
                        <span class="w-4 h-4 mt-0.5 shrink-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title xmlns="">baseline-whatsapp</title><path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg></span>
                        <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="hover:underline">
                            {{ $identity['phone'] }}
                        </a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-ui.icon name="email" class="w-4 h-4 mt-0.5 shrink-0" />
                        <a href="mailto:{{ $identity['email'] }}" class="hover:underline">{{ $identity['email'] }}</a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-ui.icon name="pin" class="w-4 h-4 mt-0.5 shrink-0" />
                        <span>{{ $identity['location_name'] }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bawah --}}
        <div class="mt-12 pt-6 border-t {{ $isDark ? 'border-white/15' : 'border-border-light' }} flex flex-col sm:flex-row items-center justify-between gap-4 text-xs {{ $isDark ? 'text-white/50' : 'text-text-soft' }}">
            <p>&copy; {{ date('Y') }} {{ $identity['site_name'] }}. Hak cipta dilindungi.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:underline">Kebijakan Privasi</a>
                <a href="#" class="hover:underline">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>