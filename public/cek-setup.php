<?php

/**
 * Cek cepat sebelum Laravel jalan (buka via browser).
 * Contoh: http://127.0.0.1:8000/cek-setup.php saat `php artisan serve`
 * Hapus file ini di production setelah aplikasi stabil.
 */

header('Content-Type: text/html; charset=utf-8');

$root = dirname(__DIR__);

function row(string $label, bool $ok, string $detail = ''): string
{
    $status = $ok ? '✅ OK' : '❌ GAGAL';
    $detailHtml = $detail !== '' ? '<br><small>'.htmlspecialchars($detail).'</small>' : '';

    return "<tr><td>{$label}</td><td>{$status}</td><td>{$detailHtml}</td></tr>";
}

$phpOk = version_compare(PHP_VERSION, '8.2.0', '>=');
$vendorOk = is_file($root.'/vendor/autoload.php');
$envOk = is_file($root.'/.env');
$envKeyOk = false;
if ($envOk) {
    $env = file_get_contents($root.'/.env');
    $envKeyOk = (bool) preg_match('/^APP_KEY=base64:.+/m', $env);
}
$sqliteOk = is_file($root.'/database/database.sqlite');
$storageOk = is_writable($root.'/storage') && is_writable($root.'/bootstrap/cache');

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>DTIX — Cek Setup</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 720px; margin: 2rem auto; padding: 0 1rem; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
        th { background: #f5f5f5; text-align: left; }
        code { background: #f0f0f0; padding: 2px 6px; border-radius: 4px; }
        .box { background: #fff8e6; border: 1px solid #f0d78c; padding: 12px; border-radius: 8px; margin-top: 1rem; }
    </style>
</head>
<body>
    <h1>DTIX — Diagnosa Setup</h1>
    <p>Gunakan halaman ini jika layar putih / error 500. Pastikan URL memakai <code>php artisan serve</code> (bukan membuka folder tanpa <code>public</code>).</p>
    <table>
        <thead><tr><th>Pemeriksaan</th><th>Status</th><th>Catatan</th></tr></thead>
        <tbody>
            <?= row('PHP 8.2+', $phpOk, 'Versi saat ini: '.PHP_VERSION) ?>
            <?= row('Composer vendor/', $vendorOk, 'Jalankan: composer install') ?>
            <?= row('File .env', $envOk, 'Jalankan: cp .env.example .env') ?>
            <?= row('APP_KEY terisi', $envKeyOk, 'Jalankan: php artisan key:generate') ?>
            <?= row('SQLite database', $sqliteOk, 'Jalankan: touch database/database.sqlite') ?>
            <?= row('storage/ & bootstrap/cache writable', $storageOk, 'Linux: chmod -R 775 storage bootstrap/cache') ?>
        </tbody>
    </table>
    <div class="box">
        <strong>Perintah perbaikan (di folder project):</strong>
        <pre>composer install
cp .env.example .env
php artisan key:generate
php artisan dtix:setup
php artisan serve</pre>
        Lalu buka <a href="/admin/login">/admin/login</a> — login <code>admin@dtix.test</code> / <code>password</code>
    </div>
</body>
</html>
