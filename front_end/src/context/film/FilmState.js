import React, { useState } from 'react'
import AuthContext from '../user/AuthContext'
import axios from "axios"



const FilmState = (props) => {
    const films = {
        "header": {
            "code": "fm9002",
            "message": "Login Successfully",
            "success": true
        },
        "body": [
            {
                "film_name": "Pirates Of Silicon Valley",
                "film_slug": "pirates-of-silicon-valley",
                "description": "random description of table",
                "rating": 3.25,
                "ticket_price": "30",
                "country": "UK",
                "film_genre": [
                    {
                        "id": 1,
                        "film_id": 1,
                        "genre_id": 2,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    },
                    {
                        "id": 10,
                        "film_id": 1,
                        "genre_id": 3,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    }
                ],
                "photo": "photo_linlk"
            },
            {
                "film_name": "The Kinngdom",
                "film_slug": "the-kingdom",
                "description": "random description of table",
                "rating": 2.945945945945946,
                "ticket_price": "40",
                "country": "US",
                "film_genre": [
                    {
                        "id": 2,
                        "film_id": 2,
                        "genre_id": 1,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    },
                    {
                        "id": 4,
                        "film_id": 2,
                        "genre_id": 3,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    },
                    {
                        "id": 7,
                        "film_id": 2,
                        "genre_id": 3,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    },
                    {
                        "id": 8,
                        "film_id": 2,
                        "genre_id": 3,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    }
                ],
                "photo": "photo_linlk"
            },
            {
                "film_name": "The Pirsuit of Happiness",
                "film_slug": "the-pirsuit-of-happiness",
                "description": "random description of table",
                "rating": 2.870967741935484,
                "ticket_price": "50",
                "country": "Germany",
                "film_genre": [
                    {
                        "id": 3,
                        "film_id": 3,
                        "genre_id": 1,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    },
                    {
                        "id": 5,
                        "film_id": 3,
                        "genre_id": 3,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    },
                    {
                        "id": 6,
                        "film_id": 3,
                        "genre_id": 4,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    },
                    {
                        "id": 9,
                        "film_id": 3,
                        "genre_id": 4,
                        "created_at": "2022-10-01T12:01:39.000000Z",
                        "updated_at": "2022-10-01T12:01:39.000000Z"
                    }
                ],
                "photo": "photo_linlk"
            }
        ]
    }

    const filmsDetails = {
        "header": {
            "code": "fm9002",
            "message": "Fetch Successfully",
            "success": true
        },
        "body": {
            "film_name": "Pirates Of Silicon Valley",
            "film_slug": "pirates-of-silicon-valley",
            "description": "random description of table",
            "rating": 3,
            "ticket_price": "30",
            "country": "UK",
            "film_genre": [
                {
                    "id": 1,
                    "genre": "Action",
                    "status": 1,
                    "created_at": "2022-10-02T11:26:16.000000Z",
                    "updated_at": "2022-10-02T11:26:16.000000Z",
                    "pivot": {
                        "film_id": 1,
                        "genre_id": 1
                    }
                },
                {
                    "id": 1,
                    "genre": "Action",
                    "status": 1,
                    "created_at": "2022-10-02T11:26:16.000000Z",
                    "updated_at": "2022-10-02T11:26:16.000000Z",
                    "pivot": {
                        "film_id": 1,
                        "genre_id": 1
                    }
                },
                {
                    "id": 4,
                    "genre": "Arabic",
                    "status": 1,
                    "created_at": "2022-10-02T11:26:16.000000Z",
                    "updated_at": "2022-10-02T11:26:16.000000Z",
                    "pivot": {
                        "film_id": 1,
                        "genre_id": 4
                    }
                },
                {
                    "id": 3,
                    "genre": "Motivation",
                    "status": 1,
                    "created_at": "2022-10-02T11:26:16.000000Z",
                    "updated_at": "2022-10-02T11:26:16.000000Z",
                    "pivot": {
                        "film_id": 1,
                        "genre_id": 3
                    }
                },
                {
                    "id": 4,
                    "genre": "Arabic",
                    "status": 1,
                    "created_at": "2022-10-02T11:26:16.000000Z",
                    "updated_at": "2022-10-02T11:26:16.000000Z",
                    "pivot": {
                        "film_id": 1,
                        "genre_id": 4
                    }
                }
            ],
            "photo": "https://livijumpa2.files.wordpress.com/2013/12/impossible.jpg"
        }
    }

    const filmGenre = [
        {
            "id": 1,
            "genre": "Action",
            "status": 1,
            "created_at": "2022-10-02T11:26:16.000000Z",
            "updated_at": "2022-10-02T11:26:16.000000Z",
            "pivot": {
                "film_id": 1,
                "genre_id": 1
            }
        },
        {
            "id": 1,
            "genre": "Action",
            "status": 1,
            "created_at": "2022-10-02T11:26:16.000000Z",
            "updated_at": "2022-10-02T11:26:16.000000Z",
            "pivot": {
                "film_id": 1,
                "genre_id": 1
            }
        },
        {
            "id": 4,
            "genre": "Arabic",
            "status": 1,
            "created_at": "2022-10-02T11:26:16.000000Z",
            "updated_at": "2022-10-02T11:26:16.000000Z",
            "pivot": {
                "film_id": 1,
                "genre_id": 4
            }
        },
        {
            "id": 3,
            "genre": "Motivation",
            "status": 1,
            "created_at": "2022-10-02T11:26:16.000000Z",
            "updated_at": "2022-10-02T11:26:16.000000Z",
            "pivot": {
                "film_id": 1,
                "genre_id": 3
            }
        },
        {
            "id": 4,
            "genre": "Arabic",
            "status": 1,
            "created_at": "2022-10-02T11:26:16.000000Z",
            "updated_at": "2022-10-02T11:26:16.000000Z",
            "pivot": {
                "film_id": 1,
                "genre_id": 4
            }
        }
    ]

    const filmComments = [
        {
            "comment": "Quasi hic fuga pariatur et similique cumque. Asperiores soluta saepe ea. Velit ea maxime vitae aut quia omnis minima aliquid.",
            "user_name": "Mrs. Onie Cartwright DVMs",
            "user_id": 1
        },
        {
            "comment": "Deserunt et voluptatem exercitationem alias odio ut et. Laborum aperiam velit error quia ratione. At sunt optio eligendi quaerat voluptatem incidunt magnam. Omnis tenetur eum debitis aliquam qui.",
            "user_name": "Floyd Jacobson",
            "user_id": 29
        },
        {
            "comment": "Sequi temporibus officiis error dolorem hic dolor. Omnis at odio magni ullam. Sit qui reprehenderit repellendus. Nulla aut incidunt reprehenderit enim iusto amet labore.",
            "user_name": "Timothy Hirthe",
            "user_id": 88
        },
        {
            "comment": "Doloremque velit veniam in. Ut dolores vel sapiente nisi quam. Quidem iure mollitia reprehenderit et ut voluptate laboriosam. Voluptas dolor minima aut hic quisquam reiciendis.",
            "user_name": "Mr. Art O'Connell",
            "user_id": 32
        }
    ]

    const countryList = {
        "header": {
            "code": "fm9004",
            "message": "country fetched",
            "success": true
        },
        "body": [
            {
                "id": 1,
                "country": "Eritrea",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 2,
                "country": "Cameroon",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 3,
                "country": "Maldives",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 4,
                "country": "Luxembourg",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 5,
                "country": "Eritrea",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 6,
                "country": "Liberia",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 7,
                "country": "South Georgia and the South Sandwich Islands",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 8,
                "country": "Timor-Leste",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 9,
                "country": "Kuwait",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            },
            {
                "id": 10,
                "country": "Albania",
                "created_at": "2022-10-06T20:25:10.000000Z",
                "updated_at": "2022-10-06T20:25:10.000000Z"
            }
        ]
    }

    const genreList = {
        "header": {
          "code": "fm9004",
          "message": "genre fetched",
          "success": true
        },
        "body": [
          {
            "id": 1,
            "genre": "Action",
            "status": 1,
            "created_at": "2022-10-06T20:25:10.000000Z",
            "updated_at": "2022-10-06T20:25:10.000000Z"
          },
          {
            "id": 2,
            "genre": "Romantic",
            "status": 1,
            "created_at": "2022-10-06T20:25:10.000000Z",
            "updated_at": "2022-10-06T20:25:10.000000Z"
          },
          {
            "id": 3,
            "genre": "Motivation",
            "status": 1,
            "created_at": "2022-10-06T20:25:10.000000Z",
            "updated_at": "2022-10-06T20:25:10.000000Z"
          },
          {
            "id": 4,
            "genre": "Arabic",
            "status": 1,
            "created_at": "2022-10-06T20:25:10.000000Z",
            "updated_at": "2022-10-06T20:25:10.000000Z"
          }
        ]
      }





    const [filmsState, setfilmsState] = useState(films)
    const [loginState, setloginState] = useState(false);
    const [filmDetailState, setfilmDetailState] = useState(filmsDetails)
    const [filmGenreState, setfilmGenreState] = useState(filmGenre)
    const [commentState, setcommentsState] = useState(filmComments)
    const [countryState, setCountryState] = useState(countryList)
    const [genreListState, setGenreListState] = useState(genreList)




    const getAllFilms = async () => {
        let response = await axios.get(process.env.REACT_APP_FILM_LIST_API);
        setfilmsState(response.data);
    };



    const getFilmBySlug = async (slug) => {
    let url = process.env.REACT_APP_FILM_SLUG_API + slug;
        let response = await axios.get(url);
        setfilmDetailState(response.data.body)
        setfilmGenreState(response.data.body.film_genre)
        setcommentsState(response.data.body.comments)
    }





    return (
        <AuthContext.Provider value={{ filmsState, setfilmsState, loginState, setloginState, getAllFilms, filmDetailState, getFilmBySlug, filmGenreState, commentState,countryState,setCountryState,genreListState,setGenreListState }} >
            {props.children}
        </AuthContext.Provider>
    )
}

export default FilmState