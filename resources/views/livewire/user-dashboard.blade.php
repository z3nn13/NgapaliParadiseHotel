<div>
    @livewire('livewire-ui-modal')
    <!------ Navigation Component ------>
    <x-nav></x-nav>

    <!------ User Dashboard ------>
    <div class="user-dashboard">

        <!------ User Dashboard Sidebar ------>
        <div class="user-dashboard__sidebar">
            <h1 class="user-dashboard__sidebar-title">Dashboard</h1>
        </div>

        <!------ User Dashboard Main Starts ------>
        <div class="user-dashboard__main">

            <!------ User Profile Section Starts ------>
            <section class="user-profile">
                <h2 class="user-profile__title">Manage Account</h2>

                <!------ User Profile Card Starts ------>
                <div class="user-profile__card">
                    <img class="user-profile__card-image"
                        src="{{ asset(auth()->user()->user_image) ?? asset('images/misc/no-image.png') }}">

                    <div class="user-profile__content">
                        <h3 class="user-profile__username">
                            {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                        </h3>
                        <button class="user-profile__button"
                            type="submit"
                            onclick="Livewire.emit('openModal', 'edit-user-modal', {{ json_encode(['user' => auth()->user()->id]) }})">
                            <img src="{{ asset('images/svgs/ic-round-edit.svg') }}"
                                alt="">
                            Edit Profile
                        </button>
                    </div>

                    <div class="user-profile__details">
                        <div class="user-profile__detail">
                            <svg class="user-profile__icon"
                                xmlns="http://www.w3.org/2000/svg"
                                width="23"
                                height="23"
                                viewBox="0 0 23 23"
                                fill="none">
                                <path
                                    d="M14.6122 15.4387L16.2222 13.8287C16.4391 13.6146 16.7134 13.468 17.012 13.4068C17.3106 13.3455 17.6205 13.3723 17.9041 13.4837L19.8663 14.2672C20.1529 14.3835 20.3987 14.5821 20.5727 14.8379C20.7466 15.0938 20.841 15.3953 20.8438 15.7047V19.2984C20.8421 19.5089 20.7979 19.7168 20.7138 19.9097C20.6296 20.1026 20.5073 20.2764 20.3542 20.4208C20.2011 20.5652 20.0204 20.6771 19.8229 20.7498C19.6254 20.8225 19.4152 20.8544 19.205 20.8437C5.45536 19.9884 2.68099 8.34469 2.1563 3.88844C2.13194 3.6696 2.1542 3.44809 2.2216 3.23848C2.289 3.02886 2.40002 2.83589 2.54735 2.67227C2.69468 2.50864 2.87499 2.37806 3.07641 2.28912C3.27784 2.20018 3.49581 2.1549 3.71599 2.15625H7.18755C7.49734 2.15717 7.79977 2.25074 8.05594 2.42494C8.31211 2.59914 8.51031 2.84599 8.62505 3.13375L9.40849 5.09594C9.52367 5.37845 9.55306 5.68865 9.49298 5.98777C9.4329 6.28689 9.28601 6.56168 9.07067 6.77781L7.46068 8.38781C7.46068 8.38781 8.38786 14.6625 14.6122 15.4387Z"
                                    fill="#D37643" />
                            </svg>
                            <p class="user-profile__text">
                                {{ auth()->user()->phone_no }}
                            </p>
                        </div>
                        <div class="user-profile__detail">
                            <svg class="user-profile__icon"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none">
                                <path d="M22 4.16667H2V20.8333H22V4.16667ZM20 8.33334L12 13.5417L4 8.33334V6.25001L12 11.4583L20 6.25001V8.33334Z"
                                    fill="#D37643" />
                            </svg>

                            <p class="user-profile__text">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>

                </div>
                <!------ User Profile Card End ------>

            </section>
            <!------ User Profile Section End ------>


            <!------- Booking Table Start ------->
            <section>
                <div class="table__title-bar">
                    <h2 class="table__caption">Booking History</h2>
                    <div class="table__options">
                        <div class="table__option--searchbar">
                            <input class="table__option--search"
                                name="roomType_search"
                                type="search"
                                spellcheck="false"
                                wire:model.debounce.300ms="searchQuery"
                                placeholder="Search...">
                            <img src="{{ asset('images/svgs/table-search.svg') }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </section>
            <section class="table__wrapper container__admin-dashboard">
                <div class="table__container">
                    <table class="table">

                        <!------- Table Head ------->
                        <thead class="table__head table__row table__row--dark"
                            class="table__heading">
                            <th class="table__heading">Time</th>
                            <th class="table__heading">Booking ID</th>
                            <th class="table__heading">Check In</th>
                            <th class="table__heading">Paid </th>
                            <th class="table__heading">Status</th>
                            <th class="table__heading">Actions</th>
                        </thead>

                        <!------- Table Body ------->
                        <tbody class="table__body">
                            @forelse  ($reservations as $reservation)
                                <x-user-booking-table-row :reservation="$reservation"
                                    :rowClass="$loop->even ? 'table__row--dark' : ''">
                                </x-user-booking-table-row>
                            @empty
                                <tr class="table__row">
                                    <td class="table__cell table__cell--not-found">No bookings found for
                                        <span class="text-semi-bold">
                                            "{{ $searchQuery }}"
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!------- Table Pagination ------->
                @if ($reservations->items())
                    <div class="table__pagination">
                        {{ $reservations->onEachSide(1)->links('livewire.livewire-pagination-links') }}
                    </div>
                @endif
            </section>

            <!------- Booking Table End ------->

        </div>
        <!------ User Dashboard Main End ------>

    </div>
    <!------ User Dashboard Ends ------>

</div>
