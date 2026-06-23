<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Pages English Translation Table
        Schema::create('pages_en', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $blueprint->string('title')->nullable();
            $blueprint->string('hero_title')->nullable();
            $blueprint->text('hero_description')->nullable();
            $blueprint->json('content_blocks')->nullable();
            $blueprint->string('seo_title')->nullable();
            $blueprint->text('seo_description')->nullable();
            $blueprint->string('seo_keywords')->nullable();
            $blueprint->timestamps();
        });

        // 2. Rooms English Translation Table
        Schema::create('rooms_en', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $blueprint->string('title')->nullable();
            $blueprint->string('slug')->nullable();
            $blueprint->string('bed_type')->nullable();
            $blueprint->text('short_description')->nullable();
            $blueprint->text('description')->nullable();
            $blueprint->string('button_label')->nullable();
            $blueprint->string('button_url')->nullable();
            $blueprint->string('image_alt')->nullable();
            $blueprint->timestamps();
        });

        // 3. Experiences English Translation Table
        Schema::create('experiences_en', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('experience_id')->constrained('experiences')->onDelete('cascade');
            $blueprint->string('title')->nullable();
            $blueprint->string('slug')->nullable();
            $blueprint->text('description')->nullable();
            $blueprint->string('image_alt')->nullable();
            $blueprint->timestamps();
        });

        // 4. Features English Translation Table
        Schema::create('features_en', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('feature_id')->constrained('features')->onDelete('cascade');
            $blueprint->string('title')->nullable();
            $blueprint->string('subtitle')->nullable();
            $blueprint->text('description')->nullable();
            $blueprint->timestamps();
        });

        // 5. Testimonials English Translation Table
        Schema::create('testimonials_en', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('testimonial_id')->constrained('testimonials')->onDelete('cascade');
            $blueprint->string('country_or_role')->nullable();
            $blueprint->text('content')->nullable();
            $blueprint->timestamps();
        });

        // 6. Journey Categories English Translation Table
        Schema::create('journey_categories_en', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('journey_category_id')->constrained('journey_categories')->onDelete('cascade');
            $blueprint->string('name')->nullable();
            $blueprint->string('slug')->nullable();
            $blueprint->text('description')->nullable();
            $blueprint->timestamps();
        });

        // 7. Journey Posts English Translation Table
        Schema::create('journey_posts_en', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('journey_post_id')->constrained('journey_posts')->onDelete('cascade');
            $blueprint->string('title')->nullable();
            $blueprint->string('slug')->nullable();
            $blueprint->longText('content')->nullable();
            $blueprint->string('seo_title')->nullable();
            $blueprint->text('seo_description')->nullable();
            $blueprint->string('seo_keywords')->nullable();
            $blueprint->timestamps();
        });

        // 8. Website Settings English Translation Table
        Schema::create('website_settings_en', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('website_setting_id')->constrained('website_settings')->onDelete('cascade');
            $blueprint->string('name')->nullable();
            $blueprint->string('site_name')->nullable();
            $blueprint->string('tagline')->nullable();
            $blueprint->text('whatsapp_default_message')->nullable();
            $blueprint->string('location_name')->nullable();
            $blueprint->text('address')->nullable();
            $blueprint->string('default_meta_title')->nullable();
            $blueprint->text('default_meta_description')->nullable();
            $blueprint->string('default_keywords')->nullable();
            $blueprint->string('default_og_title')->nullable();
            $blueprint->text('default_og_description')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings_en');
        Schema::dropIfExists('journey_posts_en');
        Schema::dropIfExists('journey_categories_en');
        Schema::dropIfExists('testimonials_en');
        Schema::dropIfExists('features_en');
        Schema::dropIfExists('experiences_en');
        Schema::dropIfExists('rooms_en');
        Schema::dropIfExists('pages_en');
    }
};