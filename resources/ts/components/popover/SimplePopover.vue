<script setup lang="ts">
interface Props {
  name: string;
}

const props = defineProps<Props>()
</script>

<template>
  <slot name="trigger" :target="name"/>
  <div :id="name"
       class="absolute z-10 invisible inline-block text-sm text-white transition-opacity duration-300 bg-gray-800 rounded-lg shadow opacity-0 dark:text-gray-200 dark:bg-gray-700"
       data-popover
       role="tooltip">
    <slot name="body"/>
    <div data-popper-arrow></div>
  </div>
</template>

<style scoped>

</style>
