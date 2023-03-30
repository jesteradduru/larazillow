<template>
  <Box>
    <template #header>Make an offer</template>
    <form @submit.prevent="makeOffer">
      <input v-model="form.amount" type="text" class="input-text" />
      <input v-model="form.amount" type="range" class="input-range mt-2" :min="min" :max="max" step="10000" @change="emit" />
      <div v-if="form.errors.amount" class="input-error">{{ form.errors.amount }}</div>
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
import { computed, watch } from 'vue'
import {debounce} from 'lodash'

const form = useForm({
  amount: props.price,
})

const makeOffer = () => form.post(route('listing.offer.store', { listing: props.listingId }), {
  preserveScroll: true,
  preserveState: true,
})

const props = defineProps({
  listingId: Number,
  price: Number, 
})



const difference = computed(() => {
  return form.amount - props.price
})
const min = computed(() => {
  return Math.round(props.price / 2)
})
const max = computed(() => {
  return Math.round(props.price * 2)
})

const emit = defineEmits(['offerUpdated'])

watch(() => form.amount, debounce((value) => emit('offerUpdated', value), 500))

</script>