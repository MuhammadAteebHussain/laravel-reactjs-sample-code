<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'film_slug', 'description', 'release_date', 'ticket_price', 'country_id', 'photo', 'status'];

    public function FilmGenre()
    {
        return $this->hasMany(FilmGenre::class);
    }
    public function FilmRatings()
    {
        return $this->hasMany(FilmUserRating::class);
    }

    public function Genre()
    {
        return $this->belongsToMany(Genre::class, 'film_genres');
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Countries()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
