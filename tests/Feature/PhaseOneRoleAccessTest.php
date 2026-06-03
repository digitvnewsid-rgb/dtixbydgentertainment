<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhaseOneRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_redirects_administrator_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::Administrator,
            'email' => 'admin@test.com',
        ]);

        $this->post(route('login'), [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));
    }

    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::factory()->create(['role' => UserRole::Customer]);

        $this->actingAs($customer)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_inactive_user_cannot_login(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::Customer,
            'is_active' => false,
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertSessionHasErrors('email');
    }

    public function test_customer_registration(): void
    {
        $this->post(route('register'), [
            'name' => 'New Customer',
            'email' => 'new@customer.test',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect(route('customer.dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'new@customer.test',
            'role' => UserRole::Customer->value,
        ]);
    }

    public function test_admin_can_toggle_user_active(): void
    {
        $admin = User::factory()->create(['role' => UserRole::Administrator]);
        $target = User::factory()->create(['role' => UserRole::Creator, 'is_active' => true]);

        $this->actingAs($admin)
            ->patch(route('admin.users.toggle-active', $target))
            ->assertRedirect();

        $this->assertFalse($target->fresh()->is_active);
    }
}
