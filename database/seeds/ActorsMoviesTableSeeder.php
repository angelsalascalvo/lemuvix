<?php

use Illuminate\Database\Seeder;

class ActorsMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('director_movie')->insert([
            'id_movie'=>1,
            'id_director'=>3
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>2,
            'id_director'=>3
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>2,
            'id_director'=>1
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>3,
            'id_director'=>1
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>4,
            'id_director'=>4
        ]);
    }
}
