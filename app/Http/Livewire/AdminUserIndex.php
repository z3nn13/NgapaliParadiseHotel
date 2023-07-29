<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class AdminUserIndex extends Component
{

    use WithPagination;
    use WithSorting;

    public $sortField = "id";
    public $searchQuery = ""; // Default search query

    public function render()
    {
        $trimmedSearchQuery = trim($this->searchQuery);
        if ($trimmedSearchQuery !== "") {
            $users = User::searchBy($trimmedSearchQuery)->orderBy($this->sortField, $this->sortDirection)->paginate(6);
        } else {
            $users = User::orderBy($this->sortField, $this->sortDirection)->paginate(6);
        }

        return view('livewire.admin-user-index', compact('users'))
            ->layout('layouts.admin', ['active' => "Users"]);
    }
}
