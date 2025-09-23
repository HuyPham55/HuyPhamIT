"use strict";
import {defineStore} from 'pinia'
import {computed, ref} from 'vue'
import axios from "axios";

export const useBookmarksStore = defineStore('bookmarks', () => {
    // map postHash -> boolean
    const map = ref(new Map<string, boolean>())

    function set(postHash: string, value: boolean) {
        map.value.set(postHash, value)
    }

    async function toggle(postHash: string) {
        await axios.post(`posts/${postHash}/bookmark`).then(res => {
            if (res.status === 200) {
                let {data} = res.data;
                let result = data.bookmark_status;
                set(postHash, result)
            }
        }).catch(err => {
            console.error(err);
        });
    }

    function isBookmarked(postHash: string) {
        /** @Usage:
         * const status = store.isBookmarked(props.postId)
         * */
        return computed(() => map.value.get(postHash) ?? false)
    }

    return {set, toggle, isBookmarked}
})