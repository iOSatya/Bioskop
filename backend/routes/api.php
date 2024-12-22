<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheatreController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");

Route::apiResource("theatres", TheatreController::class);
Route::apiResource("movies", MovieController::class);

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::get('/movies/genre/{genre}', [MovieController::class, 'getMoviesByGenre']);

Route::get('/movies/{id}/seats', [SeatController::class, 'index']);
Route::get('/seats/{id}', [SeatController::class, 'show']);

Route::get('/movies/{movieId}/schedules', [MovieController::class, 'getSchedules']);
Route::get('/schedules/{scheduleId}/seats', [SeatController::class, 'getSeatsBySchedule']);

Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware('auth:sanctum');
