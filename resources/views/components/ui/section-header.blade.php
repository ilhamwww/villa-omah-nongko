@props([
    'eyebrow' => null,
    'heading' => '',
    'link' => null,
    'linkLabel' => null,
    'align' => 'left',
])

<div class="flex flex-col {{ $align === 'center' ? 'items-center text-center' : 'sm:flex-row sm:items-end sm:justify-between' }} gap-4">
    <div class="{{ $align === 'center' ? 'max-w-2xl' : '' }}">
        @if($eyebrow)
            <p class="eyebrow">{{ $eyebrow }}</p>
        @endif
        <h2 class="mt-3 font-heading text-3xl md:text-4xl lg:text-[42px] leading-tight">{{ $heading }}</h2>
        @if($slot->isNotEmpty())
            <div class="mt-4 text-text-muted text-sm md:text-base leading-relaxed">{{ $slot }}</div>
        @endif
    </div>
    @if($link && $linkLabel)
        <a href="{{ $link }}" class="nav-link text-text-main shrink-0 inline-flex items-center gap-2 group">
            {{ $linkLabel }}
            <x-ui.icon name="arrow-right" class="w-4 h-4 btn-icon" />
        </a>
    @endif
</div>