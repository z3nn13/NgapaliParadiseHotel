<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Reservation;
use Database\Seeders\RoleSeeder;
use Database\Seeders\InvoiceSeeder;
use App\Http\Livewire\UserDashboard;
use Database\Seeders\PayTypeSeeder;
use Database\Seeders\RoomTypeSeeder;
use Database\Seeders\ReservationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDashboardTest extends TestCase
{
    use RefreshDatabase;

    private $userRole;
    private $user;
    private $reservation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRole = Role::create(["name" => "user"]);
        $this->user = User::factory()->for($this->userRole)->create();
        $this->reservation = Reservation::factory()->for($this->user)->create();
        $this->seed(PayTypeSeeder::class);
        $this->seed(InvoiceSeeder::class);
    }

    public function test_user_dashboard_page_is_rendered()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('dashboard'));

        $response->assertOk();
    }

    public function test_users_can_see_their_booking_history()
    {
        Livewire::actingAs($this->user)
            ->test(UserDashboard::class)
            ->assertOk();
    }

    public function test_users_can_view_their_booking_details()
    {

        $this->actingAs($this->user)
            ->get(route('dashboard.bookings.show', ['reservation' => $this->reservation->id]))
            ->assertOk();
    }

    public function test_users_cannot_view_other_users_booking_details()
    {
        $user2 = User::factory()->for($this->userRole)->create();
        $this->actingAs($user2)
            ->get(route('dashboard.bookings.show', ['reservation' => $this->reservation->id]))
            ->assertForbidden();
    }
}
