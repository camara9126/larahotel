<?php

use App\Http\Controllers\chambreController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\userController;
use App\Models\chambres;
use App\Models\reservation;
use App\Models\room_type;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $chambres= chambres::where('status', true)->get();
    $type_chambres= room_type::all();

    return view('home.index',compact('chambres','type_chambres'));
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
    $chambres= chambres::where('status', true)->get();
    $type_chambres= room_type::all();

    return view('home.booking', compact('chambres','type_chambres'));
});

// Services
Route::get('/services', function () {
    return view('home.service');
});

// Team
Route::get('/team', function () {
    return view('home.team');
});

// Dashboard
Route::get('/dashboard', function () {
     $chambres= chambres::all();
    $reservations= reservation::all();

    return view('dashboard.index', compact('chambres','reservations'));
})->middleware(['auth', 'verified'])->name('dashboard');

// User Authentication Routes
Route::resource('/login', userController::class);

// User Registration Routes
Route::resource('/register', registerController::class);
Route::get('/logout', [registerController::class, 'logout'])->name('logout');

// Route Chambres CRUD
Route::resource('/chambres', chambreController::class);
//Activer ou Desactiver une chambre
Route::patch('/chambres/{id}/activer', [chambreController::class, 'activate'])->name('chambres.activate');
Route::patch('/chambres/{id}/desactiver', [chambreController::class, 'desactivate'])->name('chambres.desactivate');

// Route Reservation CRUD
 Route::resource('/reservations', reservationController::class);
// Reservations en attente
 Route::get('/attente', [reservationController::class, 'attente'])->name('reservations.attente');
// Reservations validees
 Route::get('/validee', [reservationController::class, 'validee'])->name('reservations.validee');
// Reservations refusees
 Route::get('/refusee', [reservationController::class, 'refusee'])->name('reservations.refusee');

 // Reservation valider
Route::patch('/reservations/{id}/valider', [reservationController::class, 'valider'])->name('reservations.valider');
// Reservation refuser
Route::patch('/reservations/{id}/refuser', [reservationController::class, 'refuser'])->name('reservations.refuser');
