<script lang="ts" setup>
import LoginForm from "@/pages/auth/login/components/LoginForm.vue";

//73px: Header height

axios.get('/sanctum/csrf-cookie').then(response => {
  // Login...
});
</script>

<template>
  <section class="bg-white dark:bg-gray-900">
    <div class="grid lg:h-[calc(100vh-73px)] lg:grid-cols-2">
      <div class="flex items-center justify-center px-4 py-6 lg:py-0 sm:px-0 lg:order-1">
        <LoginForm/>
      </div>
      <div class="flex items-center justify-center px-4 py-6 bg-primary-600 lg:py-0 sm:px-0">
        <div class="max-w-md xl:max-w-xl">
          <a class="flex items-center mb-4 text-2xl font-semibold text-white" href="#">
            <img alt="logo" class="w-8 h-8 mr-2"
                 src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg">
            Flowbite
          </a>
          <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-white xl:text-5xl">Explore
            the world’s leading design portfolios.</h1>
          <p class="mb-4 font-light text-primary-200 lg:mb-8">Millions of designers and agencies around the
            world showcase their portfolio work on Flowbite - the home to the world’s best design and
            creative professionals.</p>
          <div class="flex items-center divide-x divide-primary-500">
            <div class="flex pr-3 -space-x-4 sm:pr-5">
              <img alt="bonnie avatar"
                   class="w-10 h-10 border-2 border-white rounded-full"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png">
              <img alt="jese avatar"
                   class="w-10 h-10 border-2 border-white rounded-full"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png">
              <img alt="roberta avatar"
                   class="w-10 h-10 border-2 border-white rounded-full"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png">
              <img alt="thomas avatar"
                   class="w-10 h-10 border-2 border-white rounded-full"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/thomas-lean.png">
            </div>
            <a class="pl-3 text-white sm:pl-5 dark:text-white" href="#">
                            <span class="text-sm text-primary-200">Over <span
                                class="font-medium text-white">15.7k</span> Happy Customers</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>

</style>
