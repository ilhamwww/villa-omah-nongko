@props(['post' => []])

<article class="group grid grid-cols-1 sm:grid-cols-[1fr_0.82fr] bg-bg-card border border-border-light">
    <a href="{{ route('journey.show', $post['slug']) }}" class="block overflow-hidden">
        <img
            src="{{ $post['foto'] }}"
            alt="{{ $post['altTeks'] }}"
            loading="lazy"
            width="800" height="450"
            class="w-full h-full aspect-video object-cover transition-transform duration-500 group-hover:scale-[1.03]">
    </a>
    <div class="p-7 md:p-9 flex flex-col justify-center">
        <p class="eyebrow">{{ $post['kategori'] }}</p>
        <h2 class="mt-3 font-heading text-2xl md:text-[28px] leading-tight">
            <a href="{{ route('journey.show', $post['slug']) }}" class="hover:underline decoration-1 underline-offset-4">{{ $post['judul'] }}</a>
        </h2>
        <p class="mt-3 text-sm text-text-muted leading-relaxed line-clamp-3">{{ $post['ringkasan'] }}</p>
        <div class="mt-5 text-xs text-text-soft">
            {{ \Carbon\Carbon::parse($post['tanggal'])->format('d M Y') }} &middot; {{ $post['waktuBaca'] }}
        </div>
        <a href="{{ route('journey.show', $post['slug']) }}" class="mt-4 nav-link text-text-main inline-flex items-center gap-2">
            Baca Selengkapnya
            <x-ui.icon name="arrow-right" class="w-4 h-4 btn-icon" />
        </a>
    </div>
</article>