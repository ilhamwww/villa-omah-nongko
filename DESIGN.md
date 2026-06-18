# DESIGN.md — Website Villa “Omah Nongko”

Dokumen ini menjelaskan desain website villa berdasarkan 4 referensi gambar yang dikirim: **Home**, **The Villa**, **Gallery**, dan **Journal/Blog**. Tujuannya agar AI/developer/designer lain bisa memahami gaya visual, struktur halaman, komponen, layout, dan aturan implementasi tanpa perlu melihat ulang gambar referensi.

---

## 1. Ringkasan Arah Desain

Website menggunakan gaya **luxury tropical villa**, editorial, tenang, natural, dan premium. Nuansa utamanya adalah vila privat di Bali dengan arsitektur tropis, taman hijau, kolam, kayu natural, serta pengalaman menginap yang eksklusif.

Karakter visual utama:

- **Premium & editorial**: heading serif besar, spasi lega, komposisi rapi.
- **Tropical luxury**: warna hijau gelap, putih hangat, tekstur daun, foto vila/taman/kolam.
- **Minimal tetapi detail**: banyak ruang kosong, garis tipis, card sederhana, ikon outline.
- **Fokus pada fotografi**: foto berukuran besar dengan crop sinematik.
- **CTA jelas**: tombol “Book via WhatsApp” selalu mudah ditemukan.

Brand/identitas pada gambar:

- Nama brand: **Omah Nongko**.
- Positioning: private villa in Bali, tropical architecture, spacious living, premium stay.
- CTA utama: **Book via WhatsApp**.

---

## 2. Design Tokens

### 2.1 Warna

Gunakan palet warna berikut sebagai acuan utama.

```css
:root {
  /* Background */
  --color-bg-main: #F6F4F2;
  --color-bg-soft: #FBFAF8;
  --color-bg-card: #FFFFFF;

  /* Text */
  --color-text-main: #161712;
  --color-text-muted: #6F6A56;
  --color-text-soft: #8C8F8D;
  --color-text-inverse: #FFFFFF;

  /* Brand green */
  --color-primary: #171A11;
  --color-primary-2: #1D2316;
  --color-primary-3: #272213;
  --color-primary-soft: #35321D;

  /* Natural accents */
  --color-olive: #544E35;
  --color-brown: #94806E;
  --color-border: #E0DEDB;
  --color-border-dark: rgba(255, 255, 255, 0.35);

  /* Overlay */
  --color-overlay-hero: rgba(0, 0, 0, 0.58);
  --color-overlay-dark: rgba(10, 15, 8, 0.78);
}
```

Catatan penggunaan warna:

- Background utama halaman memakai **off-white hangat** `#F6F4F2`, bukan putih polos.
- Area footer/CTA gelap memakai hijau sangat gelap `#171A11` atau `#1D2316`.
- Tombol utama memakai hijau gelap dengan teks putih.
- Border memakai abu hangat tipis `#E0DEDB`.
- Teks utama jangan hitam murni; pakai `#161712` agar terasa lembut.

---

### 2.2 Tipografi

Desain terlihat memakai kombinasi font serif elegan untuk heading dan sans-serif modern untuk body/navigation.

Jika font asli tidak tersedia, gunakan rekomendasi berikut:

```css
:root {
  --font-heading: "Cormorant Garamond", "Playfair Display", Georgia, serif;
  --font-body: "Inter", "Manrope", Arial, sans-serif;
}
```

Skala tipografi desktop:

| Elemen | Font | Ukuran | Line-height | Weight | Catatan |
|---|---:|---:|---:|---:|---|
| Hero title | Serif | 64–76px | 1.0–1.08 | 400 | Besar, elegan, tidak bold berat |
| Page title | Serif | 56–68px | 1.05 | 400 | Untuk Gallery, Journal, The Villa |
| Section title besar | Serif | 40–48px | 1.1 | 400 | Contoh: “A Private Villa Surrounded by Nature” |
| Section title sedang | Serif | 30–36px | 1.15 | 400 | Card/blog/rooms |
| Card title | Serif | 24–32px | 1.15 | 400 | Jangan terlalu tebal |
| Body | Sans | 14–16px | 1.7 | 400 | Warna muted |
| Small label | Sans | 10–12px | 1.2 | 600 | Uppercase + letter spacing |
| Navigation | Sans | 11–13px | 1 | 600 | Uppercase, letter spacing lebar |
| Button | Sans | 11–12px | 1 | 700 | Uppercase |

Aturan typografi:

- Heading serif harus terasa ringan dan premium. Hindari `font-weight: 700` untuk heading besar.
- Navigation, label kategori, dan tombol menggunakan uppercase dengan letter spacing `0.12em–0.18em`.
- Body text pendek, tidak terlalu panjang, line-height lega.
- Gunakan warna muted untuk paragraf: `#6F6A56`.

Contoh CSS:

```css
h1, h2, h3 {
  font-family: var(--font-heading);
  font-weight: 400;
  color: var(--color-text-main);
  letter-spacing: -0.02em;
}

body {
  font-family: var(--font-body);
  color: var(--color-text-main);
  background: var(--color-bg-main);
}

.eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.16em;
  text-transform: uppercase;
  color: var(--color-text-muted);
}
```

---

### 2.3 Spacing

Gunakan layout yang lega. Website ini tidak terasa padat kecuali bagian gallery dan blog list.

