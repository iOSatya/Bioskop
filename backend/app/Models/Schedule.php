<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     * @var string
     */
    protected $table = 'schedules';

    /**
     * Kolom yang bisa diisi (mass assignable)
     * @var array
     */
    protected $fillable = [
        'movie_id',  // Foreign key ke tabel movies
        'date',      // Tanggal pemutaran
        'time',      // Waktu pemutaran
        'room',      // Ruangan teater
    ];

    /**
     * Relasi ke model Movie
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    /**
     * Relasi ke model Seat
     */
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
