<script setup lang="ts">
import {CommentType} from "@/pages/post-detail/components/components/Comment";
import CommentDropdownButton from "@/pages/post-detail/components/components/components/CommentDropdownButton.vue";
import CommentDropdownMenu from "@/pages/post-detail/components/components/components/CommentDropdownMenu.vue";

interface Props {
  comment: CommentType,
}

const props = defineProps<Props>()

const {
  content,
  author,
  created_at,
  created_at_human,
  created_at_relative
} = props.comment;
</script>

<template>
  <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
    <footer class="flex justify-between items-center mb-2">
      <div class="flex items-center">
        <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900 dark:text-white"><img
          :alt="author.name"
          class="mr-2 w-6 h-6 rounded-full"
          :src="author.profile_picture">
          {{author.name}}
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          <time :datetime="created_at" pubdate :title="created_at_human">
            {{created_at_relative}}
          </time>
        </p>
      </div>
      <CommentDropdownButton/>
      <CommentDropdownMenu/>
    </footer>
    <p>{{content}}</p>
    <div class="flex items-center mt-4 space-x-4">
      <button class="flex items-center font-medium text-sm text-gray-500 hover:underline dark:text-gray-400"
              type="button">
        <svg aria-hidden="true" class="mr-1.5 w-3 h-3" fill="currentColor" viewBox="0 0 20 18"
             xmlns="http://www.w3.org/2000/svg">
          <path
            d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
        </svg>
        Reply
      </button>
    </div>
  </article>
</template>

<style scoped>

</style>
