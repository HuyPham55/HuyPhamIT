<script lang="ts" setup>

import {useEventBusStore} from "@/stores/eventBus";

const eventBus = useEventBusStore();

const handlerClick = function () {
  toggleSearchForm()
}

const toggleSearchForm = function () {
  eventBus.emit('openSearchModal');
}



</script>

<template>

  <button
      class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 w-10 h-10 inline-flex items-center justify-center"
      type="button"
      @click="handlerClick"
  >
    <svg aria-hidden="true" class="w-5 h-5" fill="none" viewBox="0 0 20 20"
         xmlns="http://www.w3.org/2000/svg">
      <path d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" stroke="currentColor" stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"/>
    </svg>
  </button>
</template>

<style scoped>

</style>
