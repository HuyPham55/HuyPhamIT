<script lang="ts" setup>
import {onMounted, ref} from "vue";

const ready = ref(false);

const initialize = function () {
  //TODO: Fetch
  setTimeout(() => {
    ready.value = true;
  }, 1000)
}
onMounted(initialize)

const tooltipEl = ref<HTMLElement | null>(null);


defineExpose({
  tooltipEl,
});
</script>

<template>
  <div ref="tooltipEl" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600" data-popover
       role="tooltip">
    <div v-if="ready" class="p-3">
      <div class="flex items-center justify-between mb-2">
        <a href="#">
          <img alt="Jese Leos"
               class="w-10 h-10 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png">
        </a>
        <div>
          <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                  type="button">
            Follow
          </button>
        </div>
      </div>
      <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
        <a href="#">Jese Leos</a>
      </p>
      <p class="mb-3 text-sm font-normal">
        <a class="hover:underline" href="#">@jeseleos</a>
      </p>
      <p class="mb-4 text-sm">Open-source contributor. Building <a class="text-blue-600 dark:text-blue-500 hover:underline"
                                                                   href="#">flowbite.com</a>.
      </p>
      <ul class="flex text-sm">
        <li class="me-2">
          <a class="hover:underline" href="#">
            <span class="font-semibold text-gray-900 dark:text-white">799</span>
            <span>Following</span>
          </a>
        </li>
        <li>
          <a class="hover:underline" href="#">
            <span class="font-semibold text-gray-900 dark:text-white">3,758</span>
            <span>Followers</span>
          </a>
        </li>
      </ul>
    </div>


    <div v-else class="p-3 max-w-sm animate-pulse" role="status">
      <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
      <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
      <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[100px] mb-4"></div>
      <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-2"></div>
      <span class="sr-only">Loading...</span>
    </div>


    <div data-popper-arrow></div>
  </div>
</template>

<style scoped>

</style>