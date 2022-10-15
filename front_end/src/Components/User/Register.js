import React, { useContext, useState } from 'react'
import { useNavigate } from "react-router-dom";
import AuthContext from '../../context/user/AuthContext';
import axios from "axios"

export default function Register() {
    const user = useContext(AuthContext)
    const navigate = useNavigate();

    const [credentials, setCredentials] = useState({ name: "", email: "", password: "", confirm_password: "" })
    const chnageHandler = (e) => {

        e.preventDefault();
        setCredentials({ ...credentials, [e.target.name]: e.target.value })
    }

    const registerHandler = (e) => {

       
        e.preventDefault()
        const param = credentials
        axios({
            url:  process.env.REACT_APP_REGISTER_API,
            method: "post",
            params: {
                name: credentials.name,
                email: credentials.email,
                password: credentials.password,
                confirm_password: credentials.confirm_password
            },
            headers: {
                Authorization: '',
                "Accept": "application/json",
                "Content-Type": "application/x-www-form-urlencoded"
            },

        }).then(function (response) {
            console.log(response.data.body.token);
            user.setloginState(localStorage.setItem('token', response.data.body.token));
            localStorage.setItem('user_id', response.data.body.id)

            navigate('/films');

        }).catch(function (error) {
            console.log(error);
        });
    }





    return (
        <div className='container'>
            <form>
                <h1>Register User</h1>
                <div className="row mb-4">
                    <div className="col">
                        <div className="form-outline">
                            <input type="text" id="form6Example1" onChange={chnageHandler} className="form-control" name="name" />
                            <label className="form-label" htmlFor="name" >Name</label>
                        </div>
                    </div>
                    <div className="col">
                        <div className="form-outline">
                            <input type="email" id="form6Example1" onChange={chnageHandler} className="form-control" name="email" />
                            <label className="form-label" htmlFor="email" >Email</label>
                        </div>
                    </div>
                </div>

                <div className="row mb-4">
                    <div className="col">
                        <div className="form-outline">
                            <input type="password" id="password" onChange={chnageHandler} className="form-control" name="password" />
                            <label className="form-label" htmlFor="password">Password</label>
                        </div>
                    </div>
                    <div className="col">
                        <div className="form-outline">
                            <input type="password" id="confirm_password" onChange={chnageHandler} className="form-control" name="confirm_password" />
                            <label className="form-label" htmlFor="confirm_password">Confirm-Password</label>
                        </div>
                    </div>
                </div>

                <div className="form-check d-flex justify-content-center mb-4">
                    <input className="form-check-input me-2" type="checkbox" value="" id="form6Example8" checked />
                    <label className="form-check-label" htmlFor="form6Example8"> Create an account? </label>
                </div>

                <button type="submit" onClick={registerHandler} className="btn btn-primary btn-block mb-4">Register</button>
            </form>
        </div>

    )
}