```css
:root {
  --container-max: 1280px;
  --container-wide: 1440px;
  --section-y-sm: 56px;
  --section-y-md: 88px;
  --section-y-lg: 120px;
  --gap-xs: 8px;
  --gap-sm: 16px;
  --gap-md: 24px;
  --gap-lg: 40px;
  --gap-xl: 64px;
}
```

Aturan:

- Container utama desktop: **max-width 1180–1280px**.
- Padding kiri-kanan desktop: **64–80px**.
- Padding tablet: **32–40px**.
- Padding mobile: **20–24px**.
- Jarak antar section desktop: **80–120px**.
- Jarak antar elemen dalam card: **12–24px**.

---

### 2.4 Border, Radius, Shadow

Desain hampir tidak memakai radius besar. Semua bentuk terlihat kotak, bersih, editorial.

```css
:root {
  --radius-none: 0px;
  --radius-sm: 2px;
  --shadow-photo: 0 18px 38px rgba(0,0,0,0.20);
  --shadow-card: 0 8px 24px rgba(0,0,0,0.045);
  --border-light: 1px solid var(--color-border);
}
```

Aturan:

- Foto dan card mayoritas **square corner** atau radius sangat kecil `0–2px`.
- Shadow hanya digunakan untuk foto overlap/collage agar terlihat depth.
- Card blog/sidebar menggunakan border tipis dan background putih/off-white.
- Jangan pakai rounded modern besar seperti `16px` atau `24px` karena tidak sesuai dengan referensi.

---

## 3. Grid dan Layout Global

### 3.1 Desktop

- Canvas referensi terlihat seperti desktop landing page dengan konten tengah.
- Gunakan container: `max-width: 1240px; margin: 0 auto; padding: 0 64px;`.
- Banyak section memakai grid 2 kolom atau 12 kolom.
- Foto diberi object-fit cover.

Contoh grid:

```css
.container {
  width: 100%;
  max-width: 1240px;
  margin-inline: auto;
  padding-inline: 64px;
}

.grid-12 {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  gap: 24px;
}
```

### 3.2 Tablet

- Container padding 32–40px.
- Grid 2 kolom tetap bisa dipakai, tetapi card lebih besar.
- Gallery mosaic dapat berubah menjadi 2 kolom.

### 3.3 Mobile

- Header menjadi compact.
- Semua section menjadi 1 kolom.
- Hero title turun ke 42–48px.
- Card rooms, experiences, blog menjadi stacked.
- Sidebar blog turun ke bawah list artikel.
- Feature strip menjadi horizontal scroll atau 2–3 kolom.

Breakpoint rekomendasi:

```css
/* Desktop besar */
@media (min-width: 1200px) {}

/* Tablet */
@media (max-width: 1024px) {}

/* Mobile */
@media (max-width: 768px) {}

/* Small mobile */
@media (max-width: 480px) {}
```

---

## 4. Header / Navigation

### 4.1 Struktur Header Desktop

Header berada **absolute/fixed di atas hero**, transparan, dengan teks putih.

Komposisi desktop:

1. Kiri atas:
   - Icon hamburger.
   - Link kecil: `EXPERIENCES`, `STAY`.
2. Tengah:
   - Logo `Omah Nongko` berwarna putih.
   - Logo ditempatkan tepat tengah halaman.
3. Kanan atas:
   - Link `GALLERY`.
   - Button outline `BOOK VIA WHATSAPP` + icon WhatsApp.
4. Bar navigasi kedua di bawah logo:
   - `THE VILLA`
   - `QUICK FACTS`
   - `RATES & AVAILABILITY`
   - `REVIEWS`
   - `BLOG`
   - Dipisahkan titik kecil `•`.

Spesifikasi:

```css
.site-header {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 20;
  color: #fff;
  padding: 28px 48px 0;
}

.header-main {
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  align-items: center;
}

.header-nav-secondary {
  margin-top: 28px;
  display: flex;
  justify-content: center;
  gap: 14px;
}
```

Aturan visual:

- Header tidak memiliki background solid di posisi awal.
- Saat scroll, boleh berubah menjadi background hijau gelap semi-transparan dengan blur ringan.
- Teks navigation uppercase, kecil, letter spacing lebar.
- Logo center harus tetap dominan tetapi tidak terlalu besar.

### 4.2 Mobile Header

- Tampilkan hamburger kiri.
- Tampilkan logo tengah.
- Tampilkan icon WhatsApp atau tombol kecil kanan.
- Secondary nav disembunyikan ke drawer/menu.
- Header tinggi sekitar 64–72px.

---

## 5. Hero Section Global

Hero muncul di semua halaman dengan pola yang sama: foto vila besar, overlay gelap, header di atas, dan teks putih di kiri.

### 5.1 Spesifikasi Hero

```css
.hero {
  position: relative;
  min-height: 620px;
  display: flex;
  align-items: center;
  overflow: hidden;
}

.hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(
    90deg,
    rgba(0,0,0,0.72) 0%,
    rgba(0,0,0,0.42) 42%,
    rgba(0,0,0,0.26) 100%
  );
  z-index: 1;
}

.hero img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-content {
  position: relative;
  z-index: 2;
  max-width: 520px;
  margin-left: clamp(24px, 7vw, 96px);
  padding-top: 80px;
}
```

### 5.2 Konten Hero per Halaman

#### Home

Title: `Villa Omah Nongko`

Deskripsi:

> A curved leaf in the landscape, Omah Nongko rests quietly on the edge of Bali's rice fields. Located just north of Umalas and minutes from Seminyak's coastline, this five-bedroom private villa blends sculptural architecture with spacious tropical living.

