@props([
    'icon' => 'leaf',
    'title' => null,
    'subtitle' => null,
    'label' => null,
])

<div class="flex flex-col items-center text-center">
    <x-ui.icon :name="$icon" class="w-7 h-7 text-text-main opacity-75" />
    @if($label)
        <span class="mt-3 text-[13px] leading-snug text-text-main">{{ $label }}</span>
    @else
        <span class="mt-3 text-[13px] leading-snug text-text-main">
            <span class="block">{{ $title }}</span>
            @if($subtitle)<span class="block text-text-muted">{{ $subtitle }}</span>@endif
        </span>
    @endif
</div>