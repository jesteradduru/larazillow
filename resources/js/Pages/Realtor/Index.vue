<script setup>
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
import { Link } from '@inertiajs/vue3'
defineProps(
  {
    listings: Object,
    filters: Object,
  },
)
</script>

<template>
  <h1 class="text-3xl mb-4">Your Listings</h1>
  <section>
    <RealtorFilters :filters="filters" />
  </section>
  <section class="flex flex-col md:grid md:grid-cols-2  gap-2 mx-auto ">
    <Box v-for="listing in listings.data" :key="listing.id" :class="{'border-dashed' : listing.deleted_at}">
      <div class="flex flex-col justify-between md:flex-row">
        <div class="w-full" :class="listing.deleted_at && 'opacity-25'">
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl" />
            <ListingSpace :listing="listing" class="text-sm" />
          </div>
          <ListingAddress :listing="listing" class="dark:text-gray-500" />
        </div>
        <div class="flex gap-1 mt-3 md:mt-0 items-center text-sm">
          <Link :href="route('listing.show', {listing : listing.id})" class="btn-outline">Preview</Link>
          <Link :href="route('realtor.listing.edit', {listing: listing.id})" class="btn-outline">Edit</Link>
          <Link v-if="!listing.deleted_at" class="btn-outline" :href="route('realtor.listing.destroy', {listing: listing.id})" as="button" method="delete">Delete</Link>
          <Link v-else :href="route('realtor.listing.restore', {listing: listing.id})" class="btn-outline" as="button" method="put">Restore</Link>
        </div>
      </div>
    </Box>
  </section>
  <div v-if="listings.total > 0" class="flex justify-center mt-8">
    <Pagination :links="listings.links" />
  </div>
  <div v-else class="text-center">No Listings to show.</div>
</template>