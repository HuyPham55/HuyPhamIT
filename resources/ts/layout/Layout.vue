<script lang="ts" setup>
import Header from "@/layout/components/Header.vue";
import Footer from "@/layout/components/Footer.vue";
import SearchModal from "@/layout/components/SearchModal.vue";
import {useLayoutStore} from "@/stores/layout";

useLayoutStore().fetch();

</script>
<template>
  <SearchModal/>
  <Header/>
  <RouterView v-slot="{Component}">
    <Transition name="fade-transform">
      <Component :is="Component"/>
    </Transition>
  </RouterView>
  <Footer/>
</template>
