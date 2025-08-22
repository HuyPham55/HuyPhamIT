<script lang="ts" setup>

import AngleDownIcon from "@/icons/AngleDownIcon.vue";
import {useAuthStore} from "@/stores/modules/auth";
import {computed, ref} from "vue";
import {useLayoutStore} from "@/stores/layout";

const layoutStore = useLayoutStore();
const authStore = useAuthStore();
const user = computed(() => authStore.user);
const isManuallyInitialized = ref(false);

const onMouseEnter = function() {
  // manually initialize the layout store if it hasn't been initialized yet (fix for user dropdown)
  if (!isManuallyInitialized.value) {
    isManuallyInitialized.value = true;
    layoutStore.initLayout();
  }
}
</script>

<template>
  <button id="user-menu-button"
          @mouseenter="onMouseEnter"
          aria-expanded="false"
          class="flex text-sm md:me-0 items-center text-gray-700 dark:text-white gap-1.5 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" data-dropdown-placement="bottom" data-dropdown-toggle="user-dropdown"
          type="button">
    <span class="sr-only">Open user menu</span>
    <img alt="" class="w-6 h-6 rounded-full" src="/images/profile-picture.jpg">
    <span class="font-semibold hidden lg:inline overflow-hidden overflow-ellipsis max-w-[100px]">
      {{user.username || user.name}}
    </span>
    <AngleDownIcon class="w-4 h-4 hidden sm:inline-block"/>
  </button>
</template>

<style scoped>

</style>
