<script setup lang="ts">

import {useRouter} from "vue-router";
import {computed} from "vue";

const router = useRouter()
const isLoginPage = computed(() => router.currentRoute.value.name === 'login');
</script>

<template>
  <router-link :to="{name: 'login'}"
               :class="['transition', isLoginPage ? 'text-blue-700 bg-transparent border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:text-blue-500 dark:border-blue-500 dark:hover:bg-blue-600 dark:hover:text-white dark:focus:ring-blue-800' : 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800']"
               type="button">
    Log in
  </router-link>
</template>

<style scoped>

</style>
