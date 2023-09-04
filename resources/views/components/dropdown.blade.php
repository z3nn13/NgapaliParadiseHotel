<div x-data="{
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
        this.dropdownPosition = rightSpace >= containerRect.width ? 'right-100' : 'right-100';
        this.containerWidth = containerRect.width;
    },
    setupObserver: function() {
        const observer = new ResizeObserver(() => {
            this.calculateDropdownPosition();
        });
        observer.observe(this.$refs.container);
    }
}"
    x-init="calculateDropdownPosition()">
    <div @click="toggleDropdown()"
        x-ref="trigger">{{ $trigger }}

        <div x-show="dropdown"
            x-transition.scale.80
            x-transition.scale.origin.top
            x-cloak
            @click.outside="dropdown = false">
            {{ $slot }}
        </div>
    </div>
</div>
