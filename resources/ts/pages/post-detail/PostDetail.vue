<script lang="ts" setup>
import {defineAsyncComponent, onMounted} from "vue";
import {initFlowbite} from 'flowbite'

const CommentSection = defineAsyncComponent(() => {
  return import("@/pages/post-detail/components/CommentSection.vue")
})

// initialize components based on data attribute selectors
onMounted(() => {
  initFlowbite();
})
</script>

<template>
  <div>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
      <div
          class="flex justify-between p-4 mx-2 lg:mx-auto max-w-screen-xl lg:p-10 dark:bg-gray-800 rounded-lg lg:rounded gap-8 flex-col lg:flex-row">
        <article
            class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert xl:max-w-4xl order-1">
          <header class="mb-4 lg:mb-6 not-format">
            <div class="flex lg:items-center flex-col lg:flex-row justify-between">
              <div class="flex items-center mb-2 lg:mb-0">
                <span>By &nbsp;</span>
                <a class="font-bold dark:text-white hover:underline" href="#">Jese Leos</a>
                <span class="ml-2 w-3 h-3 bg-gray-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                <span class="ml-2">
                <time class="">August 3, 2022, 2:20am EDT</time>
              </span>
              </div>
              <aside class="mb-2 lg:mb-0">
                <div class="">
                  <button class="transition hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg inline-flex"
                          data-popover-target="popover-default">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 8 19"
                         xmlns="http://www.w3.org/2000/svg">
                      <path clip-rule="evenodd"
                            d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                            fill-rule="evenodd"></path>
                    </svg>
                  </button>

                  <div id="popover-default"
                       class="absolute z-10 invisible inline-block text-sm text-white transition-opacity duration-300 bg-gray-800 rounded-lg shadow opacity-0 dark:text-gray-200 dark:bg-gray-700"
                       data-popover
                       role="tooltip">
                    <div class="px-3 py-2">
                      <h3 class="font-semibold">
                        Share on Facebook
                      </h3>
                    </div>
                    <div data-popper-arrow></div>
                  </div>

                  <button class="transition hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg inline-flex">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" viewBox="0 0 14 20"
                         xmlns="http://www.w3.org/2000/svg">
                      <path d="m13 19-6-5-6 5V2a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v17Z" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"></path>
                    </svg>
                  </button>

                  <button class="transition hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg inline-flex">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" viewBox="0 0 19 19"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.013 7.962a3.519 3.519 0 0 0-4.975 0l-3.554 3.554a3.518 3.518 0 0 0 4.975 4.975l.461-.46m-.461-4.515a3.518 3.518 0 0 0 4.975 0l3.553-3.554a3.518 3.518 0 0 0-4.974-4.975L10.3 3.7"
                          stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"></path>
                    </svg>
                  </button>
                  <button class="transition hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg inline-flex">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 16 3"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"></path>
                    </svg>
                  </button>

                </div>
              </aside>
            </div>
            <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
              Best
              practices for successful prototypes
            </h1>
          </header>
          <p class="lead">Flowbite is an open-source library of UI components built with the utility-first
            classes from Tailwind CSS. It also includes interactive elements such as dropdowns, modals,
            datepickers.</p>
          <p>Before going digital, you might benefit from scribbling down some ideas in a sketchbook. This way,
            you can think things through before committing to an actual design project.</p>
          <p>But then I found a <a href="https://flowbite.com">component library based on Tailwind CSS called
            Flowbite</a>. It comes with the most commonly used UI components, such as buttons, navigation
            bars, cards, form elements, and more which are conveniently built with the utility classes from
            Tailwind CSS.</p>
          <figure><img alt="" src="https://flowbite.s3.amazonaws.com/typography-plugin/typography-image-1.png">
            <figcaption>Digital art by Anonymous</figcaption>
          </figure>
          <h2>Getting started with Flowbite</h2>
          <p>First of all you need to understand how Flowbite works. This library is not another framework.
            Rather, it is a set of components based on Tailwind CSS that you can just copy-paste from the
            documentation.</p>
          <p>It also includes a JavaScript file that enables interactive components, such as modals, dropdowns,
            and datepickers which you can optionally include into your project via CDN or NPM.</p>
          <p>You can check out the <a href="https://flowbite.com/docs/getting-started/quickstart/">quickstart
            guide</a> to explore the elements by including the CDN files into your project. But if you want
            to build a project with Flowbite I recommend you to follow the build tools steps so that you can
            purge and minify the generated CSS.</p>
          <p>You'll also receive a lot of useful application UI, marketing UI, and e-commerce pages that can help
            you get started with your projects even faster. You can check out this <a
                href="https://flowbite.com/docs/components/tables/">comparison table</a> to better understand
            the differences between the open-source and pro version of Flowbite.</p>
          <h2>When does design come in handy?</h2>
          <p>While it might seem like extra work at a first glance, here are some key moments in which prototyping
            will come in handy:</p>
          <ol>
            <li><strong>Usability testing</strong>. Does your user know how to exit out of screens? Can they
              follow your intended user journey and buy something from the site you’ve designed? By running a
              usability test, you’ll be able to see how users will interact with your design once it’s live;
            </li>
            <li><strong>Involving stakeholders</strong>. Need to check if your GDPR consent boxes are displaying
              properly? Pass your prototype to your data protection team and they can test it for real;
            </li>
            <li><strong>Impressing a client</strong>. Prototypes can help explain or even sell your idea by
              providing your client with a hands-on experience;
            </li>
            <li><strong>Communicating your vision</strong>. By using an interactive medium to preview and test
              design elements, designers and developers can understand each other — and the project — better.
            </li>
          </ol>
          <h3>Laying the groundwork for best design</h3>
          <p>Before going digital, you might benefit from scribbling down some ideas in a sketchbook. This way,
            you can think things through before committing to an actual design project.</p>
          <p>Let's start by including the CSS file inside the <code>head</code> tag of your HTML.</p>
          <h3>Understanding typography</h3>
          <h4>Type properties</h4>
          <p>A typeface is a collection of letters. While each letter is unique, certain shapes are shared across
            letters. A typeface represents shared patterns across a collection of letters.</p>
          <h4>Baseline</h4>
          <p>A typeface is a collection of letters. While each letter is unique, certain shapes are shared across
            letters. A typeface represents shared patterns across a collection of letters.</p>
          <h4>Measurement from the baseline</h4>
          <p>A typeface is a collection of letters. While each letter is unique, certain shapes are shared across
            letters. A typeface represents shared patterns across a collection of letters.</p>
          <h3>Type classification</h3>
          <h4>Serif</h4>
          <p>A serif is a small shape or projection that appears at the beginning or end of a stroke on a letter.
            Typefaces with serifs are called serif typefaces. Serif fonts are classified as one of the
            following:</p>
          <h4>Old-Style serifs</h4>
          <ul>
            <li>Low contrast between thick and thin strokes</li>
            <li>Diagonal stress in the strokes</li>
            <li>Slanted serifs on lower-case ascenders</li>
          </ul>
          <img alt="" src="https://flowbite.s3.amazonaws.com/typography-plugin/typography-image-2.png">
          <ol>
            <li>Low contrast between thick and thin strokes</li>
            <li>Diagonal stress in the strokes</li>
            <li>Slanted serifs on lower-case ascenders</li>
          </ol>
          <h3>Laying the best for successful prototyping</h3>
          <p>A serif is a small shape or projection that appears at the beginning:</p>
          <blockquote>
            <p>Flowbite is just awesome. It contains tons of predesigned components and pages starting from
              login screen to complex dashboard. Perfect choice for your next SaaS application.</p>
          </blockquote>
          <h4>Code example</h4>
          <p>A serif is a small shape or projection that appears at the beginning or end of a stroke on a letter.
            Typefaces with serifs are called serif typefaces. Serif fonts are classified as one of the
            following:</p>
          <pre><code class="language-html">&lt;dl class="grid grid-cols-2 gap-8 max-w-screen-md text-gray-900 sm:grid-cols-3 dark:text-white"&gt;
          &lt;div class="flex flex-col justify-center items-center"&gt;
          &lt;dt class="mb-2 text-3xl font-extrabold"&gt;73M+&lt;/dt&gt;
          &lt;dd class="text-lg font-normal text-gray-500 dark:text-gray-400"&gt;developers&lt;/dd&gt;
          &lt;/div&gt;
          &lt;div class="flex flex-col justify-center items-center"&gt;
          &lt;dt class="mb-2 text-3xl font-extrabold"&gt;1B+&lt;/dt&gt;
          &lt;dd class="text-lg font-normal text-gray-500 dark:text-gray-400"&gt;contributors&lt;/dd&gt;
          &lt;/div&gt;
          &lt;div class="flex flex-col justify-center items-center"&gt;
          &lt;dt class="mb-2 text-3xl font-extrabold"&gt;4M+&lt;/dt&gt;
          &lt;dd class="text-lg font-normal text-gray-500 dark:text-gray-400"&gt;organizations&lt;/dd&gt;
          &lt;/div&gt;
          &lt;/dl&gt;
        </code></pre>
          <h4>Table example</h4>
          <p>A serif is a small shape or projection that appears at the beginning or end of a stroke on a letter.
          </p>
          <table>
            <thead>
            <tr>
              <th>Country</th>
              <th>Date &amp; Time</th>
              <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>United States</td>
              <td>April 21, 2021</td>
              <td><strong>$2,300</strong></td>
            </tr>
            <tr>
              <td>Canada</td>
              <td>May 31, 2021</td>
              <td><strong>$300</strong></td>
            </tr>
            <tr>
              <td>United Kingdom</td>
              <td>June 3, 2021</td>
              <td><strong>$2,500</strong></td>
            </tr>
            <tr>
              <td>Australia</td>
              <td>June 23, 2021</td>
              <td><strong>$3,543</strong></td>
            </tr>
            <tr>
              <td>Germany</td>
              <td>July 6, 2021</td>
              <td><strong>$99</strong></td>
            </tr>
            <tr>
              <td>France</td>
              <td>August 23, 2021</td>
              <td><strong>$2,540</strong></td>
            </tr>
            </tbody>
          </table>
          <h3>Best practices for setting up your prototype</h3>
          <p><strong>Low fidelity or high fidelity?</strong> Fidelity refers to how close a prototype will be to
            the real deal. If you’re simply preparing a quick visual aid for a presentation, a low-fidelity
            prototype — like a wireframe with placeholder images and some basic text — would be more than
            enough. But if you’re going for more intricate usability testing, a high-fidelity prototype — with
            on-brand colors, fonts and imagery — could help get more pointed results.</p>
          <p><strong>Consider your user</strong>. To create an intuitive user flow, try to think as your user
            would when interacting with your product. While you can fine-tune this during beta testing,
            considering your user’s needs and habits early on will save you time by setting you on the right
            path.</p>
          <p><strong>Start from the inside out</strong>. A nice way to both organize your tasks and create more
            user-friendly prototypes is by building your prototypes ‘inside out’. Start by focusing on what will
            be important to your user, like a Buy now button or an image gallery, and list each element by order
            of priority. This way, you’ll be able to create a prototype that puts your users’ needs at the heart
            of your design.</p>
          <p>And there you have it! Everything you need to design and share prototypes — right in Flowbite Figma.
          </p>
          <section class="not-format">
            <address class="flex items-center mb-6 not-italic">
              <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                <img alt="Jese Leos"
                     class="mr-4 w-16 h-16 rounded-full"
                     src="https://flowbite.com/docs/images/people/profile-picture-2.jpg">
                <div>
                  <a class="text-xl font-bold text-gray-900 dark:text-white" href="#" rel="author">Jese Leos</a>
                  <p class="text-base text-gray-500 dark:text-gray-400">Graphic Designer, educator & CEO Flowbite</p>
                  <p class="text-base text-gray-500 dark:text-gray-400">
                    <time datetime="2022-02-08" pubdate title="February 8th, 2022">Feb. 8, 2022</time>
                  </p>
                </div>
              </div>
            </address>
          </section>
          <CommentSection/>
        </article>
        <aside class="w-full xl:max-w-xs">
          <div class="lg:sticky lg:top-28">
            <div class="mb-8">
              <h3 class="dark:text-white font-bold uppercase mb-4">
                Recommended topics
              </h3>
              <div class="flex flex-wrap gap-3">
                <a class="bg-primary-100 hover:bg-primary-200 transition text-primary-800 dark:bg-primary-200 dark:hover:bg-primary-100 dark:text-primary-800 px-2 py-0.5 rounded"
                   href="#">
                  Technology
                </a>
                <a class="bg-primary-100 hover:bg-primary-200 transition text-primary-800 dark:bg-primary-200 dark:hover:bg-primary-100 dark:text-primary-800 px-2 py-0.5 rounded"
                   href="#">
                  Money
                </a>
                <a class="bg-primary-100 hover:bg-primary-200 transition text-primary-800 dark:bg-primary-200 dark:hover:bg-primary-100 dark:text-primary-800 px-2 py-0.5 rounded"
                   href="#">
                  Productivity
                </a>
                <a class="bg-primary-100 hover:bg-primary-200 transition text-primary-800 dark:bg-primary-200 dark:hover:bg-primary-100 dark:text-primary-800 px-2 py-0.5 rounded"
                   href="#">
                  Psychology
                </a>
              </div>
            </div>

            <div class="mb-8">
              <div class="flex justify-between mb-2 pb-2 items-center border-b border-gray-900 dark:border-white">
                <div class="flex place-content-center">
                  <a href="#">
                    <h3 class="dark:text-white font-bold uppercase">
                      Threads
                    </h3>
                  </a>
                  <button type="button">
                    <svg aria-hidden="true" class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path clip-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                            fill-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Show information</span>
                  </button>
                </div>
                <button
                    class="transition text-gray-500 dark:text-white dark:hover:text-primary-500 hover:text-primary-400 p-2 aspect-square rounded-full hover:rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex place-content">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
              <ul>
                <li class="pb-2 border-b border-gray-300 dark:border-gray-700 mb-2">
                  <a href="#">
                    <h4 class="dark:text-gray-400 mb-2 text-justify">
                      Over the past year, Volosoft has undergone changes.
                    </h4>
                  </a>
                  <div class="flex -space-x-4 rtl:space-x-reverse">
                    <img alt=""
                         class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
                         src="https://flowbite.com/docs/images/people/profile-picture-5.jpg">
                    <img alt=""
                         class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
                         src="https://flowbite.com/docs/images/people/profile-picture-2.jpg">
                    <img alt=""
                         class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
                         src="https://flowbite.com/docs/images/people/profile-picture-3.jpg">
                    <a class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800"
                       href="#">+99</a>
                  </div>
                </li>

                <li class="pb-2 border-b border-gray-300 dark:border-gray-700 mb-2">
                  <a href="#">
                    <h4 class="dark:text-gray-400 mb-2 text-justify">
                      Over the past year, Volosoft has undergone changes.
                    </h4>
                  </a>
                  <div class="flex -space-x-4 rtl:space-x-reverse">
                    <img alt=""
                         class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
                         src="https://flowbite.com/docs/images/people/profile-picture-5.jpg">
                    <img alt=""
                         class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
                         src="https://flowbite.com/docs/images/people/profile-picture-2.jpg">
                  </div>
                </li>

                <li class="pb-4 border-b border-gray-900 dark:border-white">
                  <a href="#">
                    <h4 class="dark:text-gray-400 mb-2 text-justify">
                      The article covers the essentials, challenges, myths and stages the UX designer should consider
                      while
                      creating the design strategy.
                    </h4>
                  </a>
                  <div class="flex -space-x-4 rtl:space-x-reverse">
                    <img alt=""
                         class="w-8 h-8 border-1 border-white rounded-full dark:border-gray-800"
                         src="https://flowbite.com/docs/images/people/profile-picture-5.jpg">
                  </div>
                </li>
              </ul>
            </div>

            <div class="mb-8">
              <h3 class="dark:text-white font-bold uppercase mb-2">
                Flowbite News morning headlines
              </h3>
              <p class="text-gray-500 dark:text-gray-400 mb-4 text-justify">
                Get all the stories you need-to-know from the most powerful name in news delivered first thing every
                morning
                to your inbox
              </p>
              <button
                  class="transition text-white px-5 py-3 rounded-lg w-full font-semibold bg-primary-700 hover:bg-primary-800 dark:bg-primary-600 dark:hover:bg-primary-700">
                Subscribe
              </button>
            </div>
          </div>
        </aside>
      </div>
    </main>
    <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">

      <div class="px-4 mx-auto max-w-screen-xl">
        <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
          <article class="max-w-xs">
            <a href="#">
              <img alt="Image 1" class="mb-5 rounded-lg"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="#">Our first office</a>
            </h2>
            <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes!
              After months of preparation.</p>
            <a class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline"
               href="#">
              Read in 2 minutes
            </a>
          </article>
          <article class="max-w-xs">
            <a href="#">
              <img alt="Image 2" class="mb-5 rounded-lg"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-2.png">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="#">Enterprise design tips</a>
            </h2>
            <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes!
              After months of preparation.</p>
            <a class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline"
               href="#">
              Read in 12 minutes
            </a>
          </article>
          <article class="max-w-xs">
            <a href="#">
              <img alt="Image 3" class="mb-5 rounded-lg"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-3.png">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="#">We partnered with Google</a>
            </h2>
            <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes!
              After months of preparation.</p>
            <a class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline"
               href="#">
              Read in 8 minutes
            </a>
          </article>
          <article class="max-w-xs">
            <a href="#">
              <img alt="Image 4" class="mb-5 rounded-lg"
                   src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-4.png">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="#">Our first project with React</a>
            </h2>
            <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes!
              After months of preparation.</p>
            <a class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline"
               href="#">
              Read in 4 minutes
            </a>
          </article>
        </div>
      </div>
    </aside>
  </div>
</template>

<style scoped>

</style>