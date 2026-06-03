<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class DtixSetupCommand extends Command
{
    protected $signature = 'dtix:setup {--fresh : Reset database lalu seed ulang}';

    protected $description = 'Setup lengkap DTIX (env, database, cache) untuk menghindari layar putih / error 500';

    public function handle(): int
    {
        if (! File::exists(base_path('vendor/autoload.php'))) {
            $this->error('Folder vendor belum ada. Jalankan: composer install');

            return self::FAILURE;
        }

        if (! File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->info('File .env dibuat dari .env.example');
        }

        if (empty(config('app.key'))) {
            Artisan::call('key:generate', ['--force' => true]);
            $this->info('APP_KEY di-generate');
        }

        $dbFile = database_path('database.sqlite');
        if (! File::exists($dbFile)) {
            File::put($dbFile, '');
            $this->info('database/database.sqlite dibuat');
        }

        $directories = [
            storage_path('framework/cache'),
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ];

        foreach ($directories as $directory) {
            if (! File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
        }

        if ($this->option('fresh')) {
            Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        } else {
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);
        }

        $this->line(Artisan::output());

        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        $this->newLine();
        $this->info('Setup selesai.');
        $this->line('Jalankan: php artisan serve');
        $this->line('Buka: http://127.0.0.1:8000/admin/login');
        $this->line('Login: admin@dtix.test / password');

        return self::SUCCESS;
    }
}
