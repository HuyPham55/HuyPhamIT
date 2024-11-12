<script lang="ts" setup>
import {computed, onMounted, ref, watch} from "vue";

const _scrollTop = ref(0);

const _scrollStatus = ref(false);

const _timer = ref();

const displayThreshold = 250

const computedShow = computed<boolean>(() => _scrollTop.value > displayThreshold);

const hidden = ref(false);

const transitionTime = 150 //ms;

onMounted(() => {
  window.addEventListener('wheel', function () {
    //TODO: Wheel works on both Firefox and Chromium browsers
    _scrollTop.value = document.documentElement.scrollTop;
  })
})

watch(_scrollTop, function () {
  _scrollStatus.value = true;
  clearTimeout(_timer.value)
  _timer.value = setTimeout(() => {
    _scrollStatus.value = false;
  }, 2000)
});

watch(computedShow, function (newValue) {
  if (!newValue) {
    setTimeout(() => {
      hidden.value = true;
    }, transitionTime)
  } else {
    hidden.value = false;
  }
})

// Scroll To Top
function scrollToTop() {
  window.scrollTo({top: 0, behavior: 'smooth'});
}

const clickHandler = function () {
  scrollToTop()
}
</script>

<template>
  <button id="btn-to-top" :class="['bg-primary-600 cursor-pointer border-0 text-white rounded-lg z-10 hover:opacity-100 transition fixed shadow-lg', computedShow ? '' : 'opacity-0', _scrollStatus ? 'opacity-50 ': 'opacity-25', hidden ? 'hidden':'']"
          type="button"
          @click="clickHandler">
    <i class="fa fa-angle-up"></i>
  </button>
</template>

<style scoped>
#btn-to-top {
  bottom: 10px;
  right: 10px;
  width: 40px;
  height: 40px;
  font-size: 20px;
}
</style>