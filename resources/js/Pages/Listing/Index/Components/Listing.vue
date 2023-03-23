<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import { Link, usePage } from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'

const props = defineProps({ listing:Object })

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 25, 2.5)
const user = usePage().props.user
</script>

<template>
  <Box>
    <Link :href="route('listing.show', {listing: listing.id})">
      <div class="flex items-center gap-2">
        <Price :price="listing.price" class="text-2xl font-bold" />
        <div class="text-xs">
          <Price :price="monthlyPayment" />
          / month
        </div>
      </div>
      <ListingSpace :listing="listing" class="text-gray-800 dark:text-gray-300" />
      <ListingAddress :listing="listing" class="text-gray-400 dark:text-gray-400" />
    </Link>
    <div v-if="user">
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
    </div>
  </Box>
</template>