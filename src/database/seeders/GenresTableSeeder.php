<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            "寿司",
            "焼肉",
            "イタリアン",
            "居酒屋",
            "ラーメン",
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'genre' => $genre,
            ]);
        }
    }
}
