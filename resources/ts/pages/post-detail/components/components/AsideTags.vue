<script setup lang="ts">
import {computed} from "vue";
import {TagType} from "@/pages/post-detail/PostDetail";
import AsideTagItem from "@/pages/post-detail/components/components/components/AsideTagItem.vue";

interface Props {
  tags: TagType[] | undefined;
}

const props = defineProps<Props>()

const tags = computed(() => props.tags);

</script>

<template>
  <div class="mb-8">
    <h3 class="dark:text-white font-bold uppercase mb-4">
      Recommended topics
    </h3>
    <div class="flex flex-wrap gap-3">
      <AsideTagItem v-for="tag in tags" :tag="tag"/>
    </div>
  </div>
</template>

<style scoped>

</style>
