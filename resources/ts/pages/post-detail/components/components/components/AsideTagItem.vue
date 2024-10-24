<script setup lang="ts">
import {TagType} from "@/pages/post-detail/PostDetail";

interface Props {
  tag: TagType;
}

const props = defineProps<Props>()

</script>

<template>
  <a class="bg-primary-100 hover:bg-primary-200 transition text-primary-800 dark:bg-primary-200 dark:hover:bg-primary-100 dark:text-primary-800 px-2 py-0.5 rounded" href="#">
    {{tag.name}}
  </a>
</template>

<style scoped>

</style>
