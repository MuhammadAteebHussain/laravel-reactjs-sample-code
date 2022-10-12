<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmGenre extends Model
{
    use HasFactory;
    protected $fillable =['film_id','genre_id'];
    
    public function filmGenres()
    {
        return $this->belongsToMany(Film::class);
    }

    public function Genres()
    {
        return $this->belongsToMany(Genre::class);
    }



}
