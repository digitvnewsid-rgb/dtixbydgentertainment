<?php

namespace Tests\Feature;

use App\Enums\EventStatus;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhaseTwoEventManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_home_only_shows_published_events(): void
    {
        $creator = User::factory()->create(['role' => UserRole::Creator]);
        $category = Category::create(['name' => 'Test', 'slug' => 'test', 'is_active' => true]);

        Event::create([
            'creator_id' => $creator->id,
            'category_id' => $category->id,
            'title' => 'Draft Event',
            'slug' => 'draft-event',
            'location' => 'Jakarta',
            'start_datetime' => now()->addWeek(),
            'end_datetime' => now()->addWeek()->addHours(2),
            'status' => EventStatus::Draft,
        ]);

        $published = Event::create([
            'creator_id' => $creator->id,
            'category_id' => $category->id,
            'title' => 'Live Concert',
            'slug' => 'live-concert',
            'location' => 'Bandung',
            'start_datetime' => now()->addWeek(),
            'end_datetime' => now()->addWeek()->addHours(2),
            'status' => EventStatus::Published,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Live Concert')
            ->assertDontSee('Draft Event');
    }

    public function test_creator_cannot_edit_other_creator_event(): void
    {
        $creatorA = User::factory()->create(['role' => UserRole::Creator]);
        $creatorB = User::factory()->create(['role' => UserRole::Creator]);
        $category = Category::create(['name' => 'Musik', 'slug' => 'musik', 'is_active' => true]);

        $event = Event::create([
            'creator_id' => $creatorB->id,
            'category_id' => $category->id,
            'title' => 'B Event',
            'slug' => 'b-event',
            'location' => 'Surabaya',
            'start_datetime' => now()->addWeek(),
            'end_datetime' => now()->addWeek()->addHours(2),
            'status' => EventStatus::Draft,
        ]);

        $this->actingAs($creatorA)
            ->get(route('creator.events.edit', $event))
            ->assertForbidden();
    }

    public function test_admin_can_create_category(): void
    {
        $admin = User::factory()->create(['role' => UserRole::Administrator]);

        $this->actingAs($admin)
            ->post(route('admin.categories.store'), [
                'name' => 'Olahraga',
                'description' => 'Event sport',
                'is_active' => true,
            ])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', ['name' => 'Olahraga', 'slug' => 'olahraga']);
    }

    public function test_creator_can_publish_own_event(): void
    {
        $creator = User::factory()->create(['role' => UserRole::Creator]);
        $category = Category::create(['name' => 'Musik', 'slug' => 'musik', 'is_active' => true]);

        $event = Event::create([
            'creator_id' => $creator->id,
            'category_id' => $category->id,
            'title' => 'My Show',
            'slug' => 'my-show',
            'location' => 'Jakarta',
            'start_datetime' => now()->addWeek(),
            'end_datetime' => now()->addWeek()->addHours(2),
            'status' => EventStatus::Draft,
        ]);

        $this->actingAs($creator)
            ->post(route('creator.events.publish', $event))
            ->assertRedirect();

        $this->assertEquals(EventStatus::Published, $event->fresh()->status);
    }

    public function test_closed_event_is_not_purchasable(): void
    {
        $creator = User::factory()->create(['role' => UserRole::Creator]);
        $category = Category::create(['name' => 'Musik', 'slug' => 'musik', 'is_active' => true]);

        $event = Event::create([
            'creator_id' => $creator->id,
            'category_id' => $category->id,
            'title' => 'Closed',
            'slug' => 'closed',
            'location' => 'Jakarta',
            'start_datetime' => now()->addWeek(),
            'end_datetime' => now()->addWeek()->addHours(2),
            'status' => EventStatus::Closed,
        ]);

        $this->assertFalse($event->isPurchasable());
    }

    public function test_creator_can_add_ticket_type_to_own_event(): void
    {
        Storage::fake('public');
        $creator = User::factory()->create(['role' => UserRole::Creator]);
        $category = Category::create(['name' => 'Musik', 'slug' => 'musik', 'is_active' => true]);

        $event = Event::create([
            'creator_id' => $creator->id,
            'category_id' => $category->id,
            'title' => 'Fest',
            'slug' => 'fest',
            'location' => 'Jakarta',
            'start_datetime' => now()->addWeek(),
            'end_datetime' => now()->addWeek()->addHours(4),
            'status' => EventStatus::Published,
        ]);

        $this->actingAs($creator)
            ->post(route('creator.events.ticket-types.store', $event), [
                'name' => 'Regular',
                'price' => 150000,
                'quota' => 100,
                'max_purchase' => 4,
                'sale_start' => now()->format('Y-m-d\TH:i'),
                'sale_end' => now()->addMonth()->format('Y-m-d\TH:i'),
                'status' => 'active',
            ])
            ->assertRedirect(route('creator.events.ticket-types.index', $event));

        $this->assertDatabaseHas('ticket_types', [
            'event_id' => $event->id,
            'name' => 'Regular',
            'quota' => 100,
        ]);
    }
}
