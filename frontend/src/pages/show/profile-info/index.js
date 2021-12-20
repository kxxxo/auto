import React from 'react';
import Call from './call'
import Text from "./text";

function ProfileInfo(props) {
    console.log(1);
    // implode
    return (
        <div className="u-list u-list-1">
            <div className="u-repeater u-repeater-1">
                <Text
                    mail = {props.mail}
                    telegram = {props.telegram}
                    vk = {props.vk}
                    whatsapp = {props.whatsapp}
                />
                <Call
                    telephone = {props.telephone}
                />

            </div>
        </div>
    )
}

export default ProfileInfo;