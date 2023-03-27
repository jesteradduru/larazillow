<template>
  <Box>
    <template #header>Upload Images</template>
    <form class="flex" @submit.prevent="upload">
      <input type="file" multiple @input="addFiles" />
      <div class="flex gap-3">
        <button type="submit" class="btn-outline">Upload</button>
        <button type="reset" class="btn-outline" @click="reset">Reset</button>
      </div>
    </form>
  </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/vue3'
const props = defineProps( { listing: Object })

const form = useForm({
  images: [],
})

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