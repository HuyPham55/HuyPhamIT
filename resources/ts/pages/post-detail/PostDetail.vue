<script lang="ts" setup>
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import axios from "axios";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import PostDetailWrapper from "@/pages/post-detail/components/PostDetailWrapper.vue";

// initialize components based on data attribute selectors
// onMounted(() => {
//   initFlowbite();
// })

const route = useRoute();
const router = useRouter();
const post = ref<PostDetailType>();

const loading = ref(false);
const fetch = async function () {
  loading.value = true;
  try {
    const {data: responseData} = await axios.get("/posts/" + route.params.hash)
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
  <PostDetailWrapper :loading="loading" :post="post"/>
</template>

