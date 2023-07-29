<div class="modal__wrapper">

    <div class="modal">
        <div class="modal__content">
            <h2 class="modal__title">Room Type</h2>
            <form class="modal__form"
                wire:submit.prevent="saveRoomType">

                <div class="modal__form--left">

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="room_type_name">Room Type Name:</label>
                        <input class="modal__input"
                            id="room_type_name"
                            name="room_type_name"
                            type="text"
                            wire:model="roomType.room_type_name">
                        @error('roomType.room_type_name')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="room_category_id">Room Category:</label>
                        <select class="modal__select"
                            id="room_category_id"
                            name="room_category_id"
                            wire:model="roomType.room_category_id">
                            <!-- Populate the options with room categories -->
                            @forelse ($roomCategories as $roomCategory)
                                <option value="{{ $roomCategory->id }}">{{ $roomCategory->room_category_name }}</option>
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
                            for="room_image">Room Image:</label>
                        @if (is_string($roomImage))
                            <img class="modal__image"
                                src="{{ asset($roomType->room_image) }}">
                        @else
                            <img src="{{ $roomImage->temporaryUrl() }}">
                        @endif
                        <input class="modal__file"
                            id="room_image"
                            name="room_image"
                            type="file"
                            wire:model="roomImage">
                        @error('roomType.room_image')
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
</div>
