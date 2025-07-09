<script setup lang="ts">

import AppleIcon from "@/icons/AppleIcon.vue";
import GoogleIcon from "@/icons/GoogleIcon.vue";
import AuthInput from "@/pages/auth/components/AuthInput.vue";
import {Form} from "vee-validate";
import {attemptRegister} from "@/pages/auth/register/components/RegisterForm";
import {useRouter} from "vue-router";
import {useAuthStore} from "@/stores/modules/auth";

const router = useRouter();
const authStore = useAuthStore();
const onSubmit = async function (values, actions) {
  try {
    let response = await attemptRegister(values);
    authStore.setUser(response);
    // redirect to login page
    await router.push({name: 'home'});
  } catch (error) {
    console.log(error);
    if (typeof error === "object" && error !== null && "errors" in error) {
      const err = error as { errors: Record<string, string[]> };
      for (const fieldName in err.errors) {
        actions.setFieldError(fieldName, err.errors[fieldName]);
      }
    }
    // else if (error.message) {
    //   // Optional: set a general error
    //   // actions.setStatus(error.message);
    // }
  }
}
</script>

<template>
  <Form @submit="onSubmit" class="space-y-4 max-w-md md:space-y-6 xl:max-w-xl">
    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Your Best Work Starts Here</h2>
    <div class="items-center space-y-3 space-x-0 sm:flex sm:space-x-4 sm:space-y-0">
      <a
        class="w-full inline-flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
        href="#">
        <GoogleIcon class="mr-2 w-5 h-5"/>
        Sign up with Google
      </a>
      <a
        class="w-full inline-flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
        href="#">
        <AppleIcon class="mr-2 w-5 h-5 text-gray-900 dark:text-white"/>
        Sign up with Apple
      </a>
    </div>
    <div class="flex items-center">
      <div class="w-full h-0.5 bg-gray-200 dark:bg-gray-700"></div>
      <div class="px-5 text-center text-gray-500 dark:text-gray-400">or</div>
      <div class="w-full h-0.5 bg-gray-200 dark:bg-gray-700"></div>
    </div>
    <AuthInput name="name" type="text" label="What should we call you?" placeholder="e.g. Bonnie Green"/>
    <AuthInput name="email" label="Your email" type="email" placeholder="name@company.com"/>
    <AuthInput name="password" label="Your password" type="password" placeholder="••••••••"/>
    <AuthInput name="password_confirmation" label="Confirm your password" type="password" placeholder="••••••••"/>
    <div class="space-y-3">
      <div class="flex items-start">
        <div class="flex items-center h-5">
          <input id="terms" aria-describedby="terms"
                 class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                 type="checkbox"
          >
        </div>
        <div class="ml-3 text-sm">
          <label class="font-light text-gray-500 dark:text-gray-300" for="terms">By signing up,
            you are creating a Flowbite account, and you agree to Flowbite’s <a
              class="font-medium text-primary-600 dark:text-primary-500 hover:underline"
              href="#">Terms of Use</a> and <a
              class="font-medium text-primary-600 dark:text-primary-500 hover:underline"
              href="#">Privacy Policy</a>.</label>
        </div>
      </div>
      <div class="flex items-start">
        <div class="flex items-center h-5">
          <input id="newsletter" aria-describedby="newsletter"
                 class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                 type="checkbox"
          >
        </div>
        <div class="ml-3 text-sm">
          <label class="font-light text-gray-500 dark:text-gray-300" for="newsletter">Email me
            about product updates and resources.</label>
        </div>
      </div>
    </div>
    <button
      class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-700"
      type="submit">
      Create
      an account
    </button>
    <p class="text-sm font-light text-gray-500 dark:text-gray-300">
      Already have an account?
      <router-link :to="{name: 'login'}"
                   class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
        here
      </router-link>
    </p>
  </Form>

</template>
