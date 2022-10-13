import React, { useContext, useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import AuthContext from '../context/user/AuthContext'


export default function Navbar(props) {
    const user = useContext(AuthContext)
    // const [loginState, setLoginState] = useState(false);
    const LogoutHandler = () => {
        user.setloginState(false);
        localStorage.setItem('user_id','')
        localStorage.setItem('token','');
    }
    useEffect(() => {
        if(localStorage.getItem('user_id')) 
            user.setloginState(true);
    }, [])
    

    return (
        <nav className={`navbar navbar-expand-lg navbar-light bg-light`}>
            <div className="container-fluid">
                <Link className="navbar-brand" to='films'>{props.title}</Link>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                        <li className="nav-item">
                            <Link className="nav-link active" to='films/create'>Register New Film</Link>
                        </li>
                    </ul>
                </div>
                <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                    {!user.loginState ?
                        <>
                            <li className="nav-item">
                                <Link className="nav-link active" to='login'>Login</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to='register'>Register</Link>
                            </li>
                        </> :
                        <li className="nav-item">
                            <Link className="nav-link active" to='logout' onClick={LogoutHandler}>Logout</Link>
                        </li>
                    }



                </ul>
            </div>
        </nav >
    )
}
