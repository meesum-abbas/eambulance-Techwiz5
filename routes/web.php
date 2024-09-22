<?php

use App\Http\Controllers\AdminDriverController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\EmergencyRequestController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MessageController;
use App\Models\User;
use App\Http\Controllers\ContactController;

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('saveregister');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/home', [UserController::class, 'home']);
Route::get('/', [GuestController::class, 'index']);
Route::post('/emergency-requests', [EmergencyRequestController::class, 'store'])->name('emergency-requests');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [AdminController::class, 'edit'])->name('editprofile');
    Route::post('/profile/update', [AdminController::class, 'update'])->name('updateprofile');
    Route::get('/users', action: [UserController::class, 'index'])->name('showusers');
    Route::get('/ambulances/index', action: [AmbulanceController::class, 'index'])->name('showambulance');
    Route::get('/ambulances/create', action: [AmbulanceController::class, 'create'])->name('createambulance');
    Route::post('/ambulances/store', action: [AmbulanceController::class, 'store'])->name('saveambulance');
    Route::get('/ambulances/edit/{ambulance}', [AmbulanceController::class, 'edit'])->name('editambulance');
    Route::post('/ambulances/update/{ambulance}', [AmbulanceController::class, 'update'])->name('updateambulance');
    Route::delete('/ambulances/delete/{ambulance}', [AmbulanceController::class, 'destroy'])->name('deleteambulance');
    Route::get('/drivers', [AdminDriverController::class, 'index'])->name('showdrivers');
    Route::get('/drivers/create', [AdminDriverController::class, 'create'])->name('createdriver');
    Route::post('/drivers/store', [AdminDriverController::class, 'store'])->name('savedriver');
    Route::get('/drivers/edit/{driver}', [AdminDriverController::class, 'edit'])->name('editdriver');
    Route::post('/drivers/update/{driver}', [AdminDriverController::class, 'update'])->name('updatedriver');
    Route::post('/drivers/delete/{driver}', [AdminDriverController::class, 'destroy'])->name('deletedriver');
    Route::get('/monitoring', [AdminController::class, 'Monitoring'])->name('monitoring');
    Route::get('/dispatch', [EmergencyRequestController::class, 'Dispatch'])->name('dispatch'); 
    Route::get('/contacts', [AdminController::class, 'showcontact'])->name('contacts'); 
    Route::get('/feedback', [AdminController::class, 'showfeedback'])->name('feedback'); 
    Route::put('/dispatch/{request}/assign-driver', [EmergencyRequestController::class, 'assignDriver'])->name('assign.driver');
    Route::get('/drivers/chat/{id}', function ($id) {
        $driver = User::where('id', $id)->where('rolefk', 2)->firstOrFail();
        return view('AdminPannel.chat', compact('driver'));
    })->name('chatdriver');
});


Route::get('/messages/{receiverId}', [MessageController::class, 'fetchMessages'])->name('messages.fetch');
Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');

// Driver Routes
Route::group(['prefix' => 'driver', 'middleware' => ['auth', 'isDriver']], function () {
    Route::get('/dashboard', [DriverController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [DriverController::class, 'edit'])->name('editprofiles');
    Route::get('/showbookings', [DriverController::class, 'showbookings'])->name('showbookings');
    Route::post('/profile/update', [DriverController::class, 'update'])->name('updateprofile');
    Route::put('/complete-ride/{id}', [DriverController::class, 'completeRide'])->name('complete.ride');
    Route::get('/messages/{receiverId}', [MessageController::class, 'fetchMessages'])->name('driver.messages.fetch');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('driver.messages.send');


    // Define the chat route
    Route::get('/chat/{id}', function ($id) {
        return view('DriverPannel.driver_chat', ['adminId' => $id]);
    })->name('driver.chat');
});

// User Routes
// User Routes
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'isUser']], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'update'])->name('updateprofile');
    Route::post('/medical-cards', [UserController::class, 'store'])->name('medical-cards.store'); 
});


