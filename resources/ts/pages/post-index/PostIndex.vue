<script lang="ts" setup>

import NewsItem from "@/pages/home/components/components/NewsItem.vue";
import Pagination from "@/pages/home/components/components/Pagination.vue";
import {computed, reactive, ref, watch} from "vue";
import axios from "axios";
import {PostList} from "@/pages/post-index/PostIndex";
import PostListLoading from "@/pages/post-index/components/PostListLoading.vue";
import PostListEmpty from "@/pages/post-index/components/PostListEmpty.vue";
import SearchForm from "@/pages/post-index/components/SearchForm.vue";
import DisplayMode from "@/pages/post-index/components/DisplayMode.vue";
import Sorting from "@/pages/post-index/components/Sorting.vue";


const posts = reactive<PostList>({
  data: [],
  loading: false,
  orderBy: '',
  order: '',
})

const loading = computed<boolean>(() => !!posts.loading)

const isEmpty = computed<boolean>(() => !posts.data.length)

const detailedMode = ref<boolean>(true)

const changeDisplayMode = (value: boolean) => {
  detailedMode.value = value;
}

const fetch = async function () {
  posts.loading = true;
  let response = await axios.get('/posts', {
    params: {
      orderBy: posts.orderBy,
      order: posts.order,
    }
  });
  posts.loading = false;
  let {data, meta} = response.data;
  posts.data = data
  posts.meta = meta
}

const updateSorting = function (payload) {
  const {orderBy, order} = payload;
  posts.orderBy = orderBy;
  posts.order = order;
}

watch(() => posts.orderBy + posts.order, fetch)

</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-8 antialiased md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
        <h2 class="shrink-0 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
          Posts
          <span v-if="posts.meta?.total">
            ({{ posts.meta?.total }})
          </span>
        </h2>
        <SearchForm v-if="false"/>
      </div>

      <div class="mt-4 flex justify-between gap-x-2 flex-wrap">
        <Sorting @updateSorting="updateSorting" :disabled="loading"/>
        <DisplayMode @change-display-mode="changeDisplayMode" :current-mode="detailedMode"/>
      </div>

      <hr class="mt-4">

      <div class="mt-6 flow-root sm:mt-8">
        <PostListLoading v-if="loading"/>
        <div class="divide-y divide-gray-200 dark:divide-gray-700" v-if="!loading && !isEmpty">
          <NewsItem v-for="(post, index) in posts.data" :key="post.hash as keyof PropertyKey" :post="post" :class="index===0 ?'':'py-4'" :detailedMode="detailedMode"/>
        </div>
        <PostListEmpty v-if="!loading && isEmpty"/>
      </div>

      <nav aria-label="Pagination" class="mt-6 flex items-center justify-center sm:mt-8">
        <Pagination :meta="posts.meta"/>
      </nav>
    </div>
  </section>
</template>

<style scoped>

</style>
