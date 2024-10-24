<script setup lang="ts">

import AsideTags from "@/pages/post-detail/components/components/AsideTags.vue";
import AsideThreads from "@/pages/post-detail/components/components/AsideThreads.vue";
import AsideSubscribe from "@/pages/post-detail/components/AsideSubscribe.vue";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import {computed} from "vue";

interface Props {
  post: PostDetailType|undefined;
}

const props = defineProps<Props>()

const post = computed(() => props.post);

const showTags = computed<boolean>(() => !!post.value?.tags?.length)
</script>

<template>
  <aside class="w-full xl:max-w-xs">
    <div class="lg:sticky lg:top-28">
      <AsideTags :tags="post?.tags" v-if="showTags"/>
      <AsideThreads/>
      <AsideSubscribe/>
    </div>
  </aside>
</template>

<style scoped>

</style>
