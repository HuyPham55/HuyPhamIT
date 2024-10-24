<script setup lang="ts">

import FacebookShareButton from "@/pages/post-detail/components/components/components/FacebookShareButton.vue";
import BookmarkButton from "@/pages/post-detail/components/components/components/BookmarkButton.vue";
import PostMenuButton from "@/pages/post-detail/components/components/components/PostMenuButton.vue";
import ShareLinkButton from "@/pages/post-detail/components/components/components/ShareLinkButton.vue";
</script>

<template>
  <aside class="mb-2 lg:mb-0">
    <div class="">
      <FacebookShareButton/>
      <BookmarkButton/>
      <ShareLinkButton/>
      <PostMenuButton/>
    </div>
  </aside>
</template>

<style scoped>

</style>
