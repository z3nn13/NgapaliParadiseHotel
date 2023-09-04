<?php

namespace App\DTO;

use Livewire\Wireable;
use App\Models\RoomDeal;
use App\Models\RoomType;
use Illuminate\Support\Collection;

class AvailableRoomTypesDTO implements Wireable
{
    public Collection $availableRoomTypes;

    public function __construct($availableRoomTypes)
    {
        $this->availableRoomTypes = $availableRoomTypes;
    }

    public function toLivewire()
    {
        return $this->availableRoomTypes;
    }

    public static function fromLivewire($value)
    {
        // Hydrating models
        $value = RoomType::hydrate($value);

        // Hydrating Relations
        $value->map(function (RoomType $roomType) {
            $roomDeals = RoomDeal::hydrate($roomType->room_deals);
            unset($roomType->room_deals);
            $roomType->setRelation('room_deals', $roomDeals);
        });

        return new static($value);
    }
}
