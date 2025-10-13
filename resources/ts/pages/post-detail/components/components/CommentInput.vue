<script lang="ts" setup>
import {defineEmits, ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";
import {ErrorMessage, Field, Form} from "vee-validate";
import {useAuthStore} from "@/stores/modules/auth";

interface Props {
  type: string,
  id: number
}

const emit = defineEmits(['commentSubmitted']);
const props = defineProps<Props>();
const content = ref();
const loading = ref(false);
const router = useRouter();
const authStore = useAuthStore();
const resetForm = function () {
  content.value = ''
}
const onFormSubmit = async function (values, actions) {
  if (!authStore.isAuthenticated) {
    await router.push({name: "login"})
    return
  }
  loading.value = true;
  try {
    const {type, id} = props
    let url = `/${type}/${id}/comments`
    let commentData = {
      content: content.value
    }
    let {data} = await axios.post(url, commentData)
    emit('commentSubmitted', data)
    resetForm()
  } catch (e) {
    let statusCode = (e as { status: number }).status;
    if (statusCode === 500) {
      await router.push({name: "Error"})
      return
    }
    if (statusCode === 422) {
      if (typeof e === "object" && e !== null && "response" in e) {
        const axiosError = e as { response: { data: unknown } };
        let responseData = axiosError.response.data;
        if (typeof responseData === "object" && responseData !== null && "errors" in responseData) {
          const err = responseData as { errors: Record<string, string[]> };
          for (const fieldName in err.errors) {
            actions.setFieldError(fieldName, err.errors[fieldName]);
          }
        }
      }
    }
  } finally {
    loading.value = false;
  }
}
</script>

<template>
  <Form class="mb-6" @submit="onFormSubmit">
    <div
      class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
      <label class="sr-only" for="comment">Your comment</label>
      <Field name="content" v-slot="{ field }" v-model="content">
        <textarea id="comment"
                  :disabled="loading"
                  v-bind="field"
                  class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                  placeholder="Write a comment..."
                  required rows="6"></textarea>
      </Field>
    </div>
    <Transition name="fade-slide">
      <ErrorMessage name="content" as="p" class="text-sm text-red-600 dark:text-red-500 mt-4 mb-4"/>
    </Transition>
    <button
      class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
      :disabled="loading"
      type="submit">
      Post comment
    </button>
  </Form>
</template>

<style scoped>
#comment {

}
</style>
