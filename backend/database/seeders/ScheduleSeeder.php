<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Movie;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        // Jeda minimal antar film (misalnya 30 menit)
        $minimum_gap = 30; // dalam menit

        // Film yang ingin ditayangkan
        $films = [
            ['title' => 'Barbie', 'duration' => 114],
            ['title' => 'Oppenheimer', 'duration' => 180],
            ['title' => 'The Flash', 'duration' => 144],
            ['title' => 'Guardians of the Galaxy Vol. 3', 'duration' => 150],
            ['title' => 'Spider-Man: Across the Spider-Verse', 'duration' => 140]
        ];

        // Set tanggal yang ingin di-seed
        $date = '2024-12-20';

        // Ruangan yang tersedia
        $rooms = [1, 2, 3];

        // Menambahkan jadwal tayang untuk setiap film
        foreach ($films as $film) {
            $movie = Movie::where('title', $film['title'])->first();
            $this->createFilmSchedule($movie, $date, $film['duration'], $rooms, $minimum_gap);
        }
    }

    /**
     * Helper function to create a schedule with a gap between films.
     *
     * @param $movie
     * @param $date
     * @param $duration
     * @param $rooms
     * @param $gap
     */
    private function createFilmSchedule($movie, $date, $duration, $rooms, $gap)
    {
        $start_time = strtotime("08:00:00"); // Memulai dari jam 08:00 AM

        // Membatasi jumlah tayangan film, misalnya 4 tayangan per film per hari
        $max_showtimes_per_day = 4;

        // Pilih ruangan secara acak
        $room_index = 0;

        for ($i = 0; $i < $max_showtimes_per_day; $i++) {
            // Jika kita sudah menggunakan semua ruangan, reset ke ruangan pertama
            $room = $rooms[$room_index % count($rooms)];

            // Hitung waktu mulai dan selesai untuk sesi film
            $start = date('H:i:s', $start_time);
            $end = date('H:i:s', strtotime("+$duration minutes", $start_time));

            // Buat schedule untuk film
            Schedule::create([
                'movie_id' => $movie->id,
                'date' => $date,
                'start_time' => $start,
                'end_time' => $end,
                'room' => $room
            ]);

            // Update waktu mulai untuk sesi berikutnya (dengan jeda minimal)
            $start_time = strtotime("+$duration minutes +$gap minutes", $start_time);

            // Increment index ruangan agar sesi film berikutnya bisa ditempatkan di ruangan yang berbeda
            $room_index++;
        }
    }
}
