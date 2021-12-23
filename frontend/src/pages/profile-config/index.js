import './css/style.css';
import {useEffect, useState} from "react";
import axios from "axios";

function ProfileConfig() {
    const [loaded, setLoaded] = useState(null);
    const [vk, setVk] = useState(null);
    const [telephone, setTelephone] = useState(null);
    const [telegram, setTelegram] = useState(null);
    const [mail, setMail] = useState(null);
    const [whatsapp, setWhatsapp] = useState(null);

    const [urlArray, setUrlArray] = useState([]);


    useEffect(() => {
        if(!loaded) {
            axios.get(process.env.REACT_APP_API_DOMAIN + "/api/profile", {
                headers: {
                    "Authorization": localStorage.getItem('Authorization')
                }
            })
                .then(response => {
                    if (response) {
                        setLoaded(true);
                        setVk(response.data.vk);
                        setTelephone(response.data.telephone);
                        setTelegram(response.data.telegram);
                        setMail(response.data.mail);
                        setWhatsapp(response.data.whatsapp);

                        axios.get(process.env.REACT_APP_API_DOMAIN + "/api/get-authorization-url", {
                            headers: {
                                "Authorization": localStorage.getItem('Authorization')
                            }
                        })
                            .then(response => {
                                if (response) {
                                    setUrlArray({
                                        'vk': response.data.vk_url,
                                        'telegram': response.data.telegram_url,
                                        'mail': response.data.email_url,
                                        'telephone': response.data.telephone_url,
                                        'whatsapp': response.data.telephone_url,
                                    });
                                } else {
                                    throw new Error("Get Authorization Url Error: empty message")
                                }
                            })
                            .catch(error => {
                                throw new Error("Get Authorization Url Error:" + error);
                            });


                    } else {
                        throw new Error("Empty profile");
                    }
                })
                .catch(error => {
                    debugger;
                    console.log(error);
                    window.location = '/';
                });
        }
    });

    const toggle = function(module,value) {
        axios.post(process.env.REACT_APP_API_DOMAIN + "/api/toggle/" + module,{
            value: value
        },{
            headers: {
                "Authorization":  localStorage.getItem('Authorization')
            }
        })
            .then(response => {
                window.location.reload();
            })
            .catch(error => {
                throw new Error(error);
            });
    }

    const button = function (data, module) {
        let label = "Подключить";
        let style = {
            marginBottom: '30px',
            marginTop: '10px'
        };
        let onClick = function(){
            window.location.href = urlArray[module] + '?access_token=' + localStorage.getItem('Authorization');
        };
        if(data) {
            if(data.is_enable) {
                label = "Отключить";
                style =  {
                    backgroundColor: 'rgb(199 96 96)',
                    color: '#e6e6e6',
                    marginBottom: '30px',
                    marginTop: '10px'
                };
                onClick = function(){
                    toggle(module,false);
                };
            } else {
                onClick = function(){
                    toggle(module,true);
                };
            }
        }
        return <button onClick={onClick} className="u-btn u-button-style u-btn-1" style={style} >{label}</button>;
    }

    return (
        !loaded
            ? null
            :
        <section className="u-align-left u-clearfix u-section-1" id="sec-c88f">
            <div className="u-clearfix u-sheet u-valign-middle u-sheet-1">
                <div className="u-align-center u-container-style u-grey-5 u-group u-group-1" style={{
                    width: "747px",
                    maxWidth: '100%',
                    minHeight: "843px",
                    margin: "60px auto"
                }}>
                    <div className="u-container-layout u-valign-middle u-container-layout-1">
                        <h1 className="u-text u-text-default u-text-1">Настройка профиля</h1>
                        <p className="u-text u-text-2">Телефон</p>
                        {button(telephone,'telephone')}
                        <p className="u-text u-text-3">Почтовый ящик</p>
                        {button(mail,'mail')}
                        <p className="u-text u-text-4">Whatsapp</p>
                        {button(whatsapp,'whatsapp')}
                        <p className="u-text u-text-5">Telegram</p>
                        {button(telegram,'telegram')}
                        <p className="u-text u-text-6">Vkontakte</p>
                        {button(vk,'vk')}
                        <button onClick={function() { localStorage.removeItem('authorization'); window.location = '/'; }}
                           className="u-btn u-btn-round u-button-style u-hover-palette-2-base u-palette-3-base u-radius-1 u-btn-6">
                            Выйти
                        </button>
                    </div>
                </div>
            </div>
        </section>
    );
}

export default ProfileConfig;
