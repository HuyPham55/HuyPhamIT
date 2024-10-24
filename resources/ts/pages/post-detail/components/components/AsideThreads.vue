<script setup lang="ts">

</script>

<template>
  <div class="mb-8">
    <div class="flex justify-between mb-2 pb-2 items-center border-b border-gray-900 dark:border-white">
      <div class="flex place-content-center">
        <a href="#">
          <h3 class="dark:text-white font-bold uppercase">
            Threads
          </h3>
        </a>
        <button type="button">
          <svg aria-hidden="true" class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" fill="currentColor"
               viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                  fill-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Show information</span>
        </button>
      </div>
      <button
        class="transition text-gray-500 dark:text-white dark:hover:text-primary-500 hover:text-primary-400 p-2 aspect-square rounded-full hover:rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex place-content">
        <i class="fa fa-plus"></i>
      </button>
    </div>
    <ul>
      <li class="pb-2 border-b border-gray-300 dark:border-gray-700 mb-2">
        <a href="#">
          <h4 class="dark:text-gray-400 mb-2 text-justify">
            Over the past year, Volosoft has undergone changes.
          </h4>
        </a>
        <div class="flex -space-x-4 rtl:space-x-reverse">
          <img alt=""
               class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
               src="https://flowbite.com/docs/images/people/profile-picture-5.jpg">
          <img alt=""
               class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
               src="https://flowbite.com/docs/images/people/profile-picture-2.jpg">
          <img alt=""
               class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
               src="https://flowbite.com/docs/images/people/profile-picture-3.jpg">
          <a class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800"
             href="#">+99</a>
        </div>
      </li>

      <li class="pb-2 border-b border-gray-300 dark:border-gray-700 mb-2">
        <a href="#">
          <h4 class="dark:text-gray-400 mb-2 text-justify">
            Over the past year, Volosoft has undergone changes.
          </h4>
        </a>
        <div class="flex -space-x-4 rtl:space-x-reverse">
          <img alt=""
               class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
               src="https://flowbite.com/docs/images/people/profile-picture-5.jpg">
          <img alt=""
               class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
               src="https://flowbite.com/docs/images/people/profile-picture-2.jpg">
        </div>
      </li>

      <li class="pb-4 border-b border-gray-900 dark:border-white">
        <a href="#">
          <h4 class="dark:text-gray-400 mb-2 text-justify">
            The article covers the essentials, challenges, myths and stages the UX designer should consider
            while
            creating the design strategy.
          </h4>
        </a>
        <div class="flex -space-x-4 rtl:space-x-reverse">
          <img alt=""
               class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
               src="https://flowbite.com/docs/images/people/profile-picture-5.jpg">
        </div>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>
