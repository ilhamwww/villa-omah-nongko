# PRD.md — Website Villa “Omah Nongko”

> Dokumen ini dibuat berdasarkan `DESIGN.md` yang berisi referensi desain halaman **Home**, **The Villa**, **Gallery**, dan **Journal/Blog**. Project menggunakan **Laravel + Filament** yang saat ini masih kosong, sudah bisa login, dan sudah memiliki modul **Users**. Pengembangan dimulai dari **frontend terlebih dahulu**, lalu dilanjutkan ke **admin Filament** untuk manajemen konten dan SEO.

---

## 1. Ringkasan Produk

Website ini adalah website villa premium dengan gaya visual **luxury tropical editorial**. Fokus utama website adalah menampilkan villa, suasana, fasilitas, gallery foto, pengalaman menginap, dan artikel Journey/Blog yang kuat untuk SEO.

Website **tidak memiliki fitur transaksi internal**. Semua proses booking, tanya harga, dan reservasi diarahkan ke **WhatsApp**.

Halaman frontend utama:

1. **Home Page**
2. **The Villa**
3. **Gallery**
4. **Journey / Blog**
5. **Journey Detail / Blog Detail**

Catatan istilah:

- Di referensi desain, halaman blog menggunakan label **Journal**.
- Dalam project ini, sesuai request, label yang digunakan adalah **Journey (Blog)**.
- Route utama disarankan memakai `/journey` agar konsisten.

---

## 2. Tujuan Utama

### 2.1 Tujuan Bisnis

- Menampilkan villa secara premium, profesional, dan meyakinkan.
- Menonjolkan foto villa, kolam, taman, kamar, ruang living, kitchen, dining, dan surroundings.
- Memudahkan calon tamu memahami karakter villa sebelum menghubungi via WhatsApp.
- Mengarahkan semua CTA booking ke WhatsApp.
- Menjadikan Journey/Blog sebagai sumber traffic organik melalui SEO.
- Memudahkan admin mengubah konten website melalui Filament.

### 2.2 Tujuan Teknis

- Frontend sesuai detail visual pada `DESIGN.md`.
- Struktur Laravel rapi, mudah dikembangkan, dan reusable.
- Konten frontend awal boleh static, tetapi strukturnya harus siap dipindah ke database.
- Admin Filament dibuat setelah frontend selesai dan stabil.
- Semua halaman memiliki SEO teknis lengkap.
- Target skor final **Lighthouse SEO: 100**.

### 2.3 Batasan Penting SEO

Target “SEO perfect 100%” di project ini berarti:

- Target skor **100 pada Lighthouse SEO**.
- HTML semantic dan mudah di-crawl.
- Meta title, meta description, canonical, Open Graph, Twitter Card, alt image, dan schema tersedia.
- Journey/Blog sangat dioptimalkan untuk artikel dan internal linking.

Catatan: SEO teknis 100 tidak menjamin ranking nomor 1 di Google, karena ranking juga dipengaruhi kualitas konten, kompetisi keyword, backlink, umur domain, authority, dan perilaku pengguna.

---

## 3. Scope Project

### 3.1 Scope Frontend Tahap Pertama

Frontend dibuat terlebih dahulu dengan urutan:

1. Setup layout global, design token, font, warna, spacing.
2. Header, footer, dan helper CTA WhatsApp global.
3. Home Page.
4. The Villa Page.
5. Gallery Page.
6. Journey / Blog Listing Page.
7. Journey / Blog Detail Page.
8. SEO foundation untuk semua halaman.
9. Responsive polishing.
10. Performance dan Lighthouse audit.

Pada tahap awal, data boleh menggunakan static array / config / seeder. Namun struktur komponen harus data-driven agar nanti mudah disambungkan ke database dan Filament.

### 3.2 Scope Admin Filament Tahap Kedua

Admin dibuat setelah frontend selesai.

Fungsi admin:

- Management Website Settings.
- Management konten Home Page.
- Management konten The Villa.
- Management Gallery.
- Management Journey / Blog.
- Management SEO untuk page dan postingan Journey.
- Management media / gambar.
- Management Users yang sudah ada tetap dipertahankan.

### 3.3 Out of Scope

Fitur berikut tidak dibuat:

- Checkout.
- Payment gateway.
- Cart.
- Booking engine internal.
- Invoice.
- Membership publik.
- Komentar publik pada blog.
- Review publik yang bisa dikirim langsung oleh visitor.
- Kalender ketersediaan real-time yang kompleks.

Semua booking diarahkan ke WhatsApp.

---

## 4. Tech Stack

### 4.1 Existing Stack

- Backend: **Laravel**.
- Admin panel: **Filament**.
- Admin auth: sudah bisa login.
- Modul existing: **Users**.

### 4.2 Rekomendasi Frontend

Frontend disarankan menggunakan:

- Laravel Blade.
- Tailwind CSS atau CSS custom berbasis design token.
- Alpine.js untuk interaksi ringan seperti mobile menu, gallery lightbox, tab, dan accordion.
- Vite untuk asset bundling.

Jika project sudah memakai setup lain, boleh dipakai selama hasil visual tetap mengikuti `DESIGN.md`.

### 4.3 Rekomendasi Package

Package yang bisa dipakai:

- `spatie/laravel-sitemap` untuk sitemap otomatis.
- `spatie/laravel-medialibrary` untuk upload dan pengelolaan media.
- `spatie/laravel-sluggable` atau custom slug helper untuk slug Journey.
- Rich editor Filament untuk konten artikel Journey.
- SEO helper custom untuk meta tag dan schema JSON-LD.

Package tidak harus dipasang semua di awal. Prioritas pertama adalah frontend dan SEO structure.

---

## 5. Prinsip Desain dari DESIGN.md

Website wajib mengikuti arah visual berikut:

