<script lang="ts" setup>
import {computed} from "vue";
import SwitchThemeButton from "@/layout/components/components/SwitchThemeButton.vue";
import SearchButton from "@/layout/components/components/SearchButton.vue";
import SearchInput from "@/layout/components/components/SearchInput.vue";

/*
Disable search button that toggles search input on mobile devices, even it's on mobile
Directly related to showSearchButton
 */
let showSearchButton = computed(() => {
  return 0;
})

/*
Search input on mobile devices that shows when user click on hamburger menu
Directly related to showSearchButton
 */

let showMobileSearchInput = 0;

let showSearchForm = 0; //Show search input on header that always shows on desktop devices, automatically hidden on mobile device
</script>
<template>
  <header
      class="bg-white dark:bg-gray-900 sticky w-full z-20 top-0 start-0 border-b border-blue-700 dark:border-blue-500 md:shadow">
    <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <router-link :to="{name:'home'}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img alt="Flowbite Logo" class="h-8" src="https://flowbite.com/docs/images/logo.svg">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
      </router-link>
      <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-2">
        <button v-if="showSearchButton" aria-controls="navbar-sticky" aria-expanded="false"
                class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1" data-collapse-toggle="navbar-sticky"
                type="button">
          <svg aria-hidden="true" class="w-5 h-5" fill="none" viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"/>
          </svg>
          <span class="sr-only">Search</span>
        </button>
        <SearchInput v-if="showSearchForm"/>
        <SearchButton/>
        <SwitchThemeButton/>
        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
          Get
          started
        </button>
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
      <div id="navbar-sticky" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
        <div v-if="showMobileSearchInput" class="relative mt-3 md:hidden">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400"
                 fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2"/>
            </svg>
          </div>
          <input id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                 placeholder="Search..."
                 type="text">
        </div>
        <ul
            class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a aria-current="page"
               class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
               href="#">Home</a>
          </li>
          <li>
            <router-link :to="{name: 'post_list'}" aria-current="page"
                         class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
              Posts
            </router-link>
          </li>
          <li>
            <a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
               href="#">About</a>
          </li>
          <li>
            <a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
               href="#">Services</a>
          </li>
          <li>
            <a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
               href="#">Contact</a>
          </li>
          <li>
            <button id="dropdownNavbarLink" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
                    data-dropdown-toggle="dropdownNavbar">
              Dropdown &nbsp;
              <i class="fa fa-angle-down"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar"
                 class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              <ul aria-labelledby="dropdownLargeButton"
                  class="py-2 text-sm text-gray-700 dark:text-gray-400">
                <li>
                  <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                     href="#">Dashboard</a>
                </li>
                <li>
                  <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                     href="#">Settings</a>
                </li>
                <li>
                  <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                     href="#">Earnings</a>
                </li>
              </ul>
              <div class="py-1">
                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                   href="#">Sign
                  out</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>