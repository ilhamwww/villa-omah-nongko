@props([
    'title' => '',
    'description' => null,
    'image' => '',
    'imageAlt' => '',
    'ctaLabel' => null,
    'ctaUrl' => null,
    'eager' => true,
    'isHome' => false,
])

<section class="relative {{ $isHome ? 'flex items-center min-h-[100dvh]' : 'flex items-end min-h-[60dvh] md:min-h-[70dvh]' }} overflow-hidden" style="padding-top: 160px;">
    {{-- Background image --}}
    <img
        src="{{ $image }}"
        alt="{{ $imageAlt }}"
        @if($eager) fetchpriority="high" @else loading="lazy" @endif
        width="1920" height="1080"
        class="absolute inset-0 w-full h-full object-cover">

    {{-- Overlay --}}
    <div class="absolute inset-0 z-[1]" style="background: linear-gradient(90deg, rgba(0,0,0,0.72) 0%, rgba(0,0,0,0.42) 42%, rgba(0,0,0,0.26) 100%);"></div>

    {{-- Content --}}
    <div class="relative z-[2] container-site w-full pb-12 md:pb-16">
        <div class="max-w-xl text-white">
            <h1 style="color: white" class="reveal-slide-up {{ $isHome ? 'font-sparkle font-normal tracking-normal text-6xl md:text-[80px] lg:text-[100px] normal-case leading-none' : 'font-heading text-5xl md:text-6xl lg:text-7xl leading-[1.05]' }}">{!! $title !!}</h1>
            @if($description)
                <p class="mt-5 text-sm md:text-base leading-relaxed text-white/85 max-w-md reveal-slide-up delay-200">{{ $description }}</p>
            @endif
            @if($ctaLabel && $ctaUrl)
                <div class="reveal-slide-up delay-300">
                    <a href="{{ $ctaUrl }}" class="btn-outline-light mt-8 inline-flex items-center gap-2">
                        {{ $ctaLabel }}
                        <x-ui.icon name="arrow-right" class="w-4 h-4 btn-icon" />
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>