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
        $users = User::when($this->searchQuery, function ($query) {
            return $query->searchBy(trim($this->searchQuery));
        })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(6);

        $this->paginatedModels = $users->items();


        return view('livewire.admin-user-index', compact('users'))
            ->layout('layouts.admin', ['active' => "Users"]);
    }


    public function deleteUsers(array $userIds)
    {
        $this->bulkDelete(User::class, $userIds);
    }

    public function exportClickListener()
    {
        return $this->bulkExport(UsersExport::class, 'Users.pdf');
    }
}
