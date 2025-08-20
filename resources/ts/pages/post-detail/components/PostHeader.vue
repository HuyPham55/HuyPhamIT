<script setup lang="ts">

import PostSocial from "@/pages/post-detail/components/components/PostSocial.vue";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import {computed} from "vue";

interface Props {
  post: PostDetailType|undefined;
}

const props = defineProps<Props>()

const post = computed(() => props.post);

const author = computed(() => post.value?.author);

</script>

<template>
  <header class="mb-4 lg:mb-6 not-format">
    <div class="flex lg:items-center flex-col lg:flex-row justify-between">
      <div class="flex items-center mb-2 lg:mb-0">
        <div>
          <span>By &nbsp;</span>
          <a class="font-bold dark:text-white hover:underline" href="#">
            {{author?.name}}
          </a>
        </div>
        <div class="flex items-center" v-if="post?.publish_date">
          <span class="ml-2 w-3 h-3 bg-gray-400 border-2 border-white dark:border-gray-800 rounded-full inline-block shrink-0"></span>
          <span class="ml-2 text-balance">
            <time class="">
              {{post?.publish_date}}
            </time>
          </span>
        </div>
        <div class="flex items-center">
          <span
            class="ml-2 w-3 h-3 bg-gray-400 border-2 border-white dark:border-gray-800 rounded-full inline-block shrink-0"></span>
          <span class="ml-2 text-balance">
            12 min read
          </span>
        </div>
      </div>
      <PostSocial/>
    </div>
    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
      {{post?.title}}
    </h1>
  </header>
</template>

<style scoped>

</style>
