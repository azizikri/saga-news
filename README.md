# Saga News

## Setup

- Clone the repo and cd into it

```bash
git clone https://github.com/azizikri/saga-news.git && cd saga-news
```

- Install dependencies

```bash
composer install && npm install && npm run build
```

- Copy .env.example to .env

```bash
cp .env.example .env
```

- Generate app key

```bash
php artisan key:generate
```

- Create a database and update .env file with your database credentials and your google oauth credentials

- Migrate database

```bash
php artisan migrate --seed
```

- Run the app

```bash
php artisan serve
```

- Login with the following credentials

```bash
email: admin@gmail.com
password: admin
```

## Task

### API

- Buat API list kategori ✅
- Buat API list artikel dengan ketentuan: ✅
  - Pencarian berdasarkan kolom title ✅
  - Filter berdasarkan kolom slug yang ada di table category ✅
  - Otomatis sort berdasarkan created_at terbaru ✅

Contoh: `http://test.local/api/news?keyword=&category_slug=`

- Buat API detail Artikel dengan filter berdasarkan slug, ✅

Contoh: `http://test.local/api/news/test-programmer`

### CMS

- Authentication ✅
  - Admin bisa login menggunakan email dan password ✅
- CRUD artikel ✅
  - Field yang harus ada id, category_id, title, slug, content, banner, created_at, updated_at. ✅
  - Category ID berupa dropdown untuk memilih dari daftar kategori yang ada. ✅
  - Title digunakan untuk judul artikel (misal: Judul Artikel). ✅
  - Slug diambil dari title (misal: judul-artikel). ✅
  - Banner untuk upload image. ✅
  - Selebihnya silahkan ditambah sesuai kreatifitas kamu.
- CRUD kategori ✅
  - Field yang harus ada id, name, slug. ✅
  - Selebihnya silahkan ditambah sesuai kreatifitas kamu. ✅
- CRUD user ✅
  - Field yang harus ada id, email, password.✅
  - Selebihnya silahkan ditambah sesuai kreatifitas kamu.
- Halaman User Profile ✅
  - Menampilkan profil / data user ✅
  - User bisa mengganti password. Fieldnya seperti biasa ada old password, new password, confirm password.✅

### Additional Requirements (Bonus Point)

- Ada dua jenis user ✅
  - Admin, bisa CRUD artikel, kategori, dan user. ✅
  - Admin bisa mengganti role user menjadi Admin ataupun Author. Contoh: Admin membuat user baru dengan nama John dan Doe. Admin bisa menjadikan John sebagai Admin, namun Doe sebagai Author. ✅
  - Author, hanya bisa CRUD kategori dan artikel. ✅

- Registrasi ✅
  - User bisa mendaftar ke website dengan cara:
    - Mengisi form registrasi (email dan password)✅
    - Menggunakan media sosial (Facebook Login / Signup with Google / Twitter, boleh pilih satu)✅
- Authentication✅
  - User bisa login dengan media sosial (Facebook Login / Signup with Google / Twitter, boleh pilih satu)✅
