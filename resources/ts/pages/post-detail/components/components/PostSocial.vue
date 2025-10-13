<script setup lang="ts">

import FacebookShareButton from "@/pages/post-detail/components/components/components/FacebookShareButton.vue";
import BookmarkButton from "@/pages/post-detail/components/components/components/BookmarkButton.vue";
import PostMenuButton from "@/pages/post-detail/components/components/components/PostMenuButton.vue";
import ShareLinkButton from "@/pages/post-detail/components/components/components/ShareLinkButton.vue";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import {computed, onMounted} from "vue";
import {initFlowbite} from "flowbite";

const props = defineProps<{ post: PostDetailType }>()
const post = computed(() => props.post);
// initialize components based on data attribute selectors
onMounted(() => {
  initFlowbite();
})
</script>

<template>
  <aside class="mb-2 lg:mb-0">
    <div class="">
      <FacebookShareButton/>
      <BookmarkButton :post="post"/>
      <ShareLinkButton/>
      <PostMenuButton/>
    </div>
  </aside>
</template>

<style scoped>

</style>
