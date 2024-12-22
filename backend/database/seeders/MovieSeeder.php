<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $movies = [
            [
                'title' => 'Atlas',
                'poster' => 'posters/atlas.jpg',
                'synopsis' => 'A sci-fi thriller about a man who discovers a groundbreaking AI technology.',
                'duration' => 120,
                'category' => 'Sci-Fi',
            ],
            [
                'title' => 'The Activated Man',
                'poster' => 'posters/the_activated_man.jpg',
                'synopsis' => 'A mysterious serum transforms a man into a superhuman.',
                'duration' => 115,
                'category' => 'Action',
            ],
            [
                'title' => 'Adopted',
                'poster' => 'posters/adopted.jpg',
                'synopsis' => 'A heartfelt drama about an orphan seeking to find his true family.',
                'duration' => 125,
                'category' => 'Drama',
            ],
            [
                'title' => 'Afraid',
                'poster' => 'posters/afraid.jpg',
                'synopsis' => 'A psychological thriller exploring the darkest fears of the human mind.',
                'duration' => 110,
                'category' => 'Thriller',
            ],
            [
                'title' => 'Megalopolis',
                'poster' => 'posters/megalopolis.jpg',
                'synopsis' => 'A story of hope and ambition in a futuristic metropolis.',
                'duration' => 140,
                'category' => 'Drama',
            ],
            [
                'title' => 'Moana 2',
                'poster' => 'posters/moana2.jpg',
                'synopsis' => 'Moana embarks on another adventure across the vast ocean to save her people.',
                'duration' => 130,
                'category' => 'Animation',
            ],
            [
                'title' => 'Sonic 3',
                'poster' => 'posters/sonic3.jpg',
                'synopsis' => 'Sonic teams up with Tails and Knuckles to face Dr. Robotnik’s latest scheme.',
                'duration' => 120,
                'category' => 'Animation',
            ],
            [
                'title' => 'Mufasa: The Lion King',
                'poster' => 'posters/mufasa.jpg',
                'synopsis' => 'The origin story of Mufasa, a tale of leadership, courage, and family.',
                'duration' => 125,
                'category' => 'Animation',
            ],
            [
                'title' => 'Accidental Texan',
                'poster' => 'posters/accidental_texan.jpg',
                'synopsis' => 'A heartwarming story of a city man finding purpose in rural Texas.',
                'duration' => 135,
                'category' => 'Drama',
            ],
            [
                'title' => 'The Crow',
                'poster' => 'posters/the_crow.jpg',
                'synopsis' => 'A dark tale of vengeance and redemption in a gritty urban landscape.',
                'duration' => 140,
                'category' => 'Action',
            ],
            [
                'title' => 'Venom',
                'poster' => 'posters/venom.jpeg',
                'synopsis' => 'A journalist bonds with an alien symbiote to become the anti-hero Venom.',
                'duration' => 112,
                'category' => 'Action',
            ],
            [
                'title' => 'Red One',
                'poster' => 'posters/redone.jpg',
                'synopsis' => 'A holiday action-adventure film that reimagines the world of Santa Claus.',
                'duration' => 130,
                'category' => 'Adventure',
            ],
        ];

        foreach ($movies as $movie) {
            if (!DB::table('movies')->where('title', $movie['title'])->exists()) {
                DB::table('movies')->insert(array_merge($movie, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }
}
