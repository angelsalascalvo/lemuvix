<?php

use Illuminate\Database\Seeder;

class GenreMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genre_movie')->insert([
            'id_movie'=>1,
            'id_genre'=>3
        ]);

        DB::table('genre_movie')->insert([
            'id_movie'=>1,
            'id_genre'=>1
        ]);

        DB::table('genre_movie')->insert([
            'id_movie'=>2,
            'id_genre'=>1
        ]);

        DB::table('genre_movie')->insert([
            'id_movie'=>3,
            'id_genre'=>5
        ]);

        DB::table('genre_movie')->insert([
            'id_movie'=>4,
            'id_genre'=>4
        ]);

        DB::table('genre_movie')->insert([
            'id_movie'=>4,
            'id_genre'=>1
        ]);
    }
}
