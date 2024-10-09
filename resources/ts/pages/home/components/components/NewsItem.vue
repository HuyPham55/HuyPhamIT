<script lang="ts" setup>
const props = defineProps({
  detailedMode: {
    type: Boolean,
    default: false,
    required: false,
  }
})
</script>

<template>
  <div class="grid gap-4 pb-4 sm:grid-cols-10 md:grid-cols-10 md:gap-6 md:pb-6">
    <div class="sm:col-span-10 lg:col-span-10 flex flex-wrap gap-2">
      <h3>
        <router-link :to="{name: 'post_detail'}"
                     class="content-center font-semibold text-gray-900 hover:underline dark:text-white text-xl">
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

    <div v-if="props.detailedMode" class="sm:col-span-10 lg:col-span-10">
      <p class="text-base font-normal text-gray-500 dark:text-gray-400">
        It’s a USB-C port it’s a smaller port. Not the regular size USB port. See the picture below. It fits the newer
        Apple chargers.
      </p>
    </div>
    <div class="flex items-center space-x-2 sm:col-span-8 lg:col-span-9">
      <div class="flex items-center space-x-2 md:space-x-4">
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

</template>

<style scoped>

</style>