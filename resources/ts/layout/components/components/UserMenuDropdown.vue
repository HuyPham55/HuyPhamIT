<script setup lang="ts">
import {computed} from "vue";
import {useAuthStore} from "@/stores/modules/auth";
import {useRouter} from "vue-router";

const router = useRouter();
const authStore = useAuthStore();
const user = computed(() => authStore.user);
const logout = async () => {
  if (authStore.isAuthenticated) {
    await authStore.logout();
  }
  await router.push({name: 'login'});
}
</script>

<template>
  <div
    id="user-dropdown"
    class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
    <div class="px-4 py-3">
      <span class="block text-sm text-gray-900 dark:text-white">
        {{user.name}}
      </span>
      <span class="block text-sm text-gray-500 truncate dark:text-gray-400">
        {{user.email}}
      </span>
    </div>
    <ul aria-labelledby="user-menu-button" class="py-2">
      <li>
        <router-link :to="{name: 'login'}"
                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
          Dashboard
        </router-link>
      </li>
      <li>
        <router-link :to="{name: 'register'}"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
          Settings</router-link>
      </li>
      <li>
        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
           href="#">Earnings</a>
      </li>
      <li>
        <a @click.prevent="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
           href="#">Sign
          out</a>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>
