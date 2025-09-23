<script setup lang="ts">

import BookmarkIcon from "@/icons/BookmarkIcon.vue";
import SimplePopover from "@/components/popover/SimplePopover.vue";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import {computed, ref, toRef} from "vue";
import {useBookmarksStore} from "@/stores/modules/bookmarks";

interface Props {
  post: PostDetailType;
}

const props = defineProps<Props>()
const post = toRef(props.post);
const loading = ref(false);
const onClick = async function () {
  loading.value = true;
  await store.toggle(post.value.hash)
  setTimeout(() => {
    loading.value = false;
  }, 1000)
}
const store = useBookmarksStore()
store.set(post.value.hash, post.value.bookmark_status);
const bookmark_status = store.isBookmarked(post.value.hash);
const computedHoverText = computed(() => bookmark_status.value ? 'Remove bookmark' : 'Bookmark this post')
</script>

<template>
  <SimplePopover name="bookmark-post">
    <template #trigger="{target}">
      <button
          :class="['transition hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg inline-flex', bookmark_status ? 'text-primary-500' : 'text-gray-400', loading ? 'cursor-not-allowed' : '']"
          @click.prevent="onClick"
          :disabled="loading"
          :data-popover-target="target">
        <BookmarkIcon class="w-5 h-5"/>
      </button>
    </template>
    <template #body>
      <div class="px-3 py-2">
        <h3 class="font-semibold">
          {{ computedHoverText }}
        </h3>
      </div>
    </template>
  </SimplePopover>
</template>

<style scoped>

</style>
