"use strict";

async function attemptRegister(values) {
    await axios.post('/auth/register', values)
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
