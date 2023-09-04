<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Exports\UsersExport;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\WithBulkActions;

class AdminUserIndex extends Component
{

    use WithPagination;
    use WithSorting;
    use WithBulkActions;

    protected $listeners = ['deleteUsers' => 'deleteUsers', 'userUpdated' => 'render'];


    public function render()
    {
        $users = $this->loadPageItems(User::class);

        return view('livewire.admin-user-index', compact('users'))
            ->layout('layouts.admin', ['active' => "Users"]);
    }


    public function deleteUsers(array $userIds)
    {
        $this->bulkDelete(User::class, $userIds);
    }

    public function exportUsers(string $filetype)
    {
        return $this->bulkExport(UsersExport::class, 'Users', $filetype);
    }
}
