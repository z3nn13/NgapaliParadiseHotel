<td class="table__cell table__cell--action" x-data="{
    dropdown: false,
    dropdownPosition: 'left-100',
    containerWidth: 0,
    toggleDropdown: function() {
        this.dropdown = !this.dropdown;
        if (this.dropdown) {
            this.calculateDropdownPosition();
            this.setupObserver();
        }
    },
    calculateDropdownPosition: function() {
        const triggerRect = this.$refs.trigger.getBoundingClientRect();
        const containerRect = this.$refs.container.getBoundingClientRect();
        const rightSpace = window.innerWidth - triggerRect.right;
        this.dropdownPosition = rightSpace >= containerRect.width ? 'left-100' : 'right-100';
        this.containerWidth = containerRect.width;
    },
    setupObserver: function() {
        const observer = new ResizeObserver(() => {
            this.calculateDropdownPosition();
        });
        observer.observe(this.$refs.container);
    }
}" x-init="calculateDropdownPosition()">

    <!-- Actions Button -->
    <div class="table__dropdown">
        <img class="table__dropdown-trigger" src="{{ asset('images/svgs/action.svg') }}" :class="{ 'table__dropdown-trigger--active': dropdown }" @click="toggleDropdown()" x-ref="trigger">
        <div class="table__dropdown-container" :class="dropdownPosition" x-show="dropdown" @click.outside="dropdown = false" x-cloak x-ref="container">
            {{ $slot }}
        </div>
    </div>
</td>
