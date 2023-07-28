<?php

use App\Http\Livewire\AdminDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Livewire\AdminRoomIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'index')->name('index');
Route::view('/about', 'layouts.about')->name('about.index');
Route::view('/gallery', 'layouts.gallery')->name('gallery.index');
Route::get('/rooms', App\Http\Livewire\RoomsIndex::class)->name('rooms.index');



Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/search', App\Http\Livewire\ReservationSearch::class)->name('search');
    Route::post('/create', [ReservationController::class, 'create'])->name('create');

    Route::match(['post', 'get'], '/confirm', [ReservationController::class, 'confirm'])->name('confirm')->middleware('booking.session');
    Route::get('/add-room', [ReservationController::class, 'add_room'])->name('add-room')->middleware('booking.session');
    Route::get('/payment', [ReservationController::class, 'payment'])->name('payment')->middleware('booking.session');
    Route::get('/store', [ReservationController::class, 'store'])->name('store')->middleware('booking.session');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/rooms', AdminRoomIndex::class)->name('rooms');
        Route::view('/users', 'admin.users')->name('users');
        Route::view('/settings', 'admin.settings')->name('settings');

        Route::resource('reservations', AdminReservationController::class);
    });

require __DIR__ . '/auth.php';