- **Luxury tropical villa**.
- Premium, tenang, editorial, dan natural.
- Background utama off-white hangat, bukan putih dingin.
- Warna utama hijau gelap / daun tua.
- Heading memakai serif elegan.
- Body dan navigasi memakai sans-serif bersih.
- Layout lega dan tidak padat.
- Fotografi menjadi elemen utama.
- Card minimal dengan border tipis.
- Radius kecil, bukan rounded besar.
- Header berada di atas hero dengan style transparan.
- CTA WhatsApp jelas dan konsisten.

### 5.1 Design Token Utama

```css
:root {
  --color-bg-main: #F6F4F2;
  --color-bg-soft: #FBFAF8;
  --color-bg-card: #FFFFFF;

  --color-text-main: #161712;
  --color-text-muted: #6F6A56;
  --color-text-soft: #8C8F8D;
  --color-text-inverse: #FFFFFF;

  --color-primary: #171A11;
  --color-primary-2: #1D2316;
  --color-primary-3: #272213;
  --color-primary-soft: #35321D;

  --color-olive: #544E35;
  --color-brown: #94806E;
  --color-border: #E0DEDB;

  --font-heading: "Cormorant Garamond", "Playfair Display", Georgia, serif;
  --font-body: "Inter", "Manrope", Arial, sans-serif;

  --container-max: 1240px;
}
```

### 5.2 Larangan Visual

Developer tidak boleh menggunakan:

- Warna hijau neon.
- Rounded corner besar pada card utama.
- Heading sans-serif bold untuk title besar.
- Shadow berat di semua card.
- Background putih murni yang terasa dingin.
- Layout terlalu padat.
- Icon filled warna-warni.
- Gradient modern yang terlalu mencolok.

---

## 6. User Flow Utama

### 6.1 Flow Pengunjung

1. Visitor masuk ke Home Page.
2. Visitor melihat hero, quick facts, villa overview, rooms, amenities, experiences, reviews, dan CTA.
3. Visitor membuka halaman The Villa untuk detail villa.
4. Visitor membuka Gallery untuk melihat foto lengkap.
5. Visitor membaca artikel Journey untuk inspirasi, tips, local guide, dan cerita seputar villa.
6. Visitor klik **Book via WhatsApp**.
7. Website membuka WhatsApp dengan pesan otomatis.
8. Proses booking dilakukan di WhatsApp.

### 6.2 Flow Admin

1. Admin login ke Filament.
2. Admin mengatur identitas website.
3. Admin mengatur nomor WhatsApp dan pesan default.
4. Admin mengatur konten Home, The Villa, Gallery, dan Journey.
5. Admin upload foto gallery.
6. Admin membuat kategori Journey.
7. Admin membuat postingan Journey dengan SEO lengkap.
8. Admin publish/unpublish konten.
9. Frontend menampilkan konten yang sudah published.

---

## 7. Struktur Route Frontend

Route utama:

```text
GET /                       Home Page
GET /the-villa              The Villa Page
GET /gallery                Gallery Page
GET /journey                Journey / Blog Listing
GET /journey/{slug}         Journey / Blog Detail
GET /sitemap.xml            Sitemap
GET /robots.txt             Robots
```

Opsional:

```text
GET /journal                Redirect 301 ke /journey
```

Agar tidak duplicate SEO, canonical utama tetap `/journey`.

---

## 8. WhatsApp Booking

### 8.1 Prinsip

Tidak ada transaksi di website. Semua CTA booking harus mengarah ke WhatsApp.

### 8.2 Format Link

Gunakan format:

```text
https://wa.me/{nomor}?text={encoded_message}
```

Contoh pesan default:

```text
Halo, saya tertarik untuk booking Villa Omah Nongko. Bisa dibantu informasi ketersediaan dan rate-nya?
```

### 8.3 Lokasi CTA WhatsApp

CTA WhatsApp wajib muncul di:

- Header desktop.
- Header mobile.
- Hero Home.
- Section CTA bawah setiap halaman.
- Sidebar Journey.
- Footer contact.
- Floating button mobile opsional.

### 8.4 Admin Control

Nomor WhatsApp, label tombol, dan pesan default harus bisa diubah dari Website Settings di Filament.

---

# 9. Step-by-Step Development Plan

## Phase 0 — Persiapan Project

### Task

- Audit struktur Laravel saat ini.
- Pastikan login admin Filament berjalan.
- Pastikan modul Users tidak rusak.
- Setup frontend asset pipeline.
- Setup font dan CSS global.
- Buat struktur folder Blade/component.
- Setup design token berdasarkan `DESIGN.md`.

### Output

- Layout dasar Laravel siap.
- Frontend bisa render halaman kosong.
- CSS global tersedia.
- Admin Filament tetap berjalan.

### Acceptance Criteria

- Halaman `/` bisa diakses tanpa error.
- Admin Filament tetap bisa login.
- Modul Users tetap berjalan.
- Tidak ada perubahan yang merusak project existing.

---

## Phase 1 — Design System & Global Components

### Komponen yang Dibuat

```text
resources/views/components/
  layout/app.blade.php
  layout/header.blade.php
  layout/footer.blade.php
  ui/button.blade.php
  ui/hero.blade.php
  ui/section-header.blade.php
  ui/feature-item.blade.php
  ui/photo-card.blade.php
  ui/cta-section.blade.php
  ui/gallery-mosaic.blade.php
  ui/blog-card.blade.php
  seo/meta.blade.php
  seo/schema.blade.php
```

### Style yang Dibuat

```text
resources/css/
  app.css
  tokens.css
  components.css
  pages.css
  responsive.css
```

Jika memakai Tailwind, token warna dan font dimasukkan ke `tailwind.config.js`.

### Komponen Global

#### Header

