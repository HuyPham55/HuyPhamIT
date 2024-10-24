<script setup lang="ts">

import SimplePopover from "@/components/popover/SimplePopover.vue";
import FacebookIcon from "@/icons/FacebookIcon.vue";
</script>

<template>
  <SimplePopover name="facebook-share">
    <template #trigger="{target}">
      <button class="transition hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg inline-flex" :data-popover-target="target">
        <FacebookIcon/>
      </button>
    </template>
    <template #body>
      <div class="px-3 py-2">
        <h3 class="font-semibold">
          Share on Facebook
        </h3>
      </div>
    </template>
  </SimplePopover>
</template>

<style scoped>

</style>
