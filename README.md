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

## Layar putih / tidak bisa masuk website?

1. **Jangan** buka folder project langsung di browser (XAMPP/Laragon harus mengarah ke folder **`public`**, atau pakai `php artisan serve`).
2. Jalankan perbaikan otomatis:
   ```bash
   composer install
   php artisan dtix:setup
   php artisan serve
   ```
3. Buka diagnosa: http://127.0.0.1:8000/cek-setup.php — semua baris harus **OK**.
4. Baru buka login: http://127.0.0.1:8000/admin/login

Penyebab paling sering: belum `composer install`, belum `migrate`, atau `SESSION_DRIVER=database` di `.env` tanpa tabel (sudah diperbaiki di `.env.example` baru).

## Masalah umum

| Gejala | Penyebab | Solusi |
|--------|----------|--------|
| Layar putih / HTTP 500 | DB belum migrate, vendor kosong, APP_KEY kosong | `php artisan dtix:setup` |
| Repo hanya `README.md` | Clone lama | `git pull origin main` |
| `php: command not found` | PHP belum terpasang | Install PHP 8.3+ |
| `artisan` tidak ada | Belum `composer install` | `composer install` |
| XAMPP/Laragon blank | Document root salah | Arahkan ke folder **`public`** |
| Login ditolak | Bukan akun admin | **admin@dtix.test** / `password` |

## Modul admin

- Kategori Event → `admin/categories`
- Lokasi Venue → `admin/venues`
- Acara → `admin/events`

## Tes

```bash
php artisan test
```
