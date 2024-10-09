<script lang="ts" setup>

import {computed, onMounted} from "vue";

const mode = computed(() =>
    'dark'
)
const setTheme = function (newValue: string = '') {
  let value = newValue || mode.value;
  document.documentElement.setAttribute('class', value);
}

const handlerClick = function () {
  //TODO: Handle the mouse event separately
  if (document.documentElement.classList.contains("dark")) {
    setTheme('light')
    return;
  }
  setTheme()
}

onMounted(() => {
  setTheme()
})
</script>


<template>
  <button class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 w-10 h-10 inline-flex items-center justify-center" type="button"
          @click="handlerClick">
    <svg
        aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
      <path
          d="M10 15a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0-11a1 1 0 0 0 1-1V1a1 1 0 0 0-2 0v2a1 1 0 0 0 1 1Zm0 12a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1ZM4.343 5.757a1 1 0 0 0 1.414-1.414L4.343 2.929a1 1 0 0 0-1.414 1.414l1.414 1.414Zm11.314 8.486a1 1 0 0 0-1.414 1.414l1.414 1.414a1 1 0 0 0 1.414-1.414l-1.414-1.414ZM4 10a1 1 0 0 0-1-1H1a1 1 0 0 0 0 2h2a1 1 0 0 0 1-1Zm15-1h-2a1 1 0 1 0 0 2h2a1 1 0 0 0 0-2ZM4.343 14.243l-1.414 1.414a1 1 0 1 0 1.414 1.414l1.414-1.414a1 1 0 0 0-1.414-1.414ZM14.95 6.05a1 1 0 0 0 .707-.293l1.414-1.414a1 1 0 1 0-1.414-1.414l-1.414 1.414a1 1 0 0 0 .707 1.707Z">
      </path>
    </svg>
  </button>
</template>


<style scoped>

</style>