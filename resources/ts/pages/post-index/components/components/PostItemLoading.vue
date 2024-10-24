<script setup>
const randomWidth = 75 - Math.random() * 20;
</script>
<template>
    <div class="flex items-center justify-between">
        <div class="w-full" :style="{ maxWidth: randomWidth + '%' }">
            <div class="h-5 bg-gray-300 rounded-full dark:bg-gray-600 w-full mb-2.5"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
            <div class="w-32 h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
            <div class="flex items-center">
                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32"></div>
                <div class="h-2.5 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            </div>
        </div>
        <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
    </div>
</template>

<style lang="css" scoped></style>