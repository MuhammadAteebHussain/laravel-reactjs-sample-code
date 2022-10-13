import React, { useContext, useEffect } from 'react'
import { useParams } from 'react-router';
import AuthContext from '../../context/user/AuthContext';
import Comments from './Comments';
import PostComments from './PostComments';

export default function Filmdetails() {

    const film = useContext(AuthContext)
    const { slug } = useParams();

    useEffect(() => {
        console.log(slug);
        film.getFilmBySlug(slug);

    }, [])



    return (
        <>
            <section style={{ backgroundColor: "#eee" }}>
                <div className="container my-5 py-5">
                    <div className="row d-flex justify-content-center">
                        <div className="col-md-12 col-lg-10 col-xl-8">
                            <h1>{film.filmDetailState.film_name}</h1>
                            <div className="card">
                                <div className="card-body">


                                    <p className="mt-3 mb-4 pb-2">
                                        <img alt='test' src={film.filmDetailState.photo} style={{ width: '100%' }}></img>
                                    </p>

                                    <div className="small d-flex justify-content-start">
                                        <table className="table align-middle mb-0 bg-white">
                                            <thead className="bg-light">
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                    <th>Country</th>
                                                    <th>Genres</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div className="d-flex align-items-center">

                                                            <div className="ms-3">
                                                                <p className="fw-normal mb-1">{film.filmDetailState.description}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p className="fw-normal mb-1">{film.filmDetailState.ticket_price}</p>
                                                    </td>
                                                    <td>
                                                        <p className="fw-normal mb-1">{film.filmDetailState.country}</p>
                                                    </td>

                                                    <td>
                                                        {film.filmGenreState.map((e) => {
                                                            return e.genre ? e.genre + ' ' : 'not found';
                                                        })}
                                                    </td>

                                                    <td>
                                                        <button type="button" className="btn btn-link btn-sm btn-rounded">
                                                            Edit
                                                        </button>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div className="card-footer py-3 border-0" style={{ backgroundColor: "#f8f9fa" }}>
                                    <PostComments film_id={film.filmDetailState.film_id} film_slug={film.filmDetailState.film_slug} />
                                </div>

                                {film.commentState.map((c) => {
                                    return <Comments comment={c.comment} name={c.user_name} />

                                })}


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}
