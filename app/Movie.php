<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'sinopsis', 'duration', 'year', 'rating'
    ];
}