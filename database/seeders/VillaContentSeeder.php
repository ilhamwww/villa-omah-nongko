<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebsiteSetting;
use App\Models\Page;
use App\Models\Feature;
use App\Models\Room;
use App\Models\Experience;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\Testimonial;
use App\Models\JourneyCategory;
use App\Models\JourneyPost;
use Illuminate\Support\Str;

class VillaContentSeeder extends Seeder
{
    public function run(): void
    {
        // ---------------------------------------------------------------
        // Website Settings
        // ---------------------------------------------------------------
        $setting = WebsiteSetting::first() ?? new WebsiteSetting();
        $setting->fill([
            'name' => 'Villa Omah Nongko',
            'site_name' => 'Villa Omah Nongko',
            'tagline' => 'Private Tropical Villa di Yogyakarta',
            'whatsapp_number' => '6281228685538',
            'whatsapp_default_message' => 'Halo, saya tertarik untuk booking Villa Omah Nongko. Bisa dibantu informasi ketersediaan dan rate-nya?',
            'email' => 'info@omahnongko.com',
            'phone' => '+62 812 2868 5538',
            'location_name' => 'Kregan, Umbulmartani, Ngemplak, Sleman, Yogyakarta',
            'address' => 'Unnamed Road, Kregan, Umbulmartani, Ngemplak, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55584',
            'google_maps_url' => 'https://maps.app.goo.gl/hGzN4wS8A5P8Ld1M7',
            'default_meta_title' => 'Villa Omah Nongko — Private Tropical Villa di Yogyakarta',
            'default_meta_description' => 'Sebuah villa privat di Yogyakarta yang memadukan arsitektur rumah joglo klasik dengan suasana alam pedesaan yang tenang.',
            'default_keywords' => 'villa jogja, private villa yogyakarta, penginapan sleman, rumah joglo, villa keluarga jogja, omah nongko',
            'social_links' => [
                'instagram' => 'https://instagram.com/omahnongko',
                'facebook' => 'https://facebook.com/omahnongko',
                'tiktok' => 'https://tiktok.com/@omahnongko',
                'youtube' => 'https://youtube.com/@omahnongko',
            ],
        ])->save();

        // ---------------------------------------------------------------
        // Pages
        // ---------------------------------------------------------------
        Page::updateOrCreate(['page_key' => 'home'], [
            'title' => 'Home',
            'slug' => 'home',
            'hero_title' => 'Villa Omah Nongko',
            'hero_description' => "Seperti sehelai daun melengkung di bentang alam, Omah Nongko bersandar tenang di tepi sawah Yogyakarta. Terletak tepat di utara Sleman dan hanya beberapa menit dari Gunung Merapi, villa privat tiga kamar ini memadukan arsitektur unik dengan ruang tamu tropis yang luas.",
            'hero_image' => null,
            'hero_image_alt' => 'Villa Omah Nongko dengan taman tropis di Sleman Yogyakarta',
            'seo_title' => 'Villa Omah Nongko — Luxury Tropical Villa in Yogyakarta',
            'seo_description' => 'Welcome to Villa Omah Nongko. A luxury tropical villa surrounded by nature, designed for tranquility and privacy in Yogyakarta.',
            'status' => 'published',
        ]);
        Page::updateOrCreate(['page_key' => 'the-villa'], [
            'title' => 'The Villa',
            'slug' => 'the-villa',
            'hero_title' => 'The Villa',
            'hero_description' => 'Villa Omah Nongko adalah villa privat dengan tiga kamar tidur yang memadukan arsitektur unik dengan ruang tamu tropis yang luas. Dirancang untuk selaras dengan lingkungan sekitarnya, villa ini menawarkan kenyamanan, privasi, dan ketenangan sejati di Yogyakarta.',
            'hero_image' => null,
            'hero_image_alt' => 'Tampak eksterior Villa Omah Nongko dengan kolam dan taman tropis',
            'content_blocks' => [
                'harmoni_title' => 'Hidup Selaras dengan Alam',
                'harmoni_description' => 'Ruang tamu dan ruang makan terbuka mengundang keindahan alam masuk, sementara material alami dan detail kerajinan tangan menciptakan suasana hangat yang tak lekang oleh waktu.',
                'living_checklist' => [
                    ['item' => 'Ruang tamu dan ruang makan konsep terbuka'],
                    ['item' => 'Dapur modern dengan peralatan lengkap'],
                    ['item' => 'Jendela besar dari lantai hingga langit-langit'],
                    ['item' => 'Material kayu jati alami & sentuhan arsitektur Jawa'],
                ],
            ],
            'seo_title' => 'The Villa — Villa Omah Nongko',
            'seo_description' => 'Temukan keindahan dan kenyamanan Villa Omah Nongko. Taman tropis asri, dan perpaduan arsitektur tradisional Jawa di Yogyakarta.',
            'status' => 'published',
        ]);
        Page::updateOrCreate(['page_key' => 'gallery'], [
            'title' => 'Gallery',
            'slug' => 'gallery',
            'hero_title' => 'Gallery',
            'hero_description' => 'Jelajahi keindahan Villa Omah Nongko melalui galeri foto kami. Setiap sudut dirancang dengan cermat untuk menyatu dengan alam dan menciptakan momen yang tak terlupakan.',
            'hero_image' => null,
            'hero_image_alt' => 'Galeri foto Villa Omah Nongko dengan kolam dan taman asri',
            'seo_title' => 'Gallery — Villa Omah Nongko',
            'seo_description' => 'Lihat galeri foto eksklusif Villa Omah Nongko yang menampilkan sudut villa, taman tropis, serta keindahan alam sekitarnya.',
            'status' => 'published',
        ]);
        Page::updateOrCreate(['page_key' => 'journey'], [
            'title' => 'Journey',
            'slug' => 'journey',
            'hero_title' => 'Journey',
            'hero_description' => 'Cerita dan inspirasi seputar Yogyakarta. Temukan pengalaman lokal, tips perjalanan, kebugaran, dan keseharian kehidupan villa di Omah Nongko.',
            'hero_image' => null,
            'hero_image_alt' => 'Suasana Villa Omah Nongko untuk artikel dan cerita perjalanan Jogja',
            'seo_title' => 'Journey — Artikel Perjalanan & Keseharian Villa Omah Nongko',
            'seo_description' => 'Cerita perjalanan, tips liburan, rekomendasi kuliner, dan panduan wisata terbaik di sekitar Sleman dan Yogyakarta.',
            'status' => 'published',
        ]);

        // ---------------------------------------------------------------
        // Features (grouped by page_key)
        // ---------------------------------------------------------------
        $featureGroups = config('villa_content');

        // Clean existing features
        Feature::truncate();

        foreach (['quick_facts', 'amenities', 'villa_features', 'feature_strip', 'living_checklist'] as $pageKey) {
            $items = $featureGroups[$pageKey] ?? [];
            foreach ($items as $i => $item) {
                if (is_string($item)) {
                    $item = ['title' => $item, 'icon' => 'check'];
                } else if (!isset($item['title'])) {
                    $item['title'] = $item['label'] ?? '';
                }

                Feature::create([
                    'page_key' => $pageKey,
                    'title' => $item['title'],
                    'icon' => $item['icon'] ?? null,
                    'subtitle' => $item['subtitle'] ?? null,
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ]);
            }
        }

        // ---------------------------------------------------------------
        // Rooms / Suites
        // ---------------------------------------------------------------
        Room::truncate();
        foreach ($featureGroups['rooms'] as $i => $r) {
            Room::create([
                'title' => $r['title'],
                'slug' => Str::slug($r['title']),
                'image' => $r['image'] ?? null,
                'image_alt' => $r['alt'] ?? '',
                'bed_type' => $r['bed'] ?? '',
                'description' => $r['description'] ?? '',
                'short_description' => $r['features'] ?? '',
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }

        // ---------------------------------------------------------------
        // Experiences
        // ---------------------------------------------------------------
        Experience::truncate();
        foreach ($featureGroups['experiences'] as $i => $e) {
            Experience::create([
                'title' => $e['title'],
                'slug' => Str::slug($e['title']),
                'description' => $e['description'] ?? null,
                'icon' => $e['icon'] ?? null,
                'image' => $e['image'] ?? null,
                'image_alt' => $e['alt'] ?? '',
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }

        // ---------------------------------------------------------------
        // Gallery Categories + Images
        // ---------------------------------------------------------------
        GalleryCategory::truncate();
        GalleryImage::truncate();
        $catIndex = 0;
        foreach ($featureGroups['gallery_categories'] as $cat) {
            $catIndex++;
            $category = GalleryCategory::create([
                'slug' => $cat['slug'],
                'name' => $cat['name'],
                'sort_order' => $catIndex,
                'is_active' => true,
            ]);

            foreach ($cat['images'] as $i => $img) {
                GalleryImage::create([
                    'gallery_category_id' => $category->id,
                    'image' => $img['src'],
                    'title' => $img['alt'],
                    'alt_text' => $img['alt'],
                    'sort_order' => $i + 1,
                    'is_featured' => $i === 0,
                    'is_active' => true,
                ]);
            }
        }

        // ---------------------------------------------------------------
        // Testimonials
        // ---------------------------------------------------------------
        Testimonial::truncate();
        foreach ($featureGroups['testimonials'] as $i => $t) {
            Testimonial::create([
                'name' => $t['name'],
                'country_or_role' => $t['country'],
                'content' => $t['content'],
                'rating' => $t['rating'],
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }

        // ---------------------------------------------------------------
        // Journey Categories
        // ---------------------------------------------------------------
        JourneyCategory::truncate();
        foreach ($featureGroups['journey_categories'] as $i => $jc) {
            if ($jc['slug'] === 'all') continue;
            JourneyCategory::create([
                'slug' => $jc['slug'],
                'name' => $jc['name'],
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }

        // ---------------------------------------------------------------
        // Journey Posts
        // ---------------------------------------------------------------
        JourneyPost::truncate();
        foreach ($featureGroups['journey_posts'] as $i => $p) {
            $categoryId = JourneyCategory::where('slug', $p['category_slug'])->first()?->id;
            JourneyPost::create([
                'slug' => $p['slug'],
                'journey_category_id' => $categoryId,
                'title' => $p['title'],
                'excerpt' => $p['excerpt'],
                'content' => '<p>' . $p['excerpt'] . '</p><p>Di Villa Omah Nongko, setiap momen dirancang untuk membawa Anda lebih dekat pada keindahan alam dan budaya Jawa. Sejak Anda tiba, Anda akan merasakan harmoni antara arsitektur klasik dan rindangnya alam pedesaan Yogyakarta.</p>',
                'featured_image' => $p['image'] ?? $p['featured_image'] ?? '',
                'featured_image_alt' => $p['alt'] ?? $p['featured_image_alt'] ?? '',
                'author_name' => 'Omah Nongko',
                'status' => 'published',
                'published_at' => $p['date'] ?? '2024-05-12',
                'reading_time' => (int) filter_var($p['reading_time'], FILTER_SANITIZE_NUMBER_INT),
                'is_popular' => $p['is_popular'] ?? false,
                'sort_order' => $i + 1,
                'seo_title' => $p['title'] . ' — Omah Nongko Journey',
                'seo_description' => $p['excerpt'],
            ]);
        }
    }
}