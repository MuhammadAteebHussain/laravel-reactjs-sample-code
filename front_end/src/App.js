import React, { Component } from 'react'
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom'
import Film from './Components/Films/Film'


import Filmdetails from './Components/Films/Filmdetails'
import FilmRegisterForm from './Components/Films/FilmRegisterForm'
import Listfilms from './Components/Films/Listfilms'
import Navbar from './Components/Navbar'
import Login from './Components/User/Login'
import Register from './Components/User/Register'
import FilmState from './context/film/FilmState'
import AuthState from './context/user/AuthState'


export default class App extends Component {
  render() {
    return (
      <>

        <FilmState>
          <Router>
            <Navbar title="Film" />

            <Routes>
              <Route exact path='/' element={<Film />} />
              <Route exact path='/login' element={<Login />} />
              <Route exact path='/register' element={<Register />} />


              <Route exact path='/films' element={<Film />} />

              <Route exact path='/films/:slug' element={<Filmdetails />} />
              <Route exact path='/films/create' element={<FilmRegisterForm />} />
            </Routes>
          </Router>
        </FilmState>


      </>
    )
  }
}
