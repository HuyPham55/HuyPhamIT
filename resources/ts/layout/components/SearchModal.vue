<script lang="ts" setup>
//TODO: Modal should be placed away from the header, since header is set with a specific z-index

// onMounted(() => {
//   initFlowbite();
// })

import {InstanceOptions, Modal, ModalOptions} from "flowbite";
import {onMounted, ref} from "vue";
import {useEventBusStore} from "@/stores/eventBus";

const _modal = ref();

const options: ModalOptions = {
  placement: "top-center",
  backdrop: 'dynamic',
  backdropClasses:
      'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
  closable: true,
}

// instance options object
const instanceOptions: InstanceOptions = {
  id: 'modalEl',
  override: true
};

const initialize = function () {
  const $targetEl = document.getElementById('default-modal');
  if ($targetEl) {
    _modal.value = new Modal($targetEl, options, instanceOptions);
  }
}


const closeModal = function () {
  _modal.value.hide();
}
const closeButtonHandler = function () {
  closeModal();
}
const openModal = function () {
  _modal.value.show();
}

onMounted(initialize)
defineExpose({
  closeButtonHandler,
  openModal,
})

const eventBus = useEventBusStore();

eventBus.on('openSearchModal', () => {
  openModal();
  eventBus.off('openSearchModal', () => null);
});
</script>

<template>
  <!-- Main modal -->
  <div id="default-modal" aria-hidden="true"
       class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full p-4 lg:pt-16"
       tabindex="-1">
    <div class="relative w-full max-w-lg max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">


          <form class="flex items-center flex-grow gap-x-2">
            <label class="sr-only" for="simple-search">Search</label>
            <div class="relative w-full">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400"
                     fill="none" viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"
                      stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"/>
                </svg>
              </div>
              <input id="simple-search"
                     class="bg-white border-0 focus:ring-0 text-gray-900 text-sm rounded-lg block w-full ps-10 p-2.5  dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                     placeholder="Search branch name..."
                     required type="text"/>
            </div>
          </form>


          <button
              class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
              type="button"
              @click="closeButtonHandler">
            <svg aria-hidden="true" class="w-3 h-3" fill="none" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
              <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5">
          <ul class="space-y-4">
            <li>
              <a class="px-2 transition inline-flex h-14 items-center justify-between w-full rounded-lg cursor-pointer dark:hover:text-white hover:text-white bg-gray-100 hover:bg-primary-600 dark:text-white dark:bg-gray-600 dark:hover:bg-primary-600">
                <div class="block mx-2 overflow-ellipsis overflow-x-hidden whitespace-nowrap">
                  <div class="font-semibold">UI/UX Engineer</div>
                  <div class="text-gray-400">Flowbite</div>
                </div>
                <div class="ms-3 flex items-center">
                  <i class="w-4 h-4 rtl:rotate-180 fa fa-angle-right"></i>
                </div>
              </a>
            </li>

            <li>
              <a class="px-2 transition inline-flex h-14 items-center justify-between w-full rounded-lg cursor-pointer dark:hover:text-white hover:text-white bg-gray-100 hover:bg-primary-600 dark:text-white dark:bg-gray-600 dark:hover:bg-primary-600">
                <div class="block mx-2 overflow-ellipsis overflow-x-hidden whitespace-nowrap">
                  <div class="w-full font-semibold">
                    We use an agile approach to test assumptions and connect with the needs of your audience early and
                    often.
                  </div>
                  <div class="text-gray-400">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis
                  </div>
                </div>
                <div class="ms-3 flex items-center">
                  <i class="w-4 h-4 rtl:rotate-180 fa fa-angle-right"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
