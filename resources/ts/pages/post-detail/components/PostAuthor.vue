<script setup lang="ts">
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import {computed} from "vue";

interface Props {
  post: PostDetailType | undefined;
}

const props = defineProps<Props>()
const post = computed(() => props.post);
const author = computed(() => post.value?.author);
</script>

<template>
  <section class="not-format">
    <address class="flex items-center mb-6 not-italic">
      <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
        <img :alt="author?.name"
             class="mr-4 w-16 h-16 rounded-full"
             :src="author?.profile_picture">
        <div>
          <a class="text-xl font-bold text-gray-900 dark:text-white" href="#" rel="author">
            {{author?.name}}
          </a>
          <p class="text-base text-gray-500 dark:text-gray-400">
            {{author?.description}}
          </p>
          <p class="text-base text-gray-500 dark:text-gray-400">
            <time :datetime="post?.publish_date" :title="post?.publish_date">
              {{ post?.publish_date }}
            </time>
          </p>
        </div>
      </div>
    </address>
  </section>
</template>

<style scoped>

</style>