CTA: `DISCOVER THE VILLA` + arrow.

#### The Villa

Title: `The Villa`

Deskripsi:

> Villa Omah Nongko is a five bedroom private villa that blends sculptural architecture with spacious tropical living. Designed to harmonize with its surroundings, the villa offers comfort, privacy, and a true sense of place.

#### Gallery

Title: `Gallery`

Deskripsi:

> Explore the beauty of Villa Omah Nongko through our gallery. Every space is thoughtfully designed to blend with nature and create unforgettable moments.

#### Journal

Title: `Journal`

Deskripsi:

> Stories and inspirations from Bali. Discover local experiences, travel tips, wellness, and villa life at Omah Nongko.

---

## 6. Komponen Utama

## 6.1 Button

### Primary Dark Button

Dipakai untuk CTA utama seperti `BOOK VIA WHATSAPP`, `VIEW FULL AMENITIES`, `EXPLORE EXPERIENCES`.

```css
.btn-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  min-height: 44px;
  padding: 0 24px;
  background: var(--color-primary);
  color: #fff;
  border: 1px solid var(--color-primary);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
}
```

Hover:

- Background sedikit lebih terang `#272213`.
- Icon panah/WhatsApp geser 2px ke kanan.

### Outline Light Button

Dipakai di hero/header gelap.

```css
.btn-outline-light {
  border: 1px solid rgba(255,255,255,0.55);
  color: #fff;
  background: transparent;
  min-height: 40px;
  padding: 0 18px;
}
```

### Outline Dark Button

Dipakai di section terang.

```css
.btn-outline-dark {
  border: 1px solid #A9A8A7;
  color: var(--color-text-main);
  background: transparent;
  min-height: 42px;
  padding: 0 20px;
}
```

---

## 6.2 Icon Feature Item

Dipakai untuk fitur vila:

- `5 Bedrooms`
- `5.5 Bathrooms`
- `Up to 10 Guests`
- `Private Pool & Jacuzzi`
- `Rice Field View`
- `Wi‑Fi High Speed`
- `Daily Housekeeping`

Struktur:

```html
<div class="feature-item">
  <span class="feature-icon"></span>
  <span class="feature-label">5<br>Bedrooms</span>
</div>
```

Style:

```css
.feature-item {
  text-align: center;
  color: var(--color-text-main);
}
.feature-icon {
  display: block;
  width: 28px;
  height: 28px;
  margin: 0 auto 12px;
  opacity: 0.75;
}
.feature-label {
  font-size: 13px;
  line-height: 1.35;
}
```

Ikon harus berupa line icon tipis, bukan filled icon.

---

## 6.3 Photo Card

Foto adalah elemen paling penting. Semua foto wajib terasa premium.

Aturan:

- `object-fit: cover`.
- Hindari border radius besar.
- Gunakan rasio konsisten.
- Jangan pakai filter berlebihan, kecuali overlay hero.
- Untuk collage, foto bisa overlap dengan shadow.

Rasio rekomendasi:

| Penggunaan | Rasio |
|---|---:|
| Hero | 16:9 / full bleed |
| About collage utama | 4:3 |
| About collage kecil | 4:3 / 3:2 |
| Room card | 4:3 |
| Experience card | 16:10 |
| Blog thumbnail horizontal | 16:9 |
| Gallery mosaic besar | 4:3 |
| Gallery mosaic kecil | 16:10 / 1:1 |

---

## 6.4 Section Header

Pola umum:

```html
<div class="section-header">
  <p class="eyebrow">ROOMS & SUITES</p>
  <h2>Spacious Rooms for a Restful Stay</h2>
  <a class="section-link">VIEW ALL ROOMS →</a>
</div>
```

Style:

- Eyebrow kecil uppercase.
- Heading serif center atau left tergantung section.
- Link kanan uppercase kecil.

---

## 6.5 Footer

Ada dua variasi footer:

1. **Home footer gelap** dengan newsletter di atasnya.
2. **Subpage footer terang** dengan CTA bar gelap di atas footer.

Footer umum berisi:

- Logo `Omah Nongko`.
- Deskripsi pendek:
  > A private villa in Bali blending sculptural architecture with spacious tropical living.
- Social icons: Instagram, Facebook, TikTok, YouTube.
- Explore:
  - The Villa
  - Rooms
  - Amenities
  - Experiences
  - Gallery
  - Blog
- Info:
  - Rates & Availability
  - Location
  - House Rules
  - FAQ
  - Contact
- Contact:
  - Booking via WhatsApp
  - `+62 812 3456 7890`
  - Email `info@omahnongko.com`
  - Location `Umalas, Bali, Indonesia`
- Bottom:
  - `© 2024 Villa Omah Nongko. All rights reserved.`
  - `Privacy Policy`
  - `Terms & Conditions`

Grid footer desktop:

```css
.footer-grid {
  display: grid;
  grid-template-columns: 1.4fr 1fr 1fr 1.2fr;
  gap: 64px;
}
```

---

# 7. Page: Home

Home adalah halaman utama paling lengkap. Desainnya memadukan hero, quick facts, about, rooms, amenities, experiences, reviews, newsletter, dan footer gelap.

---

## 7.1 Home Hero

Layout:

- Full-width hero foto vila dengan kolam.
- Overlay gelap agar teks putih terbaca.
- Teks hero di kiri bawah/tengah.
- CTA outline light: `DISCOVER THE VILLA`.

Elemen:

