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
        $names = ['Pete Docter','Lee Unkrich','Robert Zemeckis','Joseph Gordon-Levitt','Ben Kingsley','Charlotte Le Bon','Todd Phillips','Joaquin Phoenix','Robert De Niro','Zazie Beetz','Denis Villeneuve','Harrison Ford',' Ana de Armas','David Kerr','Rowan Atkinson','Olga Kurylenko','Emma Thompson','Frances Conroy', 'Ryan Gosling'];
        for($i=0;$i<count($names);$i++){
            if($i<=12 || $i==14){
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
