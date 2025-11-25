<?php

use App\Http\Controllers\registerController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

// Contact
Route::get('/contact', function () {
    return view('home.contact');
});

// About
Route::get('/about', function () {
    return view('home.about');
});
// Rooms
Route::get('/rooms', function () {
    return view('home.room');
}); 

// Booking
Route::get('/booking', function () {
    return view('home.booking');
});

// Services
Route::get('/services', function () {
    return view('home.service');
});

// Booking
Route::get('/booking', function () {
    return view('home.booking');
});

// Team
Route::get('/team', function () {
    return view('home.team');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Authentication Routes
Route::resource('/login', userController::class);

// User Registration Routes
Route::resource('/register', registerController::class)->middleware(['auth', 'verified']);
Route::get('/logout', [registerController::class, 'logout'])->name('logout');