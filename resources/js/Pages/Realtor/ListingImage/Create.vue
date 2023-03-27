<template>
  <Box>
    <template #header>Upload Images</template>
    <form class="flex gap-4" @submit.prevent="upload">
      <input type="file" multiple class="input-file" @input="addFiles" />
      <div class="flex gap-1">
        <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="!canUpload">Upload</button>
        <button type="reset" class="btn-outline" @click="reset">Reset</button>
      </div>
    </form>
  </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'
import NProgress from 'nprogress'

const props = defineProps( { listing: Object })

const form = useForm({
  images: [],
})

router.on('progress', (event) => {
  if (event.detail.progress.percentage) {
    NProgress.set((event.detail.progress.percentage / 100) * 0.9)
  }
})

const canUpload = computed(() => form.images.length > 0)

const upload = () => form.post(
  route('realtor.listing.image.store', 
    { listing: props.listing.id },
  ), {
    onSuccess: () => {
      form.reset('images')
    },
  })

const reset = () => form.reset('images')

const addFiles = (event) => {
  for(const file of event.target.files){
    form.images.push(file)
  }
}

</script>