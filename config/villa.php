<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Villa Site Settings
    |--------------------------------------------------------------------------
    |
    | Static site configuration for Villa Omah Nongko. These values can later be
    | moved to database via Filament Website Settings.
    |
    */

    'identity' => [
        'site_name' => 'Villa Omah Nongko',
        'brand' => 'Omah Nongko',
        'tagline' => 'Private Tropical Villa di Yogyakarta',
        'description' => 'Sebuah villa privat di Yogyakarta yang memadukan arsitektur rumah joglo klasik dengan suasana alam pedesaan yang tenang.',
        'email' => 'info@omahnongko.com',
        'phone' => '+62 812 2868 5538',
        'whatsapp_number' => '6281228685538',
        'whatsapp_default_message' => 'Halo, saya tertarik untuk booking Villa Omah Nongko. Bisa dibantu informasi ketersediaan dan rate-nya?',
        'location_name' => 'Kregan, Umbulmartani, Ngemplak, Sleman, Yogyakarta',
        'address' => 'Unnamed Road, Kregan, Umbulmartani, Ngemplak, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55584',
        'google_maps_url' => 'https://maps.app.goo.gl/hGzN4wS8A5P8Ld1M7',
    ],

    'social' => [
        ['label' => 'Instagram', 'url' => 'https://instagram.com/omahnongko', 'icon' => 'instagram'],
        ['label' => 'Facebook', 'url' => 'https://facebook.com/omahnongko', 'icon' => 'facebook'],
        ['label' => 'TikTok', 'url' => 'https://tiktok.com/@omahnongko', 'icon' => 'tiktok'],
        ['label' => 'YouTube', 'url' => 'https://youtube.com/@omahnongko', 'icon' => 'youtube'],
    ],

    'seo' => [
        'default_keywords' => 'villa jogja, private villa yogyakarta, penginapan sleman, rumah joglo, villa keluarga jogja, omah nongko',
        'default_og_image' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=1200&h=630&fit=crop',
        'twitter_handle' => '@omahnongko',
    ],

    'images' => [
        'hero_home' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=1920&h=1080&fit=crop',
        'hero_villa' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=1920&h=1080&fit=crop',
        'hero_gallery' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1920&h=1080&fit=crop',
        'hero_journey' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1920&h=1080&fit=crop',
        'about_large' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?w=900&h=700&fit=crop',
        'about_small' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=600&h=500&fit=crop',
    ],
];