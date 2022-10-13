import React, { useContext, useEffect } from 'react'
import AuthContext from '../../context/user/AuthContext'
import FilmItem from './FilmItem';
import axios from "axios"



export default function FilmData() {
    const films = useContext(AuthContext)
    useEffect(() => {
        films.getAllFilms();
    }, [])


    return (
        <>
            {films.filmsState.body.map((myfilm) => {
                //  myfilm.film_name;
                return <FilmItem title={myfilm.film_name} description={myfilm.description} image={myfilm.photo} rating={myfilm.rating} slug={myfilm.film_slug} />

            })}
        </>
    )
}
