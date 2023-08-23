<?php

namespace Tests\Feature\Reservation;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Database\Seeders\RoomTypeSeeder;
use App\Http\Livewire\ReservationSearch;
use App\Models\Room;
use App\Models\RoomDeal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookRoomTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    // Helper method to get a valid date range
    private function getValidDateRange()
    {
        return [
            'checkInDate' => now(),
            'checkOutDate' => now()->addDays(3),
        ];
    }

    public function test_users_can_book_a_room(): void
    {
        $this->seed(RoomTypeSeeder::class);
        $response = Livewire::test(ReservationSearch::class, ['request' => new Request($this->getValidDateRange())])
            ->call('bookRoom', 1, 1, [1]);


        $expectedSessionValue = [
            'booking.reservation_rooms' => [
                [
                    'roomType' => RoomType::find(1),
                    'roomDeal' => RoomDeal::find(1),
                    'roomAssigned' => Room::find(1),
                ]
            ]
        ];

        $response->assertOk()
            ->assertSessionHasAll($expectedSessionValue)
            ->assertRedirect(route('booking.create'));
    }


    public function test_users_can_book_multiple_rooms(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }


    public function test_users_can_apply_coupons(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_users_can_confirm_their_reservation(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_users_can_proceed_to_payment(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_user_can_create_reservations_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_users_cannot_revisit_the_pages_without_an_active_booking_session()
    {
        $routes = [
            'booking.search',
            'booking.create',
            'booking.confirm',
            'booking.add-room',
            'booking.payment',
            'booking.success',
        ];

        foreach ($routes as $route) {
            $response = $this->get(route($route));
            $response->assertStatus(403);
        }
    }
}
