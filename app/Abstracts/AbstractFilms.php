<?php

namespace App\Abstracts;

use App\Models\Film;
use App\Models\Comment;

abstract class AbstractFilms
{

    public function getAll()
    {
        $data = Film::with(['Genre', 'FilmRatings','Comments'])->get();
        return $data;
    }
    

    public function getBySlug(string $slug)
    {
        $data = Film::whereFilmSlug($slug)->first();
        return $data;
    }

    public function getCommentsByFilmId(int $id)
    {
        $data = Comment::whereFilmId($id)->get();
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
        $data['film_id'] = $film->id;
        $data['film_name'] = $film->name;
        $data['film_slug'] = $film->film_slug;
        $data['description'] = $film->description;
        $data['rating'] = ceil($film->FilmRatings->avg('rating'));
        $data['ticket_price'] = $film->ticket_price;
        $data['country'] = $film->country;
        $data['film_genre'] = (object) $film->Genre;

        foreach($film->Comments as $i => $comment){
            $comment_data[$i]['comment'] = $comment->comment;
            $comment_data[$i]['user_name'] = $comment->User->name;
            $comment_data[$i]['user_id'] = $comment->User->id;            
        }
        $data['comments'] = $comment_data;
        $data['photo'] = $film->photo;
        return $data;
    }

    public function storeFilms(array $data)
    {
        $data = Film::Create($data);
        return $data;
    }
}
