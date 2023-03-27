<template>
  <Box>
    <template #header>Upload Images</template>
    <section>
      <form class="flex gap-4" @submit.prevent="upload">
        <input type="file" multiple class="input-file" @input="addFiles" />
        <div class="flex gap-1">
          <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="!canUpload">Upload</button>
          <button type="reset" class="btn-outline" @click="reset">Reset</button>
        </div>
      </form>
    </section>
  </Box>

  <Box v-if="listing.images.length" class="mt-4">
    <template #header>Current Listing Images</template>
    <section class="grid grid-cols-4 gap-4">
      <div v-for="image in listing.images" :key="image.id" class="flex flex-col">
        <img :src="image.src" :alt="image.filename" class="rounded-md" />
        <Link 
          :href="route('realtor.listing.image.destroy', 
                       {listing: props.listing.id, image: image.id})" 
          class="btn-outline mt-2" method="delete" as="button"
        >
          Delete
        </Link>
      </div>
    </section>
  </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
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