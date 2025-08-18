<script setup lang="ts">

import {ref} from "vue";
import {useRoute} from "vue-router";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import axios from "axios";
import PostDetailWrapper from "@/pages/post-detail/components/PostDetailWrapper.vue";

const route = useRoute();

const post = ref<PostDetailType>();

const loading = ref(false);
const fetch = async function () {
  loading.value = true;
  // get URL
  let fullPath = route.fullPath;
  const {data: responseData} = await axios.get(fullPath)
  post.value = responseData.data
  loading.value = false;
}

fetch()

</script>

<template>
  <PostDetailWrapper :post="post" :loading="loading"/>
</template>
