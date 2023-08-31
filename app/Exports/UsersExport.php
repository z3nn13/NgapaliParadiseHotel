<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    private $userIds;

    public function __construct($userIds)
    {
        $this->userIds = $userIds;
    }

    public function headings(): array
    {
        return
            [
                'User ID',
                'Name',
                'Role',
                'Email',
                'Phone Number',
            ];
    }

    public function map($user): array
    {

        return
            [
                '#' . sprintf('%03d', $user->id),
                $user->first_name . " " . $user->last_name,
                $user->role->name,
                $user->email,
                $user->phone_no,
            ];
    }

    /** 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->userIds) {
            return User::findOrFail($this->userIds);
        } else {
            return User::all();
        }
    }
}
