@props([
    'title' => config('villa.identity.site_name') . ' — ' . config('villa.identity.tagline'),
    'description' => config('villa.identity.description'),
    'canonical' => url()->current(),
    'ogImage' => config('villa.seo.default_og_image'),
    'schema' => null,
    'footerVariant' => 'light',
])

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#171A11">

    <x-seo.meta
        :title="$title"
        :description="$description"
        :canonical="$canonical"
        :ogImage="$ogImage"
        :schema="$schema"
    />

    {{-- Favicon --}}
    @php
        $setting = \App\Models\WebsiteSetting::first();
        $faviconUrl = $setting && $setting->favicon ? asset('storage/' . $setting->favicon) : '/favicon.svg';
    @endphp
    <link rel="icon" type="image/svg+xml" href="{{ $faviconUrl }}">

    {{-- Preload hero font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body {
            overflow-x: hidden;
        }
        body {
            position: relative
        }
    </style>
</head>
<body class="min-h-screen flex flex-col overflow-x-hidden" x-data="{ mobileMenu: false }">
    {{-- Skip to content for accessibility --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-primary focus:text-white focus:px-4 focus:py-2">
        Langsung ke isi
    </a>

    <x-layouts.header />

    <main id="main-content" class="flex-1">
        {{ $slot }}
    </main>

    <x-layouts.footer :variant="$footerVariant" />

    {{-- Floating WhatsApp button (mobile) --}}
    <a href="{{ \App\Helpers\WhatsAppHelper::link() }}"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Pesan lewat WhatsApp"
       class="fixed bottom-6 right-6 z-40 w-14 h-14 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-lg hover:scale-105 transition-transform lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 24 24"><title xmlns="">baseline-whatsapp</title><path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg>
    </a>

    {{-- Back to top --}}
    <button
        x-data="{ show: false }"
        x-on:scroll.window="show = window.scrollY > 600"
        x-show="show"
        x-cloak
        x-transition
        x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        aria-label="Kembali ke atas"
        class="fixed bottom-6 right-6 z-30 w-14 h-14 bg-primary/80 text-white rounded-md hover:bg-primary shadow-soft transition-colors hidden lg:flex items-center justify-center p-0">
        <x-ui.icon name="arrow-up" class="w-6 h-6 block" />
    </button>
</body>
</html>