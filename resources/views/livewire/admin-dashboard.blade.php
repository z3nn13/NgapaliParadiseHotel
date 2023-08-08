<div>
    <!------- Dashboard Heading Start ------->
    <section class="dashboard-heading container__admin-dashboard">
        <div class="dashboard-heading__texts">
            <h1 class="dashboard-heading__title">Hi, {{ auth()->user()->first_name }}</h1>
            <p class="dashboard-heading__subtitle">Welcome back to your dashboard</p>
        </div>
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
    </section>
    <!------- Dashboard Heading End ------->

    <!------- Dashboard Report Start ------->
    <section class="dashboard-report container__admin-dashboard">
        <ul class="dashboard-report__list">
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">${{ $reports['totalRevenueToday'] / 2000 }}.00</h2>
                <p class="dashboard-report__subtitle">Total Revenue Today</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">{{ $reports['totalReservationsToday'] }}</h2>
                <p class="dashboard-report__subtitle">Total Bookings Today</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">5</h2>
                <p class="dashboard-report__subtitle">New Members Today</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">14</h2>
                <p class="dashboard-report__subtitle">Rooms Booked Today</p>
            </div>
        </ul>
    </section>
    <!------- Dashboard Report End ------->

    <!------- Booking Table Start ------->
    <section class="table__wrapper container__admin-dashboard">
        <div class="table__container">
            <table class="table">
                <div class="table__title-bar">
                    <h2 class="table__caption">Bookings</h2>
                    <div class="table__options">
                        <div class="table__option table__option--filter">
                            <p>Filters</p>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="32"
                                height="32"
                                viewBox="0 0 32 32"
                                fill="none">
                                <path
                                    d="M12 21C12 20.7348 12.1054 20.4804 12.2929 20.2929C12.4804 20.1054 12.7348 20 13 20H19C19.2652 20 19.5196 20.1054 19.7071 20.2929C19.8946 20.4804 20 20.7348 20 21C20 21.2652 19.8946 21.5196 19.7071 21.7071C19.5196 21.8946 19.2652 22 19 22H13C12.7348 22 12.4804 21.8946 12.2929 21.7071C12.1054 21.5196 12 21.2652 12 21ZM8 15C8 14.7348 8.10536 14.4804 8.29289 14.2929C8.48043 14.1054 8.73478 14 9 14H23C23.2652 14 23.5196 14.1054 23.7071 14.2929C23.8946 14.4804 24 14.7348 24 15C24 15.2652 23.8946 15.5196 23.7071 15.7071C23.5196 15.8946 23.2652 16 23 16H9C8.73478 16 8.48043 15.8946 8.29289 15.7071C8.10536 15.5196 8 15.2652 8 15ZM4 9C4 8.73478 4.10536 8.48043 4.29289 8.29289C4.48043 8.10536 4.73478 8 5 8H27C27.2652 8 27.5196 8.10536 27.7071 8.29289C27.8946 8.48043 28 8.73478 28 9C28 9.26522 27.8946 9.51957 27.7071 9.70711C27.5196 9.89464 27.2652 10 27 10H5C4.73478 10 4.48043 9.89464 4.29289 9.70711C4.10536 9.51957 4 9.26522 4 9Z"
                                    fill="black" />
                            </svg>
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

                    <x-sortable-table-heading :sortDirection=$sortDirection
                        sortField="id">
                        #
                    </x-sortable-table-heading>

                    <x-sortable-table-heading :sortDirection=$sortDirection
                        sortField="first_name">
                        Name
                    </x-sortable-table-heading>

                    <x-sortable-table-heading :sortDirection=$sortDirection
                        sortField="check_in_date">
                        Check In
                    </x-sortable-table-heading>

                    <th class="table__heading">Paid </th>
                    <th class="table__heading">Status</th>
                    <th class="table__heading">Actions</th>
                </thead>

                <!------- Table Body ------->
                <tbody class="table__body">
                    @forelse  ($reservations as $reservation)
                        <x-booking-table-row wire:model.defer="selectAll"
                            :reservation="$reservation"></x-booking-table-row>
                    @empty
                        <td class="table__cell">No Results Found.</td>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!------- Table Pagination ------->
        <div class="table__pagination">
            {{ $reservations->onEachSide(1)->links('livewire.livewire-pagination-links') }}
        </div>
    </section>

    <!------- Booking Table End ------->
</div>
