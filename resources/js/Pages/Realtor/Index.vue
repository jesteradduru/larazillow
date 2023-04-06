<template>
  <h1 class="text-3xl mb-4">Your Listings</h1>
  <section>
    <RealtorFilters :filters="filters" />
  </section>
  <section v-if="listings.data.length" class="flex flex-col md:grid md:grid-cols-2  gap-2 mx-auto ">
    <Box v-for="listing in listings.data" :key="listing.id" :class="{'border-dashed' : listing.deleted_at}">
      <div
        v-if="listing.sold_at != null" 
        class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2"
      >
        sold
      </div>
      <div class="flex flex-col justify-between md:flex-row">
        <div class="w-full" :class="listing.deleted_at && 'opacity-25'">
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl" />
            <ListingSpace :listing="listing" class="text-sm" />
          </div>
          <ListingAddress :listing="listing" class="dark:text-gray-500" />
        </div>
        <section>
          <div class="grid grid-cols-3 md:flex gap-1 mt-3 md:mt-0 justify-between text-sm content-around">
            <Link :href="route('listing.show', {listing : listing.id})" class="btn-outline">Preview</Link>
            <Link :href="route('realtor.listing.edit', {listing: listing.id})" class="btn-outline">Edit</Link>
            <Link v-if="!listing.deleted_at" class="btn-outline" :href="route('realtor.listing.destroy', {listing: listing.id})" as="button" method="delete">Delete</Link>
            <Link v-else :href="route('realtor.listing.restore', {listing: listing.id})" class="btn-outline" as="button" method="put">Restore</Link>
          </div>
          <Link :href="route('realtor.listing.image.create', {listing : listing.id})" class="btn-outline mt-2 block text-center flex-1">Images ({{ listing.images_count }})</Link>
          <Link :href="route('realtor.listing.show', {listing : listing.id})" class="btn-outline mt-2 block text-center flex-1">Offers ({{ listing.offers_count }})</Link>
        </section>
      </div>
    </Box>
  </section>
  <EmptyState v-else>No listings yet</EmptyState>
  <div v-if="listings.total > 0" class="flex justify-center mt-8">
    <Pagination :links="listings.links" />
  </div>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
import { Link } from '@inertiajs/vue3'
import EmptyState from '@/Components/UI/EmptyState.vue'
defineProps(
  {
    listings: Object,
    filters: Object,
  },
)
</script>