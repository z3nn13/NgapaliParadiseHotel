<div>
    <!------- Dashboard Heading Start ------->
    <section class="dashboard-heading container__admin-dashboard">
        <div class="dashboard-heading__texts">
            <h1 class="dashboard-heading__title">Hi, {{ auth()->user()->first_name }}</h1>
            <p class="dashboard-heading__subtitle">Welcome back to your dashboard</p>
        </div>
        <div class="dashboard-heading__options">
            <div class="dashboard-heading__tab-navigation">
                <button class="dashboard-heading__tab {{ $selectedPeriod === 'today' ? 'dashboard-heading__tab--active' : '' }}"
                    wire:click="$set('selectedPeriod', 'today')">Today</button>
                <button class="dashboard-heading__tab {{ $selectedPeriod === 'monthly' ? 'dashboard-heading__tab--active' : '' }}"
                    wire:click="$set('selectedPeriod', 'monthly')">Monthly</button>
                <button class="dashboard-heading__tab {{ $selectedPeriod === 'yearly' ? 'dashboard-heading__tab--active' : '' }}"
                    wire:click="$set('selectedPeriod', 'yearly')">Yearly</button>
            </div>
        </div>
    </section>
    <!------- Dashboard Heading End ------->
    <!------- Dashboard Report Start ------->
    <section class="dashboard-report container__admin-dashboard">
        <ul class="dashboard-report__list">
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">${{ $reportData['totalRevenue'] / 2000 }}.00</h2>
                <p class="dashboard-report__subtitle">Total Revenue</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">{{ $reportData['totalBookings'] }}</h2>
                <p class="dashboard-report__subtitle">New Bookings</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">{{ $reportData['totalUsers'] }}</h2>
                <p class="dashboard-report__subtitle">New Members</p>
            </div>
            <div class="dashboard-report__item">
                <h2 class="dashboard-report__title">{{ $reportData['totalRoomsBooked'] }}</h2>
                <p class="dashboard-report__subtitle">Rooms Booked</p>
            </div>
        </ul>
    </section>
    <!------- Dashboard Report End ------->
</div>
