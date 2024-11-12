<script lang="ts" setup>

import AngleDownIcon from "@/icons/AngleDownIcon.vue";
</script>

<template>
  <button id="user-menu-button"
          aria-expanded="false"
          class="flex text-sm md:me-0 items-center text-gray-700 dark:text-white gap-1.5 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" data-dropdown-placement="bottom" data-dropdown-toggle="user-dropdown"
          type="button">
    <span class="sr-only">Open user menu</span>
    <img alt="" class="w-6 h-6 rounded-full" src="/images/profile-picture.jpg">
    <span class="font-semibold hidden lg:inline overflow-hidden overflow-ellipsis max-w-[100px]">huyducphamofficial@gmail.com</span>
    <AngleDownIcon class="w-4 h-4 hidden sm:inline-block"/>
  </button>

  <div
      id="user-dropdown"
      class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
    <div class="px-4 py-3">
      <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
      <span class="block text-sm text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
    </div>
    <ul aria-labelledby="user-menu-button" class="py-2">
      <li>
        <router-link :to="{name: 'login'}"
                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
          Dashboard
        </router-link>
      </li>
      <li>
        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
           href="#">Settings</a>
      </li>
      <li>
        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
           href="#">Earnings</a>
      </li>
      <li>
        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
           href="#">Sign
          out</a>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>
