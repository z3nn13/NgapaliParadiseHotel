<div class="modal">
    <div class="modal__wrapper">
        <div class="modal__content">
            <h2 class="modal__title">Room Type</h2>
            <form class="modal__form"
                wire:submit.prevent="saveRoomType">

                <div class="modal__form--left">

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="room_type_name">Room name:</label>
                        <input class="modal__input"
                            id="room_type_name"
                            name="room_type_name"
                            type="text"
                            wire:model="roomType.room_type_name">
                        @error('roomType.room_type_name')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal__input-group"
                        wire:ignore>
                        <label class="modal__label"
                            for="room_category_id">Room category:</label>
                        <select class="modal__select select2"
                            id="select2">

                            @forelse ($roomCategories as $roomCategory)
                                <option value="{{ $roomCategory->id }}">
                                    {{ $roomCategory->room_category_name }}
                                </option>
                            @empty
                                <option disabled
                                    selected>--No room categories found--</option>
                            @endforelse
                        </select>
                        @error('roomType.room_category_id')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="room_image">Room image:</label>

                        @php
                            $roomImageExists = $roomImage;
                            $roomImageIsUrl = is_string($roomImage);
                            $hasNoErrors = empty($errors->get('roomImage'));
                        @endphp
                        @if ($roomImageExists && $hasNoErrors)
                            @if ($roomImageIsUrl)
                                <img class="modal__image"
                                    src="{{ asset($roomImage) }}">
                            @else
                                <img class="modal__image"
                                    src="{{ $roomImage->temporaryUrl() }}">
                            @endif
                        @endif
                        <input class="modal__file"
                            id="room_image"
                            name="room_image"
                            type="file"
                            wire:model="roomImage">
                        @error('roomImage')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="modal__form--right">

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="occupancy">Occupancy:</label>
                        <input class="modal__input"
                            id="occupancy"
                            name="occupancy"
                            type="number"
                            wire:model="roomType.occupancy">
                        @error('roomType.occupancy')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="view">View:</label>
                        <input class="modal__input"
                            id="view"
                            name="view"
                            type="text"
                            wire:model="roomType.view">
                        @error('roomType.view')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="bedding">Bedding:</label>
                        <input class="modal__input"
                            id="bedding"
                            name="bedding"
                            type="text"
                            wire:model="roomType.bedding">
                        @error('roomType.bedding')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="description">Description:</label>
                        <textarea class="modal__textarea"
                            id="description"
                            name="description"
                            wire:model="roomType.description"></textarea>
                        @error('roomType.description')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal__cta-container">
                        <button class="modal__cta-btn modal__cta-btn--save"
                            type="submit">Save</button>
                        <button class="modal__cta-btn modal__cta-btn--cancel"
                            type="button"
                            wire:click="$emit('closeModal')">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function() {
            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set('roomType.room_category_id', data);
            });
        });


        $(".select2").select2({
            placeholder: "Please select a room category",
            allowClear: false,
            minimumResultsForSearch: 6,
            dropdownCssClass: "category-select__select",
        });
    </script>
</div>
