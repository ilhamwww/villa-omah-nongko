<?php

namespace App\Helpers;

class IconHelper
{
    public static $svgs = [
        'bed' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M3 18V8m0 6h18m0 4V12a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v2"/><circle cx="8" cy="12" r="1.4" stroke-width="1.6"/>',
        'bath' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M3 12h18v3a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-3Zm3 0V7a2 2 0 1 1 4 0M4 19l-1 2m18-2 1 2"/>',
        'users' => '<circle cx="9" cy="9" r="3" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" d="M15 11a2.5 2.5 0 1 0 0-5M3 19a6 6 0 0 1 12 0m6 0a5 5 0 0 0-5-5"/>',
        'pool' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M2 18c1.5 0 1.5 1 3 1s1.5-1 3-1 1.5 1 3 1 1.5-1 3-1 1.5 1 3 1 1.5-1 3-1M7 14V6a2 2 0 1 1 4 0M13 14V6a2 2 0 1 1 4 0M7 10h10"/>',
        'view' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M2 20h20M3 20l4-7 3 4 4-8 7 11"/><circle cx="17" cy="6" r="2" stroke-width="1.6"/>',
        'wifi' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M2 9a16 16 0 0 1 20 0M5 13a10 10 0 0 1 14 0M8 17a4 4 0 0 1 8 0"/><circle cx="12" cy="20" r="0.8" fill="currentColor"/>',
        'clean' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M14 3 11 10l5 2 1 9H7l1-9 5-2-3-7Zm-4 7L4 21M16 12l4 9"/>',
        'leaf' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M4 20c0-9 7-16 16-16-1 9-6 14-12 15M9 15l11-11"/>',
        'kitchen' => '<rect x="4" y="4" width="16" height="16" rx="1" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" d="M4 10h16M9 7h.01M9 16v-3"/>',
        'ac' => '<rect x="3" y="6" width="18" height="8" rx="2" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" d="M7 18v2m5-2v2m5-2v2"/>',
        'tv' => '<rect x="3" y="5" width="18" height="12" rx="2" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" d="M9 21h6"/>',
        'safe' => '<rect x="4" y="4" width="16" height="16" rx="1" stroke-width="1.6"/><circle cx="14" cy="12" r="3" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" d="M14 9V7M4 12h2"/>',
        'parking' => '<rect x="4" y="4" width="16" height="16" rx="2" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" d="M10 17V8h3.5a2.5 2.5 0 0 1 0 5H10"/>',
        'dining' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M5 3v8a2 2 0 0 0 2 2v8M7 7h0M19 3c-2 0-3 2-3 5s1 5 3 5M19 3v18"/>',
        'spa' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M12 22c0-6 4-10 10-10-2 5-5 8-10 10Zm0 0c0-6-4-10-10-10 2 5 5 8 10 10ZM12 12V4m-3 3 3-3 3 3"/>',
        'tour' => '<circle cx="12" cy="12" r="9" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',

        // Contextual tropical villa icons
        'rice-field' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M2 20h20M4 20c0-4 2-7 5-9M8 20c0-3 1.5-6 4-8M12 20c0-3 1-5 3-7M16 20c0-2 .5-4 2-5"/><circle cx="6" cy="8" r="1.2" stroke-width="1.4"/><circle cx="11" cy="6" r="1.2" stroke-width="1.4"/><circle cx="16" cy="5" r="1.2" stroke-width="1.4"/><path stroke-width="1.4" stroke-linecap="round" d="M6 9.2V11M11 7.2V9M16 6.2V8"/>',
        'spray' => '<rect x="8" y="8" width="8" height="13" rx="1" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" d="M10 8V5h4v3M12 5V3M3 5l2 2M3 8h3M3 11l2-1M21 5l-2 2M21 8h-3M21 11l-2-1"/>',
        'pool-lounger' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M2 16h20M4 16v-3l3-5h2l-1 3h6l4-3h2l-3 5v3"/><path stroke-width="1.6" stroke-linecap="round" d="M2 19c2 0 2 1 4 1s2-1 4-1 2 1 4 1 2-1 4-1 2 1 4 1"/>',
        'palm' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M12 22V10M12 10c-3-4-8-4-9-2 3 0 6 1 9 2ZM12 10c3-4 8-4 9-2-3 0-6 1-9 2ZM12 13c-2-3-6-4-7-2 2 0 5 1 7 2ZM12 13c2-3 6-4 7-2-2 0-5 1-7 2Z"/>',
        'shield' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v5c0 5 3.5 8.5 8 10 4.5-1.5 8-5 8-10V6l-8-3Z"/><path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4"/>',
        'car' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M5 17h14l-1.5-6H6.5L5 17ZM5 17v2h2v-2M17 17v2h2v-2"/><circle cx="7.5" cy="17" r="1.2" stroke-width="1.4"/><circle cx="16.5" cy="17" r="1.2" stroke-width="1.4"/><path stroke-width="1.6" stroke-linecap="round" d="M6.5 11 8 7h8l1.5 4"/>',
        'lotus' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M12 20c-4 0-7-2-7-5 2 0 4 1 7 5ZM12 20c4 0 7-2 7-5-2 0-4 1-7 5Z"/><path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M12 20c-2-3-3-7 0-12 3 5 2 9 0 12Z"/><path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M12 15c-3-2-5-5-4-9 4 1 5 5 4 9ZM12 15c3-2 5-5 4-9-4 1-5 5-4 9Z"/>',
        'chef-hat' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M6 15h12v6H6zM6 15c-2 0-3-1.5-3-3.5S4.5 7 7 7c0-2.5 2-4 5-4s5 1.5 5 4c2.5 0 4 2 4 4.5S19.5 15 18 15"/><path stroke-width="1.6" stroke-linecap="round" d="M9 18h6"/>',
        'hands-spa' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M7 17c-2-1-4-3-4-6 0-2 1-3 2.5-3S8 9.5 8 11M17 17c2-1 4-3 4-6 0-2-1-3-2.5-3S16 9.5 16 11"/><path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M8 11c0 3 1.5 5 4 6 2.5-1 4-3 4-6"/><path stroke-width="1.6" stroke-linecap="round" d="M12 8V4M10 5l2-2 2 2"/>',
        'compass' => '<circle cx="12" cy="12" r="9" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="m14.5 9.5-3 5.5-3-5.5 3-5.5 3 5.5Z"/><circle cx="12" cy="12" r="1" fill="currentColor"/>',
        'sunrise' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M2 18h20M12 12V8M8 14l-2-2M16 14l2-2M5 18c0-4 3-7 7-7s7 3 7 7"/><path stroke-width="1.6" stroke-linecap="round" d="M6 10l-1-1M18 10l1-1M12 6V4"/>',
        'whatsapp' => '<path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/>',
        'instagram' => '<rect x="3" y="3" width="18" height="18" rx="4" stroke-width="1.6"/><circle cx="12" cy="12" r="4" stroke-width="1.6"/><circle cx="17.5" cy="6.5" r="0.8" fill="currentColor"/>',
        'facebook' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M14 7h2V4h-2.5A3.5 3.5 0 0 0 10 7.5V10H8v3h2v8h3v-8h2.5l.5-3H13V8c0-.6.4-1 1-1Z"/>',
        'tiktok' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M14 4v10.5a3.5 3.5 0 1 1-3.5-3.5M14 4c.5 2 2 3.5 4 3.5"/>',
        'youtube' => '<rect x="3" y="6" width="18" height="12" rx="3" stroke-width="1.6"/><path d="m11 9 4 3-4 3z" fill="currentColor"/>',
        'star' => '<path d="m12 2 3 6.5 7 1-5 5 1.2 7L12 18l-6.2 3.5L7 14.5l-5-5 7-1z" fill="currentColor"/>',
        'phone' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M22 16.5v3a2 2 0 0 1-2 2 19 19 0 0 1-18-18 2 2 0 0 1 2-2h3a1 1 0 0 1 1 .9c.1 1 .3 2 .6 2.9a1 1 0 0 1-.2 1L7 7.5a16 16 0 0 0 7 7l1.2-1.4a1 1 0 0 1 1-.2c1 .3 2 .5 3 .6a1 1 0 0 1 .9 1Z"/>',
        'email' => '<rect x="3" y="5" width="18" height="14" rx="2" stroke-width="1.6"/><path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6"/>',
        'pin' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M12 22s7-7 7-12a7 7 0 1 0-14 0c0 5 7 12 7 12Z"/><circle cx="12" cy="10" r="2.5" stroke-width="1.6"/>',
        'check' => '<path stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4 10-10"/>',
    ];

