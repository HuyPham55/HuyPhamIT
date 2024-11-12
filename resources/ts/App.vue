<script setup lang="ts">
</script>

<template>
  <RouterView v-slot="{Component}">
    <Transition name="fade">
      <Component :is="Component"/>
    </Transition>
  </RouterView>
</template>

<style scoped>
</style>
