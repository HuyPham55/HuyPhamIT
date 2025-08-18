<script setup lang="ts">

import ArticleLoading from "@/pages/post-detail/components/ArticleLoading.vue";
import PostAside from "@/pages/post-detail/components/PostAside.vue";
import AsideLoading from "@/pages/post-detail/components/AsideLoading.vue";
import RelatedArticles from "@/pages/post-detail/components/RelatedArticles.vue";
import PostAuthor from "@/pages/post-detail/components/PostAuthor.vue";
import PostHeader from "@/pages/post-detail/components/PostHeader.vue";
import {defineAsyncComponent, ref} from "vue";
import {useRoute} from "vue-router";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import axios from "axios";

const CommentSection = defineAsyncComponent(() => {
  return import("@/pages/post-detail/components/CommentSection.vue")
})

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

// TODO: Refactor interface to be reusable with PostDetail
</script>

<template>
  <div>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
      <div
        class="flex justify-between p-4 mx-2 lg:mx-auto max-w-screen-xl lg:p-10 dark:bg-gray-800 rounded-lg lg:rounded gap-8 flex-col lg:flex-row">
        <article v-if="!loading"
                 class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert xl:max-w-4xl lg:order-1">
          <PostHeader :post="post"/>
          <div class="post-content" v-html="post?.content"></div>
          <PostAuthor :post="post"/>
          <CommentSection/>
        </article>
        <PostAside :post="post" v-if="!loading"/>

        <ArticleLoading v-if="loading"/>
        <AsideLoading v-if="loading"/>
      </div>
    </main>
    <RelatedArticles/>
  </div>
</template>

<style scoped>

</style>