- Absolute di atas hero.
- Logo center.
- Hamburger kiri.
- Menu kiri: Experiences, Stay.
- Menu kanan: Gallery, Book via WhatsApp.
- Secondary nav: The Villa, Quick Facts, Rates & Availability, Reviews, Journey.
- Saat scroll, header berubah menjadi background hijau gelap semi-transparan.

#### Footer

- Footer terang untuk subpage.
- Footer gelap untuk Home jika mengikuti referensi.
- Grid 4 kolom desktop.
- Berisi logo, deskripsi, social links, explore links, info links, contact, copyright.

#### Hero

- Full-width image.
- Overlay gelap.
- H1 kiri.
- Deskripsi pendek.
- CTA opsional.

#### Button

- Primary dark.
- Outline light.
- Outline dark.
- Semua button uppercase, kecil, dan letter-spacing.

### Acceptance Criteria

- Header dan footer responsive.
- Tombol WhatsApp bekerja.
- Hero bisa menerima title, description, image, CTA.
- Komponen bisa dipakai ulang di semua halaman.
- Satu halaman tidak mengulang kode visual yang sama terlalu banyak.

---

## Phase 2 — Frontend Home Page

### Route

```text
GET /
```

### Tujuan Halaman

Home Page menjadi halaman utama untuk memperkenalkan villa, menampilkan highlight, dan mendorong visitor booking via WhatsApp.

### Struktur Section Home

1. Hero Home.
2. Quick Facts Strip.
3. About Section.
4. Rooms & Suites.
5. Highlights & Amenities.
6. Experiences.
7. Guest Reviews.
8. Newsletter / Stay in the Loop.
9. Footer.

### 2.1 Hero Home

Konten default:

```text
Title: Villa Omah Nongko
Description: A curved leaf in the landscape, Omah Nongko rests quietly on the edge of Yogyakarta's rice fields. Located just north of Umalas and minutes from Seminyak's coastline, this five-bedroom private villa blends sculptural architecture with spacious tropical living.
CTA: Discover The Villa
```

### 2.2 Quick Facts Strip

Data default:

- 5 Bedrooms
- 5.5 Bathrooms
- Up to 10 Guests
- Private Pool & Jacuzzi
- Rice Field View
- Wi‑Fi High Speed
- Daily Housekeeping

### 2.3 About Section

Konten:

- Eyebrow: `ABOUT OMAH NONGKO`
- Heading: `A Private Villa Surrounded by Nature`
- Deskripsi pendek tentang filosofi villa, arsitektur, ruang terbuka, material natural, dan taman tropis.
- CTA: `LEARN MORE`
- Foto collage kanan.

### 2.4 Rooms & Suites

Card yang ditampilkan:

1. Master Suite — 1 King Bed
2. Suite Garden View — 1 King Bed
3. Suite Pool View — 1 King Bed
4. Suite Terrace — 1 King Bed
5. Suite Family — 2 Single Beds

Setiap card berisi:

- Foto kamar.
- Nama suite.
- Bed info.
- Link `View Room Details`.

### 2.5 Highlights & Amenities

Icon grid:

- Private Pool & Jacuzzi
- Tropical Garden
- Fully Equipped Kitchen
- Air Conditioning Throughout
- Smart TV & Entertainment
- High Speed Wi‑Fi
- Safety Box
- Parking Area Available

CTA: `VIEW FULL AMENITIES`

### 2.6 Experiences

Card 4 kolom:

1. Relax & Unwind
2. In‑Villa Dining
3. Spa & Massage
4. Day Tours

CTA: `EXPLORE EXPERIENCES`

### 2.7 Guest Reviews

Tampilkan testimonial 2 kolom desktop:

- Quote text.
- Nama guest.
- Negara.
- Rating bintang.

### Acceptance Criteria Home

- Home Page sesuai style referensi.
- Semua section responsive.
- Semua gambar memiliki alt text.
- Semua CTA WhatsApp berfungsi.
- Hanya ada satu H1.
- Meta title dan meta description unik.
- Lighthouse SEO minimal 95 pada tahap awal, target final 100.

---

## Phase 3 — Frontend The Villa Page

### Route

```text
GET /the-villa
```

### Tujuan Halaman

Menjelaskan detail villa secara editorial dan premium.

### Struktur Section

1. Hero The Villa.
2. Intro: A Private Villa Surrounded by Nature.
3. Villa Gallery Mosaic.
4. Living in Harmony.
5. Five Comfortable Suites.
6. Architecture & Location.
7. CTA Bar.
8. Footer.

### 3.1 Hero

```text
H1: The Villa
Description: Villa Omah Nongko is a five bedroom private villa that blends sculptural architecture with spacious tropical living. Designed to harmonize with its surroundings, the villa offers comfort, privacy, and a true sense of place.
```

### 3.2 Intro Section

Konten:

- Heading: `A Private Villa Surrounded by Nature`
- Deskripsi tentang harmoni arsitektur dan alam.
- Button: `BOOK VIA WHATSAPP`
- Feature icons:
  - 5 Bedrooms
  - 5.5 Bathrooms
  - Up to 10 Guests
  - Private Pool & Jacuzzi
  - Rice Field View
  - Tropical Garden
- Collage foto exterior dan interior.

### 3.3 Villa Gallery Mosaic

Tabs:

- All
- Villa
- Rooms
- Pool
- Surroundings

Grid:

- Foto besar kiri.
- Grid foto kecil kanan.
- Semua foto object-fit cover.

### 3.4 Living in Harmony

Konten kiri:

- Heading: `Living in Harmony`
- Deskripsi tentang ruang open-air, dining, material natural, dan suasana hangat.
- Checklist:
  - Open-plan living and dining area
  - Fully equipped kitchen
  - Floor-to-ceiling windows
  - Natural wood & local materials

Konten kanan:

- Foto besar living room.

### 3.5 Five Comfortable Suites

Kiri:

