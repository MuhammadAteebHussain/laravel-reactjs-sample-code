<?php

namespace App\Contracts;

use App\Models\Film;

abstract class AbstractFilms
{

    public function getAll()
    {
        $data = Film::with(['Genre', 'FilmRatings'])->get();
        return $data;
    }

    public function getBySlug(string $slug)
    {
        $data = Film::whereFilmSlug($slug)->first();
        return $data;
    }

    public function getAllById(int $id)
    {
        $data = Film::whereId($id)->first();
        return $data;
    }

    public function singlefilmResponseGenerator(object $film)
    {
        $data = array();
        $data['film_name'] = $film->name;
        $data['film_slug'] = $film->film_slug;
        $data['description'] = $film->description;
        $data['rating'] = ceil($film->FilmRatings->avg('rating'));
        $data['ticket_price'] = $film->ticket_price;
        $data['country'] = $film->country;
        $data['film_genre'] = $film->Genre;
        $data['photo'] = $film->photo;
        return $data;
    }

    public function storeFilms(array $data)
    {
        $data = Film::Create($data);
        return $data;
    }
}