```text
Villa Omah Nongko
A curved leaf in the landscape, Omah Nongko rests quietly on the edge of Bali's rice fields...
[DISCOVER THE VILLA →]
```

Hero height desktop: `640–720px`.

---

## 7.2 Quick Facts Strip

Tepat setelah hero, ada strip putih/off-white dengan 7 icon feature.

Desktop:

- Layout 7 kolom sama rata.
- Tinggi sekitar 120–140px.
- Border bawah tipis.
- Ikon line di atas, teks di bawah.

Data:

```text
5 Bedrooms
5.5 Bathrooms
Up to 10 Guests
Private Pool & Jacuzzi
Rice Field View
Wi‑Fi High Speed
Daily Housekeeping
```

Mobile:

- Jadikan horizontal scroll atau grid 2 kolom.

---

## 7.3 About Section

Konten kiri:

- Eyebrow: `ABOUT OMAH NONGKO`
- Heading: `A Private Villa Surrounded by Nature`
- Deskripsi pendek 2–3 baris.
- Button outline dark: `LEARN MORE →`

Konten kanan:

- Collage 2 foto:
  - Foto besar interior/living/dining di kanan atas.
  - Foto kecil/medium kolam/taman overlap di kiri bawah.
- Foto overlap menggunakan shadow.

Layout desktop:

```text
[Text 40%]        [Photo collage 60%]
```

Spesifikasi CSS:

```css
.about-section {
  padding: 96px 0;
}
.about-grid {
  display: grid;
  grid-template-columns: 0.9fr 1.4fr;
  gap: 72px;
  align-items: center;
}
.about-collage {
  position: relative;
  min-height: 430px;
}
.about-photo-large {
  width: 72%;
  margin-left: auto;
}
.about-photo-small {
  position: absolute;
  left: 0;
  bottom: 24px;
  width: 48%;
  box-shadow: var(--shadow-photo);
}
```

---

## 7.4 Rooms & Suites

Section title:

- Eyebrow: `ROOMS & SUITES`
- Heading: `Spacious Rooms for a Restful Stay`
- Link kanan: `VIEW ALL ROOMS →`

Layout:

- 5 room cards dalam satu row desktop.
- Setiap card memiliki foto atas dan konten bawah.
- Konten card:
  - Nama room.
  - Bed info.
  - Link kecil `View Room Details →`.

Data card:

1. `Master Suite` — `1 King Bed`
2. `Suite Garden View` — `1 King Bed`
3. `Suite Pool View` — `1 King Bed`
4. `Suite Terrace` — `1 King Bed`
5. `Suite Family` — `2 Single Beds`

Style card:

```css
.room-card {
  background: #fff;
  border: 1px solid var(--color-border);
}
.room-card img {
  aspect-ratio: 4 / 3;
  width: 100%;
  object-fit: cover;
}
.room-card-body {
  padding: 22px 20px;
}
```

Mobile:

- Horizontal scroll cards atau 1 kolom stacked.

---

## 7.5 Highlights & Amenities

Section center:

- Eyebrow: `HIGHLIGHTS & AMENITIES`
- Heading: `Everything You Need for a Perfect Stay`

Ikon 8 item:

1. `Private Pool & Jacuzzi`
2. `Tropical Garden`
3. `Fully Equipped Kitchen`
4. `Air Conditioning Throughout`
5. `Smart TV & Entertainment`
6. `High Speed Wi‑Fi`
7. `Safety Box`
8. `Parking Area Available`

Layout:

- Desktop: 8 kolom atau 4 kolom x 2 bila lebar tidak cukup.
- Button center: `VIEW FULL AMENITIES`.

Background:

- Off-white dengan bayangan daun samar di kiri bawah.
- Daun sebagai decorative background opacity rendah `0.05–0.10`.

---

## 7.6 Experiences

Section center:

- Eyebrow: `EXPERIENCES`
- Heading: `Designed for Your Bali Moments`
- Deskripsi:
  > From relaxing days by the pool to exploring Bali's vibrant culture, we create experiences you'll always remember.

Card 4 kolom:

1. `Relax & Unwind`
   - Deskripsi: `Enjoy peaceful moments surrounded by nature.`
   - Foto: area pool/living.
2. `In‑Villa Dining`
   - Deskripsi: `Savor delicious meals prepared just for you.`
   - Foto: floating breakfast/dining.
3. `Spa & Massage`
   - Deskripsi: `Rejuvenate your body and mind in-villa.`
   - Foto: spa/massage.
4. `Day Tours`
   - Deskripsi: `Explore Bali's best spots with ease.`
   - Foto: travel/pool/resort.

Visual:

- Foto di atas.
- Ikon bulat kecil overlay di bawah foto, center.
- Judul serif kecil.
- Deskripsi sans muted.

Button center: `EXPLORE EXPERIENCES`.

---

## 7.7 Guest Reviews

Section center:

- Eyebrow: `GUEST REVIEWS`
- Heading: `Loved by Our Guests`

Layout desktop:

- 2 testimonial columns.
- Quote mark besar berwarna olive/green muted.
- Text testimonial pendek.
- Nama guest + negara.
- Rating bintang 5.
- Slider dots di bawah.

Contoh konten:

```text
Omah Nongko is even more beautiful in person. The villa is huge, spotlessly clean, and the staff are incredibly kind and attentive. We felt at home and didn't want to leave!
— Sarah T., Australia
★★★★★

The perfect place for our family holiday in Bali. The kids loved the pool and the open space. Everything was just perfect.
— Michael H., Singapore
★★★★★
```

