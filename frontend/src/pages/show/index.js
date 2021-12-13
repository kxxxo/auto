import './css/style.css';
import React, { useState } from 'react';
import {useEffect} from "react";
import axios from "axios";
import { useParams } from "react-router";
import ProfileInfo from "./profile-info";
import {useHistory} from "react-router-dom";

function Show() {
    let { id } = useParams();
    const history = useHistory();

    const [loaded, setLoaded] = useState(null);
    const [data, setData] = useState({
        'vk': null,
        'telephone': null,
        'whatsapp': null,
        'telegram': null,
        'mail': null
    });

    useEffect(() => {
        axios.get(process.env.REACT_APP_API_DOMAIN + "/api/get-profile?id=" + id,{
        })
            .then(response => {
                if(response) {
                    if(response.data.vk === null
                        && response.data.telegram === null
                        && response.data.telephone === null
                        && response.data.whatsapp === null
                        && response.data.mail === null
                    ) {
                        window.location.href = process.env.REACT_APP_API_DOMAIN + '/password-confirm/?id=' + id;
                    } else {
                        setLoaded(true);
                        setData(data);
                    }
                } else {
                    window.location = '/';
                }
            })
            .catch(error => {
                console.log(error);
                window.location = '/';
            });

    });

    if(!loaded) {
        return null;
    }
    return (
        <section className="u-align-center u-clearfix u-section-1" id="carousel_17d0">
            <div className="u-clearfix u-sheet u-valign-middle-sm u-valign-middle-xl u-sheet-1" style={{minHeight: 'auto'}}>
                <h2 className="u-text u-text-default u-text-1" style={{fontWeight:400, letterSpacing: 'auto'}}>Мешает авто?</h2>
                <div className="u-list u-list-1">
                    <ProfileInfo
                        mail = {data.mail}
                        telephone = {data.telephone}
                        telegram = {data.telegram}
                        vk = {data.vk}
                        whatsapp = {data.whatsapp}
                    />
                </div>
            </div>
        </section>
    )
}

export default Show;