<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;
use App\Models\Schedule;

class SeatSeeder extends Seeder
{
    public function run()
    {
        // Mengambil semua jadwal yang sudah ada
        $schedules = Schedule::all();

        // Looping untuk setiap jadwal
        foreach ($schedules as $schedule) {
            // Misalnya kita menyediakan 40 kursi per sesi
            for ($i = 1; $i <= 40; $i++) {
                Seat::create([
                    'schedule_id' => $schedule->id, // Mengaitkan kursi dengan jadwal
                    'seat_number' => $i,  // Nomor kursi
                    'is_booked' => false, // Kursi tersedia saat pertama kali dibuat
                ]);
            }
        }
    }
}
