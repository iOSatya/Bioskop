<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies')->insert([
            [
                'title' => 'Barbie',
                'poster' => 'posters/barbie.jpg',
                'rating' => 7.2,
                'synopsis' => 'To the world’s delight, Barbie (Margot Robbie) leaves her pink utopia for the real world and embarks on an adventure that is both hilarious and heartfelt.',
                'duration' => 114,
                'category' => 'Comedy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Oppenheimer',
                'poster' => 'posters/oppenheimer.jpg',
                'rating' => 8.9,
                'synopsis' => 'The story of J. Robert Oppenheimer’s role in the development of the atomic bomb during World War II.',
                'duration' => 180,
                'category' => 'Drama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Flash',
                'poster' => 'posters/the_flash.jpg',
                'rating' => 6.1,
                'synopsis' => 'Barry Allen uses his super speed to change the past, but his attempt to save his family creates a world without superheroes.',
                'duration' => 144,
                'category' => 'Action',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Guardians of the Galaxy Vol. 3',
                'poster' => 'posters/guardians_vol3.jpg',
                'rating' => 8.0,
                'synopsis' => 'The Guardians are out to save one of their own as Peter Quill (Chris Pratt) battles with the past.',
                'duration' => 150,
                'category' => 'Action',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Spider-Man: Across the Spider-Verse',
                'poster' => 'posters/spiderman.jpg',
                'rating' => 8.7,
                'synopsis' => 'Miles Morales embarks on a new adventure, meeting new allies and enemies across the multiverse.',
                'duration' => 140,
                'category' => 'Animation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
