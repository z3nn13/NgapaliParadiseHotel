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
                '#' . sprintf('%03d', $roomType->id),
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
        return RoomType::find($this->roomTypeIds);
    }
}
