import React from 'react';

function Text(props) {

    if (!props.mail && !props.telegram && !props.vk && !props.whatsapp) {
        return null;
    }

    let buttons = [];
    if (props.vk) {
        buttons.push(
            <a href={"https://vk.com/id" + props.vk}
               rel="noreferrer noopener"
               style={{padding: 0}}
               className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base"
               target="_blank">VK</a>
        );
    }
    if(props.vk) {
        buttons.push(
            <a
                href={"https://t.me/" + props.telegram}
                rel="noreferrer noopener"
                style={{padding: 0}}
                className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base"
                target="_blank">Telegram</a>
        );
    }
    if (props.whatsapp) {
        buttons.push(
            <a
                href={"https://api.whatsapp.com/send/?phone=" + props.whatsapp + "&amp;text&amp;app_absent=0"}
                rel="noreferrer noopener"
                style={{padding: 0}}
                className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base "
                target="_blank">WhatsApp</a>
        );
    }
    if (props.mail) {
        buttons.push(<a
            href={"mailto:" + props.mail + "?subject=%D0%92%D0%B0%D1%88%20%D0%B0%D0%B2%D1%82%D0%BE%20%D0%BC%D0%BD%D0%B5%20%D0%BC%D0%B5%D1%88%D0%B0%D0%B5%D1%82"}
            rel="noreferrer noopener"
            style={{padding: 0}}
            className="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base">электронную
            почту</a>
        );
    }


    return (
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
                    Используя&nbsp;
                    {
                        buttons
                            .map(item => <span>{item}</span>)
                            .reduce((acc, x) => acc === null ? [x] : [acc, ' , ', x], null)
                    }.

                </p>
            </div>
        </div>
    )
}

export default Text;