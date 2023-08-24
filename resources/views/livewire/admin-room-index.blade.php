<div>
    <!------- Dashboard Heading Start ------->
    <section class="dashboard-heading container__admin-dashboard">
        <div class="dashboard-heading__texts">
            <h1 class="dashboard-heading__title">Rooms</h1>
            <p class="dashboard-heading__subtitle">Rooms > All Room Types</p>
        </div>
        <div class="dashboard-heading__options">

            <x-dropdown>
                <div class="dropdown">
                    <x-slot name="trigger">
                        <div x-data="{ selected: @entangle('selectedModels') }">

                            {{-- TODO: MAKE THIS APPEAR, SHIT WORKS NOW, JUST NOT APPEARING --}}
                            <div class="dashboard-heading__option table__option--bulk"
                                x-show="selected.length != 0 || Object.values(selected).some(val => val)">
                                Bulk
                                Actions
                            </div>
                        </div>
                    </x-slot>
                    <div class="table__dropdown-container"
                        x-ref="container">
                        <button class="table__option table__dropdown-option"
                            onclick='confirmDelete(
                        "RoomType", @json($this->getSelectedModels()->values()->all())
                        )'>
                            Bulk Delete
                        </button>
                    </div>
                </div>
            </x-dropdown>

            <button class="dashboard-heading__option table__option--add"
                onclick='Livewire.emit(
                "openModal", "edit-room-type-modal"
                )'>
                + Add Room
            </button>

            <button class="dashboard-heading__option--export"
                type="submit"
                wire:click="exportRoomTypes">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none">
                    <path d="M5 20H19V18H5M19 9H15V3H9V9H5L12 16L19 9Z"
                        fill="black" />
                </svg>
                Export
            </button>
        </div>
    </section>

    <!------- Room Type Table Start ------->
    <section class="table__wrapper container__admin-dashboard">
        <div class="table__container">
            <table class="table">
                <div class="table__title-bar">
                    <h2 class="table__caption">Room Types</h2>
                    <div class="table__options"
                        x-data="{ selected: @entangle('selectedModels') }">
                        <div class="table___option"
                            x-show="selected.length != 0 || Object.values(selected).some(val => val)">
                            <p class="table__option">Selected {{ count($this->getSelectedModels()->values()->all()) }} rows</p>
                        </div>

                        <div class="table__option--searchbar">
                            <input class="table__option--search"
                                name="roomType_search"
                                type="search"
                                spellcheck="false"
                                wire:model.debounce.300ms="searchQuery"
                                placeholder="Search Room">
                            <img src="{{ asset('images/svgs/table-search.svg') }}"
                                alt="">
                        </div>

                    </div>
                </div>

                <!------- Table Head ------->
                <thead class="table__head"
                    x-data="{ sortDirection: @entangle('sortDirection'), sortField: @entangle('sortField') }">
                    <th class="table__heading">
                        <input class="table__checkbox"
                            type="checkbox"
                            wire:model="selectAll">
                    </th>

                    <x-sortable-table-heading :sortDirection=$sortDirection
                        sortField="id">
                        #
                    </x-sortable-table-heading>

                    <th class="table__heading">Room Image</th>

                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="room_type_name">Room Name</x-sortable-table-heading>

                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="view">View</x-sortable-table-heading>
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="occupancy">Housing</x-sortable-table-heading>
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="bedding">Bedding</x-sortable-table-heading>
                    <th class="table__heading">Description</th>
                    <th class="table__heading">Actions</th>
                </thead>


                <!------- Table Body ------->
                <tbody class="table__body">
                    @forelse  ($roomTypes as $roomType)
                        <x-room-type-table-row wire:model.defer="selectAll"
                            :roomType=$roomType></x-room-type-table-row>
                    @empty
                        <td></td>
                        <td class="table__cell">No Results Found.</td>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!------- Table Pagination ------->
        <div class="table__pagination">
            {{ $roomTypes->onEachSide(1)->links('livewire.livewire-pagination-links') }}
        </div>
    </section>
    <!------- Room Type Table End ------->

</div>
