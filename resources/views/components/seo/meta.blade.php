@props([
    'title' => config('villa.identity.site_name'),
    'description' => config('villa.identity.description'),
    'canonical' => url()->current(),
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => config('villa.seo.default_og_image'),
    'twitterTitle' => null,
    'twitterDescription' => null,
    'twitterImage' => null,
    'robots' => 'index, follow',
    'schema' => null,
])

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $ogTitle ?? $title }}">
<meta property="og:description" content="{{ $ogDescription ?? $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:site_name" content="{{ config('villa.identity.site_name') }}">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $twitterTitle ?? $ogTitle ?? $title }}">
<meta name="twitter:description" content="{{ $twitterDescription ?? $ogDescription ?? $description }}">
<meta name="twitter:image" content="{{ $twitterImage ?? $ogImage }}">

{{-- Schema JSON-LD --}}
@if($schema)
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif