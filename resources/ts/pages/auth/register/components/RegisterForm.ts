"use strict";
import axios from "axios";

async function attemptRegister(values) {
    return await axios.post('/auth/register', values)
        .then(response => {
            return response.data;
        })
        .catch(error => {
            throw error.response.data;
        });
}

export {
    attemptRegister
}
