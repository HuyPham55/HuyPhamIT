<script setup lang="ts">

import AuthInput from "@/pages/auth/components/AuthInput.vue";
import GoogleIcon from "@/icons/GoogleIcon.vue";
import AppleIcon from "@/icons/AppleIcon.vue";
import {Form} from "vee-validate";

const onSubmit = function(values) {
  axios.post("/auth/login", values)
    .then(response => {
      // Handle success
      console.log("Login successful:", response.data);
      // Redirect or show success message
    })
    .catch(error => {
      // Handle error
      console.error("Login failed:", error.response.data);
      // Show error message
    });
}
</script>

<template>
  <Form @submit="onSubmit" action="#" class="w-full max-w-md space-y-4 md:space-y-6 xl:max-w-xl">
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
    <AuthInput name="email" label="Email" type="email" placeholder="Enter your email" />
    <AuthInput name="password" label="Password" type="password" placeholder="••••••••"/>
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
  </Form>
</template>

<style scoped>

</style>
