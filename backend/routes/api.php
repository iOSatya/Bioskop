<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheatreController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");

Route::apiResource("theatres", TheatreController::class);
Route::apiResource("movies", MovieController::class);
Route::put("/movies-order", [MovieController::class, "order"]);

Route::post("/tickets-order", [TicketController::class, "order"])->middleware("auth:sanctum");