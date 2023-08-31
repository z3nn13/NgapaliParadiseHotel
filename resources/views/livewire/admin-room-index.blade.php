<div>
    <!------- Dashboard Heading Start ------->
    <section class="dashboard-heading container__admin-dashboard">
        <div class="dashboard-heading__texts">
            <h1 class="dashboard-heading__title">Rooms</h1>
            <p class="dashboard-heading__subtitle">Rooms > All Room Types</p>
        </div>
        <div class="dashboard-heading__options">

            <button class="dashboard-heading__option table__option--add"
                onclick='Livewire.emit(
                "openModal", "edit-room-type-modal"
                )'>
                Add Room +
            </button>

            <button class="dashboard-heading__option--export"
                type="submit"
                wire:click="exportRoomTypes">
                Export As
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none">
                    <path d="M5 20H19V18H5M19 9H15V3H9V9H5L12 16L19 9Z"
                        fill="black" />
                </svg>
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
                            x-show="Object.values(selected).some(value => value === true);">
                            <p class="table__option">{{ count($this->getSelectedModels()->values()->all()) }} selected</p>
                        </div>


                        <x-dropdown>
                            <div class="dropdown">
                                <x-slot name="trigger">
                                    <div x-data="{ selected: @entangle('selectedModels') }">

                                        <div class="dashboard-heading__option table__option--bulk"
                                            x-show="Object.values(selected).some(value => value === true);"
                                            x-transition.duration.300>
                                            Bulk
                                            Actions +
                                        </div>
                                    </div>
                                </x-slot>
                                <div class="table__dropdown-container"
                                    x-ref="container">
                                    <button class="table__option table__dropdown-option"
                                        wire:click='confirmDelete(
                        "RoomType", @json($this->getSelectedModels()->values()->all())
                        )'>
                                        Bulk Delete
                                    </button>
                                </div>
                            </div>
                        </x-dropdown>
                        <div class="table__option table__option--filter">
                            <p>Filters</p>
                            <img src="{{ asset('images/svgs/table-filter.svg') }}">
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
                        <tr class="table__row">
                            <td class="table__cell table__cell--not-found"
                                colspan="9">
                                @if ($searchQuery)
                                    No room types found for
                                    "<span class="text-semi-bold">{{ $searchQuery }}</span>".
                                @else
                                    There are no existing room type records.
                                    <p>Please add a <span class="text-semi-bold">room type</span> or run the seeder file.</p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!------- Table Pagination ------->
        @if ($roomTypes->total() > $items_per_page)
            <div class="table__pagination">
                {{ $roomTypes->onEachSide(1)->links('livewire.livewire-pagination-links') }}
            </div>
        @endif
    </section>
    <!------- Room Type Table End ------->

</div>