---

## 7.8 Newsletter + Dark Footer

Newsletter block berada di atas footer gelap.

Layout:

- Background hijau gelap dengan texture daun.
- Kiri: `STAY IN THE LOOP` + deskripsi pendek.
- Kanan: input email + button `SUBSCRIBE`.

Input style:

- Transparent/dark background.
- Border putih opacity rendah.
- Button outline/solid dark.

Footer di bawah tetap gelap, grid 4 kolom.

---

# 8. Page: The Villa

Halaman ini menjelaskan detail vila secara editorial. Komposisi lebih tenang dan banyak section foto.

---

## 8.1 Hero The Villa

Gunakan pola hero global.

Konten:

```text
The Villa
Villa Omah Nongko is a five bedroom private villa that blends sculptural architecture with spacious tropical living. Designed to harmonize with its surroundings, the villa offers comfort, privacy, and a true sense of place.
```

---

## 8.2 Intro: A Private Villa Surrounded by Nature

Layout desktop:

```text
[Text + CTA + quick facts]      [Image collage]
```

Kiri:

- Heading: `A Private Villa Surrounded by Nature`
- Deskripsi:
  > Built with a philosophy of harmony between architecture and nature, Omah Nongko offers a peaceful retreat with open living spaces, natural materials, and lush tropical gardens.
- Button: `BOOK VIA WHATSAPP`
- Row feature icons:
  - `5 Bedrooms`
  - `5.5 Bathrooms`
  - `Up to 10 Guests`
  - `Private Pool & Jacuzzi`
  - `Rice Field View`
  - `Tropical Garden`

Kanan:

- Foto besar exterior/pool.
- Foto kecil interior overlap di kanan bawah.
- Gunakan shadow untuk foto overlap.

---

## 8.3 Villa Gallery Mosaic

Section title: `Villa Gallery`

Tabs kecil di atas kanan/center:

- `All`
- `Villa`
- `Rooms`
- `Pool`
- `Surroundings`

Mosaic layout:

- Grid 2 kolom besar:
  - Kiri: foto besar pool/exterior, lebar 50%.
  - Kanan: grid 2 x 3 foto kecil.
- Baris bawah ada 2 foto sedang dan beberapa foto kecil.

Implementasi rekomendasi CSS grid:

```css
.villa-mosaic {
  display: grid;
  grid-template-columns: 1.1fr 1fr;
  gap: 8px;
}
.villa-mosaic-right {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 8px;
}
```

---

## 8.4 Living in Harmony

Layout:

- Kiri: teks.
- Kanan: foto besar living room.

Konten kiri:

- Heading: `Living in Harmony`
- Deskripsi:
  > Open-air living and dining spaces invite the outdoors in, while natural materials and artisanal details create a warm, timeless atmosphere.
- Checklist icon:
  - `Open-plan living and dining area`
  - `Fully equipped kitchen`
  - `Floor-to-ceiling windows`
  - `Natural wood & local materials`

Foto kanan:

- Rasio horizontal 16:9 atau 16:10.
- Width lebih besar dari teks.

---

## 8.5 Five Comfortable Suites

Layout:

- Kiri: text block + button.
- Kanan: carousel horizontal rooms.

Kiri:

- Heading: `Five Comfortable Suites`
- Deskripsi:
  > Each suite is designed for rest and relaxation, featuring en-suite bathrooms, garden or pool views, and a blend of modern comfort with tropical charm.
- Button: `VIEW ROOM DETAILS →`

Kanan:

- 5 mini cards/foto room.
- Tiap item:
  - Foto kamar.
  - Nama suite.
  - Bed type.

Ada slider arrow bulat kecil di bawah.

---

## 8.6 Architecture & Location

Section 3 kolom/komposisi editorial:

- Kiri: `Architecture` + deskripsi.
- Tengah: foto exterior villa.
- Kanan: `The Location` + deskripsi + button `EXPLORE LOCATION`.

Konten:

Architecture:

> Omah Nongko's architectural design draws from the curves and textures of Bali's natural landscape. The signature leaf-shaped roofs, open spaces, and use of natural elements create a villa that feels both unique and deeply connected to its surroundings.

The Location:

> Located just north of Umalas and minutes from Seminyak's coastline, the villa offers a peaceful escape while keeping you close to the best of Bali — beaches, restaurants, and vibrant culture.

---

## 8.7 CTA Bar + Footer

CTA bar gelap:

- Kiri: `Ready to experience Omah Nongko?`
- Subtext: `Book your stay and enjoy a private escape in the heart of Bali.`
- Kanan: button outline light `BOOK VIA WHATSAPP`.

Footer terang/off-white di bawahnya.

---

# 9. Page: Gallery

Halaman Gallery fokus pada foto kategori. Layout grid rapat, bersih, dan editorial.

---

## 9.1 Hero Gallery

Gunakan hero global.

Konten:

```text
Gallery
Explore the beauty of Villa Omah Nongko through our gallery. Every space is thoughtfully designed to blend with nature and create unforgettable moments.
```

---

## 9.2 Gallery Filter Bar

Tepat di bawah hero.

Kiri: kategori tabs:

- `All`
- `Villa Exterior`
- `Living Areas`
- `Bedrooms`
- `Bathrooms`
- `Kitchen & Dining`
- `Pool & Garden`
- `Surroundings`

Kanan: button outline `VIEW SLIDESHOW` + icon play/circle.

Style:

