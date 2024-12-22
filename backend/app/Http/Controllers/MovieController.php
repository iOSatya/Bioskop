<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\Order;

class MovieController extends Controller
{
    public function index()
    {
        // Ambil semua film
        $movies = Movie::all();

        // Kembalikan sebagai JSON
        return response()->json([
            'movies' => $movies,
        ]);
    }

    // Ambil detail film berdasarkan ID film
    public function show($id)
    {
        // Ambil film berdasarkan ID beserta jadwal pemutaran
        $movie = Movie::with('schedules')->find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        // Kembalikan respons JSON
        return response()->json([
            'movie' => $movie,
            'schedules' => $movie->schedules,
        ], 200);
    }

    public function getSchedules($movieId)
    {
        $movie = Movie::with('schedules')->findOrFail($movieId);

        return response()->json([
            'movie' => $movie,
            'schedules' => $movie->schedules,
        ]);
    }
    public function getSeats($schedule_id)
    {
        // Ambil kursi yang tersedia berdasarkan schedule_id
        $seats = Seat::where('schedule_id', $schedule_id)
                     ->where('is_available', true)
                     ->get();

        if ($seats->isEmpty()) {
            return response()->json(['message' => 'No available seats'], 404);
        }

        // Kembalikan kursi sebagai JSON
        return response()->json([
            'seats' => $seats
        ], 200);
    }

    public function showtimes($movie_id)
    {

        $movie = Movie::find($movie_id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        try {
            $showtimes = Schedule::where('movie_id', $movie_id)
                ->with('room')
                ->get();

            return response()->json(['showtimes' => $showtimes]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching showtimes', 'error' => $e->getMessage()], 500);
        }
    }

    public function createOrder(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'seat_numbers' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->schedule_id = $request->schedule_id;
        $order->seat_numbers = json_encode($request->seat_numbers);
        $order->total_price = $request->total_price;
        $order->status = 'pending';
        $order->save();

        $seatsToUpdate = Seat::whereIn('seat_number', $request->seat_numbers)
                            ->where('schedule_id', $request->schedule_id)
                            ->where('is_available', true)
                            ->get();

        if ($seatsToUpdate->isEmpty()) {
            return response()->json(['message' => 'Some seats are no longer available'], 400);
        }

        foreach ($seatsToUpdate as $seat) {
            $seat->is_available = false;
            $seat->save();
        }

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);
    }
}
