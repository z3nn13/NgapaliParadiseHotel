<div>
    <!------- Dashboard Heading Start ------->
    <section class="dashboard-heading container__admin-dashboard">
        <div class="dashboard-heading__texts">
            <h1 class="dashboard-heading__title">Rooms</h1>
            <p class="dashboard-heading__subtitle">Rooms > All Room Types</p>
        </div>
        <div class="heading__buttons">
            <button onclick='Livewire.emit("openModal", "edit-room-type-modal")'>Add Room Type</button>
            <button class="dashboard-heading__export-button"
                type="submit">
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
            <table class="table">
                <div class="table__title-bar">
                    <h2 class="table__caption">Room Types</h2>
                    <div class="table__options">
                        <div class="table__filters">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 48 48">
                                <g fill="none"
                                    stroke="currentColor"
                                    stroke-linejoin="round"
                                    stroke-width="4">
                                    <rect width="36"
                                        height="36"
                                        x="6"
                                        y="6"
                                        rx="3" />
                                    <path stroke-linecap="round"
                                        d="M24 16v16m-8-8h16" />
                                </g>
                            </svg>
                            <p>Add Room</p>
                        </div>
                        <input class="table__search-input"
                            name="roomType_search"
                            type="search"
                            spellcheck="false"
                            wire:model.debounce.300ms="searchQuery"
                            placeholder="Search Room">
                    </div>
                </div>

                <!------- Table Head ------->
                <thead class="table__head"
                    x-data="{ sortDirection: @entangle('sortDirection'), sortField: @entangle('sortField') }">
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="id">Room No</x-sortable-table-heading>
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
                        <x-room-type-table-row :roomType=$roomType></x-room-type-table-row>
                    @empty
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


@section('scripts')
    <script>
        function confirmDeleteRoomType(roomTypeId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteRoomType', roomTypeId);
                }
            });
        }
    </script>
@endsection
