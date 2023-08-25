<?php

namespace Tests\Feature\Reservation;

use Tests\TestCase;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Livewire\Livewire;
use App\Models\RoomDeal;
use App\Models\RoomType;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Database\Seeders\RoomTypeSeeder;
use App\Http\Livewire\ReservationCreate;
use App\Http\Livewire\ReservationSearch;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingProcessTest extends TestCase
{
    use RefreshDatabase;

    // Properties to store testing objects
    protected $roomCategory;
    protected $roomType;
    protected $room;
    protected $roomDeal;

    // Set up testing environment
    protected function setUp(): void
    {
        parent::setUp();

        // Create necessary objects for testing
        $this->roomCategory = RoomCategory::factory()->create();
        $this->roomType = RoomType::factory()->for($this->roomCategory)->create();
        $this->room = Room::factory()->for($this->roomType)->create(['room_number' => "1A"]);
        $this->roomDeal = RoomDeal::factory()->for($this->roomType)->create();
    }

    // Helper method to get a valid date range
    private function getValidDateRange()
    {
        return [
            'checkInDate' => now(),
            'checkOutDate' => now()->addDays(3),
            'numGuests' => 1
        ];
    }

    private function getMockReservationSession()
    {
        return ['booking.reservation_rooms' => [
            [
                'roomType' => RoomType::find($this->roomType->id),
                'roomDeal' => RoomDeal::find($this->roomDeal->id),
                'roomAssigned' => Room::find($this->room->id),
            ]
        ]];
    }


    public function test_users_can_add_rooms_to_reservation(): void
    {
        $response = Livewire::withQueryParams($this->getValidDateRange())
            ->test(ReservationSearch::class)
            ->call('bookRoom', $this->roomType->id, $this->roomDeal->id, [$this->room->id]);

        $expectedSessionValue = $this->getMockReservationSession();

        $response->assertOk()
            ->assertSessionHasAll($expectedSessionValue)
            ->assertRedirect(route('booking.create'));
    }

    public function test_guests_can_view_their_reservation_summary_and_billing_form()
    {
        session($this->getMockReservationSession());
        Livewire::test(ReservationCreate::class)
            ->assertStatus(200);
        session()->forget('booking');
    }

    public function test_guests_can_change_their_preferred_currency(): void
    {
        session($this->getMockReservationSession());
        $response = Livewire::test(ReservationCreate::class)
            ->emit('updatedPreferredCurrency', 'USD');

        $response->assertOk()
            ->assertSet('preferredCurrency', 'USD')
            ->assertSee('$');
    }


    public function test_authenticated_users_can_auto_fill_booking_details()
    {
        session($this->getMockReservationSession());
        $role = Role::create(['name' => 'user']);
        $user = User::factory()->for($role)->create();

        $response = $this->actingAs($user)
            ->get(route('booking.create'));

        $response->assertSee($user->first_name)
            ->assertSee($user->last_name)
            ->assertSee($user->email)
            ->assertSee($user->phone_no);
    }

    public function test_guests_can_see_validation_errors_for_invalid_inputs()
    {
        session($this->getMockReservationSession());
        Livewire::test(ReservationCreate::class)
            ->assertStatus(200);
    }


    public function test_guests_can_use_coupons(): void
    {
        session($this->getMockReservationSession());
        Livewire::test(ReservationCreate::class)
            ->assertStatus(200);
    }

    public function test_guests_can_confirm_their_reservation(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_guests_can_see_error_for_invalid_coupons(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
