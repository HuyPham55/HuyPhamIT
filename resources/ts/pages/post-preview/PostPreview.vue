<script setup lang="ts">

import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import axios from "axios";
import PostDetailWrapper from "@/pages/post-detail/components/PostDetailWrapper.vue";

const route = useRoute();
const router = useRouter();
const post = ref<PostDetailType>();
const loading = ref(false);
const fetch = async function () {
  loading.value = true;
  try {
    // get URL
    let fullPath = route.fullPath;
    const {data: responseData} = await axios.get(fullPath)
    post.value = responseData.data
  } catch (e) {
    if ((e as { status: number }).status === 404) {
      await router.push({name: "NotFound"})
      return
    }
    console.error(e)
  }
  loading.value = false;
}
fetch()

</script>

<template>
  <PostDetailWrapper :post="post" :loading="loading"/>
</template>
