<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    
    protected $fillable = [
        'description'
    ];

    public function movies(){
        //Modelo para relacion | tabla intermedia | campo correspondiente a esta tabla | campo correspondiente con la tabla ajena
        return $this->belongsToMany('App\Movie', 'genre_movie', 'id_genre', 'id_movie'); 
    }

}
