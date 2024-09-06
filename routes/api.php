<?php

use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::delete('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
    Route::get('/profile', 'profile')->name('profile')->middleware('auth:sanctum');
});

Route::apiResource('events',EventController::class)->middleware(['auth:sanctum']);

Route::get('/users/events', [EventController::class, 'showUserEvents'])->middleware(['auth:sanctum']);