- Heading: `Five Comfortable Suites`
- Deskripsi pendek.
- CTA: `VIEW ROOM DETAILS`

Kanan:

- Carousel / row 5 suite cards:
  - Master Suite
  - Suite Garden View
  - Suite Pool View
  - Suite Terrace
  - Suite Family

### 3.6 Architecture & Location

Layout:

- Kolom kiri: Architecture.
- Kolom tengah: foto exterior villa.
- Kolom kanan: The Location + CTA `EXPLORE LOCATION`.

### Acceptance Criteria The Villa

- Layout desktop dua kolom dan mosaic sesuai referensi.
- Mobile menjadi satu kolom.
- CTA WhatsApp tersedia.
- H1 hanya satu.
- Meta title dan description unik.
- Semua foto memiliki alt text.

---

## Phase 4 — Frontend Gallery Page

### Route

```text
GET /gallery
```

### Tujuan Halaman

Menampilkan foto villa secara premium dengan kategori dan mosaic grid.

### Struktur Section

1. Hero Gallery.
2. Gallery Filter Bar.
3. Category Sections.
4. CTA Bar.
5. Footer.

### 4.1 Hero Gallery

```text
H1: Gallery
Description: Explore the beauty of Villa Omah Nongko through our gallery. Every space is thoughtfully designed to blend with nature and create unforgettable moments.
```

### 4.2 Filter Bar

Kategori:

- All
- Villa Exterior
- Living Areas
- Bedrooms
- Bathrooms
- Kitchen & Dining
- Pool & Garden
- Surroundings

Kanan:

- Button outline: `VIEW SLIDESHOW`

### 4.3 Gallery Category Section

Setiap kategori menampilkan:

- Section title.
- Link `VIEW ALL PHOTOS`.
- Foto besar kiri.
- Grid foto kecil kanan.

Kategori utama:

1. Villa Exterior
2. Living Areas
3. Bedrooms
4. Pool & Garden
5. Kitchen & Dining
6. Surroundings

### 4.4 Lightbox / Slideshow

Fitur:

- Klik foto membuka lightbox.
- Next / previous.
- ESC untuk close.
- Overlay gelap.
- Caption opsional.
- Alt text tetap ada di gambar asli HTML.

### Acceptance Criteria Gallery

- Grid tidak monoton; harus mosaic.
- Filter responsive horizontal scroll di mobile.
- Lightbox bekerja.
- Semua image optimized.
- Semua image punya alt text.
- Gallery tetap cepat walau banyak gambar.

---

## Phase 5 — Frontend Journey / Blog Listing Page

### Route

```text
GET /journey
```

### Tujuan Halaman

Journey adalah halaman artikel / blog yang menjadi pondasi utama SEO website. Halaman ini harus editorial, mudah dibaca, cepat, dan SEO-friendly.

### Struktur Section

1. Hero Journey.
2. Latest Stories Layout.
3. Blog List Horizontal Cards.
4. Sidebar.
5. Pagination.
6. Feature Strip.
7. Footer.

### 5.1 Hero Journey

```text
H1: Journey
Description: Stories and inspirations from Yogyakarta. Discover local experiences, travel tips, wellness, and villa life at Omah Nongko.
```

### 5.2 Blog Listing Layout

Desktop:

```text
[Latest Stories 70%] [Sidebar 30%]
```

Mobile:

```text
[Latest Stories]
[Cards stacked]
[Sidebar bawah]
```

### 5.3 Blog Card

Setiap card wajib berisi:

- Featured image.
- Category.
- Title.
- Excerpt.
- Published date.
- Reading time.
- Read more link.

Artikel placeholder dari desain:

1. The Beauty of Yogyakarta’s Rice Field Living
2. Wellness & Relaxation in Your Villa
3. In‑Villa Dining: A Taste of Yogyakarta at Home
4. Local Experiences You Shouldn’t Miss
5. Yogyakarta’s Best Beaches Near Umalas

### 5.4 Sidebar

Sidebar terdiri dari:

- Search articles.
- Categories.
- Popular posts.
- Subscribe.
- Dark CTA WhatsApp card.

Kategori default:

- All Articles
- Local Guide
- Wellness
- In‑Villa Experience
- Things To Do
- Travel Guide

### 5.5 Pagination

- Active page diberi border.
- URL pagination harus SEO-friendly.
- Page 2 dan seterusnya punya title tambahan, contoh: `Journey — Page 2`.
- Hindari duplicate meta description antar halaman pagination.

### Acceptance Criteria Journey Listing

- Blog listing mirip referensi Journal.
- Search UI tersedia.
- Category filter tersedia.
- Popular posts tersedia.
- Pagination tersedia.
- Tidak ada duplicate H1.
- Meta title unik.
- Schema `CollectionPage` / `Blog` tersedia.

---

## Phase 6 — Frontend Journey / Blog Detail Page

### Route

```text
GET /journey/{slug}
```

### Tujuan Halaman

Halaman detail artikel adalah halaman paling penting untuk SEO. Setiap artikel harus mudah dibaca, cepat, dan lengkap struktur SEO-nya.

### Struktur Halaman Detail

1. Header global.
2. Article hero.
3. Breadcrumb.
4. Article content.
5. Table of contents opsional.
6. Author / brand info.
7. Related posts.
8. CTA WhatsApp.
9. Footer.

### 6.1 Article Hero

Berisi:

- Category.
- H1 article title.
- Excerpt.
- Date.
- Reading time.
- Featured image.

### 6.2 Article Content

Konten harus support:

- Heading H2/H3.
- Paragraph.
- Image.
- Gallery kecil.
- Quote.
- List.
- Internal link.
- CTA block.
- FAQ block opsional.

### 6.3 SEO Detail Post

Setiap post wajib punya:

