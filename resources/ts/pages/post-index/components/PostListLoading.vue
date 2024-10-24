<script setup lang="ts">
import PostItemLoading from './components/PostItemLoading.vue';
</script>

<template>
    <div role="status"
        class="space-y-4 divide-y divide-gray-200 rounded shadow animate-pulse dark:divide-gray-700">
        <PostItemLoading v-for="i in 6" :class="i===1?'':'pt-4'"/>
        <span class="sr-only">Loading...</span>
    </div>
</template>