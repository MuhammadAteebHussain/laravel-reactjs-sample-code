import React from 'react'
import ReactStars from "react-rating-stars-component";
import { Link } from 'react-router-dom';

export default function FilmItem(props) {
    const firstExample = {
        size: 30,
        value: props.rating,
        edit: false
      };
    return (
        <div className="row gx-5">
            <div className="col-md-6 mb-4">
                <div className="bg-image hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
                    <img src={props.image} className="img-fluid" />
                    <a href="">
                        <div className="mask" style={{ backgroundColor: "rgba(251, 251, 251, 0.15)" }}></div>
                    </a>
                </div>
            </div>

            <div className="col-md-6 mb-4">
                <ReactStars {...firstExample} />
                <h4><strong>{props.title}</strong></h4>
                <p className="text-muted">{props.description}</p>
                <Link type="button" className="btn btn-primary" to={`${props.slug}`}>Read more</Link>
            </div>
        </div>

    )
}
