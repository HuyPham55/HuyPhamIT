<script setup lang="ts">
import {ref, watch} from "vue";

const emits = defineEmits(["updateSorting"])
const options = ref([
  {
    id: 'created_at-asc',
    orderBy: 'created_at',
    order: 'asc',
    text: 'Most recent'
  },
  {
    id: 'updated_at-desc',
    orderBy: 'updated_at',
    order: 'desc',
    text: 'Latest activity'
  },
  {
    id: 'view_count-desc',
    orderBy: 'view_count',
    order: 'desc',
    text: 'Most viewed'
  },
]);

let defaultValue = options.value.find(() => true).id

const modelValue = ref(defaultValue);

watch(modelValue, function (value, oldValue, onCleanup) {
  let match = options.value.find((item) => item.id === value);
  if (match) {
    let {orderBy, order} = match;
    emits("updateSorting", {orderBy, order})
  }
}, {immediate: true})

</script>

<template>
  <div class="flex">
    <div class="flex items-center mr-4" v-for="(option, index) in options">
      <input :id="'radio-' + index"
             class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
             name="order_by" type="radio"
             v-model="modelValue"
             :value="option.id">
      <label :for="'radio-' + index"
             :class="['ms-2 text-sm text-gray-900 dark:text-gray-300 text-nowrap select-none cursor-pointer', option.id === modelValue ? 'font-bold' : 'font-medium']">
        {{ option.text }}
      </label>
    </div>
  </div>
</template>

<style scoped>

</style>
