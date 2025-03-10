<script setup lang="ts">

</script>

<template>
  <div id="navbar-sticky" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
    <ul class="navbar-nav">
      <li>
        <router-link aria-current="page" :to="{name: 'home'}" class="nav-link">
          Home
        </router-link>
      </li>
      <li>
        <router-link :to="{name: 'posts'}" aria-current="page" class="nav-link">
          Posts
        </router-link>
      </li>
      <li>
        <a
          class="nav-link"
          href="#">About</a>
      </li>
      <li>
        <a
          class="nav-link"
          href="#">Services</a>
      </li>
      <li>
        <router-link :to="{name: 'contact_us'}"
                     class="nav-link"
                     href="#">Contact</router-link>
      </li>
      <li>
        <button id="dropdownNavbarLink"
                class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
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
            <a
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
              href="#">Sign
              out</a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>
