<script setup lang="ts">
import {toRef} from "vue";

const emits = defineEmits(['changeDisplayMode']);

declare type Props = {
  currentMode: boolean;
}

const props = defineProps<Props>()

const currentMode = toRef(() => props.currentMode);

const setListMode = function () {
  emits('changeDisplayMode', false)
}

const setDetailedMode = function () {
  emits('changeDisplayMode', true)
}
</script>

<template>
  <div class="flex items-center gap-2">
    <a href="#" @click.prevent="setListMode">
      <i :class="['text-xl fa-solid fa-list', !currentMode ? 'text-primary-500' :'text-gray-400']"></i>
    </a>
    <a href="#" @click.prevent="setDetailedMode">
      <i :class="['text-xl fa-solid fa-newspaper', currentMode ? 'text-primary-500' :'text-gray-400']"></i>
    </a>
  </div>
</template>

<style scoped>

</style>

