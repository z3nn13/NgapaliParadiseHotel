<div class="modal__wrapper">

    <div class="modal">
        <div class="modal__content">
            <h2 class="modal__title">User Details</h2>
            <form class="modal__form"
                wire:submit.prevent="saveUser">

                <div class="modal__form--left">

                    @if (auth()->user()->role->name === 'admin')
                        <div class="modal__input-group"
                            wire:ignore>
                            <label class="modal__label">Role:</label>
                            <select class="modal__select select2"
                                id="roleSelect">
                                <!-- Populate the options with available roles -->
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        @if ($user->role->id === $role->id) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('user.role_id')
                                <span class="modal__error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="first_name">First Name:</label>
                        <input class="modal__input"
                            id="first_name"
                            name="first_name"
                            type="text"
                            wire:model="user.first_name">
                        @error('user.first_name')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="last_name">Last Name:</label>
                        <input class="modal__input"
                            id="last_name"
                            name="last_name"
                            type="text"
                            wire:model="user.last_name">
                        @error('user.last_name')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="modal__form--right">

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="email">Email:</label>
                        <input class="modal__input"
                            id="email"
                            name="email"
                            type="email"
                            wire:model="user.email">
                        @error('user.email')
                            <span class="modal__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal__input-group">
                        <label class="modal__label"
                            for="phone_no">Phone Number:</label>
                        <input class="modal__input"
                            id="phone_no"
                            name="phone_no"
                            type="text"
                            wire:model="user.phone_no">
                        @error('user.phone_no')
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
            $('#roleSelect').on('change', function(e) {
                var data = $('#roleSelect').select2("val");
                @this.set('user.role_id', data);
            });

            $("#roleSelect").select2({
                placeholder: "Select a role",
                allowClear: false,
                minimumResultsForSearch: 6,
                dropdownCssClass: "category-select__select",
            });
        });
    </script>

</div>
