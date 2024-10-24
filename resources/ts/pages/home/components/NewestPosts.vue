<script lang="ts" setup>

import Pagination from "@/pages/home/components/components/Pagination.vue";

// onMounted(() => {
//   initFlowbite();
// })
</script>

<template>
  <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="mx-auto max-w-5xl">

        <div class="mx-auto max-w-screen-sm text-center mb-8">
          <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our
            Blog</h2>
          <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions
            and connect with the needs of your audience early and often.</p>
        </div>

        <div class="gap-4 sm:flex sm:items-center sm:justify-between">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My warranties</h2>
          <div class="mt-6 flex items-center space-x-4 sm:mt-0">
            <div>
              <label class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="warranty-status">Warranty
                status</label>
              <select id="warranty-status"
                      class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                <option selected>All</option>
                <option value="pending">Pending</option>
                <option value="active">Active</option>
                <option value="expired">Expired</option>
              </select>
            </div>
            <span class="inline-block text-gray-500 dark:text-gray-400"> from </span>
            <div>
              <label class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="warranty-length">Select
                warranty length</label>
              <select id="warranty-length"
                      class="block w-full min-w-[10rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                <option selected>Warranty length</option>
                <option value="12">12 months</option>
                <option value="24">24 months</option>
                <option value="48">48 months</option>
                <option value="60">60 months</option>
              </select>
            </div>
          </div>
        </div>

        <div class="mt-6 flow-root sm:mt-8">
          <div class="divide-y divide-gray-200 dark:divide-gray-700">
<!--            <NewsItem/>-->
            <div class="grid gap-4 py-4 md:grid-cols-10 md:gap-6 md:py-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">Apple
                iPhone 15 Pro Max</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">12 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expires on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">08 Feb 2025</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown2" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder2"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder2"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown2"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        <span>Extend warranty</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid gap-4 py-4 md:grid-cols-10 md:gap-6 md:py-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">iPad
                Pro 13-Inch (M4)</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">48 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expires on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">26 Apr 2027</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown3" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder3"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder3"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown3"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        <span>Extend warranty</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid gap-4 py-4 md:grid-cols-10 md:gap-6 md:py-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">PlayStation®5
                Console</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">12 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expires on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">17 Aug 2024</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown4" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder4"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder4"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown4"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        <span>Extend warranty</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid gap-4 py-4 md:grid-cols-10 md:gap-6 md:py-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">Microsoft
                Surface Pro, Copilot</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">36 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expires on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">30 Dec 2027</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown5" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder5"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder5"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown5"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        <span>Extend warranty</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid gap-4 py-4 md:grid-cols-10 md:gap-6 md:py-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">Apple
                Watch SE [GPS 40mm]</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">24 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expires on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">28 Oct 2026</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown6" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder6"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder6"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown6"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        <span>Extend warranty</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid gap-4 py-4 md:grid-cols-10 md:gap-6 md:py-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">Microsoft
                Xbox Series X</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">12 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expires on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">14 Jul 2025</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown7" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder7"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder7"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown7"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        <span>Extend warranty</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid gap-4 py-4 md:grid-cols-10 md:gap-6 md:py-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">Beats
                Fit Pro - True Wireless</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">48 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expires on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">27 Mar 2028</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown8" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder8"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder8"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown8"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        <span>Extend warranty</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid gap-4 py-4 md:grid-cols-10 md:gap-6 md:py-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">Apple
                iMac 24" All-In-One PC</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">12 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expired on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">08 Mar 2024</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown9" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder9"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder9"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown9"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        <span>Extend warranty</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid gap-4 pt-4 md:grid-cols-10 md:gap-6 md:pt-6">
              <a class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3"
                 href="#">Brother
                Printer HL-L3220CDW</a>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty length:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">36 months</dd>
              </dl>
              <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                <dt class="font-medium text-gray-900 dark:text-white">Expired on:</dt>
                <dd class=" text-gray-500 dark:text-gray-400">29 May 2024</dd>
              </dl>
              <div class="sm:col-span-2 md:justify-self-end lg:col-span-1">
                <button id="actionsMenuDropdown10" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto" data-dropdown-toggle="dropdownOrder10"
                        type="button">
                  More
                  <svg aria-hidden="true" class="-me-0.5 ms-1.5 h-4 w-4" fill="none" height="24"
                       viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                  </svg>
                </button>
                <div id="dropdownOrder10"
                     class="z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                     data-popper-placement="bottom">
                  <ul aria-labelledby="actionsMenuDropdown10"
                      class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li>
                      <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                         href="#">
                        <svg
                            aria-hidden="true"
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
                            class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
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
    </div>
  </section>
</template>

<style scoped>

</style>
