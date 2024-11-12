<script lang="ts" setup>

import GoogleIcon from "@/icons/GoogleIcon.vue";
import AppleIcon from "@/icons/AppleIcon.vue";

//73px: Header height
</script>

<template>
  <section class="bg-white dark:bg-gray-900">
    <div class="grid lg:h-[calc(100vh-73px)] lg:grid-cols-2">
      <div class="flex items-center justify-center px-4 py-6 lg:py-0 sm:px-0 lg:order-1">
        <form action="#" class="w-full max-w-md space-y-4 md:space-y-6 xl:max-w-xl">
          <h1 class="text-xl font-bold text-gray-900 dark:text-white">Welcome back</h1>
          <div class="items-center space-x-0 space-y-3 sm:flex sm:space-x-4 sm:space-y-0">
            <a class="w-full inline-flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
               href="#">
              <GoogleIcon class="w-5 h-5 mr-2"/>
              Sign in with Google
            </a>
            <a class="w-full inline-flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
               href="#">
              <AppleIcon class="w-5 h-5 mr-2 text-gray-900 dark:text-white"/>
              Sign in with Apple
            </a>
          </div>
          <div class="flex items-center">
            <div class="w-full h-0.5 bg-gray-200 dark:bg-gray-700"></div>
            <div class="px-5 text-center text-gray-500 dark:text-gray-400">or</div>
            <div class="w-full h-0.5 bg-gray-200 dark:bg-gray-700"></div>
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                   for="email">Email</label>
            <input id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" name="email"
                   placeholder="Enter your email"
                   type="email">
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                   for="password">Password</label>
            <input id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" name="password" placeholder="••••••••"
                   type="password"
            >
          </div>
          <div class="flex items-center justify-between">
            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                       type="checkbox"
                >
              </div>
              <div class="ml-3 text-sm">
                <label class="text-gray-500 dark:text-gray-300" for="remember">Remember me</label>
              </div>
            </div>
            <a class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
               href="#">Forgot
              password?</a>
          </div>
          <button class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                  type="submit">
            Sign
            in to your account
          </button>
          <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            Don't have an account?
            <router-link :to="{name: 'register'}"
                         class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign
              up
            </router-link>
          </p>
        </form>
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