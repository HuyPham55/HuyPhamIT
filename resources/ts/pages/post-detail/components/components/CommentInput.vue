<script lang="ts" setup>

</script>

<template>
  <form class="mb-6">
    <div
        class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
      <label class="sr-only" for="comment">Your comment</label>
      <textarea id="comment"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                placeholder="Write a comment..."
                required rows="6"></textarea>
    </div>
    <button
        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
        type="submit">
      Post comment
    </button>
  </form>
</template>

<style scoped>

</style>