<?php

namespace Tests\Feature;

use App\Models\EventCategory;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_venues(): void
    {
        $this->get(route('admin.venues.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_venues_index(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.venues.index'))
            ->assertOk()
            ->assertSee('Lokasi Venue');
    }

    public function test_admin_can_create_venue(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.venues.store'), [
                'name' => 'Arena Test',
                'address' => 'Jl. Test 1',
                'city' => 'Bandung',
                'capacity' => 1000,
                'description' => 'Deskripsi',
                'is_active' => true,
            ])
            ->assertRedirect(route('admin.venues.index'));

        $this->assertDatabaseHas('venues', [
            'name' => 'Arena Test',
            'slug' => 'arena-test',
            'city' => 'Bandung',
        ]);
    }

    public function test_event_requires_category_and_venue(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = EventCategory::create([
            'name' => 'Komedi',
            'slug' => 'komedi',
            'is_active' => true,
        ]);
        $venue = Venue::create([
            'name' => 'Gedung Seni',
            'slug' => 'gedung-seni',
            'address' => 'Jl. Seni',
            'city' => 'Surabaya',
            'capacity' => 500,
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.events.store'), [
                'event_category_id' => $category->id,
                'venue_id' => $venue->id,
                'title' => 'Stand Up Night',
                'start_at' => now()->addWeek()->format('Y-m-d\TH:i'),
                'end_at' => now()->addWeek()->addHours(2)->format('Y-m-d\TH:i'),
                'status' => 'published',
            ])
            ->assertRedirect(route('admin.events.index'));

        $this->assertDatabaseHas('events', [
            'title' => 'Stand Up Night',
            'event_category_id' => $category->id,
            'venue_id' => $venue->id,
        ]);
    }
}
