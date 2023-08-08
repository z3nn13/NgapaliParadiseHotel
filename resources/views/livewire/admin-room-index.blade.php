<div>
    <!------- Dashboard Heading Start ------->
    <section class="dashboard-heading container__admin-dashboard">
        <div class="dashboard-heading__texts">
            <h1 class="dashboard-heading__title">Rooms</h1>
            <p class="dashboard-heading__subtitle">Rooms > All Room Types</p>
        </div>
        <div class="heading__buttons">
            <button class="dashboard-heading__export-button"
                type="submit"
                wire:click="exportClickListener">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none">
                    <path d="M5 20H19V18H5M19 9H15V3H9V9H5L12 16L19 9Z"
                        fill="black" />
                </svg>
                Export</button>
        </div>
    </section>

    <!------- Room Type Table Start ------->
    <section class="table__wrapper container__admin-dashboard">
        <div class="table__container">
            <table class="table"
                x-data="{ show: false }">
                <div class="table__title-bar">
                    <h2 class="table__caption">Room Types</h2>
                    <div class="table__options">
                        <div class="table___option"
                            x-show="show">
                            <p class="table__option">Selected {{ $selectedModels->count() }} rows</p>
                        </div>
                        <div class="table__option table__option--bulk">
                            Bulk
                            Actions
                            <button class="table__option table__option--add"
                                onclick='confirmDelete(
                                    "RoomType", @json($this->getSelectedModels()->values()->all())
                                )'>
                                Bulk Delete
                            </button>
                        </div>

                        <button class="table__option table__option--add"
                            onclick='Livewire.emit(
                                "openModal", "edit-room-type-modal"
                                )'>
                            +
                            Add
                            Room
                        </button>

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
                            @click="show = !show"
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
