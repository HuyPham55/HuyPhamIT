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
        await axios.get('/user')
            .then(response => {
                setUser(response.data)
            })
            .catch(error => {
                console.error(error);
            });
    }

    return {
        user,
        isAuthenticated,
        fetchUser
    }
})
