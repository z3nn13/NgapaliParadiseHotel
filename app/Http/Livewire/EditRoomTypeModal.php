<?php
// app/Http/Livewire/EditRoomTypeModal.php
namespace App\Http\Livewire;

use App\Models\RoomType;
use App\Models\RoomCategory;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditRoomTypeModal extends ModalComponent
{
    use WithFileUploads;
    public RoomType $roomType;
    public $roomImage;

    public function mount(RoomType $roomType)
    {
        $this->roomType = $roomType;
        if ($roomType->room_image) {
            $this->roomImage = $roomType->room_image;
        }
    }

    public function render()
    {
        $roomCategories = RoomCategory::latest()->get();
        return view('livewire.edit-room-type-modal', compact('roomCategories'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveRoomType()
    {
        $this->validate();

        $this->roomType->save();

        $this->closeModalWithEvents([
            AdminRoomIndex::getName() => 'roomUpdated'
        ]);
    }
    protected function rules(): array
    {
        return [
            'roomType.room_type_name' => 'required|min:3|max:50',
            'roomType.room_category_id' => 'required|exists:room_categories,id',
            'roomType.room_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'roomType.occupancy' => 'required|integer|min:1',
            'roomType.view' => 'required|string|max:255',
            'roomType.bedding' => 'required|string|max:255',
            'roomType.description' => 'nullable|string|max:1000',
        ];
    }
}