- SEO title.
- Meta description.
- Slug.
- Canonical URL.
- Focus keyword.
- OG title.
- OG description.
- OG image.
- Twitter title.
- Twitter description.
- Twitter image.
- Robots index/follow.
- Schema BlogPosting JSON-LD.
- Breadcrumb schema.
- FAQ schema jika artikel memiliki FAQ.

### Acceptance Criteria Journey Detail

- H1 hanya judul artikel.
- Semua gambar di artikel punya alt.
- Artikel detail valid untuk rich result dasar.
- Related posts muncul.
- CTA WhatsApp muncul di bawah artikel.
- Page speed tetap baik.

---

# 10. SEO Requirements

SEO diterapkan sejak frontend dibuat, bukan setelah website selesai.

## 10.1 Global SEO

Semua halaman wajib memiliki:

- `<title>` unik.
- `<meta name="description">` unik.
- Canonical URL.
- Open Graph tags.
- Twitter Card tags.
- Robots meta.
- Favicon.
- Apple touch icon.
- Theme color.
- JSON-LD schema.
- Semantic HTML.
- Satu H1 per halaman.
- Alt text di semua image.
- Lazy loading image selain hero.
- Width dan height image untuk mencegah layout shift.

## 10.2 Meta Title Format

Rekomendasi format:

```text
Home: Villa Omah Nongko — Private Tropical Villa in Yogyakarta
The Villa: The Villa — Omah Nongko Yogyakarta
Gallery: Gallery — Villa Omah Nongko
Journey: Journey — Yogyakarta Travel, Wellness & Villa Stories
Post: {Post Title} — Omah Nongko Journey
```

## 10.3 Meta Description

Setiap halaman harus memiliki deskripsi 120–160 karakter.

Contoh:

```text
A private villa in Yogyakarta blending sculptural architecture, spacious tropical living, lush gardens, and a peaceful poolside escape near Umalas and Seminyak.
```

## 10.4 Schema JSON-LD

### Global Website Schema

Gunakan:

- `WebSite`
- `LodgingBusiness` atau `LocalBusiness`
- `Organization`
- `BreadcrumbList`

### Home Page

Gunakan:

- `WebSite`
- `LodgingBusiness`
- `Organization`

### Gallery Page

Gunakan:

- `CollectionPage`
- `ImageGallery`
- `ImageObject` untuk gambar penting.

### Journey Listing

Gunakan:

- `Blog`
- `CollectionPage`

### Journey Detail

Gunakan:

- `BlogPosting`
- `BreadcrumbList`
- `ImageObject`
- `FAQPage` jika artikel memiliki FAQ.

## 10.5 Sitemap

Buat sitemap otomatis:

```text
/sitemap.xml
```

Isi sitemap:

- Home.
- The Villa.
- Gallery.
- Journey.
- Semua Journey posts yang published.
- Gallery category jika dibuat sebagai halaman sendiri.

Setiap item sitemap harus punya:

- URL.
- Last modified.
- Priority.
- Change frequency.

## 10.6 Robots

Buat:

```text
/robots.txt
```

Production:

```text
User-agent: *
Allow: /
Sitemap: https://domain.com/sitemap.xml
```

Staging/development:

```text
User-agent: *
Disallow: /
```

Jangan sampai staging terindex Google.

## 10.7 Canonical

Setiap halaman harus punya canonical.

Contoh:

```html
<link rel="canonical" href="https://domain.com/journey/the-beauty-of-Yogyakartas-rice-field-living">
```

Jika ada query filter/search/pagination, pastikan canonical tidak membuat duplicate content.

## 10.8 Image SEO

Setiap gambar wajib:

- Filename deskriptif.
- Alt text natural.
- Format WebP / AVIF jika memungkinkan.
- Ukuran responsive via `srcset`.
- Lazy loading untuk gambar non-hero.
- Hero image dipreload.

Contoh alt:

```text
Kolam renang private Villa Omah Nongko dengan taman tropis di Yogyakarta
```

Bukan:

```text
image1
foto
IMG_1234
```

## 10.9 Blog/Journey SEO Khusus

Setiap postingan Journey wajib memiliki field SEO:

- Focus keyword.
- SEO title.
- Meta description.
- Slug.
- Excerpt.
- Featured image.
- Featured image alt.
- Category.
- Tags.
- Published date.
- Updated date.
- Reading time.
- Author.
- Related posts.
- Internal links.
- FAQ opsional.

### SEO Checklist Artikel

Sebelum artikel publish:

- [ ] Judul artikel jelas.
- [ ] Slug pendek dan mengandung keyword.
- [ ] Meta description 120–160 karakter.
- [ ] Featured image ada alt text.
- [ ] H1 hanya satu.
- [ ] Ada H2 untuk struktur artikel.
- [ ] Ada internal link ke The Villa, Gallery, dan CTA booking.
- [ ] Ada CTA WhatsApp.
- [ ] Schema BlogPosting valid.
- [ ] Tidak noindex.

## 10.10 Lighthouse SEO Target

Target final:

- SEO: 100.
- Performance: minimal 90 desktop, minimal 85 mobile.
- Accessibility: minimal 90.
- Best Practices: minimal 90.

---

# 11. Content Model / Database Plan

Admin dibuat setelah frontend, tetapi struktur database perlu disiapkan dari awal agar frontend mudah dibuat dinamis.

## 11.1 Website Settings

Website Settings sudah ada sebagai modul awal. Field dapat diperluas jika dibutuhkan.

### Identity

- `site_name`
- `tagline`
- `description`
- `email`
- `phone`
- `whatsapp_number`
- `whatsapp_default_message`
- `location_name`
- `address`
- `google_maps_url`

### Assets

- `logo_light`
- `logo_dark`
- `favicon`
- `default_og_image`
- `default_hero_image`
- `footer_background_image`

### Social Links

Gunakan repeater:

- `label`
- `url`
- `icon`
- `is_active`
- `sort_order`

