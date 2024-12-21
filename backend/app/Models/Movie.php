<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     * @var string
     */
    protected $table = 'movies';

    /**
     * Kolom yang bisa diisi (mass assignable)
     * @var array
     */
    protected $fillable = [
        'title',
        'poster',     // Path gambar poster
        'rating',     // Rating film
        'synopsis',   // Sinopsis film
        'duration',   // Durasi dalam menit
        'category',   // Kategori film
    ];

    /**
     * Casting kolom ke tipe data
     * @var array
     */
    protected $casts = [
        'rating' => 'decimal:1',
        'duration' => 'integer',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
