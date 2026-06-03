<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\TicketType;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        if (! User::query()->where('email', 'admin@dtix.test')->exists()) {
            User::factory()->create([
                'name' => 'Admin DTIX',
                'email' => 'admin@dtix.test',
                'password' => 'password',
                'role' => 'admin',
            ]);
        }

        if (! User::query()->where('email', 'customer@dtix.test')->exists()) {
            User::factory()->create([
                'name' => 'Customer Demo',
                'email' => 'customer@dtix.test',
                'password' => 'password',
                'role' => 'customer',
            ]);
        }

        if (EventCategory::query()->exists()) {
            return;
        }

        $music = EventCategory::create([
            'name' => 'Musik',
            'slug' => 'musik',
            'description' => 'Konser dan festival musik',
            'is_active' => true,
        ]);

        $theater = EventCategory::create([
            'name' => 'Teater',
            'slug' => 'teater',
            'description' => 'Pertunjukan teater dan drama',
            'is_active' => true,
        ]);

        $gbk = Venue::create([
            'name' => 'Gelora Bung Karno',
            'slug' => 'gelora-bung-karno',
            'address' => 'Jl. Pintu Satu Senayan',
            'city' => 'Jakarta',
            'capacity' => 80000,
            'description' => 'Stadion utama Jakarta',
            'is_active' => true,
        ]);

        $taman = Venue::create([
            'name' => 'Taman Ismail Marzuki',
            'slug' => 'taman-ismail-marzuki',
            'address' => 'Jl. Cikini Raya No. 73',
            'city' => 'Jakarta',
            'capacity' => 1200,
            'description' => 'Pusat kesenian Jakarta',
            'is_active' => true,
        ]);

        $concert = Event::create([
            'event_category_id' => $music->id,
            'venue_id' => $gbk->id,
            'title' => 'DTIX Music Festival 2026',
            'slug' => 'dtix-music-festival-2026',
            'description' => 'Festival musik tahunan BYDG Entertainment',
            'start_at' => now()->addMonths(2),
            'end_at' => now()->addMonths(2)->addHours(5),
            'status' => 'published',
        ]);

        $play = Event::create([
            'event_category_id' => $theater->id,
            'venue_id' => $taman->id,
            'title' => 'Drama Nusantara',
            'slug' => 'drama-nusantara',
            'description' => 'Pertunjukan teater musikal',
            'start_at' => now()->addMonth(),
            'end_at' => now()->addMonth()->addHours(2),
            'status' => 'draft',
        ]);

        TicketType::create([
            'event_id' => $concert->id,
            'name' => 'Festival Pass',
            'price' => 750000,
            'quota' => 5000,
            'sold_count' => 120,
            'is_active' => true,
        ]);

        TicketType::create([
            'event_id' => $concert->id,
            'name' => 'VIP',
            'price' => 1500000,
            'quota' => 500,
            'sold_count' => 45,
            'is_active' => true,
        ]);
    }
}
