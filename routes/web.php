<?php

use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ReservationController;
use App\Http\Livewire\RoomTypeSearch;

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

Route::get('/', function () {
    return view('index');
})->name('index');


Route::post('/booking/create', [ReservationController::class, 'create'])->name('booking.create');
Route::post('/booking/add-room', [ReservationController::class, 'add-room'])->name('booking.add-room');
Route::post('/booking/confirm', [ReservationController::class, 'confirm'])->name('booking.confirm');
Route::post('/booking/payment', [ReservationController::class, 'payment'])->name('booking.payment');
Route::get('/booking/store', [ReservationController::class, 'store'])->name('booking.store');


Route::get('/room-types/search', RoomTypeSearch::class)->name('room-types.search');
Route::post('/room-types/sort', [RoomTypeController::class, 'sort'])->name('room-types.sort');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
