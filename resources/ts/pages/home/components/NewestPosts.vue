<script lang="ts" setup>

import {computed, onMounted, reactive} from "vue";
import axios from "axios";
import NewsItem from "@/pages/home/components/components/NewsItem.vue";
import {PostList} from "@/pages/post-index/PostIndex";

const posts = reactive<PostList>({
  data: [],
  loading: true,
  orderBy: null,
})
const fetchRecentPosts = async function () {
  posts.loading = true;
  let response = await axios.get('/posts', {

  });
  posts.loading = false;
  let {data, meta} = response.data;
  posts.data = data
  posts.meta = meta
}

onMounted(() => {
  fetchRecentPosts()
})

const loading = computed(() => posts.loading)
</script>

<template>
  <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="mx-auto max-w-5xl">

        <div class="mx-auto max-w-screen-sm text-center mb-8">
          <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our
            Blog</h2>
          <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions
            and connect with the needs of your audience early and often.</p>
        </div>

        <div class="gap-4 sm:flex sm:items-center sm:justify-between">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My warranties</h2>
          <div class="mt-6 flex items-center space-x-4 sm:mt-0">
            <div>
              <label class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="warranty-status">Warranty
                status</label>
              <select id="warranty-status" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                <option value="pending" selected>
                  Recently opened
                </option>
                <option value="pending">Reading</option>
                <option value="active">Bookmarked</option>
              </select>
            </div>
          </div>
        </div>

        <div class="mt-6 flow-root sm:mt-8">
          <div class="divide-y divide-gray-200 dark:divide-gray-700">
            <NewsItem v-for="post in posts.data" :post="post"/>
          </div>
        </div>

        <nav aria-label="Page navigation example" class="mt-6 flex items-center justify-center sm:mt-8">
          <Pagination/>
        </nav>
      </div>
    </div>
  </section>
</template>

<style scoped>

</style>
