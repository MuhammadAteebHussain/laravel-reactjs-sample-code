import React from 'react'
import PostComments from './PostComments'

export default function Comments(props) {
    return (
        <>
            <div className="card-footer py-3 border-0" style={{ backgroundColor: "#f8f9fa" }}>
                <div className="d-flex mb-3">
                    <a href="">
                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/8.webp" className="border rounded-circle me-2"
                            alt="Avatar" style={{ height: "40px" }} />
                    </a>
                    <div>
                        <div className="bg-light rounded-3 px-3 py-1">
                            <a href="" className="text-dark mb-0">
                                <strong>{props.name}</strong>
                            </a>
                            <div className="text-muted d-block">
                                <small>{props.comment}</small>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </>

    )
}