```css
.gallery-filter {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 44px 0 32px;
}
.gallery-tabs {
  display: flex;
  gap: 34px;
}
.gallery-tab {
  font-size: 12px;
  color: var(--color-text-muted);
}
.gallery-tab.active {
  color: var(--color-text-main);
  border-bottom: 1px solid var(--color-text-main);
}
```

Mobile:

- Tabs menjadi horizontal scroll.
- Button slideshow turun ke baris bawah.

---

## 9.3 Gallery Category Section

Setiap kategori memiliki struktur:

```text
[Section Title]                              [VIEW ALL PHOTOS →]
[Large Image] [Small Image Grid]
```

Judul kategori:

1. `Villa Exterior`
2. `Living Areas`
3. `Bedrooms`
4. `Pool & Garden`
5. `Kitchen & Dining`
6. `Surroundings`

### Layout Mosaic A

Untuk kategori besar seperti Villa Exterior, Living Areas, Bedrooms, Pool & Garden:

```css
.gallery-category-grid {
  display: grid;
  grid-template-columns: 1.15fr 1fr;
  gap: 8px;
}
.gallery-main-photo {
  aspect-ratio: 16 / 10;
}
.gallery-small-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 8px;
}
.gallery-small-grid img {
  aspect-ratio: 16 / 10;
}
```

Jumlah foto per section:

- 1 foto besar kiri.
- 4 foto kecil kanan.
- Pada beberapa section, bisa 1 foto besar + 5 foto kecil jika layout butuh.

### Layout Mosaic B

Untuk `Kitchen & Dining` dan `Surroundings`, gambar terlihat lebih horizontal:

```css
.gallery-row-grid {
  display: grid;
  grid-template-columns: 1.25fr repeat(3, 1fr);
  gap: 8px;
}
```

Aturan crop:

- Exterior: tampilkan bangunan villa, pool, taman, langit.
- Living Areas: tampilkan sofa, dining, jendela besar, view taman.
- Bedrooms: tampilkan kasur, kayu, jendela, suasana hangat.
- Pool & Garden: tampilkan pool, jacuzzi, palms, garden path.
- Kitchen & Dining: tampilkan meja makan, breakfast, kitchen, open dining.
- Surroundings: tampilkan rice field, pantai, sunset, pura/gate Bali, landscape.

---

## 9.4 Gallery CTA + Footer

CTA bar gelap setelah gallery:

```text
Ready to experience Omah Nongko?
Book your stay and enjoy a private escape in the heart of Bali.
[BOOK VIA WHATSAPP]
```

Footer terang/off-white.

---

# 10. Page: Journal / Blog

Halaman Journal memiliki layout editorial blog dengan list artikel dan sidebar kanan.

---

## 10.1 Hero Journal

Gunakan hero global.

Konten:

```text
Journal
Stories and inspirations from Bali. Discover local experiences, travel tips, wellness, and villa life at Omah Nongko.
```

---

## 10.2 Blog Main Layout

Desktop:

```text
[Latest Stories 70%]    [Sidebar 30%]
```

CSS:

```css
.blog-layout {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 320px;
  gap: 64px;
  align-items: start;
}
```

Top row di main content:

- Kiri: heading `Latest Stories`.
- Kanan kecil: dropdown sort `Most Recent`.
- Sidebar atas: search input.

---

## 10.3 Blog Post Card Horizontal

Card artikel terdiri dari foto kiri dan teks kanan.

Struktur:

```html
<article class="post-card">
  <img src="..." alt="..." />
  <div class="post-card-body">
    <p class="eyebrow">LOCAL GUIDE</p>
    <h2>The Beauty of Bali’s Rice Field Living</h2>
    <p>Step into the heart of Bali and discover the timeless beauty of rice field living...</p>
    <div class="post-meta">May 12, 2024 · 5 min read</div>
    <a>READ MORE →</a>
  </div>
</article>
```

Style:

```css
.post-card {
  display: grid;
  grid-template-columns: 1fr 0.82fr;
  background: var(--color-bg-card);
  border: 1px solid var(--color-border);
  margin-bottom: 12px;
}
.post-card img {
  width: 100%;
  height: 100%;
  aspect-ratio: 16 / 9;
  object-fit: cover;
}
.post-card-body {
  padding: 32px 36px;
}
.post-card h2 {
  font-size: 30px;
  line-height: 1.12;
}
```

Artikel yang terlihat:

1. Category: `LOCAL GUIDE`  
   Title: `The Beauty of Bali’s Rice Field Living`  
   Date: `May 12, 2024`  
   Read time: `5 min read`

2. Category: `WELLNESS`  
   Title: `Wellness & Relaxation in Your Villa`  
   Date: `April 30, 2024`  
   Read time: `4 min read`

3. Category: `IN‑VILLA EXPERIENCE`  
   Title: `In‑Villa Dining: A Taste of Bali at Home`  
   Date: `April 18, 2024`  
   Read time: `5 min read`

4. Category: `THINGS TO DO`  
   Title: `Local Experiences You Shouldn’t Miss`  
   Date: `April 5, 2024`  
   Read time: `6 min read`

5. Category: `TRAVEL GUIDE`  
   Title: `Bali’s Best Beaches Near Umalas`  
   Date: `March 20, 2024`  
   Read time: `4 min read`

---

## 10.4 Sidebar Journal

Sidebar terdiri dari 4 block:

### Search Box

- Input placeholder: `Search articles...`
- Icon search kanan.
- Tinggi 52–56px.
- Border tipis.

