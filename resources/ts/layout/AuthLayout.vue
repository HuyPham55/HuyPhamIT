<script lang="ts" setup>
import Header from "@/layout/components/Header.vue";
import SearchModal from "@/layout/components/SearchModal.vue";
import {onUpdated} from "vue";
import {initFlowbite} from "flowbite";

onUpdated(() => {
  initFlowbite()
  console.log("Updated")
})
</script>
<template>
  <div>
    <SearchModal/>
    <Header/>
    <RouterView v-slot="{Component}">
      <Transition name="slide">
        <Component :is="Component"/>
      </Transition>
    </RouterView>
  </div>
</template>
