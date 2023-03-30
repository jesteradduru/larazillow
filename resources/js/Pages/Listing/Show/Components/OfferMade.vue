<template>
  <Box>
    <template #header>Offer Made</template>
    <Price :price="props.offerMade.amount" class="text-3xl" />
    <div class="flex justify-between text-gray-500 mt-1">
      <div>Made on</div>
      <div>{{ offerMadeOn }}</div>
    </div>
  </Box>
</template>

<script setup>
import { computed } from 'vue'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
const props = defineProps({
  offerMade: Object,
})

const offerMadeOn = computed(() => new Date(props.offerMade.created_at).toDateString())
</script>