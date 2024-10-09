<script lang="ts" setup>
// import {onMounted} from "vue";
// import {initFlowbite} from "flowbite";
//
//
// //initialize components based on data attribute selectors
// onMounted(() => {
//   initFlowbite();
// })
</script>

<template>
  <div class="relative hidden md:block">
    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
      <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400"
           fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" stroke="currentColor" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2"/>
      </svg>
      <span class="sr-only">Search icon</span>
    </div>
    <input id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           placeholder="Search..."
           type="text">
    <kbd
        class="absolute inset-y-0 end-0 flex items-center pe-3 px-2 py-1.5 text-xs font-semibold text-gray-800 dark:text-gray-400">
      /
    </kbd>
  </div>
</template>

<style scoped>

</style>