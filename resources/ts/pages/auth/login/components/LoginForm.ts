"use strict";
import axios from "axios";
import {useAuthStore} from "@/stores/modules/auth";

const attempt = async function (credentials) {
    const authStore = useAuthStore();
    return await axios.post('/auth/login', credentials)
        .then(response => {
            return authStore.fetchUser()
        })
        .catch(res => {
            if (res.status === 422) {
                throw res.response.data;
            } else {
                console.log(res)
                throw res.response;
            }
        });
}

export {
    attempt
}
