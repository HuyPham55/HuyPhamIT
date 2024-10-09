<template>
  <main>
    <Hero/>
    <FeaturedList/>
    <NewestPosts/>
    <Newsletter/>
  </main>
</template>
<style scoped>
main {
  min-height: 100vh;
}
</style>
<script lang="ts" setup>
import Newsletter from "@/pages/home/components/Newsletter.vue";
import Hero from "@/pages/home/components/Hero.vue";
import NewestPosts from "@/pages/home/components/NewestPosts.vue";
import FeaturedList from "@/pages/home/components/FeaturedList.vue";
</script>