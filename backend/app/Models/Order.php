<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'total_price',
    ];

    // Relasi dengan model User (sebagai pemesan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Seat (kursi yang dipesan)
    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'order_seat');
    }

    // Relasi dengan model Schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
