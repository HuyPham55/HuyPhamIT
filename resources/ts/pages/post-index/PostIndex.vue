<script lang="ts" setup>

import NewsItem from "@/pages/home/components/components/NewsItem.vue";
import Pagination from "@/pages/home/components/components/Pagination.vue";
import {computed, reactive} from "vue";
import axios from "axios";
import {PostList} from "@/pages/post-index/PostIndex";
import PostListLoading from "@/pages/post-index/components/PostListLoading.vue";
import PostListEmpty from "@/pages/post-index/components/PostListEmpty.vue";


const posts = reactive<PostList>({
  data: [],
  loading: false,
})

const loading = computed(() => posts.loading)

const isEmpty = computed<boolean>(() => !posts.data.length)

const fetch = async function () {
  posts.loading = true;
  let response = await axios.get('/posts');
  posts.loading = false;
  let {data} = response.data;
  posts.data = data
}
fetch();
</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-8 antialiased md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
        <h2 class="shrink-0 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Questions (147)</h2>
        <form class="mt-4 w-full gap-4 sm:flex sm:items-center sm:justify-end lg:mt-0">
          <label class="sr-only" for="simple-search">Search</label>
          <div class="relative w-full flex-1 lg:max-w-sm">
            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
              <svg aria-hidden="true" class="h-4 w-4 text-gray-500 dark:text-gray-400"
                   fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" stroke="currentColor"
                      stroke-linecap="round"
                      stroke-width="2"></path>
              </svg>
            </div>
            <input id="simple-search"
                   class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 ps-9 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                   placeholder="Search Questions &amp; Answers"
                   :required="true" type="text">
          </div>
          <button
            class="mt-4 w-full shrink-0 rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:mt-0 sm:w-auto"
            type="button">
            Ask a question
          </button>
        </form>
      </div>

      <div class="mt-4 flex justify-between gap-x-2 flex-wrap">
        <div class="flex">
          <div class="flex items-center mr-4">
            <input id="default-radio-1"
                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                   name="default-radio" type="radio"
                   value="">
            <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 text-nowrap" for="default-radio-1">Default
              radio</label>
          </div>
          <div class="flex items-center">
            <input id="default-radio-2" checked
                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                   name="default-radio" type="radio"
                   value="">
            <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 text-nowrap" for="default-radio-2">Checked
              state</label>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <a href="#">
            <i class="text-primary-500 text-xl fa-solid fa-list"></i>
          </a>
          <a href="#">
            <i class="text-gray-400 text-xl fa-solid fa-newspaper"></i>
          </a>
        </div>
      </div>

      <hr class="mt-4">

      <div class="mt-6 flow-root sm:mt-8">
        <PostListLoading v-if="loading"/>
        <div class="divide-y divide-gray-200 dark:divide-gray-700" v-if="!loading && !isEmpty">
          <NewsItem v-for="(post, index) in posts.data" :key="post.hash as keyof PropertyKey" :post="post" :class="index===0 ?'':'py-4'"/>
        </div>
        <PostListEmpty v-if="!loading && isEmpty"/>
      </div>

      <nav aria-label="Page navigation example" class="mt-6 flex items-center justify-center sm:mt-8">
        <Pagination/>
      </nav>
    </div>
  </section>
</template>

<style scoped>

</style>