### Default SEO

- `default_meta_title`
- `default_meta_description`
- `default_keywords`
- `default_og_title`
- `default_og_description`
- `default_og_image`
- `robots_index_default`
- `schema_type`

---

## 11.2 Pages

Untuk halaman statis yang bisa diedit:

Table: `pages`

Field:

- `id`
- `page_key` — home, the_villa, gallery, journey.
- `title`
- `slug`
- `hero_title`
- `hero_description`
- `hero_image`
- `hero_image_alt`
- `content_blocks` JSON opsional.
- `status` draft/published.
- `published_at`
- `created_at`
- `updated_at`

SEO fields:

- `seo_title`
- `seo_description`
- `seo_keywords`
- `canonical_url`
- `og_title`
- `og_description`
- `og_image`
- `twitter_title`
- `twitter_description`
- `twitter_image`
- `robots_index`
- `robots_follow`

---

## 11.3 Quick Facts / Features

Table: `features`

Field:

- `id`
- `page_key`
- `icon`
- `title`
- `subtitle`
- `description`
- `sort_order`
- `is_active`

Digunakan untuk:

- Quick Facts Home.
- Amenities.
- Feature Strip Footer.

---

## 11.4 Rooms / Suites

Table: `rooms`

Field:

- `id`
- `title`
- `slug`
- `bed_type`
- `short_description`
- `description`
- `image`
- `image_alt`
- `button_label`
- `button_url`
- `sort_order`
- `is_featured`
- `is_active`

---

## 11.5 Experiences

Table: `experiences`

Field:

- `id`
- `title`
- `slug`
- `description`
- `image`
- `image_alt`
- `icon`
- `sort_order`
- `is_active`

---

## 11.6 Gallery Categories

Table: `gallery_categories`

Field:

- `id`
- `name`
- `slug`
- `description`
- `sort_order`
- `is_active`
- `seo_title`
- `seo_description`

Default categories:

- Villa Exterior
- Living Areas
- Bedrooms
- Bathrooms
- Kitchen & Dining
- Pool & Garden
- Surroundings

---

## 11.7 Gallery Images

Table: `gallery_images`

Field:

- `id`
- `gallery_category_id`
- `title`
- `image`
- `alt_text`
- `caption`
- `sort_order`
- `is_featured`
- `is_active`
- `created_at`
- `updated_at`

Rules:

- Alt text wajib.
- Title gambar wajib.
- Category wajib.
- Bisa drag-and-drop sort order di Filament.

---

## 11.8 Testimonials

Table: `testimonials`

Field:

- `id`
- `name`
- `country_or_role`
- `content`
- `rating`
- `image` opsional.
- `sort_order`
- `is_active`

---

## 11.9 Journey Categories

Table: `journey_categories`

Field:

- `id`
- `name`
- `slug`
- `description`
- `icon`
- `sort_order`
- `is_active`
- `seo_title`
- `seo_description`

Default categories:

- All Articles
- Local Guide
- Wellness
- In‑Villa Experience
- Things To Do
- Travel Guide

---

## 11.10 Journey Posts

Table: `journey_posts`

Field utama:

- `id`
- `journey_category_id`
- `title`
- `slug`
- `excerpt`
- `content`
- `featured_image`
- `featured_image_alt`
- `author_name`
- `status` draft/published/scheduled.
- `published_at`
- `updated_at`
- `reading_time`
- `is_featured`
- `is_popular`
- `sort_order`

SEO fields:

- `focus_keyword`
- `seo_title`
- `seo_description`
- `seo_keywords`
- `canonical_url`
- `og_title`
- `og_description`
- `og_image`
- `twitter_title`
- `twitter_description`
- `twitter_image`
- `robots_index`
- `robots_follow`

Optional fields:

- `faq_items` JSON.
- `related_post_ids` JSON.
- `schema_override` JSON.

---

## 11.11 Newsletter Subscribers

Jika form subscribe dibuat aktif:

Table: `newsletter_subscribers`

Field:

- `id`
- `email`
- `source`
- `subscribed_at`
- `is_active`

Jika belum ingin backend subscribe, form bisa dibuat nonaktif sementara dengan pesan sukses dummy. Namun lebih baik tetap simpan email agar tidak sia-sia.

---

# 12. Admin Filament Requirements

Admin dibuat setelah frontend selesai.

## 12.1 Resource Prioritas

Urutan implementasi admin:

1. Website Settings.
2. Page Content.
3. Gallery Categories.
4. Gallery Images.
5. Features / Amenities.
6. Rooms / Suites.
7. Experiences.
8. Testimonials.
9. Journey Categories.
10. Journey Posts.
11. Newsletter Subscribers.
12. SEO Tools.

## 12.2 Website Settings Resource

Resource ini melanjutkan yang sudah ada.

Tambahkan section:

- Identitas Website.
- Logo dan Gambar Depan.
- Kontak dan WhatsApp.
- Social Links.
- Default SEO.
- Default Schema.
- Footer Settings.

### Validation

- Site name wajib.
- WhatsApp wajib numeric.
- URL social valid.
- Meta description maksimal 160 karakter.
- Logo wajib image.
- OG image ukuran direkomendasikan 1200x630.

---

## 12.3 Page Content Resource

Untuk mengelola Home, The Villa, Gallery, dan Journey hero.

Field:

- Page key.
- Title.
- Hero title.
- Hero description.
- Hero image.
- Hero image alt.
- SEO tab.

Filament form dibagi tab:

1. Content.
2. Media.
3. SEO.
4. Advanced.

---

## 12.4 Journey Posts Resource

Ini resource paling penting untuk SEO.

### Form Tabs

#### Tab Content

- Title.
- Slug auto generated.
- Category.
- Excerpt.
- Content rich editor.
- Featured image.
- Featured image alt.
- Status.
- Published at.

