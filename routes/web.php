<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;

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

Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/search', App\Http\Livewire\ReservationSearch::class)->name('search');
    Route::post('/create', [ReservationController::class, 'create'])->name('create');
    Route::post('/add-room', [ReservationController::class, 'add-room'])->name('add-room');
    Route::post('/confirm', [ReservationController::class, 'confirm'])->name('confirm');
    Route::post('/payment', [ReservationController::class, 'payment'])->name('payment');
    Route::get('/store', [ReservationController::class, 'store'])->name('store');
});


Route::get('/rooms', App\Http\Livewire\RoomsIndex::class)->name('rooms.index');
Route::view('/gallery', 'layouts.gallery')->name('gallery.index');
Route::view('/about', 'layouts.about')->name('about.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});

require __DIR__ . '/auth.php';
