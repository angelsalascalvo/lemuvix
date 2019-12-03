<?php

use Illuminate\Database\Seeder;

class DirectorsMoviesTableSeeder extends Seeder
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
            'id_director'=>1
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>1,
            'id_director'=>2
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>2,
            'id_director'=>3
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>3,
            'id_director'=>7
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>4,
            'id_director'=>11
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>5,
            'id_director'=>14
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>6,
            'id_director'=>1
        ]);

        //A continuacion los datos no son reales

        DB::table('director_movie')->insert([
            'id_movie'=>7,
            'id_director'=>7
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>7,
            'id_director'=>6
        ]);

        DB::table('director_movie')->insert([
            'id_movie'=>8,
            'id_director'=>11
        ]);

    }
}
