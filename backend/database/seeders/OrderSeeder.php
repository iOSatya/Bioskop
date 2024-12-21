<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Ambil contoh pengguna
        $user = User::first();  // Pastikan ada pengguna yang sudah terdaftar

        // Ambil contoh film dan jadwal tayang
        $movie = Movie::first();  // Ambil film pertama
        $schedule = Schedule::first();  // Ambil jadwal pertama

        // Buat pesanan
        Order::create([
            'movie_id' => $movie->id,
            'schedule_id' => $schedule->id,
            'seats' => json_encode([1, 2, 3]),  // Kursi yang dipilih
            'total_price' => 90000,  // Total harga untuk 3 kursi
            'user_id' => $user->id,
            'user_email' => $user->email,
        ]);
    }
}
