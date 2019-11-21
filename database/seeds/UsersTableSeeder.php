<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'id'=>1,
            'name'=>'Juan Perez Lopez',
            'nick' =>'juanlo',
            'email' => 'juanlo@gmail.com',
            'password' => Hash::make('123'),
            'admin' => 0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('Users')->insert([
            'id'=>2,
            'name'=>'Antonio Fernandez Navarro',
            'nick' =>'antofer',
            'email' => 'antofer@gmail.com',
            'password' => Hash::make('123'),
            'admin' => 0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('Users')->insert([
            'id'=>3,
            'name'=>'Angel Salas Calvo',
            'nick' =>'angel',
            'email' => 'angelsalascalvo@gmail.com',
            'password' => Hash::make('123'),
            'admin' => 0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('Users')->insert([
            'id'=>4,
            'name'=>'Maria Nieto Sanchez',
            'nick' =>'maria85',
            'email' => 'maria85@gmail.com',
            'password' => Hash::make('123'),
            'admin' => 0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('Users')->insert([
            'id'=>5,
            'name'=>'Carla Garcia Gutierrez',
            'nick' =>'carlaga',
            'email' => 'carlaga@gmail.com',
            'password' => Hash::make('123'),
            'admin' => 0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('Users')->insert([
            'id'=>6,
            'name'=>'Joaquin Domene Encinas',
            'nick' =>'joaquindo',
            'email' => 'joaquindo@gmail.com',
            'password' => Hash::make('123'),
            'admin' => 0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('Users')->insert([
            'id'=>7,
            'name'=>'Beatriz Lopez Garcia',
            'nick' =>'bealopez',
            'email' => 'bealopez@gmail.com',
            'password' => Hash::make('123'),
            'admin' => 0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
    }
}
