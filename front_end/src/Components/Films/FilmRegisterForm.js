import axios from 'axios'
import React, { useContext, useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom';
import AuthContext from '../../context/user/AuthContext';


export default function FilmRegisterForm() {
    const film = useContext(AuthContext)
    const navigate = useNavigate();

    useEffect(() => {

        axios({
            url: "http://127.0.0.1:9084/api/country/list",
            method: "GET",
            headers: {
                Authorization: '',
                "Accept": "application/json",
            },

        }).then(function (response) {
            film.setCountryState(response.data)

        }).catch(function (error) {
            console.log(error);
        });


        axios({
            url: "http://127.0.0.1:9084/api/genre/list",
            method: "GET",
            headers: {
                Authorization: '',
                "Accept": "application/json",
            },

        }).then(function (response) {
            film.setGenreListState(response.data)

        }).catch(function (error) {
            console.log(error);
        });


    }, [])

    const [params, setParamsState] = useState({
        name: '', photo: '', description: '', release_date: '', rating: '', country: '', genre_id: ''
    })
    const [photoState, setPhotoState] = useState({ photo: '' });
    const [countryValueState, setValueCountryState] = useState(false);
    const [genreValueState, setValueGenreState] = useState([]);
    const [checked, setChecked] = useState([]);


    const onChangeHandler = (e) => {
        setParamsState({ ...params, [e.target.name]: e.target.value })

    }

    const onChangeImageHandler = (e) => {
        setPhotoState({ photo: e.target.files[0] });
    }

    const onChangeCountryHandler = (e) => {
        setValueCountryState({ country_id: e.target.value })
    }
    const value = [];

    const onChangeGenreHandler = (e) => {

        let updatedList = [...genreValueState];
        if (e.target.checked) {
            updatedList = [...genreValueState, e.target.value];
        } else {
            updatedList.splice(checked.indexOf(e.target.value), 1);
        }
        setValueGenreState(updatedList);
    }


    const registerFilm = (e) => {
        e.preventDefault()
        let formData = new FormData();

        formData.append('name', params.name)
        formData.append('film_slug', params.film_slug)
        formData.append('release_date', params.release_date)
        formData.append('ticket_price', params.ticket_price)
        formData.append('country_id', countryValueState.country_id)
        formData.append('genre_ids', genreValueState)
        formData.append('description', params.description)
        formData.append('photo', photoState.photo)

        const param = params;
        console.log(param);
        axios({
            url: "http://127.0.0.1:9084/api/film/store",
            method: "POST",
            data: formData,
            headers: {
                Authorization: '',
                "Accept": "application/json",
                "Content-Type": "multipart/form-data"
            },

        }).then(function (response) {
            console.log(response.data);
            navigate('/films');

        }).catch(function (error) {
            console.log(error);
        });


    }
    return (
        <div className='container'>
            <form>
                <h1>Add New Film</h1>
                <div className="row mb-4">

                    <div className="col">

                        <div className="form-outline">
                            <input type="text" id="film_name" className="form-control" name='name' onChange={onChangeHandler} />
                            <label className="form-label" htmlFor="film_name">Name</label>
                        </div>

                        <div className="form-outline">
                            <input type="text" id="film_name" className="form-control" name='film_slug' onChange={onChangeHandler} />
                            <label className="form-label" htmlFor="film_slug">Film Slug</label>
                        </div>



                        <div className="form-outline">
                            <input className="form-control" type="file" id="photo" name='photo' onChange={onChangeImageHandler} />
                            <label className="form-label" htmlFor="photo">Cover Photo</label>
                        </div>

                    </div>
                    <div className="col">
                        <div className="form-outline">
                            <textarea className="form-control" id="description" rows="4" name='description' onChange={onChangeHandler}></textarea>
                            <label className="form-label" htmlFor="description">Description</label>
                        </div>
                    </div>
                </div>


                <div className="row mb-4">
                    <div className="col-md-5">
                        <div className="form-outline">
                            <input type="date" id="release_date" className="form-control" name='release_date' onChange={onChangeHandler} />
                            <label className="form-label" htmlFor="release_date">Release Date</label>
                        </div>
                    </div>
                   
                </div>

                <div className="row mb-4">
                    <div className="col-md-4">
                        <div className="form-outline">
                            <input type="text" id="form6Example4" className="form-control" name='ticket_price' onChange={onChangeHandler} />
                            <label className="form-label" htmlFor="ticker_price">Ticket Price</label>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="form-outline">
                            <select id="country" className="form-control" name='country' onChange={onChangeCountryHandler}>
                                <option value=''>Please Select Country</option>
                                {film.countryState.body.map((c) => {
                                    return <option value={c.id}>{c.country}</option>
                                })}

                            </select>
                            <label className="form-label" htmlFor="country">Country</label>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="form-outline">
                            {film.genreListState.body.map((g) => {
                          return   <div className="form-check">
                                    <input className="form-check-input" type="checkbox" value={g.id} onChange={onChangeGenreHandler} name="genre_check" />
                                    <label className="form-check-label" for="flexCheckDefault">
                                        {g.genre}
                                    </label>
                                </div>
                            })}

                            <label className="form-label" htmlFor="form6Example4">Film Genre</label>
                        </div>
                    </div>

                </div>



                <button type="button" className="btn btn-primary btn-block mb-4" onClick={registerFilm}>Register</button>
            </form>
        </div>
    )
}
