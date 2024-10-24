import {defineStore} from 'pinia'
import axios from "axios";

declare type LayoutData = {
    app_name: string;
    logo: string;
}

export const useLayoutStore = defineStore('layoutStore', {
    state: (): {
        data: LayoutData
    } => {
        return {
            data: {
                app_name: '',
                logo: '',
            }
        }
    },
    actions: {
        async fetch() {
            axios.get("/layout").then((response) => {
                let data = response.data.data;
                Object.keys(data).forEach(key => {
                    this.data[key as keyof LayoutData] = data[key];
                })
            })
        }
    },
})
