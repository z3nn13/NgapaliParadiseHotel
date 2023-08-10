<div>
    <!------- Dashboard Heading Start ------->
    <section class="dashboard-heading container__admin-dashboard">
        <div class="dashboard-heading__texts">
            <h1 class="dashboard-heading__title">Hi, {{ auth()->user()->first_name }}</h1>
            <p class="dashboard-heading__subtitle">Welcome back to your dashboard</p>
        </div>
        <div class="dashboard-heading__options">
            <select class="dashboard-heading__option--select select2"
                wire:model="selectedPeriod">
                <option value="today">Today</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
            <button class="dashboard-heading__option--export"
                type="submit">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none">
                    <path d="M5 20H19V18H5M19 9H15V3H9V9H5L12 16L19 9Z"
                        fill="black" />
                </svg>
                Export As
            </button>
        </div>
    </section>
    <!------- Dashboard Heading End ------->
    <!------- Dashboard Report Start ------->
    <section class="dashboard-report container__admin-dashboard">
        <ul class="dashboard-report__list">
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">${{ $reportData['totalRevenue'] / 2000 }}.00</h2>
                <p class="dashboard-report__subtitle">Total Revenue {{ ucfirst($selectedPeriod) }}</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">{{ $reportData['totalBookings'] }}</h2>
                <p class="dashboard-report__subtitle">Total Bookings {{ ucfirst($selectedPeriod) }}</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">{{ $reportData['totalUsers'] }}</h2>
                <p class="dashboard-report__subtitle">New Members {{ ucfirst($selectedPeriod) }}</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">{{ $reportData['totalRoomsBooked'] }}</h2>
                <p class="dashboard-report__subtitle">Rooms Booked {{ ucfirst($selectedPeriod) }}</p>
            </div>
        </ul>
    </section>
    <!------- Dashboard Report End ------->
</div>
