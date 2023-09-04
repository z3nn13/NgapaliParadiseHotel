<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ReservationRoom extends Pivot
{

    public function roomDeal()
    {
        return $this->belongsTo(RoomDeal::class);
    }
}
