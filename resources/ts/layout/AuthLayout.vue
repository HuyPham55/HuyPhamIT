<template>
  <RouterView v-slot="{Component}">
    <Transition name="slide-fade">
      <Component :is="Component"/>
    </Transition>
  </RouterView>
</template>
