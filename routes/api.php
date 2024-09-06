<?php

use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\VerifyOwnershipMiddleware;

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::delete('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
    Route::get('/profile', 'profile')->name('profile')->middleware('auth:sanctum');
});

Route::apiResource('events',EventController::class)->middleware('auth:sanctum');

Route::controller(EventController::class)->middleware(['auth:sanctum', VerifyOwnershipMiddleware::class])->group(function () {

    Route::patch('/events/{event}', 'update');
    Route::delete('/events/{event}', 'destroy');

});

//Route::apiResource('events',EventController::class)->middleware(['auth:sanctum']);

Route::get('/users/events', [EventController::class, 'showUserEvents'])->middleware(['auth:sanctum']);
