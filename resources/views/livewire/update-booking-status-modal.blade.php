<div class="modal">
    <div class="modal__wrapper">
        <div class="modal__content">
            <h1 class="modal__title">Mark As</h1>
            <form class="modal__form modal__form--status"
                wire:submit.prevent='saveBookingStatus'>
                <div wire:ignore>
                    <label for="">Booking Status:</label>
                    <select class="modal__select select2"
                        id="statusSelect"
                        name="Status">
                        @foreach (['finished', 'cancelling', 'cancelled', 'upcoming'] as $option)
                            <option value="{{ $option }}"
                                @if (strtolower($status) === $option) selected @endif>{{ ucfirst($option) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal__cta-container">
                    <button class="modal__cta-btn modal__cta-btn--save"
                        type="submit">Save</button>
                    <button class="modal__cta-btn modal__cta-btn--cancel"
                        type="button"
                        wire:click="$emit('closeModal')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function() {
            $('#statusSelect').on('change', function(e) {
                var data = $('#statusSelect').select2("val");
                @this.set('status', data);
            });

            $("#statusSelect").select2({
                placeholder: "Select a booking status",
                allowClear: false,
                minimumResultsForSearch: 6,
                dropdownCssClass: "category-select__select",
            });
        });
    </script>
</div>
