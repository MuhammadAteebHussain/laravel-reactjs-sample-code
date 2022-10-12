import React, { useState } from 'react'
import AuthContext from './AuthContext'


const AuthState = (props) => {
    const user = {
        'user': 'ateeb',
        'password': 'valid',
    }

    const [userState, setuserState] = useState(user)

    const update = () => {
        setTimeout(() => {
            setuserState({
                'user': 'hussain',
                'password': 'not valid',
            })
        }, 1000);
    }

    return (
        <AuthContext.Provider value={{ userState, update }} >
            {props.children}
        </AuthContext.Provider>
    )
}

export default AuthState