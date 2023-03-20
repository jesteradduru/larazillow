<template>
  <span>{{ computedPrice }}</span>
</template>

<script setup>
import { computed } from 'vue'
const props = defineProps({
  price: [Number, String],
})
const computedPrice = computed(() => Number(props.price).toLocaleString('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 0,
}))
</script>
