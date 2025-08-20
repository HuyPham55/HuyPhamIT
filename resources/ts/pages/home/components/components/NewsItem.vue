<script lang="ts" setup>
import {PostItem} from "@/pages/post-index/PostIndex";
import {computed, toRefs} from "vue";
import VoteIcon from "@/icons/VoteIcon.vue";
import PostItemAction from "@/pages/home/components/components/components/PostItemAction.vue";

interface Props {
  detailedMode?: Boolean;
  post: PostItem;
}

const props = defineProps<Props>()

const {post} = toRefs(props)

/**
 * Destructured refs
 * Keep reactivity intact
 */
const {
  title,
  hash,
  short_description,
  publish_date,
  view_count,
  author,
  tags,
} = toRefs(post.value)


const hasTags = computed<boolean>(() => !!(tags?.value?.length))

const computedShowDescription = computed(() => !!short_description.value.length && props.detailedMode)

</script>

<template>
  <div class="grid gap-4 pb-4 sm:grid-cols-10 md:grid-cols-10 md:gap-6 md:pb-6">
    <div class="sm:col-span-10 lg:col-span-10 flex flex-wrap gap-2">
      <h3>
        <router-link :to="{name: 'post_detail', params: {hash}}"
                     class="content-center font-semibold text-gray-900 hover:underline dark:text-white text-xl">
          {{ title }}
        </router-link>
      </h3>
      <div class="d-flex flex-wrap" v-if="hasTags">
        <a v-for="tag in tags"
           class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
           href="#">
          {{ tag.name }}
        </a>
      </div>
    </div>

    <div v-if="computedShowDescription" class="sm:col-span-10 lg:col-span-10">
      <p class="text-base font-normal text-gray-500 dark:text-gray-400">
        {{ short_description }}
      </p>
    </div>
    <div class="flex items-center space-x-2 sm:col-span-8 lg:col-span-9">
      <div class="flex items-center space-x-2 md:space-x-4">
        <img alt="Bonnie Green avatar"
             class="w-7 h-7 rounded-full"
             :src="author?.profile_picture"><span
        class="font-medium text-primary-600 dark:text-primary-500 hover:underline cursor-pointer">
        {{ author?.name }}
      </span>
      </div>
      <span class="text-gray-500 dark:text-gray-400">
        {{ publish_date }}
      </span>
      <div class="flex flex-grow space-x-2 justify-end">
        <span class="font-medium text-gray-500 dark:text-gray-400 inline-flex items-center">
          <i class="fa fa-comment mr-1 h-3"></i>
          12
        </span>
        <span class="font-medium text-gray-500 dark:text-gray-400 inline-flex items-center">
          <VoteIcon class="self-end w-5 h-5"/>
          14
        </span>
        <span class="font-medium text-gray-500 dark:text-gray-400 inline-flex items-center">
          <i class="fa fa-eye mr-1 h-3"></i>
          {{view_count}}
        </span>
      </div>
    </div>
    <PostItemAction :post="post"/>
  </div>

</template>

<style scoped>

</style>
