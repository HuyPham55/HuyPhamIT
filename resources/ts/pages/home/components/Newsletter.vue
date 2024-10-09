<script lang="ts" setup>

</script>

<template>
  <aside
      class="py-10 sm:py-16 bg-gray-50 lg:py-20 dark:bg-gray-800 border-t border-b border-gray-100 dark:border-gray-700">
    <div class="px-4 mx-auto max-w-8xl"><h2
        class="mb-4 text-2xl md:text-4xl font-bold tracking-tight text-gray-900 md:font-extrabold lg:leading-none dark:text-white md:text-center lg:mb-7">
      Sign up for our newsletter</h2>
      <p class="mb-4 text-base text-gray-500 md:mb-6 dark:text-gray-400 md:text-center md:text-xl lg:px-20 xl:px-56">
        Do you want to get notified when a new component is added to Flowbite? Sign up for our newsletter and you will
        be among the first to find out about new features, components, versions, and tools.</p>
      <div class="mb-4">
        <form action="https://app.convertkit.com/forms/4692392/subscriptions"
              class="flex max-w-xl md:mx-auto" data-format="inline" data-options="{&quot;settings&quot;:{&quot;after_subscribe&quot;:{&quot;action&quot;:&quot;message&quot;,&quot;success_message&quot;:&quot;Success! Now check your email to confirm your subscription.&quot;,&quot;redirect_url&quot;:&quot;&quot;},&quot;analytics&quot;:{&quot;google&quot;:null,&quot;fathom&quot;:null,&quot;facebook&quot;:null,&quot;segment&quot;:null,&quot;pinterest&quot;:null,&quot;sparkloop&quot;:null,&quot;googletagmanager&quot;:null},&quot;modal&quot;:{&quot;trigger&quot;:&quot;timer&quot;,&quot;scroll_percentage&quot;:null,&quot;timer&quot;:5,&quot;devices&quot;:&quot;all&quot;,&quot;show_once_every&quot;:15},&quot;powered_by&quot;:{&quot;show&quot;:true,&quot;url&quot;:&quot;https://convertkit.com/features/forms?utm_campaign=poweredby&amp;utm_content=form&amp;utm_medium=referral&amp;utm_source=dynamic&quot;},&quot;recaptcha&quot;:{&quot;enabled&quot;:false},&quot;return_visitor&quot;:{&quot;action&quot;:&quot;show&quot;,&quot;custom_content&quot;:&quot;&quot;},&quot;slide_in&quot;:{&quot;display_in&quot;:&quot;bottom_right&quot;,&quot;trigger&quot;:&quot;timer&quot;,&quot;scroll_percentage&quot;:null,&quot;timer&quot;:5,&quot;devices&quot;:&quot;all&quot;,&quot;show_once_every&quot;:15},&quot;sticky_bar&quot;:{&quot;display_in&quot;:&quot;top&quot;,&quot;trigger&quot;:&quot;timer&quot;,&quot;scroll_percentage&quot;:null,&quot;timer&quot;:5,&quot;devices&quot;:&quot;all&quot;,&quot;show_once_every&quot;:15}},&quot;version&quot;:&quot;5&quot;}"
              data-sv-form="4692392" data-uid="344e3b5c48" data-version="5"
              method="post"
              min-width="400 500">
          <div class="w-full" data-style="clean"><label class="hidden" for="member_email">Email address</label>
            <div class="relative h-full">
              <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400"
                     fill="currentColor" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"></path>
                  <path
                      d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"></path>
                </svg>
              </div>
              <input id="member_email" class="block w-full px-3 py-4 pl-11 text-base text-gray-900 bg-white border border-gray-200 rounded-l-xl formkit-input focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="email_address"
                     placeholder="Enter your email"
                     :required="true" type="email"></div>
          </div>
          <div><input id="member_submit" class="formkit-submit formkit-submit w-full px-4 py-4 text-base font-medium text-center text-white bg-blue-700 dark:bg-blue-600 dark:border-blue-600 border border-blue-700 cursor-pointer rounded-r-xl formkit-submit hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 dark:hover:border-blue-700 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-element="submit"
                      type="submit"
                      value="Subscribe"></div>
        </form>
      </div>
      <p class="text-sm text-gray-500 md:text-center dark:text-gray-400 font-normal">By subscribing, you agree with
        ConvertKit's <a class="text-blue-600 dark-text-blue-400 hover:underline" href="https://convertkit.com/terms"
                        rel="nofollow noopener noreferrer">Terms of Service</a> and <a
            class="text-blue-600 dark-text-blue-400 hover:underline" href="https://convertkit.com/privacy"
            rel="nofollow noopener noreferrer">Privacy Policy</a>.</p></div>
  </aside>
</template>

<style scoped>

</style>