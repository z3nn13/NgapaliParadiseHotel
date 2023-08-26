<?php

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
        $this->roomImage =  $roomType->room_image ?: '';
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
        $path = $this->roomImage->store('images/rooms', 'public');

        $this->roomType->room_image = $path;
        $this->roomType->save();

        $this->closeModalWithEvents([
            AdminRoomIndex::getName() => 'roomUpdated'
        ]);
        $this->dispatchBrowserEvent('swal:notification', [
            'type' => 'success',
            'text' => 'Room Type ID #' . $this->roomType->formattedID() . ' saved successfully.'
        ]);
    }

    protected function rules(): array
    {
        return [
            'roomType.room_type_name' => 'required|min:3|max:50',
            'roomType.room_category_id' => 'required|exists:room_categories,id',
            'roomType.occupancy' => 'required|integer|min:1',
            'roomType.view' => 'required|string|max:255',
            'roomType.bedding' => 'required|string|max:255',
            'roomType.description' => 'nullable|string|max:1000',
            'roomImage' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
