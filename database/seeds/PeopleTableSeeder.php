<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Joseph Gordon-Levitt','Ben Kingsley','Charlotte Le Bon','James Badge Dale','Michael Fassbender','Kate Winslet','Seth Rogen','Ryan Gosling'];
        for($i=0;$i<count($names);$i++){
            if($i<=3){
                DB::table('people')->insert([
                    'id'=>$i+1,
                    'name'=>$names[$i],
                    'photo'=> "photo".($i+1).".jpg",
                    'created_at' => date('Y-m-d H:m:s'),
                    'updated_at' => date('Y-m-d H:m:s')
                ]);    
            }else{
                DB::table('people')->insert([
                    'id'=>$i+1,
                    'name'=>$names[$i],
                    'created_at' => date('Y-m-d H:m:s'),
                    'updated_at' => date('Y-m-d H:m:s')
                ]);    
            }
        }
    }
}
