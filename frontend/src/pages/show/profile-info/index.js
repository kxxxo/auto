import React from 'react';

function ProfileInfo(props) {
    // implode
    return (
        <div className="u-list u-list-1">
            <div className="u-repeater u-repeater-1">
                <div className="u-align-left u-container-style u-list-item u-repeater-item">
                    <div
                        className="u-container-layout u-similar-container u-valign-bottom-sm u-valign-middle-lg u-valign-top-xl u-valign-top-xs u-container-layout-1"
                        style={{padding: '10px 30px'}}
                    >
                        <h5 className="u-text u-text-default u-text-2"
                        style={{
                            fontWeight: '700',
                            margin: '0 auto 0 94px',
                        }}
                        >Напишите мне</h5>
                        <span
                            style={{
                                margin: '-4px auto 0 0',
                            }}
                            className="u-icon u-icon-circle u-icon-1">
                            <svg className="u-svg-link"
                                 preserveAspectRatio="xMidYMin slice"
                                 viewBox="0 0 58 58">
                                <use xmlnsXlink="http://www.w3.org/1999/xlink" xlinkHref="#svg-b0d2"/>
                            </svg>
                            <svg
                                className="u-svg-content" viewBox="0 0 58 58" x="0px" y="0px" id="svg-b0d2"
                                style={{enableBackground: 'new 0 0 58 58'}}>
                                <path style={{fill: '#424A60'}}
                                      d="M32.595,58H7.405C5.525,58,4,56.475,4,54.595V3.405C4,1.525,5.525,0,7.405,0h25.189  C34.475,0,36,1.525,36,3.405v51.189C36,56.475,34.475,58,32.595,58z"/><rect
                                x="4" y="6" style={{fill: '#E7ECED'}} width="32" height="40"/>
                                <circle
                                    style={{fill: '#262B35'}} cx="20" cy="52" r="3"/>
                                <path style={{fill: '#262B35'}}
                                      d="M20,4h-4c-0.553,0-1-0.447-1-1s0.447-1,1-1h4c0.553,0,1,0.447,1,1S20.553,4,20,4z"/>
                                <path
                                    style={{fill: '#262B35'}}
                                    d="M24,4h-1c-0.553,0-1-0.447-1-1s0.447-1,1-1h1c0.553,0,1,0.447,1,1S24.553,4,24,4z"/>
                                <polygon
                                    style={{fill: '#25AE88'}}
                                    points="54,12 18,12 18,31 22,31 22,37 30,31 54,31 "/>
                                <g>
                                    <path
                                        style={{fill: '#57D8AB'}}
                                        d="M24,20h10c0.552,0,1-0.447,1-1s-0.448-1-1-1H24c-0.552,0-1,0.447-1,1S23.448,20,24,20z"/>
                                    <path
                                        style={{fill: '#57D8AB'}}
                                        d="M48,23H24c-0.552,0-1,0.447-1,1s0.448,1,1,1h24c0.552,0,1-0.447,1-1S48.552,23,48,23z"/>
                                </g>
                            </svg>
                        </span>
                        <p className="u-text u-text-3"
                            style={{
                                margin: '-36px 0 0 94px',
                                fontSize: '1rem'
                            }}>
                            Используя <a href={props.vk}
                                rel="noreferrer noopener"
                                style={{padding: 0}}
                                className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base"
                                target="_blank">VK</a>, <a
                                href={"https://t.me/"+props.vk}
                                rel="noreferrer noopener"
                                style={{padding: 0}}
                                className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base"
                                target="_blank">Telegram</a>, <a
                                href={"https://api.whatsapp.com/send/?phone=" + props.whatsapp +"&amp;text&amp;app_absent=0"}
                                rel="noreferrer noopener"
                                style={{padding: 0}}
                                className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base "
                                target="_blank">WhatsApp</a> или <a
                                href={"mailto:" + props.mail +"?subject=%D0%92%D0%B0%D1%88%20%D0%B0%D0%B2%D1%82%D0%BE%20%D0%BC%D0%BD%D0%B5%20%D0%BC%D0%B5%D1%88%D0%B0%D0%B5%D1%82"}
                                rel="noreferrer noopener"
                                style={{padding: 0}}
                                className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base">электронную
                                почту</a>
                        </p>
                    </div>
                </div>
                <div className="u-align-left u-container-style u-list-item u-repeater-item">
                    <div
                        className="u-container-layout u-similar-container u-valign-middle u-container-layout-2">
                        <h5 className="u-text u-text-default u-text-4"
                            style={{
                                fontWeight: 700,
                                margin: '0 auto 0 94px'
                            }}
                        >Или позвоните мне</h5>
                        <span
                            className="u-icon u-icon-circle u-icon-2"
                            style={{margin: '-4px auto 0 0'}}
                        >
                            <svg className="u-svg-link"
                                 preserveAspectRatio="xMidYMin slice"
                                 viewBox="0 0 58 58">
                                <use xmlnsXlink="http://www.w3.org/1999/xlink" xlinkHref="#svg-aaea"/>
                            </svg>
                            <svg
                                className="u-svg-content" viewBox="0 0 58 58" x="0px" y="0px" id="svg-aaea"
                                style={{enableBackground: 'new 0 0 58 58'}}>
                                <rect x="25.677" y="47" style={{fill: '#C8D2D6'}}
                                      width="24" height="11"/>
                                <path
                                    style={{fill: '#E7ECED'}}
                                    d="M41.677,58h-16V47h9.426c3.631,0,6.574,2.943,6.574,6.574V58z"/>
                                <circle
                                    style={{fill: '#7383BF'}} cx="35.177" cy="52.5" r="2.5"/>
                                <path style={{fill: '#FBCE9D'}}
                                      d="M33.581,10.702c1.233-0.542,2.096-1.77,2.096-3.202c0-1.933-1.567-3.5-3.5-3.5
c-1.433,0-2.661,0.863-3.202,2.096L33.581,10.702z"/>
                                <path style={{fill: '#FBCE9D'}} d="M38.581,15.702c1.233-0.542,2.096-1.77,2.096-3.202c0-1.933-1.567-3.5-3.5-3.5
c-1.433,0-2.661,0.863-3.202,2.096L38.581,15.702z"/>
                                <path style={{fill: '#FBCE9D'}} d="M43.581,20.702c1.233-0.542,2.096-1.77,2.096-3.202c0-1.933-1.567-3.5-3.5-3.5
c-1.433,0-2.661,0.863-3.202,2.096L43.581,20.702z"/>
                                <path style={{fill: '#FBCE9D'}} d="M48.581,25.702c1.233-0.542,2.096-1.77,2.096-3.202c0-1.933-1.567-3.5-3.5-3.5
c-1.433,0-2.661,0.863-3.202,2.096L48.581,25.702z"/>
                                <path style={{fill: '#FBCE9D'}} d="M28.177,33h-10c-1.925,0-3.5-1.575-3.5-3.5v0c0-1.925,1.575-3.5,3.5-3.5h10
c1.925,0,3.5,1.575,3.5,3.5v0C31.677,31.425,30.102,33,28.177,33z"/>
                                <g>
                                    <path style={{fill: '#F7B563'}} d="M48.813,31.563l-11.12,11.12c-0.896,0.896-2.349,0.896-3.244,0L24.767,33h-6.589
c-0.578,0.283-2.155-0.738-1.55-0.219l10.812,10.77c0.074,0.074,0.16,0.127,0.238,0.194V47h20v-4.51c1.819-1.369,3-3.538,3-5.99
C50.677,34.607,49.97,32.883,48.813,31.563z"/>
                                </g>
                                <path style={{fill: '#424A60'}} d="M25.769,2.889L10.212,18.446l7.592,7.592C17.929,26.025,18.05,26,18.177,26h10
c1.925,0,3.5,1.575,3.5,3.5s-1.575,3.5-3.5,3.5h-3.411l6.355,6.355l15.556-15.557L25.769,2.889z"/>
                                <g>
                                    <path
                                        style={{fill: '#E7ECED'}} d="M25.769,2.889l-2.217-2.217c-0.896-0.896-2.349-0.896-3.244,0L7.995,12.984
c-0.896,0.896-0.896,2.349,0,3.245l2.217,2.217L25.769,2.889z"/>
                                    <path style={{fill: '#E7ECED'}} d="M50.005,27.126l-3.328-3.328L31.121,39.355l3.327,3.327c0.896,0.896,2.349,0.896,3.244,0
l12.312-12.312C50.901,29.475,50.901,28.022,50.005,27.126z"/>
                                </g>
                                <circle style={{fill: '#FFFFFF'}} cx="41.177" cy="33.5" r="2"/>
                                <path style={{fill: '#424A60'}} d="M15.677,11c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414l2-2
c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-2,2C16.189,10.902,15.933,11,15.677,11z"/>
                            </svg>
                        </span>
                        <p className="u-text u-text-5" style={{margin: '-36px 0 0 94px', fontSize: '16px'}}>Сразу на <a href={"tel:+" + props.telephone }
                               style={{padding: 0}}
                               className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base">мобильный
                                телефон</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default ProfileInfo;