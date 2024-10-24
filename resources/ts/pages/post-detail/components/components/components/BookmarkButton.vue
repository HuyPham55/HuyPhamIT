<script setup lang="ts">

import BookmarkIcon from "@/icons/BookmarkIcon.vue";
import SimplePopover from "@/components/popover/SimplePopover.vue";
</script>

<template>
  <SimplePopover name="bookmark-post">
    <template #trigger="{target}">
      <button class="transition hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg inline-flex" :data-popover-target="target">
        <BookmarkIcon/>
      </button>
    </template>
    <template #body>
      <div class="px-3 py-2">
        <h3 class="font-semibold">
          Bookmark this post
        </h3>
      </div>
    </template>
  </SimplePopover>
</template>

<style scoped>

</style>
