<?php

namespace Tests\Feature\Auth;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RoleAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_access_admin_dashboard(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmcodelab.com',
            'password' => Hash::make('password123'),
            'role' => UserRole::SUPER_ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);

        $response = $this->actingAs($superAdmin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Admin Control Dashboard');
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmcodelab.com',
            'password' => Hash::make('password123'),
            'role' => UserRole::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_create_cli_command(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'CLI Admin',
            '--email' => 'cliadmin@gmcodelab.com',
            '--role' => 'admin',
        ])
        ->expectsQuestion('Enter Password (minimum 8 characters)', 'SecurePassword123')
        ->expectsQuestion('Confirm Password', 'SecurePassword123')
        ->assertSuccessful();

        $admin = User::where('email', 'cliadmin@gmcodelab.com')->first();

        $this->assertNotNull($admin);
        $this->assertEquals(UserRole::ADMIN, $admin->role);
        $this->assertTrue(Hash::check('SecurePassword123', $admin->password));
    }
}
