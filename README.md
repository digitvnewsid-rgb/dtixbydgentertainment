# DTIX BYDG Entertainment

Panel admin tiket hiburan (Laravel 13 + SQLite).

## Persyaratan

- **PHP 8.3+** dengan ekstensi: `mbstring`, `xml`, `curl`, `zip`, `sqlite3`, `bcmath`
- **Composer** 2.x

Cek: `php -v` dan `composer -V`

## Instalasi (wajib berurutan)

```bash
git clone https://github.com/digitvnewsid-rgb/dtixbydgentertainment.git
cd dtixbydgentertainment

composer install

cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate --seed

php artisan serve
```

Buka: **http://127.0.0.1:8000/admin/login**

| Field | Nilai |
|-------|--------|
| Email | `admin@dtix.test` |
| Password | `password` |

Atau jalankan skrip otomatis (Linux/macOS):

```bash
chmod +x setup.sh
./setup.sh
php artisan serve
```

## Masalah umum

| Gejala | Penyebab | Solusi |
|--------|----------|--------|
| Repo hanya `README.md` | Clone lama sebelum merge ke `main` | `git pull origin main` — kode ada di branch **main** |
| `php: command not found` | PHP belum terpasang | Install PHP 8.3+ |
| `artisan` tidak ada | Belum `composer install` / folder salah | Pastikan di root project setelah clone |
| Error database | File SQLite belum dibuat | `touch database/database.sqlite` lalu `php artisan migrate --seed` |
| Login ditolak | Pakai akun customer | Hanya **admin@dtix.test** untuk panel admin |
| Halaman kosong / 500 | `.env` belum ada | `cp .env.example .env` dan `php artisan key:generate` |

## Modul admin

- Kategori Event → `admin/categories`
- Lokasi Venue → `admin/venues`
- Acara → `admin/events`

## Tes

```bash
php artisan test
```
