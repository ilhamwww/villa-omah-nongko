{{-- Modal lightbox. Membutuhkan Alpine store `lightbox`. --}}
<div
    x-data
    x-show="$store.lightbox.open"
    x-transition.opacity
    x-on:keydown.escape.window="$store.lightbox.close()"
    x-on:keydown.arrow-right.window="$store.lightbox.next()"
    x-on:keydown.arrow-left.window="$store.lightbox.prev()"
    class="fixed inset-0 z-[60] bg-black/90 flex items-center justify-center"
    style="display: none;"
    role="dialog"
    aria-modal="true"
    aria-label="Galeri Foto">

    {{-- Tutup --}}
    <button type="button" x-on:click="$store.lightbox.close()" aria-label="Tutup galeri"
            class="absolute top-5 right-5 text-white/80 hover:text-white">
        <x-ui.icon name="close" class="w-7 h-7" />
    </button>

    {{-- Sebelumnya --}}
    <button type="button" x-on:click="$store.lightbox.prev()" aria-label="Foto sebelumnya"
            class="absolute left-4 md:left-8 text-white/70 hover:text-white">
        <x-ui.icon name="arrow-left" class="w-8 h-8" />
    </button>

    {{-- Gambar --}}
    <figure class="max-w-[90vw] max-h-[85vh] flex flex-col items-center">
        <img :src="$store.lightbox.currentSrc()" :alt="$store.lightbox.currentAlt()"
             class="max-w-full max-h-[80vh] object-contain">
        <figcaption class="mt-3 text-white/70 text-sm text-center" x-text="$store.lightbox.currentAlt()"></figcaption>
    </figure>

    {{-- Berikutnya --}}
    <button type="button" x-on:click="$store.lightbox.next()" aria-label="Foto berikutnya"
            class="absolute right-4 md:right-8 text-white/70 hover:text-white">
        <x-ui.icon name="arrow-right" class="w-8 h-8" />
    </button>
</div>