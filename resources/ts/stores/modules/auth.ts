"use strict";
import {defineStore} from 'pinia'
import {computed, ref} from "vue";
import axios from "axios";

export const useAuthStore = defineStore('authStore', () => {
    const user = ref()
    const isAuthenticated = computed(() => !!user.value)

    function setUser(newData) {
        user.value = newData
    }

    async function fetchUser() {
        return await axios.get('/user')
            .then(response => {
                let data = response.data;
                setUser(data)
                return data;
            })
            .catch(error => {
                console.error(error);
            });
    }

    async function logout() {
        return await axios.post('/auth/logout')
            .then(() => {
                setUser(null)
            })
            .catch(error => {
                console.error(error);
            });
    }

    return {
        user,
        isAuthenticated,
        fetchUser,
        setUser,
        logout,
    }
})
