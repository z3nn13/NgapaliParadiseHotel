<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $userRole = Role::create(["name" => "user"]);
        $this->user = User::factory()->for($userRole)->create();
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get(route('register'));
        $response->assertOk();
    }

    public function test_new_users_can_register(): void
    {
        $this->seed(RoleSeeder::class);
        $response = $this->post('/register', [
            'first_name' => 'Test',
            'last_name' => ' User',
            'email' => 'test@example.com',
            'password' => 'password',
            'phone_no' => fake()->phoneNumber()
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue(Hash::check('password', $user->password));
    }


    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));
        $response->assertOk();
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }


    public function test_users_can_logout(): void
    {
        $response = $this->actingAs($this->user)->post(route('logout'));

        $response->assertRedirect('/');
        $this->assertGuest();
    }


    public function test_admin_accounts_cannot_authenticate_using_the_login_screen(): void
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $adminUser = User::factory()->for($adminRole)->create();

        $response = $this->post(route('login'), [
            'email' => $adminUser->email,
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }
}
