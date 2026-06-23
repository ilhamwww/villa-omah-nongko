<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Room;
use App\Models\Experience;
use App\Models\Feature;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use App\Models\JourneyCategory;
use App\Models\JourneyPost;
use App\Models\GalleryCategory;

class EnglishTranslationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pages
        $home = Page::where('page_key', 'home')->first();
        if ($home) {
            $home->translationEn()->updateOrCreate(
                ['page_id' => $home->id],
                [
                    'title' => 'Home',
                    'hero_title' => 'Villa Omah Nongko',
                    'hero_description' => "Like a curved leaf in the landscape, Omah Nongko rests quietly on the edge of Yogyakarta's rice fields. Located just north of Sleman and only minutes from Mount Merapi, this private three-bedroom villa blends unique architecture with spacious tropical living.",
                    'seo_title' => 'Villa Omah Nongko — Luxury Tropical Villa in Yogyakarta',
                    'seo_description' => 'Welcome to Villa Omah Nongko. A luxury tropical villa surrounded by nature, designed for tranquility and privacy in Yogyakarta.',
                ]
            );
        }

        $theVilla = Page::where('page_key', 'the-villa')->first();
        if ($theVilla) {
            $theVilla->translationEn()->updateOrCreate(
                ['page_id' => $theVilla->id],
                [
                    'title' => 'The Villa',
                    'hero_title' => 'The Villa',
                    'hero_description' => "Villa Omah Nongko is a private three-bedroom villa that blends unique architecture with spacious tropical living spaces. Designed to harmonize with its surrounding environment, this villa offers ultimate comfort, privacy, and true serenity in Yogyakarta.",
                    'content_blocks' => [
                        'harmoni_title' => 'Living in Harmony with Nature',
                        'harmoni_description' => 'The open-concept living and dining areas invite the beauty of nature inside, while natural materials and hand-crafted details create a warm, timeless atmosphere.',
                        'living_checklist' => [
                            "Open-concept living and dining area",
                            "Modern fully-equipped kitchen",
                            "Large floor-to-ceiling windows",
                            "Natural teak wood materials & Javanese architectural touches"
                        ]
                    ],
                    'seo_title' => 'The Villa — Villa Omah Nongko',
                    'seo_description' => 'Discover the beauty and comfort of Villa Omah Nongko. Private pool, lush tropical garden, and a blend of traditional Javanese architecture in Yogyakarta.',
                ]
            );
        }

        $gallery = Page::where('page_key', 'gallery')->first();
        if ($gallery) {
            $gallery->translationEn()->updateOrCreate(
                ['page_id' => $gallery->id],
                [
                    'title' => 'Gallery',
                    'hero_title' => 'Gallery',
                    'hero_description' => "Explore the beauty of Villa Omah Nongko through our photo gallery. Every corner is carefully designed to blend with nature and create unforgettable moments.",
                    'seo_title' => 'Gallery — Villa Omah Nongko',
                    'seo_description' => 'View the exclusive photo gallery of Villa Omah Nongko, showcasing villa corners, the tropical garden, the private pool, and the surrounding natural beauty.',
                ]
            );
        }

        $journey = Page::where('page_key', 'journey')->first();
        if ($journey) {
            $journey->translationEn()->updateOrCreate(
                ['page_id' => $journey->id],
                [
                    'title' => 'Journey',
                    'hero_title' => 'Journey',
                    'hero_description' => "Stories and inspirations about Yogyakarta. Discover local experiences, travel tips, wellness, and the daily life at Villa Omah Nongko.",
                    'seo_title' => 'Journey — Travel Stories & Daily Life of Villa Omah Nongko',
                    'seo_description' => 'Travel stories, holiday tips, culinary recommendations, and the best travel guides around Sleman and Yogyakarta.',
                ]
            );
        }

        // 2. Rooms
        $room1 = Room::find(1);
        if ($room1) {
            $room1->translationEn()->updateOrCreate(
                ['room_id' => $room1->id],
                [
                    'title' => 'Master Bedroom',
                    'bed_type' => '2 guests · King bed',
                    'short_description' => 'King bed, AC, Hot water, WiFi, Rice field & river view',
                    'description' => 'Our most spacious room features large windows opening directly to rice field views and the soothing sounds of the river. Batik pillows, teak wood flooring, and warm lighting welcome you every night.',
                ]
            );
        }

        $room2 = Room::find(2);
        if ($room2) {
            $room2->translationEn()->updateOrCreate(
                ['room_id' => $room2->id],
                [
                    'title' => 'Bedroom 2',
                    'bed_type' => '2 guests · Queen bed',
                    'short_description' => 'Queen bed, AC, Hot water, WiFi, Garden view',
                    'description' => 'Quiet and private, featuring natural teak wood furniture and subtle batik accents. The window overlooks the villa\'s lush tropical garden.',
                ]
            );
        }

        $room3 = Room::find(3);
        if ($room3) {
            $room3->translationEn()->updateOrCreate(
                ['room_id' => $room3->id],
                [
                    'title' => 'Bedroom 3',
                    'bed_type' => '2–3 guests · Queen bed',
                    'short_description' => 'Queen bed, AC, Hot water, WiFi',
                    'description' => 'Flexible configuration ideal for families, friends, or children. Quick access to the main joglo area and the kitchen.',
                ]
            );
        }

        // 3. Experiences
        $experiences = [
            2 => [
                'title' => 'Close to Universitas Islam Indonesia',
                'description' => 'Enjoy convenient access to Universitas Islam Indonesia (UII) for academic needs, family visits, or business trips.',
            ],
            5 => [
                'title' => 'Kopi Klotok Culinary',
                'description' => 'Experience the authentic rural flavors of Yogyakarta at Kopi Klotok, featuring traditional dishes and a warm, inviting dining atmosphere.',
            ],
            6 => [
                'title' => 'Mbak Pesta Culinary',
                'description' => 'Explore favorite local culinary delights with a rich variety of home-cooked menus that bring a memorable dining experience.',
            ],
            7 => [
                'title' => 'Merapi Jeep Tour',
                'description' => 'Feel the thrill of exploring Yogyakarta\'s nature on an exciting jeep adventure, tracing countryside trails, rivers, and stunning panoramas.',
            ]
        ];

        foreach ($experiences as $id => $data) {
            $exp = Experience::find($id);
            if ($exp) {
                $exp->translationEn()->updateOrCreate(
                    ['experience_id' => $id],
                    $data
                );
            }
        }

        // 4. Features
        $features = [
            3 => ['title' => 'Up to 10', 'subtitle' => 'Guests'],
            5 => ['title' => 'View', 'subtitle' => 'Rice Field & Mt. Merapi'],
            6 => ['title' => 'Wi-Fi', 'subtitle' => 'High Speed'],
            9 => ['title' => 'Lush Garden & Gazebo'],
            10 => ['title' => 'Fully Equipped Kitchen & Modern Appliances'],
            11 => ['title' => 'Air Conditioning in All Bedrooms'],
            12 => ['title' => 'Smart TV & Entertainment'],
            13 => ['title' => 'High-Speed Wi-Fi'],
            14 => ['title' => 'Safety Deposit Box'],
            15 => ['title' => 'Spacious Parking Area'],
            18 => ['title' => 'Up to 10 Guests'],
            20 => ['title' => 'Rice Field & Mt. Merapi View'],
            21 => ['title' => 'Lush Garden & Pavilion'],
            23 => ['title' => 'Lush Garden in Sleman'],
            24 => ['title' => 'Fully Equipped Kitchen'],
            25 => ['title' => 'AC in Every Room'],
            26 => ['title' => 'High-Speed Wi-Fi'],
            28 => ['title' => 'Open-concept living and dining area'],
            29 => ['title' => 'Modern fully-equipped kitchen'],
            1 => ['title' => '3', 'subtitle' => 'Bedrooms'],
            16 => ['title' => '3 Bedrooms'],
        ];

        foreach ($features as $id => $data) {
            $feat = Feature::find($id);
            if ($feat) {
                $feat->translationEn()->updateOrCreate(
                    ['feature_id' => $id],
                    $data
                );
            }
        }

        // 5. Testimonials
        $testimonials = [
            1 => [
                'content' => 'Omah Nongko is even more beautiful in person. The villa is very spacious with a modern joglo concept, sparkling clean, and the staff are incredibly friendly and polite. We felt so comfortable and did not want to leave!',
            ],
            2 => [
                'content' => 'An amazing place for our family vacation in Yogyakarta. The view of the rice fields with Mount Merapi in the background is gorgeous, and the kids absolutely loved the pool.',
            ]
        ];

        foreach ($testimonials as $id => $data) {
            $testi = Testimonial::find($id);
            if ($testi) {
                $testi->translationEn()->updateOrCreate(
                    ['testimonial_id' => $id],
                    $data
                );
            }
        }

        // 6. Website Setting
        $setting = WebsiteSetting::first();
        if ($setting) {
            $setting->translationEn()->updateOrCreate(
                ['website_setting_id' => $setting->id],
                [
                    'tagline' => 'Private Tropical Villa in Yogyakarta',
                    'location_name' => 'Kregan, Umbulmartani, Ngemplak, Sleman, Yogyakarta',
                    'address' => 'Unnamed Road, Kregan, Umbulmartani, Ngemplak, Sleman Regency, Special Region of Yogyakarta 55584',
                    'default_meta_title' => 'Villa Omah Nongko — Private Tropical Villa in Pakem Sleman',
                    'default_meta_description' => 'Villa Omah Nongko is a private family villa in Pakem, Sleman, near Kopi Klotok and Kaliurang. 3 AC bedrooms, joglo, garden, and booking via WhatsApp.',
                    'default_keywords' => 'villa omah nongko, villa near kopi klotok, villa pakem sleman, villa near kaliurang, private villa jogja, family villa jogja, sleman lodging, joglo villa jogja, villa near kaliurang road, villa with garden jogja',
                    'default_og_title' => 'Villa Omah Nongko — Private Tropical Villa in Pakem Sleman',
                    'default_og_description' => 'Villa Omah Nongko is a private family villa in Pakem, Sleman, near Kopi Klotok and Kaliurang. 3 AC bedrooms, joglo, garden, and booking via WhatsApp.',
                ]
            );
        }

        // 7. Journey Categories
        $journeyCategories = [
            1 => [
                'name' => 'Local Guide',
                'description' => 'Local recommendations and guides around the villa.',
            ],
            2 => [
                'name' => 'Wellness & Spa',
                'description' => 'Relaxation and wellness activities at the villa.',
            ],
            3 => [
                'name' => 'Villa Activities',
                'description' => 'Exciting activities you can do inside the villa.',
            ],
            4 => [
                'name' => 'Things to Do',
                'description' => 'Interesting places to visit around Sleman and Yogyakarta.',
            ],
            5 => [
                'name' => 'Yogyakarta Travel Guide',
                'description' => 'Complete travel guide for exploring Yogyakarta.',
            ],
        ];

        foreach ($journeyCategories as $id => $data) {
            $cat = JourneyCategory::find($id);
            if ($cat) {
                $cat->translationEn()->updateOrCreate(
                    ['journey_category_id' => $id],
                    $data
                );
            }
        }

        // 8. Journey Posts
        $journeyPosts = [
            1 => [
                'title' => 'The Beauty of Living in Sleman Countryside & Rice Fields',
                'content' => '<p>Experience the peace of life surrounded by the expanse of Sleman rice fields with fresh mountain air and silence.</p><p>At Villa Omah Nongko, every moment is designed to bring you closer to the beauty of Javanese nature and culture. From the moment you arrive, you will feel the harmony between classic architecture and the lush countryside of Yogyakarta.</p>',
                'featured_image_alt' => 'Green rice fields in Sleman with views of Mount Merapi',
                'seo_title' => 'The Beauty of Living in Sleman Countryside & Rice Fields — Omah Nongko Journey',
                'seo_description' => 'Experience the peace of life surrounded by the expanse of Sleman rice fields with fresh mountain air and silence.',
            ],
            2 => [
                'title' => 'Health & Relaxation Traditional Javanese Massage at the Villa',
                'content' => '<p>Refresh your body and mind with the warmth of wedang jahe and traditional therapist services typical of the Jogja palace.</p><p>At Villa Omah Nongko, every moment is designed to bring you closer to the beauty of Javanese nature and culture. From the moment you arrive, you will feel the harmony between classic architecture and the lush countryside of Yogyakarta.</p>',
                'featured_image_alt' => 'Javanese spa relaxation massage session at Villa Omah Nongko',
                'seo_title' => 'Health & Relaxation Traditional Javanese Massage at the Villa — Omah Nongko Journey',
                'seo_description' => 'Refresh your body and mind with the warmth of wedang jahe and traditional therapist services typical of the Jogja palace.',
            ],
            3 => [
                'title' => 'Dine in Villa: Authentic Flavors of Javanese Cuisine',
                'content' => '<p>Enjoy legendary traditional dishes such as Gudeg Manggar, Bakmi Jawa, and Sate Klatak cooked fresh.</p><p>At Villa Omah Nongko, every moment is designed to bring you closer to the beauty of Javanese nature and culture. From the moment you arrive, you will feel the harmony between classic architecture and the lush countryside of Yogyakarta.</p>',
                'featured_image_alt' => 'Traditional Javanese dinner served on the dining table of Villa Omah Nongko',
                'seo_title' => 'Dine in Villa: Authentic Flavors of Javanese Cuisine — Omah Nongko Journey',
                'seo_description' => 'Enjoy legendary traditional dishes such as Gudeg Manggar, Bakmi Jawa, and Sate Klatak cooked fresh.',
            ],
            5 => [
                'title' => 'Nearest Kaliurang Nature Attractions from the Villa',
                'content' => '<p>Exploring the cool Kaliurang area, Kaliadem bunker, and Mount Merapi Museum which are only a few minutes drive.</p><p>At Villa Omah Nongko, every moment is designed to bring you closer to the beauty of Javanese nature and culture. From the moment you arrive, you will feel the harmony between classic architecture and the lush countryside of Yogyakarta.</p>',
                'featured_image_alt' => 'The beauty of cool trees on the slopes of Kaliurang Sleman',
                'seo_title' => 'Nearest Kaliurang Nature Attractions from the Villa — Omah Nongko Journey',
                'seo_description' => 'Exploring the cool Kaliurang area, Kaliadem bunker, and Mount Merapi Museum which are only a few minutes drive.',
            ],
            6 => [
                'title' => 'Culinary Guide and Aesthetic Coffee Shops in Sleman',
                'content' => '<p>Discover legendary traditional coffee shops like Kopi Klotok and various cafes set against beautiful rice fields in Sleman.</p><p>At Villa Omah Nongko, every moment is designed to bring you closer to the beauty of Javanese nature and culture. From the moment you arrive, you will feel the harmony between classic architecture and the lush countryside of Yogyakarta.</p>',
                'featured_image_alt' => 'Kopi klotok and Sleman Yogyakarta rural culinary',
                'seo_title' => 'Culinary Guide and Aesthetic Coffee Shops in Sleman — Omah Nongko Journey',
                'seo_description' => 'Discover legendary traditional coffee shops like Kopi Klotok and various cafes set against beautiful rice fields in Sleman.',
            ]
        ];

        foreach ($journeyPosts as $id => $data) {
            $post = JourneyPost::find($id);
            if ($post) {
                $post->translationEn()->updateOrCreate(
                    ['journey_post_id' => $id],
                    $data
                );
            }
        }

        // 9. Gallery Categories
        $galleryCategories = [
            1 => [
                'name' => 'Villa Exterior',
                'slug' => 'villa-exterior',
            ],
            2 => [
                'name' => 'Living Areas',
                'slug' => 'living-areas',
            ],
            3 => [
                'name' => 'Bedrooms',
                'slug' => 'bedrooms',
            ],
            5 => [
                'name' => 'Kitchen & Dining',
                'slug' => 'kitchen-dining',
            ],
            6 => [
                'name' => 'Surroundings',
                'slug' => 'surroundings',
            ],
            4 => [
                'name' => 'Garden',
                'slug' => 'pool-garden',
            ],
        ];

        foreach ($galleryCategories as $id => $data) {
            $cat = GalleryCategory::find($id);
            if ($cat) {
                $cat->translationEn()->updateOrCreate(
                    ['gallery_category_id' => $id],
                    $data
                );
            }
        }
    }
}
