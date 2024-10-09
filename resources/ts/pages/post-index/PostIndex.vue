<script lang="ts" setup>

import NewsItem from "@/pages/home/components/components/NewsItem.vue";
import Pagination from "@/pages/home/components/components/Pagination.vue";
</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-8 antialiased md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
        <h2 class="shrink-0 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Questions (147)</h2>
        <form class="mt-4 w-full gap-4 sm:flex sm:items-center sm:justify-end lg:mt-0">
          <label class="sr-only" for="simple-search">Search</label>
          <div class="relative w-full flex-1 lg:max-w-sm">
            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
              <svg aria-hidden="true" class="h-4 w-4 text-gray-500 dark:text-gray-400"
                   fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" stroke="currentColor" stroke-linecap="round"
                      stroke-width="2"></path>
              </svg>
            </div>
            <input id="simple-search" class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 ps-9 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                   placeholder="Search Questions &amp; Answers"
                   :required="true" type="text">
          </div>
          <button class="mt-4 w-full shrink-0 rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:mt-0 sm:w-auto"
                  type="button">
            Ask a question
          </button>
        </form>
      </div>

      <div class="mt-4 flex justify-between gap-x-2 flex-wrap">
        <div class="flex">
          <div class="flex items-center mr-4">
            <input id="default-radio-1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="default-radio" type="radio"
                   value="">
            <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 text-nowrap" for="default-radio-1">Default
              radio</label>
          </div>
          <div class="flex items-center">
            <input id="default-radio-2" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="default-radio" type="radio"
                   value="">
            <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 text-nowrap" for="default-radio-2">Checked
              state</label>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <a href="#">
            <i class="text-primary-500 text-xl fa-solid fa-list"></i>
          </a>
          <a href="#">
            <i class="text-gray-400 text-xl fa-solid fa-newspaper"></i>
          </a>
        </div>
      </div>

      <hr class="mt-4">

      <div class="mt-6 flow-root sm:mt-8">
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
          <NewsItem/>

          <div class="grid gap-4 py-4 sm:grid-cols-10 md:grid-cols-10 md:gap-6 md:py-6">
            <div class="sm:col-span-10 lg:col-span-10 flex flex-wrap gap-2">
              <h3>
                <router-link :to="{name: 'post_detail'}"
                             class="content-center font-semibold text-gray-900 hover:underline dark:text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua.
                </router-link>
              </h3>
              <div class="d-flex flex-wrap">
                <a class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                   href="#">Default</a>
                <a class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"
                   href="#">Red</a>
                <a class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                   href="#">Yellow</a>
              </div>
            </div>

            <div class="flex items-center space-x-2 sm:col-span-8 lg:col-span-9">
              <div class="flex items-center space-x-4">
                <img alt="Bonnie Green avatar"
                     class="w-7 h-7 rounded-full"
                     src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"><span
                  class="font-medium text-primary-600 dark:text-primary-500 hover:underline cursor-pointer"> Bonnie Green </span>
              </div>
              <span class="text-gray-500 dark:text-gray-400">08 Feb 2025</span>
              <div class="flex flex-grow space-x-2 justify-end">
                  <span class="font-medium text-gray-500 dark:text-gray-400 inline-flex items-center">
                    <svg aria-hidden="true" class="self-end mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 18"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                    </svg>
                    12
                  </span>
                <span class="font-medium text-gray-500 dark:text-gray-400 inline-flex items-center">
                     <svg aria-hidden="true" class="self-end mr-1 w-5 h-5" fill="currentColor"
                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                    </svg>
                    14
                  </span>
              </div>
            </div>


            <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
              <button id="actionsMenuDropdown1"
                      class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto"
                      data-dropdown-toggle="dropdownOrder1"
                      type="button">
                More
                <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                     viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                  <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"/>
                </svg>
              </button>
              <div id="dropdownOrder1"
                   class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                   data-popper-placement="bottom">
                <ul aria-labelledby="actionsMenuDropdown1"
                    class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                  <li>
                    <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                       href="#">
                      <svg
                          aria-hidden="true"
                          class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                          fill="none" height="24" viewBox="0 0 24 24" width="24"
                          xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"/>
                      </svg>
                      <span>Download certificate</span>
                    </a>
                  </li>
                  <li>
                    <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                       href="#">
                      <svg
                          aria-hidden="true"
                          class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                          fill="none" height="24" viewBox="0 0 24 24" width="24"
                          xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"/>
                      </svg>
                      <span>Extend warranty</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="grid gap-4 py-4 sm:grid-cols-10 md:grid-cols-10 md:gap-6 md:py-6">
            <div class="sm:col-span-10 lg:col-span-10 flex flex-wrap gap-2">
              <h3>
                <router-link :to="{name: 'post_detail'}"
                             class="content-center font-semibold text-gray-900 hover:underline dark:text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore
                  et dolore magna aliqua.
                </router-link>
              </h3>
              <div class="d-flex flex-wrap">
                <a class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                   href="#">Default</a>
                <a class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"
                   href="#">Red</a>
                <a class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                   href="#">Yellow</a>
              </div>
            </div>

            <div class="flex items-center space-x-2 sm:col-span-8 lg:col-span-9">
              <div class="flex items-center space-x-4">
                <img alt="Bonnie Green avatar"
                     class="w-7 h-7 rounded-full"
                     src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"><span
                  class="font-medium text-primary-600 dark:text-primary-500 hover:underline cursor-pointer"> Bonnie Green </span>
              </div>
              <span class="text-gray-500 dark:text-gray-400">08 Feb 2025</span>
              <div class="flex flex-grow space-x-2 justify-end">
                  <span class="font-medium text-gray-500 dark:text-gray-400 inline-flex items-center">
                    <svg aria-hidden="true" class="self-end mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 18"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                    </svg>
                    12
                  </span>
                <span class="font-medium text-gray-500 dark:text-gray-400 inline-flex items-center">
                     <svg aria-hidden="true" class="self-end mr-1 w-5 h-5" fill="currentColor"
                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                    </svg>
                    14
                  </span>
              </div>
            </div>


            <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
              <button id="actionsMenuDropdown1"
                      class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto"
                      data-dropdown-toggle="dropdownOrder1"
                      type="button">
                More
                <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                     viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                  <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"/>
                </svg>
              </button>
              <div id="dropdownOrder1"
                   class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                   data-popper-placement="bottom">
                <ul aria-labelledby="actionsMenuDropdown1"
                    class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                  <li>
                    <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                       href="#">
                      <svg
                          aria-hidden="true"
                          class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                          fill="none" height="24" viewBox="0 0 24 24" width="24"
                          xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"/>
                      </svg>
                      <span>Download certificate</span>
                    </a>
                  </li>
                  <li>
                    <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                       href="#">
                      <svg
                          aria-hidden="true"
                          class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                          fill="none" height="24" viewBox="0 0 24 24" width="24"
                          xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"/>
                      </svg>
                      <span>Extend warranty</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <nav aria-label="Page navigation example" class="mt-6 flex items-center justify-center sm:mt-8">
        <Pagination/>
      </nav>
    </div>
  </section>
</template>

<style scoped>

</style>