### Categories Card

Title: `Categories`

Items:

- `All Articles`
- `Local Guide`
- `Wellness`
- `In‑Villa Experience`
- `Things To Do`
- `Travel Guide`

Style:

- Card putih/off-white dengan border.
- Item active memiliki background beige/grey sangat muda.
- Icon line kecil di kiri.

### Popular Posts Card

Title: `Popular Posts`

List item:

- Thumbnail 80x60.
- Title kecil bold/serif atau sans semi-bold.
- Date kecil muted.

Popular posts:

1. `The Beauty of Bali’s Rice Field Living` — `May 12, 2024`
2. `A Guide to Seminyak & Umalas` — `April 25, 2024`
3. `In‑Villa Dining: A Taste of Bali at Home` — `April 18, 2024`
4. `Local Experiences You Shouldn’t Miss` — `April 5, 2024`

### Subscribe Card

Title: `Stay Inspired`

Description:

> Subscribe to receive travel tips, exclusive offers, and villa updates.

Input: `Enter your email`

Button: `SUBSCRIBE`

### Dark CTA Card

- Background image daun gelap.
- Text: `Ready to experience Omah Nongko?`
- Button: `BOOK VIA WHATSAPP`.

---

## 10.5 Pagination

Di bawah list artikel:

```text
[1] 2 3 ... 7
```

Style:

- Active page kotak outline.
- Non-active text biasa.
- Spasi antar angka 20–24px.

---

## 10.6 Journal Feature Strip + Footer

Sebelum footer ada strip gelap dengan 6 amenity icons:

- `Private Pool & Jacuzzi`
- `Tropical Garden`
- `Fully Equipped Kitchen`
- `Air Conditioning Throughout`
- `High Speed Wi‑Fi`
- `Daily Housekeeping`

Background strip hijau gelap dengan texture daun.

Footer di bawahnya versi terang/off-white.

---

# 11. Asset Direction

## 11.1 Jenis Foto yang Dibutuhkan

Website membutuhkan foto-foto berikut:

### Villa Exterior

- Wide shot vila + pool + taman.
- Villa malam hari dengan lampu warm.
- Path/taman tropis menuju vila.
- Tampilan roof arsitektur melengkung/leaf-inspired.

### Living Areas

- Open living room dengan sofa dan view pool.
- Dining area dengan meja kayu.
- Interior kayu natural.
- Jendela besar menghadap taman.

### Bedrooms

- Master suite dengan king bed.
- Suite garden view.
- Suite pool view.
- Suite terrace.
- Suite family/twin bed.

### Pool & Garden

- Private pool wide shot.
- Jacuzzi detail.
- Tropical garden/palm trees.
- Pool at dusk/night.

### Kitchen & Dining

- Dining table set.
- In-villa dining setup.
- Floating breakfast.
- Kitchen detail.

### Surroundings

- Rice field.
- Beach sunset.
- Bali temple/gate.
- Umalas/Seminyak nearby scenery.

---

## 11.2 Naming Asset

Gunakan nama file konsisten agar mudah dibaca AI/developer:

```text
hero-home-villa-pool.jpg
hero-the-villa.jpg
hero-gallery.jpg
hero-journal.jpg
villa-exterior-01.jpg
villa-exterior-night-01.jpg
living-area-01.jpg
bedroom-master-01.jpg
bedroom-garden-01.jpg
pool-garden-01.jpg
kitchen-dining-01.jpg
surroundings-rice-field-01.jpg
surroundings-beach-01.jpg
journal-rice-field-living.jpg
journal-wellness-villa.jpg
journal-in-villa-dining.jpg
journal-local-experiences.jpg
journal-bali-beaches.jpg
texture-palm-dark.jpg
```

---

# 12. Interaction & State

## 12.1 Navigation

- Hover link: opacity turun ke `0.75` atau underline tipis.
- Active page: underline tipis atau warna lebih terang.
- Header on scroll: background `rgba(23, 26, 17, 0.88)` + blur.

## 12.2 Button

- Hover primary: background sedikit lebih olive.
- Hover outline: background putih 8–12% opacity untuk dark area, atau background hijau gelap untuk light area.
- Icon arrow bergeser `translateX(2px)`.

## 12.3 Gallery

- Klik foto membuka lightbox/slideshow.
- Filter tabs menyaring kategori.
- `VIEW ALL PHOTOS` membuka halaman/filter kategori terkait.
- Hover foto: overlay hitam `rgba(0,0,0,0.15)` + sedikit scale `1.02`.

## 12.4 Blog

- Search input filter artikel.
- Category item active highlight.
- Blog card hover: foto sedikit scale, title underline halus.
- Pagination update list artikel.

## 12.5 Forms

- Subscribe field validasi email.
- Success message: `Thank you for subscribing.`
- Error message: `Please enter a valid email address.`

---

# 13. Responsive Rules Detail

## 13.1 Desktop ≥ 1200px

- Header full navigation tampil.
- Hero tinggi 620–720px.
- Container max 1240px.
- Rooms 5 kolom.
- Experiences 4 kolom.
- Gallery mosaic desktop penuh.
- Blog layout 2 kolom dengan sidebar 320px.

## 13.2 Tablet 769–1199px

- Header secondary nav boleh tetap tampil bila cukup, atau masuk menu.
- Hero tinggi 540–620px.
- About grid tetap 2 kolom tapi gap lebih kecil.
- Rooms 3 kolom atau horizontal scroll.
- Amenities 4 kolom x 2.
- Experiences 2 kolom.
- Gallery mosaic 2 kolom sederhana.
- Blog sidebar turun jika lebar kurang dari 1024px.

