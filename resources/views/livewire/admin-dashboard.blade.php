<div>
    @livewire('admin-reports')
    <section class="dashboard-heading dashboard-heading--export container__admin-dashboard">
        <x-dropdown>
            <x-slot name='trigger'>
                <button class="dashboard-heading__option--export"
                    type="submit">
                    Export As
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none">
                        <path d="M5 20H19V18H5M19 9H15V3H9V9H5L12 16L19 9Z"
                            fill="currentColor" />
                    </svg>
                </button>
            </x-slot>
            <div class="export__dropdown-container">
                <button class="export__dropdown-option"
                    wire:click="exportReservations('xlsx')">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 16 16">
                        <path fill="currentColor"
                            fill-rule="evenodd"
                            d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM7.86 14.841a1.13 1.13 0 0 0 .401.823c.13.108.29.192.479.252c.19.061.411.091.665.091c.338 0 .624-.053.858-.158c.237-.105.416-.252.54-.44a1.17 1.17 0 0 0 .187-.656c0-.224-.045-.41-.135-.56a1.002 1.002 0 0 0-.375-.357a2.028 2.028 0 0 0-.565-.21l-.621-.144a.97.97 0 0 1-.405-.176a.37.37 0 0 1-.143-.299c0-.156.061-.284.184-.384c.125-.101.296-.152.513-.152c.143 0 .266.023.37.068a.624.624 0 0 1 .245.181a.56.56 0 0 1 .12.258h.75a1.093 1.093 0 0 0-.199-.566a1.21 1.21 0 0 0-.5-.41a1.813 1.813 0 0 0-.78-.152c-.293 0-.552.05-.777.15c-.224.099-.4.24-.527.421c-.127.182-.19.395-.19.639c0 .201.04.376.123.524c.082.149.199.27.351.367c.153.095.332.167.54.213l.618.144c.207.049.36.113.462.193a.387.387 0 0 1 .153.326a.512.512 0 0 1-.085.29a.558.558 0 0 1-.255.193c-.111.047-.25.07-.413.07c-.117 0-.224-.013-.32-.04a.837.837 0 0 1-.249-.115a.578.578 0 0 1-.255-.384h-.764Zm-3.726-2.909h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036l.823-1.438Zm1.923 3.325h1.697v.674H5.266v-3.999h.791v3.325Zm7.636-3.325h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036l.823-1.438Z" />
                    </svg>
                    XLSX
                </button>
                <button class="export__dropdown-option"
                    wire:click="exportReservations('pdf')">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="M48 120h160a8 8 0 0 0 8-8V88a8 8 0 0 0-2.34-5.66l-56-56A8 8 0 0 0 152 24H56a16 16 0 0 0-16 16v72a8 8 0 0 0 8 8Zm104-76l44 44h-44Zm72 108a8 8 0 0 1-8 8h-24v16h16a8 8 0 0 1 0 16h-16v16a8 8 0 0 1-16 0v-56a8 8 0 0 1 8-8h32a8 8 0 0 1 8 8Zm-160-8H48a8 8 0 0 0-8 8v56a8 8 0 0 0 16 0v-8h8a28 28 0 0 0 0-56Zm0 40h-8v-24h8a12 12 0 0 1 0 24Zm64-40h-16a8 8 0 0 0-8 8v56a8 8 0 0 0 8 8h16a36 36 0 0 0 0-72Zm0 56h-8v-40h8a20 20 0 0 1 0 40Z" />
                    </svg>
                    PDF
                </button>
                <button class="export__dropdown-option"
                    wire:click="exportReservations('csv')">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 256 256">
                        <g fill="currentColor">
                            <path d="M208 88h-56V32Z"
                                opacity=".2" />
                            <path
                                d="M48 180c0 11 7.18 20 16 20a14.24 14.24 0 0 0 10.22-4.66a8 8 0 0 1 11.56 11.06A30.06 30.06 0 0 1 64 216c-17.65 0-32-16.15-32-36s14.35-36 32-36a30.06 30.06 0 0 1 21.78 9.6a8 8 0 0 1-11.56 11.06A14.24 14.24 0 0 0 64 160c-8.82 0-16 9-16 20Zm79.6-8.69c-4-1.16-8.14-2.35-10.45-3.84c-1.25-.81-1.23-1-1.12-1.9a4.57 4.57 0 0 1 2-3.67c4.6-3.12 15.34-1.73 19.83-.56a8 8 0 0 0 4.14-15.48c-2.12-.55-21-5.22-32.84 2.76a20.58 20.58 0 0 0-9 14.95c-2 15.88 13.65 20.41 23 23.11c12.06 3.49 13.12 4.92 12.78 7.59c-.31 2.41-1.26 3.34-2.14 3.93c-4.6 3.06-15.17 1.56-19.55.36a8 8 0 0 0-4.31 15.44a61.34 61.34 0 0 0 15.19 2c5.82 0 12.3-1 17.49-4.46a20.82 20.82 0 0 0 9.19-15.23c2.19-17.31-14.32-22.14-24.21-25Zm83.09-26.84a8 8 0 0 0-10.23 4.84L188 184.21l-12.47-34.9a8 8 0 0 0-15.07 5.38l20 56a8 8 0 0 0 15.07 0l20-56a8 8 0 0 0-4.84-10.22ZM216 88v24a8 8 0 0 1-16 0V96h-48a8 8 0 0 1-8-8V40H56v72a8 8 0 0 1-16 0V40a16 16 0 0 1 16-16h96a8 8 0 0 1 5.66 2.34l56 56A8 8 0 0 1 216 88Zm-27.31-8L160 51.31V80Z" />
                        </g>
                    </svg>
                    CSV
                </button>
            </div>
        </x-dropdown>
    </section>
    <!------- Booking Table Start ------->
    <section class="table__wrapper container__admin-dashboard">
        <div class="table__container">
            <table class="table">
                <div class="table__title-bar">
                    <h2 class="table__caption">Bookings</h2>
                    <div class="table__options"
                        x-data="{ selected: @entangle('selectedModels') }">
                        <div class="table___option"
                            x-show="Object.values(selected).some(value => value === true);">
                            <p class="table__option--selected">{{ count($this->getSelectedModels()->values()->all()) }} selected</p>
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
                        ID #
                    </x-sortable-table-heading>

                    <x-sortable-table-heading :sortDirection=$sortDirection
                        sortField="first_name">
                        Guest Name
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
                        <x-admin-booking-table-row wire:model.defer="selectAll"
                            :reservation="$reservation"></x-admin-booking-table-row>
                    @empty
                        <tr class="table__row">
                            <td class="table__cell table__cell--not-found"
                                colspan="7">
                                @if ($searchQuery)
                                    No bookings found for
                                    "<span class="text-semi-bold">{{ $searchQuery }}</span>".
                                @else
                                    There are no existing booking records.
                                    <p>Please make a <span class="text-semi-bold">reservation</span> or run the seeder file.</p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!------- Table Pagination ------->
        @if ($reservations->total() > $items_per_page)
            <div class="table__pagination">
                {{ $reservations->onEachSide(1)->links('livewire.livewire-pagination-links') }}
            </div>
        @endif

    </section>

    <!------- Booking Table End ------->
</div>
