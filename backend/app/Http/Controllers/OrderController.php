<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Seat;
use App\Models\Schedule;

class OrderController extends Controller
{
    // Membuat pesanan tiket
    public function createOrder(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'seat_numbers' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        // Periksa apakah jadwal valid
        $schedule = Schedule::find($request->schedule_id);
        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        // Simpan pesanan
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->schedule_id = $request->schedule_id;
        $order->seat_numbers = json_encode($request->seat_numbers);
        $order->total_price = $request->total_price;
        $order->status = 'pending';
        $order->save();

        // Update status kursi menjadi tidak tersedia (booked)
        $seatsToUpdate = Seat::whereIn('seat_number', $request->seat_numbers)
                            ->where('schedule_id', $request->schedule_id)
                            ->where('is_available', true) // Pastikan hanya kursi yang tersedia
                            ->get();

        if ($seatsToUpdate->isEmpty()) {
            // Kembalikan respons jika kursi yang dipilih tidak tersedia
            return response()->json(['message' => 'Some seats are no longer available'], 400);
        }

        foreach ($seatsToUpdate as $seat) {
            $seat->is_available = false;  // Ubah status kursi menjadi tidak tersedia
            $seat->save();
        }

        // Kembalikan respons berhasil
        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);
    }

    // Melihat detail pesanan berdasarkan ID
    public function getOrder($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json(['order' => $order], 200);
    }
}
