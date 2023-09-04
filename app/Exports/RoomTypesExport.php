<?php

namespace App\Exports;

use App\Models\RoomType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RoomTypesExport implements FromCollection, WithHeadings, WithMapping
{
    private $roomTypeIds;

    public function __construct($roomTypeIds)
    {
        $this->roomTypeIds = $roomTypeIds;
    }

    public function headings(): array
    {
        return
            [
                'Room No',
                'Room Name',
                'View',
                'Housing',
                'Bedding',
                'Description',
            ];
    }

    public function map($roomType): array
    {
        return
            [
                $roomType->formatted_id,
                $roomType->room_type_name,
                $roomType->view,
                $roomType->occupancy,
                $roomType->bedding,
                $roomType->description,
            ];
    }

    /** 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->roomTypeIds->isEmpty()) {
            return RoomType::all();
        }
        return RoomType::findOrFail($this->roomTypeIds);
    }
}
