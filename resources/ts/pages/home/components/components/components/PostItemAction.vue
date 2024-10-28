<script setup lang="ts">

import AngleDownIcon from "@/icons/AngleDownIcon.vue";
import DownloadIcon from "@/icons/DownloadIcon.vue";
import SaveIcon from "@/icons/SaveIcon.vue";
import {PostItem} from "@/pages/post-index/PostIndex";
import {computed, onMounted} from "vue";
import {Dropdown} from "flowbite";

interface Props {
  post: PostItem;
}

const props = defineProps<Props>()

const buttonID = computed<string>(() => 'button' + props.post.hash)

const menuID = computed(() => 'menu' + props.post.hash)

onMounted(() => {
  // set the dropdown menu element
  const $targetEl = document.getElementById(menuID.value);

  // set the element that trigger the dropdown menu on click
  const $triggerEl = document.getElementById(buttonID.value);

  new Dropdown($targetEl, $triggerEl);
})
</script>

<template>
  <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
    <button
      class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto"
      :data-dropdown-toggle="menuID"
      :id="buttonID"
      type="button">
      More
      <AngleDownIcon class="-me-0.5 ms-1.5 h-4 w-4"/>
    </button>
    <div :id="menuID" class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
      <ul :aria-labelledby="buttonID" class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
        <li>
          <a
            class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
            href="#">
            <DownloadIcon
              class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"/>
            <span>Add to bookmark</span>
          </a>
        </li>
        <li>
          <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" href="#">
            <SaveIcon
              class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"/>
            <span>Add to reading list</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>

</style>
