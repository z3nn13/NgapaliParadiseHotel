<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $userRole = Role::create(["name" => "user"]);
        $this->user = User::factory()->for($userRole)->create();

        $adminRole = Role::create(["name" => "admin"]);
        $this->admin = User::factory()->for($adminRole)->create();
    }


    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertOk();
    }


    public function test_admin_can_authenticate_using_the_login_screen(): void
    {
        $response = $this->post(route('admin.login'), [
            'email' => $this->admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(RouteServiceProvider::ADMIN_HOME);
        $this->assertAuthenticated();
    }


    public function test_users_cannot_authenticate_using_the_login_screen(): void
    {
        $response = $this->post(route('admin.login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);
        $this->assertGuest();
    }


    public function test_admin_can_logout(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