#### Tab SEO

- Focus keyword.
- SEO title.
- SEO description.
- SEO preview Google style.
- Canonical URL.
- Robots index/follow.

#### Tab Social Share

- OG title.
- OG description.
- OG image.
- Twitter title.
- Twitter description.
- Twitter image.

#### Tab Schema

- Schema type default BlogPosting.
- FAQ items.
- Custom JSON-LD optional.

#### Tab Relations

- Related posts.
- Popular post toggle.
- Featured post toggle.

### Admin Helper SEO

Filament harus menampilkan indikator:

- SEO title length.
- Meta description length.
- Slug preview.
- Featured image status.
- Alt text status.
- Focus keyword status.

### Publish Rules

Post tidak boleh publish jika:

- Title kosong.
- Slug kosong.
- Excerpt kosong.
- Content kosong.
- Featured image kosong.
- Featured image alt kosong.
- SEO title kosong.
- SEO description kosong.

---

# 13. Frontend Components Detail

## 13.1 Header

Desktop:

- Transparent di atas hero.
- Logo di tengah.
- Menu kiri dan kanan.
- CTA WhatsApp outline.
- Secondary nav di bawah logo.

Mobile:

- Hamburger kiri.
- Logo tengah.
- WhatsApp icon kanan.
- Menu drawer.

Behavior:

- Saat scroll, header berubah menjadi background hijau gelap semi-transparan.
- Active nav diberi underline tipis.

## 13.2 Hero

Props:

- `title`
- `description`
- `image`
- `image_alt`
- `cta_label`
- `cta_url`
- `variant`

Rules:

- Hero image wajib optimized.
- Overlay gelap minimal 45%.
- H1 putih dan terbaca.
- Hero height desktop 620–720px.
- Hero height mobile 520–580px.

## 13.3 CTA Section

Digunakan di bawah subpage.

Konten:

```text
Ready to experience Omah Nongko?
Book your stay and enjoy a private escape in the heart of Yogyakarta.
[BOOK VIA WHATSAPP]
```

## 13.4 Footer

Footer harus memuat:

- Logo.
- Deskripsi.
- Social icons.
- Explore links.
- Info links.
- Contact.
- Copyright.
- Privacy Policy.
- Terms & Conditions.

## 13.5 Blog Card

Props:

- image.
- image_alt.
- category.
- title.
- excerpt.
- date.
- reading_time.
- url.

Hover:

- Image scale 1.02.
- Title underline halus.

## 13.6 Gallery Mosaic

Props:

- category.
- images.
- layout variant.

Rules:

- Desktop mosaic.
- Mobile stacked.
- Click image opens lightbox.

---

# 14. Responsive Requirements

## Desktop ≥ 1200px

- Header full navigation tampil.
- Hero 620–720px.
- Container max 1240px.
- Rooms/suites 4–5 kolom.
- Experiences 4 kolom.
- Gallery mosaic desktop.
- Journey layout 2 kolom dengan sidebar 320px.

## Tablet 769–1199px

- Header secondary nav boleh disembunyikan jika sempit.
- Hero 540–620px.
- About tetap 2 kolom atau 1 kolom tergantung ruang.
- Rooms 2–3 kolom.
- Experiences 2 kolom.
- Gallery menjadi 2 kolom sederhana.
- Journey sidebar turun jika width kurang.

## Mobile ≤ 768px

- Header compact.
- Hero title 42–48px.
- Feature strip horizontal scroll.
- Semua section 1 kolom.
- Gallery filter horizontal scroll.
- Gallery images full width.
- Blog card stacked.
- Sidebar blog turun ke bawah.
- Footer 1 kolom.

---

# 15. Accessibility Requirements

- Semua gambar wajib alt text.
- Semua tombol bisa diakses keyboard.
- Focus state terlihat.
- Link tidak hanya dibedakan warna, tetapi juga hover/underline.
- Form input punya label accessible.
- Icon tidak boleh menjadi satu-satunya informasi.
- Semantic HTML wajib:
  - `header`
  - `nav`
  - `main`
  - `section`
  - `article`
  - `footer`
- Kontras hero harus aman untuk teks putih.
- Font size body minimal nyaman dibaca.

---

# 16. Performance Requirements

- Hero image dipreload.
- Font pakai `font-display: swap`.
- Image lazy loading selain above-the-fold.
- Gunakan WebP/AVIF jika memungkinkan.
- Hindari JavaScript berat.
- Lightbox hanya load saat dibutuhkan.
- CSS dipisah rapi dan tidak bloat.
- Minify asset production.
- Cache static asset.
- Gunakan width/height image untuk mengurangi CLS.

Target Core Web Vitals:

- LCP: < 2.5 detik.
- CLS: < 0.1.
- INP: < 200ms.

---

# 17. Security & Admin Rules

- Hanya admin login yang bisa akses Filament.
- Upload image dibatasi mime type.
- Validasi ukuran file image.
- Sanitasi content rich editor.
- Jangan render HTML mentah tanpa sanitasi.
- CSRF aktif.
- Rate limit form subscribe jika aktif.
- Staging harus noindex.
- Admin route tidak dimasukkan sitemap.

---

# 18. Testing Checklist

## 18.1 Frontend Visual

- [ ] Header sesuai desain.
- [ ] Hero sesuai desain.
- [ ] Typography serif dan sans sesuai.
- [ ] Warna sesuai token.
- [ ] Gallery mosaic tidak pecah.
- [ ] Blog listing sesuai referensi.
- [ ] Footer rapi.
- [ ] Mobile tidak overflow.

## 18.2 Functional

- [ ] WhatsApp CTA membuka nomor benar.
- [ ] Gallery lightbox bekerja.
- [ ] Blog search UI bekerja.
- [ ] Category filter bekerja.
- [ ] Pagination bekerja.
- [ ] Subscribe form validasi email.