    public static function getSvgPath(?string $icon): string
    {
        return self::$svgs[$icon] ?? '';
    }

    public static function getOptions(): array
    {
        return [
            'bed' => 'Bed',
            'bath' => 'Bath',
            'users' => 'Guests',
            'pool' => 'Pool & Jacuzzi',
            'view' => 'View',
            'wifi' => 'Wi-Fi',
            'clean' => 'Daily Housekeeping',
            'leaf' => 'Leaf / Tropical Garden',
            'kitchen' => 'Fully Equipped Kitchen',
            'ac' => 'Air Conditioning',
            'tv' => 'Smart TV',
            'safe' => 'Safety Box',
            'parking' => 'Parking Area',
            'dining' => 'Dining / Restaurant',
            'spa' => 'Spa & Massage',
            'tour' => 'Day Tours',
            'rice-field' => 'Rice Field View',
            'spray' => 'Housekeeping Spray',
            'pool-lounger' => 'Pool Lounger',
            'palm' => 'Palm / Tropical',
            'shield' => 'Shield / Security',
            'car' => 'Car / Parking',
            'lotus' => 'Lotus / Wellness',
            'chef-hat' => 'Chef Hat / Private Dining',
            'hands-spa' => 'Hands Spa / Massage',
            'compass' => 'Compass / Explore',
            'sunrise' => 'Sunrise / Morning',
            'check' => 'Checkmark / Standard',
        ];
    }

    public static function getHtmlOptions(): array
    {
        $options = [];
        foreach (self::getOptions() as $key => $label) {
            $svgPath = self::getSvgPath($key);
            $options[$key] = "<div class=\"flex items-center gap-3 w-full\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" class=\"w-5 h-5 text-primary-500 shrink-0\" style=\"width: 1.25rem; height: 1.25rem; flex-shrink: 0;\">{$svgPath}</svg><span>{$label}</span></div>";
        }
        return $options;
    }
}
