import React, { useContext, useEffect } from 'react'
import AuthContext from '../../context/user/AuthContext'
import FilmData from './FilmData'
import FilmItem from './FilmItem'

export default function Film() {
    return (
        <div className='container'>
            <FilmData />
        </div>

    )
}
