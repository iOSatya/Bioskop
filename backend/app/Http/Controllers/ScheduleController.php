<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function getSeats($scheduleId)
    {
        try {
            // Cari jadwal berdasarkan ID
            $schedule = Schedule::findOrFail($scheduleId);

            // Ambil data kursi dari relasi
            $seats = $schedule->seats;

            // Kembalikan respon JSON
            return response()->json($seats, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
