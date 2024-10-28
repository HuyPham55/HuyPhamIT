<script lang="ts" setup>
import {PaginationLinkArray, PaginationType} from "@/components/paginations/Pagination";
import PreviousIcon from "@/pages/home/components/components/components/PreviousIcon.vue";
import NextIcon from "@/pages/home/components/components/components/NextIcon.vue";

interface Props {
  meta: PaginationType|undefined;
  links?: PaginationLinkArray;
}

const props = defineProps<Props>()

const emits = defineEmits(['changePage'])

const changePage = function (url:string) {
  emits('changePage', url);
}
</script>

<template>
  <ul class="flex h-8 items-center -space-x-px text-sm">
    <li v-if="links?.prev">
      <a @click="" class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">
        <span class="sr-only">Previous</span>
        <PreviousIcon class="h-4 w-4 rtl:rotate-180"/>
      </a>
    </li>
    <li v-for="item in meta?.links">
      <a v-if="item.active" aria-current="page" class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
         href="#" v-html="item.label">
      </a>
      <a v-else class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#" v-html="item.label">
      </a>
    </li>
    <li v-if="links?.next">
      <a class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">
        <span class="sr-only">Next</span>
        <NextIcon class="h-4 w-4 rtl:rotate-180"/>
      </a>
    </li>
  </ul>
</template>

<style scoped>

</style>
