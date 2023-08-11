<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserDashboard extends Component
{
    public function render()
    {
        return view('livewire.user-dashboard')->layout('layouts.app');
    }
}
