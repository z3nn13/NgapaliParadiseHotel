# Ngapali Paradise Hotel Reservation System

Welcome to the Ngapali Paradise Hotel Reservation System, a solution designed for managing hotel reservations, built for final years bachelor degree. This robust system is built on the TALL stack, incorporating Tailwind CSS, Alpine.js, Laravel, and Livewire. Furthermore, although SASS is employed for styling instead.

## Features

### Home

-   An inviting and user-friendly landing page providing an enticing overview of Ngapali Paradise Hotel.

### Rooms

-   Explore detailed information about available rooms, including pricing, amenities, and captivating images.

### Gallery

-   Immerse yourself in a visually stunning gallery showcasing the hotel's rooms, facilities, and the natural beauty of Ngapali.

### About

-   Discover the rich history of Ngapali Paradise Hotel and get to know the dedicated team behind the scenes.

### Authentication System

-   Secure user authentication for both guests and administrators.

### Admin Dashboard

-   A powerful dashboard for administrators to efficiently manage rooms, users, and bookings.

### Booking System

-   Seamless booking process for guests with an intuitive interface.
-   Enjoy the benefits of a working coupon system to avail exciting discounts on bookings.

### Stripe Integration

-   Secure payment processing with seamless Stripe integration for convenient and secure transactions.

## Technologies Used

-   **TALL Stack:** Tailwind CSS, Alpine.js, Laravel, Livewire.
-   **Styling:** SASS for a flexible and maintainable styling approach.

## Getting Started

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/ngapali-paradise-hotel.git
    ```
2. Install dependencies:
    ```bash
    composer install
    npm install && npm run dev
    ```
3. Set up your environment variables:
    - Copy `.env.example` to `.env` and configure your database and Stripe API keys.
4. Run migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```
5. Start the development server:
    ```bash
    php artisan serve
    ```
6. Visit `http://localhost:8000` in your browser.

## License

The Laravel project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