## 18.3 SEO

- [ ] Setiap halaman punya satu H1.
- [ ] Meta title unik.
- [ ] Meta description unik.
- [ ] Canonical ada.
- [ ] OG tags ada.
- [ ] Twitter tags ada.
- [ ] JSON-LD valid.
- [ ] Sitemap bisa diakses.
- [ ] Robots benar.
- [ ] Gambar punya alt.
- [ ] Lighthouse SEO 100.

## 18.4 Admin

- [ ] Admin bisa login.
- [ ] Users module tetap jalan.
- [ ] Website settings bisa disimpan.
- [ ] Journey post bisa dibuat draft.
- [ ] Journey post bisa publish.
- [ ] SEO fields tervalidasi.
- [ ] Upload gambar berjalan.

---

# 19. Definition of Done

Project dianggap selesai jika:

1. Frontend Home, The Villa, Gallery, Journey, dan Journey Detail selesai responsive.
2. Semua CTA booking mengarah ke WhatsApp.
3. Tidak ada fitur transaksi internal.
4. SEO global diterapkan ke semua halaman.
5. Journey/Blog memiliki SEO paling lengkap.
6. Sitemap dan robots tersedia.
7. Lighthouse SEO mencapai 100 di production.
8. Admin Filament bisa mengelola konten utama.
9. Admin Filament bisa mengelola SEO Journey.
10. Website Settings dapat mengubah identitas, kontak, logo, hero image, sosial link, dan SEO default.

---

# 20. Urutan Eksekusi Singkat untuk Developer

## Frontend Dulu

1. Setup token warna, font, spacing.
2. Buat layout global.
3. Buat header.
4. Buat footer.
5. Buat CTA WhatsApp helper.
6. Buat komponen Hero.
7. Buat Home Page.
8. Buat The Villa Page.
9. Buat Gallery Page.
10. Buat Journey Listing Page.
11. Buat Journey Detail Page.
12. Tambahkan SEO global.
13. Responsive polish.
14. Performance polish.
15. Lighthouse audit.

## Admin Setelah Frontend

1. Rapikan Website Settings existing.
2. Tambahkan field yang kurang.
3. Buat Page Content manager.
4. Buat Gallery manager.
5. Buat Features/Amenities manager.
6. Buat Rooms/Suites manager.
7. Buat Experiences manager.
8. Buat Testimonials manager.
9. Buat Journey Categories.
10. Buat Journey Posts dengan SEO tabs.
11. Buat sitemap otomatis dari data published.
12. Final QA.

---

# 21. Catatan Implementasi Penting

- Jangan membuat frontend terlalu bergantung ke database dulu. Boleh mulai dari static data agar desain cepat jadi.
- Tetapi struktur data harus dibuat seperti data real agar saat masuk admin tidak perlu rombak layout.
- SEO jangan ditunda sampai akhir; buat helper SEO dari awal.
- Journey/Blog detail harus dianggap sebagai halaman SEO utama.
- Setiap image upload dari admin harus punya alt text.
- Semua tombol booking harus mengambil nomor WhatsApp dari Website Settings.
- Gunakan desain dari `DESIGN.md` sebagai single source of truth untuk style.

---

# 22. Contoh Struktur Folder Laravel

```text
app/
  Helpers/
    SeoHelper.php
    WhatsAppHelper.php
  Models/
    WebsiteSetting.php
    Page.php
    Feature.php
    Room.php
    Experience.php
    GalleryCategory.php
    GalleryImage.php
    JourneyCategory.php
    JourneyPost.php
    Testimonial.php

app/Filament/Resources/
  WebsiteSettingResource.php
  PageResource.php
  FeatureResource.php
  RoomResource.php
  ExperienceResource.php
  GalleryCategoryResource.php
  GalleryImageResource.php
  JourneyCategoryResource.php
  JourneyPostResource.php
  TestimonialResource.php

resources/views/
  layouts/
    app.blade.php
  components/
    header.blade.php
    footer.blade.php
    hero.blade.php
    cta-section.blade.php
    blog-card.blade.php
    gallery-mosaic.blade.php
  pages/
    home.blade.php
    the-villa.blade.php
    gallery.blade.php
    journey/index.blade.php
    journey/show.blade.php
  seo/
    meta.blade.php
    schema.blade.php

resources/css/
  app.css
  tokens.css
  components.css
  pages.css
  responsive.css

routes/
  web.php
```

---

# 23. MVP Content Placeholder

Jika belum ada konten final, pakai placeholder berikut agar frontend bisa dibangun.

## Home

- Hero title: `Villa Omah Nongko`
- Hero description: `A curved leaf in the landscape, Omah Nongko rests quietly on the edge of Yogyakarta's rice fields and offers spacious tropical living near Umalas and Seminyak.`
- CTA: `Book via WhatsApp`

## The Villa

- Title: `The Villa`
- Description: `Villa Omah Nongko is a five-bedroom private villa designed to harmonize with nature, offering comfort, privacy, and a true sense of place.`

## Gallery Categories

- Villa Exterior
- Living Areas
- Bedrooms
- Bathrooms
- Kitchen & Dining
- Pool & Garden
- Surroundings

## Journey Categories

- Local Guide
- Wellness
- In‑Villa Experience
- Things To Do
- Travel Guide

---

# 24. Final Notes

Dokumen ini memprioritaskan pengerjaan frontend terlebih dahulu sesuai request:

```text
Home Page → The Villa → Gallery → Journey / Blog
```

Setelah frontend selesai dan sudah sesuai visual, baru dilanjutkan ke admin Filament untuk membuat seluruh konten dinamis dan mudah dikelola.

SEO harus menjadi bagian dari fondasi sejak awal, terutama untuk Journey/Blog, karena halaman artikel adalah sumber utama traffic organik jangka panjang.
