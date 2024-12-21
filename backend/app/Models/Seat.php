<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_number',
        'is_available',
        'schedule_id',
    ];

    // Relasi dengan model Order
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_seat');
    }

    // Relasi dengan model Schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
