<?php

namespace Database\Seeders;

use App\Enums\EventStatus;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@etms.test'],
            [
                'name' => 'Super Admin',
                'phone' => '08000000001',
                'password' => Hash::make('password'),
                'role' => UserRole::Administrator,
                'is_active' => true,
            ]
        );

        $creator = User::firstOrCreate(
            ['email' => 'creator@etms.test'],
            [
                'name' => 'Event Creator',
                'phone' => '08000000002',
                'password' => Hash::make('password'),
                'role' => UserRole::Creator,
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@etms.test'],
            [
                'name' => 'Customer Demo',
                'phone' => '08000000003',
                'password' => Hash::make('password'),
                'role' => UserRole::Customer,
                'is_active' => true,
            ]
        );

        $ticketing = User::firstOrCreate(
            ['email' => 'ticketing@etms.test'],
            [
                'name' => 'Petugas Gate',
                'phone' => '08000000004',
                'password' => Hash::make('password'),
                'role' => UserRole::Ticketing,
                'is_active' => true,
            ]
        );

        $category = Category::firstOrCreate(
            ['slug' => 'musik'],
            ['name' => 'Musik', 'description' => 'Konser & festival', 'is_active' => true]
        );

        $event = Event::firstOrCreate(
            ['slug' => 'summer-fest-2026'],
            [
                'creator_id' => $creator->id,
                'category_id' => $category->id,
                'title' => 'Summer Fest 2026',
                'description' => 'Event demo untuk pengujian sistem.',
                'location' => 'Jakarta International Expo',
                'map_url' => 'https://maps.google.com',
                'start_datetime' => now()->addMonths(2),
                'end_datetime' => now()->addMonths(2)->addHours(6),
                'status' => EventStatus::Published,
            ]
        );

        $event->ticketingStaff()->syncWithoutDetaching([$ticketing->id]);
    }
}
