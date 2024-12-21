<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index($schedule_id)
    {
        $seats = Seat::where('schedule_id', $schedule_id)->get();

        if ($seats->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data kursi untuk jadwal ini.'
            ], 404);
        }

        return response()->json($seats, 200);
    }

    public function getSeatsBySchedule($scheduleId)
    {
        $schedule = Schedule::with('seats')->findOrFail($scheduleId);

        return response()->json([
            'schedule' => $schedule,
            'seats' => $schedule->seats,
        ]);
    }

    public function updateAvailability(Request $request, $id)
    {
        $seat = Seat::find($id);

        if (!$seat) {
            return response()->json(['message' => 'Kursi tidak ditemukan'], 404);
        }

        $request->validate([
            'is_available' => 'required|boolean',
        ]);

        $seat->is_available = $request->is_available;
        $seat->save();

        return response()->json([
            'message' => 'Status kursi berhasil diperbarui.',
            'seat' => $seat
        ], 200);
    }
}
