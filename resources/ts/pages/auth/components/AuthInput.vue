<script setup lang="ts">
import {toRefs, computed} from "vue";
import {ErrorMessage, Field} from "vee-validate";

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: 'text',
  },
  placeholder: {
    type: String,
    default: '',
  },
  label: {
    type: String,
    default: '',
  },
  autocomplete: {
    type: String,
    default: 'off',
  },
})
const {
  name,
  type,
  placeholder,
  label,
} = toRefs(props)

const computedClass = computed(() => {
  return `bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white`
})
</script>

<template>
  <div>
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" :for="name">
      {{ label }}
    </label>
    <Field :name="name" v-slot="{ field }">
      <input
        v-bind="field"
        :id="name"
        :placeholder="placeholder"
        :type="type"
        :class="computedClass"
        :autocomplete="autocomplete">
    </Field>
    <ErrorMessage :name="name" as="small"/>
  </div>
</template>

<style scoped>

</style>
