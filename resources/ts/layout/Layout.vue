<script lang="ts" setup>
import {useLayoutStore} from "@/stores/layout";

useLayoutStore().fetch();

</script>
<template>
  <RouterView v-slot="{Component}">
    <Transition name="fade-transform">
      <Component :is="Component"/>
    </Transition>
  </RouterView>
</template>
