<div class="modal">
    <div class="modal__wrapper">
        <div class="modal__content">
            <h1 class="modal__title">Mark As</h1>
            <form class="modal__form modal__form--status"
                wire:submit.prevent='saveBookingStatus'>
                <label for="">Booking Status:</label>
                <select class="modal__select"
                    id=""
                    name="Status"
                    wire:model='status'>
                    <option value="completed">Completed</option>
                    <option value="cancelling">Cancelling</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="upcoming">Upcoming</option>
                </select>
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
</div>
