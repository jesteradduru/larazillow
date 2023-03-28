<template>
  <Box>
    <template #header>Make an offer</template>
    <form>
      <input v-model="form.amount" type="text" class="input-text" />
      <input v-model="form.amount" type="range" class="input-range mt-2" :min="min" :max="max" step="10000" />
      <button type="submit" class="btn-outline block w-full mt-3">Make an offer</button>
    </form>
    <div class="flex justify-between mt-3">
      <div>Difference</div>
      <Price :price="difference" class="text-md" />
    </div>
  </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

const form = useForm({
  amount: props.price,
})

const props = defineProps({
  listingId: Number,
  price: Number, 
})

const difference = computed(() => {
  return form.amount - props.price
})
const min = computed(() => {
  return props.price / 2
})
const max = computed(() => {
  return props.price * 2
})


</script>