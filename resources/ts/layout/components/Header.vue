<script lang="ts" setup>
import {ref, toRef} from "vue";
import SwitchThemeButton from "@/layout/components/components/SwitchThemeButton.vue";
import SearchButton from "@/layout/components/components/SearchButton.vue";
import {useLayoutStore} from "@/stores/layout";
import UserMenu from "@/layout/components/components/UserMenu.vue";
import NavbarMenu from "@/layout/components/components/NavbarMenu.vue";

const layoutStore = useLayoutStore();

const data = toRef(() => layoutStore.data);

const authenticated = ref(false);

</script>
<template>
  <header
    class="bg-white dark:bg-gray-900 sticky w-full z-20 top-0 start-0 border-b border-blue-700 dark:border-blue-500 md:shadow">
    <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <router-link :to="{name:'home'}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img :alt="data.app_name" class="h-8 hidden sm:inline" src="https://flowbite.com/docs/images/logo.svg">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
          {{ data.app_name }}
        </span>
      </router-link>
      <div class="flex md:order-2 rtl:space-x-reverse gap-1 md:gap-2 items-center">
        <SearchButton/>
        <SwitchThemeButton/>
        <router-link :to="{name: 'login'}"
          v-if="!authenticated"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="button">
          Log in
        </router-link>
        <UserMenu v-else/>

        <button aria-controls="navbar-sticky" aria-expanded="false"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                data-collapse-toggle="navbar-sticky" type="button">
          <span class="sr-only">Open main menu</span>
          <svg aria-hidden="true" class="w-5 h-5" fill="none" viewBox="0 0 17 14"
               xmlns="http://www.w3.org/2000/svg">
            <path d="M1 1h15M1 7h15M1 13h15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"/>
          </svg>
        </button>
      </div>
      <NavbarMenu/>
    </nav>
  </header>
</template>
