import React, { useContext, useEffect, useState } from 'react'
import axios from "axios"
import AuthContext from '../../context/user/AuthContext'
import {  useNavigate } from "react-router-dom";




export default function Login() {
    const user = useContext(AuthContext)
    const navigate = useNavigate();

    useEffect(() => {
        if(localStorage.getItem('user_id')) 
         navigate('/');
    }, [])
    




    const [credentials, setCredentials] = useState({ email: "", password: "" })
    const chnageHandler = (e) => {

        e.preventDefault();
        setCredentials({ ...credentials, [e.target.name]: e.target.value })
    }

    const loginHandler = () => {
        
        const param = credentials
        console.log(param);

        axios({
            url: "http://127.0.0.1:9084/api/user/login",
            method: "post",
            params: {
                email: credentials.email,
                password: credentials.password
            },
            headers: {
              Authorization:'',
                "Accept": "application/json",
                "Content-Type": "application/x-www-form-urlencoded"
            },
        
        }).then(function (response) {
            console.log(response.data.body.token);
            localStorage.setItem('user_id',response.data.body.id)
            localStorage.setItem('token',response.data.body.token);
            user.setloginState(true);
            // user.setloginState(localStorage.setItem('token',response.data.body.token));
            navigate('/films');

        }).catch(function (error) {
            console.log(error);
        });
    }


    return (
        <div className='container mx-auto mt-5'>
            <form>
                {/* <!-- Email input --> */}
                <div className="form-outline mb-4">
                    <input type="email" id="form2Example1" name='email' onChange={chnageHandler} className="form-control" />
                    <label className="form-label" Htmlfor="form2Example1">Email address</label>
                </div>

                {/* <!-- Password input --> */}
                <div className="form-outline mb-4">
                    <input type="password" id="form2Example2" name='password' onChange={chnageHandler} className="form-control" />
                    <label className="form-label" Htmlfor="form2Example2">Password</label>
                </div>

                {/* <!-- 2 column grid layout for inline styling --> */}
                <div className="row mb-4">
                    <div className="col d-flex justify-content-center">
                        {/* <!-- Checkbox --> */}
                        <div className="form-check">
                            <input className="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label className="form-check-label" Htmlfor="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div className="col">
                        {/* <!-- Simple link --> */}
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                {/* <!-- Submit button --> */}
                <button type="button" className="btn btn-primary btn-block mb-4" onClick={loginHandler}>Sign in</button>

                {/* <!-- Register buttons --> */}
                <div className="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                    <p>or sign up with:</p>
                    <button type="button" className="btn btn-link btn-floating mx-1">
                        <i className="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" className="btn btn-link btn-floating mx-1">
                        <i className="fab fa-google"></i>
                    </button>

                    <button type="button" className="btn btn-link btn-floating mx-1">
                        <i className="fab fa-twitter"></i>
                    </button>

                    <button type="button" className="btn btn-link btn-floating mx-1">
                        <i className="fab fa-github"></i>
                    </button>
                </div>
            </form>
        </div>

    )
}
