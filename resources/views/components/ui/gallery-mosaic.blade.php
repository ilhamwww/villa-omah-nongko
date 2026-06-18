@props([
    'images' => [],
    'layout' => 'a',
])

@php
    $main = $images[0] ?? null;
    $rest = array_slice($images, 1);
@endphp

<div class="grid grid-cols-1 md:grid-cols-[1.15fr_1fr] gap-2">
    {{-- Large left image --}}
    @if($main)
        <button type="button"
                x-on:click="openLightbox({{ json_encode(array_column($images, 'src')) }}, {{ json_encode(array_column($images, 'alt')) }}, 0)"
                class="group block overflow-hidden relative">
            <img src="{{ $main['src'] }}" alt="{{ $main['alt'] }}"
                 loading="lazy" width="900" height="560"
                 class="w-full h-full aspect-[16/10] object-cover transition-transform duration-500 group-hover:scale-[1.03]">
            <span class="absolute inset-0 bg-black/0 group-hover:bg-black/15 transition-colors"></span>
        </button>
    @endif

    {{-- Small grid right --}}
    <div class="grid grid-cols-2 gap-2">
        @foreach($rest as $i => $img)
            <button type="button"
                    x-on:click="openLightbox({{ json_encode(array_column($images, 'src')) }}, {{ json_encode(array_column($images, 'alt')) }}, {{ $i + 1 }})"
                    class="group block overflow-hidden relative">
                <img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"
                     loading="lazy" width="500" height="320"
                     class="w-full h-full aspect-[16/10] object-cover transition-transform duration-500 group-hover:scale-[1.03]">
                <span class="absolute inset-0 bg-black/0 group-hover:bg-black/15 transition-colors"></span>
            </button>
        @endforeach
    </div>
</div>