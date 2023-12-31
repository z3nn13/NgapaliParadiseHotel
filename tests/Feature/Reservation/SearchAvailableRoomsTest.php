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
    private function getValidData()
    {
        return [
            'checkInDate' => now(),
            'checkOutDate' => now()->addDays(1),
            'numGuests' => 1
        ];
    }

    // Helper method to get an invalid date range
    private function getInvalidData()
    {
        return [
            'checkInDate' => now(),
            'checkOutDate' => now()->subDays(1),
            'numGuests' => 1
        ];
    }


    // Test: Guests can search for available rooms
    public function test_guests_can_search_for_available_rooms()
    {
        Livewire::withQueryParams($this->getValidData())
            ->test(ReservationSearch::class)
            ->assertOk()
            ->assertViewIs('livewire.reservation-search')
            ->assertSee($this->roomType->room_type_name);
    }

    // Test: Guests receive an error for an invalid date range
    public function test_guests_receive_error_for_invalid_date_range()
    {
        Livewire::withQueryParams($this->getInvalidData())
            ->test(ReservationSearch::class)
            ->assertBadRequest();
    }

    // Test: Guests receive an error for no available rooms
    public function test_guests_receive_error_for_no_available_rooms()
    {
        $this->createReservationWithRooms(now(), now()->addDays(1));
        $response = Livewire::withQueryParams($this->getValidData())
            ->test(ReservationSearch::class)
            ->assertOk()
            ->assertSee('There are no rooms available for these dates');
        $this->assertTrue($response->get('availableRoomData')->isEmpty());
    }

    public function test_guests_can_sort_available_rooms_by_price()
    {
        // $this->createSortableRoomTypes();
        $response = Livewire::withQueryParams($this->getValidData())
            ->test(ReservationSearch::class)
            ->call('sortByPrice', 'high_to_low')
            ->assertOk();
    }

    private function createSortableRoomTypes()
    {
    }
}
