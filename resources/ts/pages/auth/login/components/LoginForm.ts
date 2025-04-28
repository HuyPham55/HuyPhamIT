import axios from "axios";

const attempt = async function (credentials) {
    await axios.post('/auth/login', credentials)
        .then(response => {
            authStore.fetchUser()
        })
        .catch(res => {
            if (res.status === 422) {
                throw res.response.data;
            } else {
                console.error(res);
            }
        });
}

export {
    attempt
}
