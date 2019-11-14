<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'id'=>1,
            'description'=>'Aventura',
            'image'=>'image1.png',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('genres')->insert([
            'id'=>2,
            'description'=>'Terror',
            'image'=>'image2.png',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('genres')->insert([
            'id'=>3,
            'description'=>'Animacion',
            'image'=>'image3.png',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('genres')->insert([
            'id'=>4,
            'description'=>'Ciencia Ficción',
            'image'=>'image4.png',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('genres')->insert([
            'id'=>5,
            'description'=>'Documental',
            'image'=>'image5.png',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('genres')->insert([
            'id'=>6,
            'description'=>'Comedia',
            'image'=>'image6.png',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);


    }
}
