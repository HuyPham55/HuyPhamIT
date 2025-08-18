<script lang="ts" setup>
import {ref} from "vue";
import {useRoute} from "vue-router";
import axios from "axios";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import PostDetailWrapper from "@/pages/post-detail/components/PostDetailWrapper.vue";

// initialize components based on data attribute selectors
// onMounted(() => {
//   initFlowbite();
// })

const route = useRoute();

const post = ref<PostDetailType>();

const loading = ref(false);
const fetch = async function () {
  loading.value = true;
  const {data: responseData} = await axios.get("/posts/" + route.params.hash)
  post.value = responseData.data
  loading.value = false;
}

fetch()
</script>

<template>
  <PostDetailWrapper :loading="loading" :post="post"/>
</template>

