<script setup lang="ts">

import LinkIcon from "@/icons/LinkIcon.vue";
import SimplePopover from "@/components/popover/SimplePopover.vue";
</script>

<template>
  <SimplePopover name="share-post-url">
    <template #trigger="{target}">
      <button class="transition hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg inline-flex" :data-popover-target="target">
        <LinkIcon class="w-5 h-5"/>
      </button>
    </template>
    <template #body>
      <div class="px-3 py-2">
        <h3 class="font-semibold">
          Copy post URL
        </h3>
      </div>
    </template>
  </SimplePopover>
</template>

<style scoped>

</style>
