<?php

namespace Tests\Feature\Reservation;

use Tests\TestCase;
use App\Models\Room;
use Livewire\Livewire;
use App\Models\RoomDeal;
use App\Models\RoomType;
use App\Models\Reservation;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Database\Seeders\RoomTypeSeeder;
use App\Http\Livewire\ReservationSearch;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchAvailableRoomsTest extends TestCase
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

    // Helper method to create a reservation with rooms
    private function createReservationWithRooms($checkInDate, $checkOutDate)
    {
        $reservation = Reservation::factory()->create([
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
        ]);

        $reservation->rooms()->attach($this->room->id, ['room_deal_id' => $this->roomDeal->id]);

        return $reservation;
    }

    // Helper method to get a valid date range
    private function getValidDateRange()
    {
        return [
            'checkInDate' => now(),
            'checkOutDate' => now()->addDays(3),
        ];
    }

    // Helper method to get an invalid date range
    private function getInvalidDateRange()
    {
        return [
            'checkInDate' => now(),
            'checkOutDate' => now()->subDays(1),
        ];
    }


    // Test: Guests can search for available rooms
    public function test_guests_can_search_for_available_rooms()
    {
        Livewire::test(ReservationSearch::class, ['request' => new Request($this->getValidDateRange())])
            ->assertOk()
            ->assertViewIs('livewire.reservation-search')
            ->assertSet('availableRoomTypes.0.availableRoomIds', [$this->roomType->id])
            ->assertSee($this->roomType->room_type_name);
    }

    // Test: Guests receive an error for an invalid date range
    public function test_guests_receive_error_for_invalid_date_range()
    {
        Livewire::test(ReservationSearch::class, ['request' => new Request($this->getInvalidDateRange())])
            ->assertBadRequest();
    }

    // Test: Guests receive an error for no available rooms
    public function test_guests_receive_error_for_no_available_rooms()
    {
        $this->createReservationWithRooms(now(), now()->addDays(1));
        $response = Livewire::test(ReservationSearch::class, ['request' => new Request($this->getValidDateRange())])
            ->assertOk()
            ->assertSee('No rooms available for these dates');

        $this->assertTrue($response->get('availableRoomTypes')->isEmpty());
    }

    // // Test: Guests can filter rooms by price
    // public function test_guests_can_sort_available_rooms_by_price()
    // {
    //     $this->createSortableRoomTypes();
    // }

    // private function createSortableRoomTypes()
    // {
    // }
}
