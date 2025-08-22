<script setup lang="ts">
import Header from "@/layout/components/Header.vue";
import SearchModal from "@/layout/components/SearchModal.vue";
import Footer from "@/layout/components/Footer.vue";
import GetToTop from "@/layout/components/GetToTop.vue";
import {useRoute} from "vue-router";
import {computed} from "vue";

const route = useRoute();
const isAuthRoute = computed(() => route.meta.isAuth);  // is auth route or not
</script>

<template>
  <SearchModal/>
  <Header/>
  <RouterView v-slot="{Component}">
    <Transition name="fade">
      <Component :is="Component"/>
    </Transition>
  </RouterView>
  <Transition name="fade">
    <GetToTop v-if="!isAuthRoute"/>
  </Transition>
  <Transition name="fade">
    <Footer v-if="!isAuthRoute"/>
  </Transition>
</template>

<style scoped>
</style>
