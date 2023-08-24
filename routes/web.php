<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RoomsIndex;
use App\Http\Livewire\UserDashboard;
use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\AdminRoomIndex;
use App\Http\Livewire\AdminUserIndex;
use App\Http\Livewire\ReservationCreate;
use App\Http\Livewire\ReservationSearch;
use App\Http\Livewire\UserBookingDetails;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;

/*
* Basic views 
*/

Route::view('/', 'index')->name('index');
Route::view('/about', 'layouts.about')->name('about.index');
Route::view('/gallery', 'layouts.gallery')->name('gallery.index');
Route::get('/rooms', RoomsIndex::class)->name('rooms.index');

/*
* Booking routes with 'booking.session' middleware 
*/
Route::middleware('booking.session')->prefix('booking')->name('booking.')->group(function () {
    Route::get('/search', ReservationSearch::class)->name('search');
    Route::get('/create', ReservationCreate::class)->name('create');

    Route::get('/confirm', [ReservationController::class, 'confirm'])->name('confirm');
    Route::get('/add-room', [ReservationController::class, 'add_room'])->name('add-room');
    Route::get('/payment', [ReservationController::class, 'payment'])->name('payment');
    Route::get('/success', [ReservationController::class, 'store'])->name('success');
});

/*
* User dashboard routes with 'auth' middleware
*/
Route::middleware('auth')->prefix('dashboard')->name('dashboard')->group(function () {
    Route::get('/', UserDashboard::class);
    Route::get('/bookings/{reservation}', UserBookingDetails::class)
        ->name('.bookings.show')
        ->middleware('booking.owner');
});

/*
* Admin routes with 'auth' and 'role:admin' middleware
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/rooms', AdminRoomIndex::class)->name('rooms');
    Route::get('/users', AdminUserIndex::class)->name('users');
    Route::view('/settings', 'admin.settings')->name('settings');
    Route::resource('reservations', AdminReservationController::class);
});

// Include authentication routes
require __DIR__ . '/auth.php';
