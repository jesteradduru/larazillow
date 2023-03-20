<script setup>
defineProps({
  listing: Object,
})
</script>

<template>
  <div>
    <span class="font-bold">{{ listing.beds }}</span> bds <span> | </span>
    <span class="font-bold">{{ listing.baths }}</span> ba <span> | </span>
    <span class="font-bold">{{ listing.area }}</span> m²
  </div>
</template>