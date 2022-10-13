import React, { useContext, useState } from 'react'
import axios from "axios"
import { useNavigate, useParams } from 'react-router-dom';
import AuthContext from '../../context/user/AuthContext';

export default function PostComments(props) {
    const [commentState, setcommentState] = useState({ comment: "", user_id: "", film_id: "" })
    const navigate = useNavigate();
    const film = useContext(AuthContext)
    const { slug } = useParams();


    const onChangeHandler = (e) => {
        console.log(e.target.value);
        setcommentState({
            comment: e.target.value,
            user_id: localStorage.getItem('user_id'),
            film_id: props.film_id
        })
    }

    const storeComment = () => {

        axios({
            url: "http://127.0.0.1:9084/api/comment/store",
            method: "post",
            params: commentState,
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'),
                "Accept": "application/json",
                "Content-Type": "application/x-www-form-urlencoded"
            },

        }).then(function (response) {

            setcommentState({
                comment: "",
                user_id: "",
                film_id: ""
            })

            film.getFilmBySlug(slug);

        }).catch(function (error) {
            console.log(error);
        });
    }



    return (
        <div className="d-flex mb-3">
            <a href="">
                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/18.webp" className="border rounded-circle me-2"
                    alt="Avatar" style={{ height: "40px" }} />
            </a>
            {film.loginState ?  
            <div className="form-outline w-100">
                <textarea className="form-control" id="comment" rows="2" name='comment' onChange={onChangeHandler} value={commentState.comment}></textarea>
                <label className="form-label" htmlFor="comments">Write a comment</label>
                <button className='btn btn-sm btn-primary' onClick={storeComment}>Post</button>
            </div>
            : ''}
        </div>
    )
}
