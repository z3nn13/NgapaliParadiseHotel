<section class="category-select__container"
    wire:ignore>
    <label class="category-select__label"
        for="categorySelect">
        Choose a <p class="category-select__label--bold">Category</p>
    </label>

    <select class="category-select__select select2"
        id="select2-dropdown"
        wire:model="selectedRoomCategory">
        <option></option>
        @forelse ($roomCategories as $category)
            <option value="{{ $category->id }}">{{ $category->room_category_name }}</option>
        @empty
            <option disabled> -- No Results Found --</option>
        @endforelse
    </select>

    <script type="module">
        $(function() {
            $('#select2-dropdown').on('change', function(e) {
                var data = $('#select2-dropdown').select2("val");
                @this.set('selectedRoomCategory', data);
            });
        });

        /*-------------------
            Customize Select2
        ---------------------*/

        $(".select2").select2({
            placeholder: "Please select a room category",
            allowClear: true,
            dropdownCssClass: "category-select__select",
        });
    </script>
</section>
