<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import { ref } from 'vue'

const props = defineProps({
  listing: Object,
})
const interestRate = ref(2.5)
const duration = ref(25)

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, duration, interestRate)

</script>

<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box class="md:col-span-7 flex items-center w-full">
      <div class="w-full text-center">No images</div>
    </Box>
    <div class="md:col-span-5 flex flex-col gap-4">
      <Box>
        <template #header>Basic Info</template>
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" class="text-gray-800 dark:text-gray-300" />
        <ListingAddress :listing="listing" class="text-gray-500 dark:text-gray-400" />
      </Box>
      <Box>
        <template #header>Monthly Payment</template>
        <div>
          <label class="label">Interest Rate ({{ interestRate }}%)</label>
          <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1" class="input-range" />
        </div>
        <div>
          <label class="label">Duration ({{ duration }} years)</label>
          <input v-model.number="duration" type="range" min="3" max="35" step="1" class="input-range" />
        </div>
        <div>
          <label class="label">Your monthly payment</label>
          <Price :price="monthlyPayment" class="text-3xl" />
        </div>

        <div class="flex justify-between text-md">
          <div>Total Paid</div>
          <Price :price="totalPaid" />
        </div>
        <div class="flex justify-between text-md">
          <div>Total Principle Paid</div>
          <Price :price="props.listing.price" />
        </div>
        <div class="flex justify-between text-md">
          <div>Total Interest Paid</div>
          <Price :price="totalInterest" />
        </div>
      </Box>
    </div>
  </div>
</template>
