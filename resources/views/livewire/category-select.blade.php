<section class="category-select__container">
    <label class="category-select__label" for="categorySelect">
        Choose a <p class="category-select__label--bold">Category</p>
    </label>

    <select class="category-select__select select2" id="selectedRoomCategory" wire:model="selectedRoomCategory">
        <option></option>
        @foreach ($roomCategories as $category)
            <option value="{{ $category->id }}">{{ $category->room_category_name }}</option>
        @endforeach
    </select>
    <script>
        $(document).ready(function() {
            $('#selectedRoomCategory').on('change', function(e) {
                livewire.emit('category_selected', e.target.value)
            });
        });
    </script>
</section>
