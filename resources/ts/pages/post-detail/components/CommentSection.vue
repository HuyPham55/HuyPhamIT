<script lang="ts" setup>

import CommentInput from "@/pages/post-detail/components/components/CommentInput.vue";
import {PostDetailType} from "@/pages/post-detail/PostDetail";
import {reactive, toRef, toRefs} from "vue";
import Comment from "@/pages/post-detail/components/components/Comment.vue";
import {CommentType} from "@/pages/post-detail/components/components/Comment";
import axios from "axios";

const type = 'posts';
const props = defineProps<{
  post: PostDetailType
}>()
const post = toRef(props.post)
const {
  comments_count
} = toRefs(post.value);
const comments = reactive({
  data: <CommentType[]>[],
})
// The last comment <article> doesn't have "mb-6" class
const fetch = async function (url = '') {
  let {id} = post.value;
  if (!url.length) {
    url = `/${type}/${id}/comments`;
  }
  let {data} = await axios.get(url);
  data.forEach((item: CommentType) => {
    comments.data.unshift(item)
  })
}
fetch()

const onCommentSubmitted = function (comment: CommentType) {
  comments.data.unshift(comment);
}
/** TODO: Implement auto-increment comment number when a new comment is added */
</script>

<template>
  <section class="not-format">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion ({{comments_count}})</h2>
    </div>
    <CommentInput :type="type" :id="post.id" @commentSubmitted="onCommentSubmitted"/>
    <TransitionGroup tag="div" name="appear">
      <Comment v-for="comment in comments.data" :key="comment.id" :comment="comment"/>
    </TransitionGroup>
  </section>
</template>
