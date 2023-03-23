<script setup>
import ListingAddress from '../../Components/ListingAddress.vue'
import ListingSpace from '../../Components/ListingSpace.vue'
import { Link } from '@inertiajs/vue3'
import Box from '../../Components/UI/Box.vue'
import Price from '../../Components/Price.vue'
defineProps({
  listings: Array,
})
</script>

<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <Box v-for="listing in listings" :key="listing.id">
      <Link :href="route('listing.show', {listing: listing.id})">
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" class="text-gray-800 dark:text-gray-300" />
        <ListingAddress :listing="listing" class="text-gray-400 dark:text-gray-400" />
      </Link>
      <div>
        <Link :href="route('listing.edit', {listing: listing.id})">
          Edit
        </Link>
      </div>
      <div>
        <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE" as="button">
          Delete
        </Link>
      </div>
    </Box>
  </div>
</template>
