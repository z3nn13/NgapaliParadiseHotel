<?php
// app/Http/Livewire/EdituserModal.php
namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\UserDashboard;
use LivewireUI\Modal\ModalComponent;
use App\Http\Livewire\AdminUserIndex;

class EditUserModal extends ModalComponent
{
    use WithFileUploads;

    public User $user;
    public $userImage;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->userImage = $user->user_image ?? '';
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
        if (is_string($this->userImage)) {
            $path = $this->userImage;
        } else {
            $this->validate();
            $path = $this->userImage->store('images/avatars', 'public');
        }

        $this->user->user_image = $path;
        $this->user->save();

        $this->closeModalWithEvents([
            AdminUserIndex::getName() => 'userUpdated',
            UserDashboard::getName() => 'userUpdated',
        ]);
        $this->dispatchBrowserEvent('swal:notification', [
            'type' => 'success',
            'text' => 'User details were updated successfully.'
        ]);
    }
    protected function rules(): array
    {
        $userId = $this->user->id;
        return [
            'user.first_name' => ['required', 'string', 'max:255'],
            'user.last_name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'user.phone_no' => ['required', 'string'],
            'user.role_id' => 'required|exists:roles,id',
            'userImage' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
