<div>
    <!------- Dashboard Heading Start ------->
    <section class="dashboard-heading container__admin-dashboard">
        <div class="dashboard-heading__texts">
            <h1 class="dashboard-heading__title">Users</h1>
            <p class="dashboard-heading__subtitle">Dashboard > Users</p>
        </div>
        <div class="heading__buttons">
            <button class="dashboard-heading__option--export"
                type="submit"
                wire:click="exportUsers">
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


    <!------- User Table Start ------->
    <section class="table__wrapper container__admin-dashboard">
        <div class="table__container">
            <table class="table">
                <div class="table__title-bar">
                    <h2 class="table__caption">Users</h2>
                    <div class="table__options">
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
                                placeholder="Search Booking">
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
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="id">User ID</x-sortable-table-heading>
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="first_name">Name</x-sortable-table-heading>


                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="role_id">Role</x-sortable-table-heading>
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="email">Email</x-sortable-table-heading>
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="phone_no">Phone Number</x-sortable-table-heading>

                    <th class="table__heading">Actions</th>
                </thead>


                <!------- Table Body ------->
                <tbody class="table__body">
                    @forelse  ($users as $user)
                        <x-user-table-row wire:model.defer="selectAll"
                            :user=$user></x-user-table-row>
                    @empty
                        <td class="table__cell">No Results Found.</td>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!------- Table Pagination ------->
        <div class="table__pagination">
            {{ $users->onEachSide(1)->links('livewire.livewire-pagination-links') }}
        </div>
    </section>
    <!------- User Table End ------->
</div>