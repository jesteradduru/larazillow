<script setup>
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '../../Components/ListingSpace.vue'
import ListingAddress from '../../Components/ListingAddress.vue'
import { Link } from '@inertiajs/vue3'
defineProps(
  {
    listings: Array,
  },
)
</script>

<template>
  <h1 class="text-3xl mb-4">Your Listings</h1>
  <section class="mb-4">
    <div>Filters</div>
  </section>
  <section class="flex flex-col md:grid md:grid-cols-2  gap-2 mx-auto ">
    <Box v-for="listing in listings" :key="listing.id" class="flex flex-col justify-between md:flex-row">
      <div class="w-full">
        <div class="xl:flex items-center gap-2">
          <Price :price="listing.price" class="text-2xl" />
          <ListingSpace :listing="listing" class="text-sm" />
        </div>
        <ListingAddress :listing="listing" class="dark:text-gray-500" />
      </div>
      <div class="flex gap-1 mt-3 md:mt-0 items-center text-sm">
        <Link class="btn-outline">Preview</Link>
        <Link class="btn-outline">Edit</Link>
        <Link class="btn-outline">Delete</Link>
      </div>
    </Box>
  </section>
</template>