## 13.3 Mobile ≤ 768px

- Header: hamburger + logo + WhatsApp icon.
- Hero tinggi 560px, teks di kiri bawah.
- Hero title 42–48px.
- Feature strip horizontal scroll.
- About menjadi 1 kolom, collage ditampilkan setelah teks.
- Rooms menjadi horizontal cards atau stacked.
- Amenities 2 kolom.
- Experiences 1 kolom.
- Gallery filter horizontal scroll.
- Gallery mosaic menjadi 1 kolom, semua foto full width.
- Blog post card menjadi stacked: foto atas, teks bawah.
- Sidebar journal turun ke bawah.
- Footer grid menjadi 1 kolom.

Contoh mobile card:

```css
@media (max-width: 768px) {
  .container {
    padding-inline: 24px;
  }

  .hero {
    min-height: 560px;
  }

  .hero h1 {
    font-size: 46px;
  }

  .post-card {
    grid-template-columns: 1fr;
  }

  .footer-grid {
    grid-template-columns: 1fr;
    gap: 36px;
  }
}
```

---

# 14. Accessibility

- Semua foto wajib memiliki `alt` yang deskriptif.
- Kontras teks putih di hero harus cukup; overlay jangan kurang dari 45% gelap.
- Tombol harus dapat difokus menggunakan keyboard.
- Fokus state harus terlihat, misalnya outline `2px solid #94806E`.
- Form email harus punya label accessible walaupun placeholder tampil.
- Icon tidak boleh menjadi satu-satunya informasi; tetap pakai teks.
- Gunakan semantic HTML:
  - `<header>`
  - `<nav>`
  - `<main>`
  - `<section>`
  - `<article>` untuk blog cards
  - `<footer>`

---

# 15. SEO & Content Structure

Gunakan satu `h1` per halaman:

- Home: `Villa Omah Nongko`
- The Villa: `The Villa`
- Gallery: `Gallery`
- Journal: `Journal`

Section title gunakan `h2`, card title gunakan `h3`.

Meta title rekomendasi:

```text
Home: Villa Omah Nongko — Private Tropical Villa in Bali
The Villa: The Villa — Omah Nongko Bali
Gallery: Gallery — Villa Omah Nongko
Journal: Journal — Bali Travel, Wellness & Villa Stories
```

Meta description rekomendasi:

```text
A private villa in Bali blending sculptural architecture, spacious tropical living, lush gardens, and a peaceful poolside escape near Umalas and Seminyak.
```

---

# 16. Implementation Notes untuk AI/Developer

## 16.1 Struktur Komponen Rekomendasi

```text
/components
  Header.tsx
  Footer.tsx
  Hero.tsx
  Button.tsx
  FeatureStrip.tsx
  SectionHeader.tsx
  PhotoMosaic.tsx
  RoomCard.tsx
  ExperienceCard.tsx
  TestimonialCard.tsx
  BlogPostCard.tsx
  BlogSidebar.tsx
  Newsletter.tsx
  CTASection.tsx

/pages
  Home.tsx
  TheVilla.tsx
  Gallery.tsx
  Journal.tsx

/styles
  tokens.css
  global.css
  layout.css
  components.css
```

## 16.2 Data-driven Content

Simpan data seperti rooms, amenities, experiences, blog posts, dan gallery categories dalam file data agar mudah diedit.

Contoh:

```ts
export const amenities = [
  { label: "Private Pool & Jacuzzi", icon: "pool" },
  { label: "Tropical Garden", icon: "leaf" },
  { label: "Fully Equipped Kitchen", icon: "kitchen" },
  { label: "Air Conditioning Throughout", icon: "ac" },
  { label: "High Speed Wi‑Fi", icon: "wifi" },
  { label: "Daily Housekeeping", icon: "housekeeping" },
];
```

## 16.3 Larangan Visual

Agar desain tetap sesuai referensi, hindari:

- Warna hijau neon atau terlalu terang.
- Rounded corner besar.
- Font heading sans-serif tebal.
- Card shadow berat di semua elemen.
- Layout terlalu padat.
- Background putih murni terlalu dingin.
- Icon filled berwarna-warni.
- Gradien modern yang terlalu mencolok.

---

# 17. Checklist Final UI

Sebelum desain dianggap selesai, pastikan:

- [ ] Header transparan di atas hero dan terlihat premium.
- [ ] Hero punya overlay gelap dan teks terbaca jelas.
- [ ] Heading memakai serif elegan.
- [ ] Body memakai sans-serif dengan warna muted.
- [ ] Background utama off-white hangat.
- [ ] Tombol utama hijau gelap dengan uppercase text.
- [ ] Semua foto crop rapi dan konsisten.
- [ ] Gallery memakai mosaic grid, bukan grid biasa semua ukuran sama.
- [ ] Journal memakai layout artikel horizontal + sidebar.
- [ ] Footer punya 4 kolom pada desktop.
- [ ] Mobile layout tidak pecah dan tetap terasa premium.
- [ ] CTA WhatsApp selalu mudah ditemukan.

---

# 18. Ringkasan Gaya dalam 1 Kalimat

Desain ini adalah website villa tropis premium dengan **hero fotografi gelap, typography serif editorial, warna hijau daun gelap, background putih hangat, layout lega, photo mosaic, card minimal, dan CTA WhatsApp yang konsisten**.
