<?php

namespace App\Abstracts;

use App\Models\Film;
use App\Models\Comment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

abstract class AbstractFilms
{

    public function getAll()
    {
        $data = Film::with(['Genre', 'FilmRatings', 'Comments', 'Countries'])->get();
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
        try {
            $data = array();
            $comment_data = array();
            $data['film_id'] = $film->id;
            $data['film_name'] = $film->name;
            $data['film_slug'] = $film->film_slug;
            $data['description'] = $film->description;
            $data['rating'] = ceil($film->FilmRatings->avg('rating'));
            $data['ticket_price'] = $film->ticket_price;
            $data['country'] = $film->Countries->country;
            $data['film_genre'] = (object) $film->Genre;

            if ($film->Comments) {
                foreach ($film->Comments as $i => $comment) {
                    $comment_data[$i]['comment'] = $comment->comment;
                    $comment_data[$i]['user_name'] = $comment->User->name;
                    $comment_data[$i]['user_id'] = $comment->User->id;
                }
            }



            $data['comments'] = $comment_data;
            $data['photo'] = $this->getPhotoLink($film);

            return $data;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function storeFilms(array $data)
    {
        $data = Film::Create($data);
        return $data;
    }

    public function getPhotoLink($film)
    {
        if (Str::contains($film->photo, 'http')) {
            $link = $film->photo;
        } else {
            $link = App::make('url')->to('/') . env('DESTINATION_PATH_FOR_IMAGES') . $film->photo;
        }
        return $link;
    }
}
