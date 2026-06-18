@props([
    'categories' => [],
    'activeCategory' => 'all',
    'popular' => [],
    'search' => '',
])

@php $waLink = \App\Helpers\WhatsAppHelper::link(); @endphp

<aside class="space-y-8" aria-label="Sidebar cerita">
    {{-- Pencarian --}}
    <form action="{{ route('journey.index') }}" method="GET" role="search">
        <label for="journey-search" class="sr-only">Cari artikel</label>
        <div class="relative">
            <input id="journey-search" type="search" name="q" value="{{ $search }}" placeholder="Cari artikel..."
                   class="w-full h-14 border border-border-light bg-bg-card pl-4 pr-12 text-sm focus:border-text-muted focus:ring-0">
            <button type="submit" aria-label="Cari" class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted">
                <x-ui.icon name="search" class="w-5 h-5" />
            </button>
        </div>
    </form>

    {{-- Kategori --}}
    <div class="border border-border-light bg-bg-card p-6">
        <h2 class="font-heading text-xl">Kategori</h2>
        <ul class="mt-4 space-y-1">
            @foreach($categories as $kat)
                @php $aktif = $activeCategory === $kat['slug']; @endphp
                <li>
                    <a href="{{ route('journey.index', $kat['slug'] === 'all' ? [] : ['category' => $kat['slug']]) }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-sm transition-colors {{ $aktif ? 'bg-bg-main text-text-main' : 'text-text-muted hover:text-text-main' }}">
                        <x-ui.icon name="leaf" class="w-4 h-4 opacity-70" />
                        {{ $kat['nama'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Artikel Populer --}}
    <div class="border border-border-light bg-bg-card p-6">
        <h2 class="font-heading text-xl">Artikel Populer</h2>
        <ul class="mt-4 space-y-4">
            @foreach($popular as $p)
                <li>
                    <a href="{{ route('journey.show', $p['slug']) }}" class="flex gap-3 group">
                        <img src="{{ $p['foto'] }}" alt="{{ $p['altTeks'] }}"
                             loading="lazy" width="80" height="60"
                             class="w-20 h-[60px] object-cover shrink-0">
                        <div>
                            <h3 class="text-sm font-semibold leading-snug text-text-main group-hover:underline decoration-1 underline-offset-2">{{ $p['judul'] }}</h3>
                            <p class="mt-1 text-xs text-text-soft">{{ \Carbon\Carbon::parse($p['tanggal'])->format('d M Y') }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Berlangganan --}}
    <div class="border border-border-light bg-bg-card p-6">
        <h2 class="font-heading text-xl">Tetap Terinspirasi</h2>
        <p class="mt-2 text-sm text-text-muted">Masukkan email Anda untuk menerima tips wisata, penawaran spesial, dan info terbaru villa.</p>
        <form x-data="{ email: '', terkirim: false }" x-on:submit.prevent="terkirim = true" class="mt-4 space-y-3">
            <label for="sidebar-email" class="sr-only">Alamat email</label>
            <input x-model="email" id="sidebar-email" type="email" required placeholder="Masukkan email Anda"
                   class="w-full h-12 border border-border-light px-3 text-sm focus:border-text-muted focus:ring-0">
            <button type="submit" class="btn-primary w-full" x-text="terkirim ? 'Sudah Berlangganan!' : 'Berlangganan'">Berlangganan</button>
        </form>
    </div>

    {{-- CTA Card Gelap --}}
    <div class="relative overflow-hidden bg-primary text-white p-8">
        <x-ui.icon name="leaf" class="absolute -right-6 -bottom-6 w-40 h-40 text-white opacity-[0.08] pointer-events-none" />
        <h2 class="font-heading text-2xl text-white relative">Siap merasakan Omah Nongko?</h2>
        <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-outline-light mt-6 relative">
            Pesan lewat WhatsApp
            <span class="w-4 h-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title xmlns="">baseline-whatsapp</title><path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg></span>
        </a>
    </div>
</aside>