# Villa Omah Nongko — SEO Fase A Audit

Tanggal audit: 2026-08-27
Environment audit: production publik dan source repo `/home/villa`
Scope: audit only; tidak ada perubahan production pada Fase A.

## Ringkasan

Website dapat di-crawl dan seluruh URL yang tercantum pada sitemap publik mengembalikan HTTP 200 setelah redirect resolution. Robots production mengizinkan crawling dan menunjuk ke sitemap. Homepage memiliki canonical, hreflang, Open Graph, dan JSON-LD `LodgingBusiness`.

Temuan teknis P0 yang perlu ditangani pada Fase B:

1. `http://www.villaomahnongko.com/` mengembalikan 404, sedangkan host canonical yang lain berakhir di `https://www.villaomahnongko.com/`.
2. Canonical homepage dan URL schema perlu diverifikasi/diselaraskan pada source aktif. Source homepage memakai `route('home.index')`; production canonical yang terlihat adalah `https://www.villaomahnongko.com` tanpa trailing slash, sedangkan sitemap memakai URL tanpa trailing slash untuk homepage.
3. Source dan production perlu diaudit ulang setelah perubahan karena terdapat lebih dari satu jalur locale (`/` untuk Indonesia dan `/en` untuk Inggris), sementara helper locale memiliki konsep target `id` dan route homepage default.

## Fakta terverifikasi

### Domain dan redirect

| URL | Hasil |
|---|---|
| `http://villaomahnongko.com/` | redirect ke HTTPS lalu www, final 200 |
| `https://villaomahnongko.com/` | redirect ke www HTTPS, final 200 |
| `http://www.villaomahnongko.com/` | 404 Not Found |
| `https://www.villaomahnongko.com/` | 200 OK |
| `https://www.villaomahnongko.com/en` | 200 OK |
| `https://www.villaomahnongko.com/id` | 200 OK pada pemeriksaan publik sebelumnya |

Nginx origin memiliki server block HTTP yang hanya melakukan redirect untuk host `villaomahnongko.com`, lalu `return 404` untuk server block yang juga mencantumkan `www.villaomahnongko.com`. Ini menjelaskan 404 pada HTTP www.

### Robots dan sitemap

- `https://www.villaomahnongko.com/robots.txt`: HTTP 200.
- Production robots berisi `User-agent: *`, `Allow: /`, dan URL sitemap.
- `https://www.villaomahnongko.com/sitemap.xml`: HTTP 200, XML valid secara bentuk.
- Sitemap publik berisi 18 URL.
- 18/18 URL sitemap mengembalikan HTTP 200 setelah redirect resolution.
- Sitemap controller source: `app/Http/Controllers/SitemapController.php`.
- URL homepage Indonesia dan Inggris memang sengaja dibedakan oleh controller.
- `lastmod` untuk halaman statis menggunakan tanggal saat request (`now()->toDateString()`), bukan tanggal perubahan konten. Ini bukan blocker indexing, tetapi membuat sinyal perubahan kurang akurat dan perlu diperbaiki pada fase teknis berikutnya.

### Metadata homepage production

Homepage publik mengirim:

- `robots`: `index, follow`;
- canonical: `https://www.villaomahnongko.com`;
- hreflang `id`: `https://www.villaomahnongko.com`;
- hreflang `en`: `https://www.villaomahnongko.com/en`;
- hreflang `x-default`: `https://www.villaomahnongko.com`;
- H1: `Villa Omah Nongko`;
- JSON-LD type: `LodgingBusiness`.

Halaman `/en` mengirim canonical ke `/en` dan pasangan hreflang yang sama.

### Structured data homepage source

`resources/views/pages/home.blade.php` membuat schema `LodgingBusiness` dengan:

- nama bisnis;
- deskripsi;
- URL dari `route('home.index')`;
- image;
- telephone;
- address locality/region/country;
- amenity features.

Data yang belum ada di schema homepage source:

- `@id` stabil untuk entity;
- `sameAs` profil resmi;
- `geo` coordinates;
- `streetAddress`/postal code lengkap;
- `priceRange` jika memang tersedia.

Data tersebut tidak boleh diisi dengan nilai tebakan.

### `baseline-whatsapp`

`baseline-whatsapp` bukan duplicate document title. Audit DOM menunjukkan seluruh kemunculannya berada di dalam elemen `<title>` pada SVG ikon WhatsApp, misalnya:

```html
<svg ...><title>baseline-whatsapp</title>...</svg>
```

Document title halaman tetap satu. Temuan ini bukan penyebab utama masalah indexing dan tidak perlu dihapus sebagai SEO fix.

## Hal yang belum dapat dipastikan dari luar

Tanpa akses Google Search Console, audit publik tidak dapat memastikan apakah homepage berstatus:

- Indexed;
- Crawled - currently not indexed;
- Discovered - currently not indexed;
- Duplicate, Google chose different canonical;
- atau memiliki masalah manual action/security.

Permintaan indexing dan status Google-selected canonical harus diverifikasi di Google Search Console pada Fase A lanjutan atau sebelum Fase B deploy.

## Rekomendasi Fase B

1. Perbaiki semua HTTP/HTTPS dan www/non-www supaya berakhir di satu canonical host.
2. Putuskan secara eksplisit apakah homepage Indonesia canonical memakai `/` atau `/id`; jangan biarkan dua URL identik bersaing.
3. Samakan canonical, JSON-LD `url`, `og:url`, hreflang, internal links, dan sitemap.
4. Ubah `lastmod` sitemap agar memakai tanggal perubahan konten nyata atau hilangkan `lastmod` untuk URL yang tidak memiliki data perubahan.
5. Pertimbangkan memperkaya `LodgingBusiness` dengan data bisnis nyata yang sudah dikonfirmasi.
6. Setelah deploy Fase B, submit sitemap dan request indexing di Google Search Console.

## Status Fase A

- Audit source repo yang benar: selesai.
- Audit redirect publik: selesai.
- Audit robots/sitemap: selesai.
- Audit metadata/canonical/hreflang/schema: selesai.
- Perubahan production: tidak dilakukan.
- Perubahan source aplikasi: tidak dilakukan.
- Laporan audit ini: siap di-commit dan dipush ke branch Git terpisah.

## Catatan Git

File laporan ini adalah satu-satunya file yang dimaksudkan untuk commit Fase A. Perubahan lokal existing pada `.gitignore`, `package-lock.json`, dan view lain tidak termasuk scope dan tidak boleh ikut ter-stage.

Untracked `public/slava-reference.png` juga tidak termasuk scope.

## Referensi pemeriksaan publik

- `https://www.villaomahnongko.com/`
- `https://www.villaomahnongko.com/en`
- `https://www.villaomahnongko.com/robots.txt`
- `https://www.villaomahnongko.com/sitemap.xml`
- `http://www.villaomahnongko.com/`
- `https://villaomahnongko.com/`
- `http://villaomahnongko.com/`

Semua hasil di atas adalah snapshot audit pada tanggal audit dan harus diverifikasi ulang setelah perubahan konfigurasi atau deploy.