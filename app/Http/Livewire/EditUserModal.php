<?php
// app/Http/Livewire/EdituserModal.php
namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use App\Http\Livewire\AdminUserIndex;

class EditUserModal extends ModalComponent
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.edit-user-modal', compact('roles'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveUser()
    {
        $this->validate();
        $this->user->save();

        $this->closeModalWithEvents([
            AdminUserIndex::getName() => 'userUpdated'
        ]);
        $this->emit('dataChanged', 'User', $this->user->id, 'saved');
    }

    protected function rules(): array
    {
        return [
            'user.first_name' => ['required', 'string', 'max:255'],
            'user.last_name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'email', 'max:255'],
            'user.phone_no' => ['required', 'string'],
            'user.role_id' => 'required|exists:roles,id',
        ];
    }
}
