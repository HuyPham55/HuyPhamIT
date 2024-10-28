<script setup lang="ts">

</script>

<template>
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
</template>

<style scoped>

</style>
