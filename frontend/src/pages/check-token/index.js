
import { useParams } from "react-router";
import {useEffect} from "react";
import axios from "axios";
import { useHistory } from "react-router-dom";

function CheckToken() {
    let { token } = useParams();
    const history = useHistory();

    useEffect(() => {
        axios.get(process.env.REACT_APP_API_DOMAIN + "/api/profile",{
            headers: {
                "Authorization": "Bearer " + token
            }
        })
            .then(response => {
                if(response) {
                    localStorage.setItem("Authorization", "Bearer " + token);
                    history.push("/profile-config");
                } else {
                    localStorage.setItem("Authorization", "");
                    history.push("/authorization");
                }
            })
            .catch(error => {
                localStorage.setItem("Authorization", "");
                history.push("/authorization");
            });

    });

    return null;
}

export default CheckToken;