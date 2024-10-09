<script lang="ts" setup>
import FeaturedItem from "@/pages/home/components/components/FeaturedItem.vue";
</script>

<template>
  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
        <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our Blog</h2>
        <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions
          and connect with the needs of your audience early and often.</p>
      </div>
      <div class="grid gap-8 lg:grid-cols-2">
        <FeaturedItem/>
        <article
            class="p-6 bg-white hover:bg-gray-50 transition rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
          <div class="flex justify-between items-center mb-5 text-gray-500">
            <span
                class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
              <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                   xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd"
                                                            d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                                                            fill-rule="evenodd"></path><path
                  d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path></svg>
              Article
            </span>
            <span class="text-sm">14 days ago</span>
          </div>
          <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a href="#">Our first project
            with React</a></h2>
          <p class="mb-5 font-light text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing
            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
          <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
              <img alt="Bonnie Green avatar"
                   class="w-7 h-7 rounded-full"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"/>
              <span class="font-medium dark:text-white">
                Bonnie Green
              </span>
            </div>
            <a class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"
               href="#">
              Read more
              <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                      fill-rule="evenodd"></path>
              </svg>
            </a>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>

<style scoped>

</style>