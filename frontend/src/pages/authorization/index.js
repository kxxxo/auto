import './css/style.css';
import {Link, NavLink} from "react-router-dom";
import {useEffect} from "react";
import axios from "axios";
import React, {useState} from 'react';

function Authorization() {
    const [vk_url, setVkUrl] = useState("#");
    const [telegram_url, setTgUrl] = useState("#");
    const [email_url, setEmailUrl] = useState("#");
    const [telephone_url, setTelephoneUrl] = useState("#");

    useEffect(() => {
        axios.get(process.env.REACT_APP_API_DOMAIN + "/api/get-authorization-url", {})
            .then(response => {
                if (response) {
                    setVkUrl(response.data.vk_url);
                    setTgUrl(response.data.telegram_url);
                    setEmailUrl(response.data.email_url);
                    setTelephoneUrl(response.data.telephone_url);
                } else {
                    throw new Error("Get Authorization Url Error: empty message")
                }
            })
            .catch(error => {
                throw new Error("Get Authorization Url Error:" + error);
            });

    });

    return (
        <section className="u-clearfix u-section-1" id="carousel_b64e">
            <div
                className="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-xl u-valign-middle-xs u-sheet-1">
                <img
                    src="images/poteryashka.jpg"
                    className="u-align-left u-image u-image-1" data-image-width="1280" data-image-height="853"
                    alt={"poteryashka"}/>
                <div className="u-align-center u-container-style u-group u-shape-rectangle u-white u-group-1">
                    <div className="u-container-layout u-container-layout-1">
                        <h2 className="u-text u-text-default u-text-palette-1-base u-text-1">Авторизация</h2>
                        <p className="u-text u-text-default u-text-2">Вы можете авторизоваться используя одну из
                            перечисленных социальных сетей:</p>
                        <div style={{paddingTop: "35px"}}>
                            <a href={vk_url}>
                                <span className="u-icon u-icon-circle u-text-palette-1-base u-icon-1">
                                    <svg
                                    className="u-svg-link" preserveAspectRatio="xMidYMin slice"
                                    viewBox="0 0 112.196 112.196"
                                ><use xmlnsXlink="http://www.w3.org/1999/xlink" xlinkHref="#svg-b8a8"/></svg>
                                    <svg
                                    className="u-svg-content" viewBox="0 0 112.196 112.196" x="0px" y="0px"
                                    id="svg-b8a8"
                                    style={{enableBackground: 'new 0 0 112.196 112.196'}}><g><g>
                                        <circle id="XMLID_11_" style={{fill: "currentColor"}} cx="56.098" cy="56.098"
                                                r="56.098"/>
                                        </g>
                                        <path style={{fillRule: "evenodd", clipRule: "evenodd", fill: "#FFFFFF"}}
                                          d="M53.979,80.702h4.403c0,0,1.33-0.146,2.009-0.878   c0.625-0.672,0.605-1.934,0.605-1.934s-0.086-5.908,2.656-6.778c2.703-0.857,6.174,5.71,9.853,8.235   c2.782,1.911,4.896,1.492,4.896,1.492l9.837-0.137c0,0,5.146-0.317,2.706-4.363c-0.2-0.331-1.421-2.993-7.314-8.463   c-6.168-5.725-5.342-4.799,2.088-14.702c4.525-6.031,6.334-9.713,5.769-11.29c-0.539-1.502-3.867-1.105-3.867-1.105l-11.076,0.069   c0,0-0.821-0.112-1.43,0.252c-0.595,0.357-0.978,1.189-0.978,1.189s-1.753,4.667-4.091,8.636c-4.932,8.375-6.904,8.817-7.71,8.297   c-1.875-1.212-1.407-4.869-1.407-7.467c0-8.116,1.231-11.5-2.397-12.376c-1.204-0.291-2.09-0.483-5.169-0.514   c-3.952-0.041-7.297,0.012-9.191,0.94c-1.26,0.617-2.232,1.992-1.64,2.071c0.732,0.098,2.39,0.447,3.269,1.644   c1.135,1.544,1.095,5.012,1.095,5.012s0.652,9.554-1.523,10.741c-1.493,0.814-3.541-0.848-7.938-8.446   c-2.253-3.892-3.954-8.194-3.954-8.194s-0.328-0.804-0.913-1.234c-0.71-0.521-1.702-0.687-1.702-0.687l-10.525,0.069   c0,0-1.58,0.044-2.16,0.731c-0.516,0.611-0.041,1.875-0.041,1.875s8.24,19.278,17.57,28.993   C44.264,81.287,53.979,80.702,53.979,80.702L53.979,80.702z"/>
                                    </g></svg></span>
                            </a>
                            <a href={email_url}>
                                <span className="u-icon u-icon-circle u-icon-2"><svg className="u-svg-link"
                                                                                     preserveAspectRatio="xMidYMin slice"
                                                                                     viewBox="0 0 128 128"><use
                                    xmlnsXlink="http://www.w3.org/1999/xlink" xlinkHref="#svg-24c3"/></svg><svg
                                    className="u-svg-content" viewBox="0 0 128 128" id="svg-24c3"><g id="Circle_Grid"><circle
                                    cx="64" cy="64" fill="#2cbfae" r="64"/>
                                    </g><g id="icon"><path d="m105 40.184v47.632a1.074 1.074 0 0 1 -.293.733c-.01 0-.01.01-.021.021a1.055 1.055 0 0 1 -.733.293h-79.906a1.05 1.05 0 0 1 -1.047-1.047v-47.632a1.05 1.05 0 0 1 1.047-1.047h79.906a1.043 1.043 0 0 1 1.047 1.047z"
                           fill="#eeefee"/><g fill="#dbd8dd"><path
                                    d="m104.738 39.483c-3.193 2.764-40.733 33.8-40.733 33.8s-37.55-31.039-40.733-33.8c3.266 2 34.9 24.873 40.733 28.893 5.863-4.051 37.467-26.894 40.733-28.893z"/><path
                                    d="m104.707 88.549c-.01 0-.01.01-.021.021l-29.228-27.041 2.219-2.219z"/><path
                                    d="m23.3 88.549c.01 0 .01.01.021.021l30.659-25.607-2.219-2.219z"/>
                                    </g>
                                    </g></svg></span>
                            </a>
                            <a href={telephone_url}>
                                <span className="u-icon u-icon-circle u-icon-3"><svg className="u-svg-link"
                                                                                     preserveAspectRatio="xMidYMin slice"
                                                                                     viewBox="0 0 512 512"><use
                                    xlinkHref="#svg-9c84"/></svg><svg
                                    className="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" id="svg-9c84"
                                    style={{enableBackground: 'new 0 0 512 512'}}><path style={{fill: '#4CAF50'}}
                                                                                        d="M256.064,0h-0.128l0,0C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104  l98.4-31.456C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z"/><path
                                    style={{fill: '#FAFAFA'}}
                                    d="M405.024,361.504c-6.176,17.44-30.688,31.904-50.24,36.128c-13.376,2.848-30.848,5.12-89.664-19.264  C189.888,347.2,141.44,270.752,137.664,265.792c-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624,26.176-62.304  c6.176-6.304,16.384-9.184,26.176-9.184c3.168,0,6.016,0.16,8.576,0.288c7.52,0.32,11.296,0.768,16.256,12.64  c6.176,14.88,21.216,51.616,23.008,55.392c1.824,3.776,3.648,8.896,1.088,13.856c-2.4,5.12-4.512,7.392-8.288,11.744  c-3.776,4.352-7.36,7.68-11.136,12.352c-3.456,4.064-7.36,8.416-3.008,15.936c4.352,7.36,19.392,31.904,41.536,51.616  c28.576,25.44,51.744,33.568,60.032,37.024c6.176,2.56,13.536,1.952,18.048-2.848c5.728-6.176,12.8-16.416,20-26.496  c5.12-7.232,11.584-8.128,18.368-5.568c6.912,2.4,43.488,20.48,51.008,24.224c7.52,3.776,12.48,5.568,14.304,8.736  C411.2,329.152,411.2,344.032,405.024,361.504z"/></svg></span>
                            </a>
                            <a href={telegram_url}>
                                <span className="u-icon u-icon-circle u-icon-4"><svg className="u-svg-link"
                                                                                     preserveAspectRatio="xMidYMin slice"
                                                                                     viewBox="0 0 24 24"><use
                                    xlinkHref="#svg-c2f9"/></svg><svg
                                    className="u-svg-content" viewBox="0 0 24 24" id="svg-c2f9"><circle cx="12" cy="12"
                                                                                                        fill="currentColor"
                                                                                                        r="12"/><path
                                    d="m5.491 11.74 11.57-4.461c.537-.194 1.006.131.832.943l.001-.001-1.97 9.281c-.146.658-.537.818-1.084.508l-3-2.211-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953z"
                                    fill="#fff"/></svg></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )
}

export default Authorization;