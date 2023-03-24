<script setup>

import { computed, reactive, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import { debounce } from 'lodash'

const props = defineProps({
  filters: Object,
})

const filterForm = reactive({
  deleted: props.filters.deleted ?? false,
  by: props.filters.by ?? 'created_at',
  order: props.filters.order ?? 'asc',
})

const sortLabels = {
  created_at: [
    {
      label: 'Earliest',
      value: 'desc',
    },
    {
      label: 'Oldest',
      value: 'asc',
    },
  ],
  price: [
    {
      label: 'Cheapest',
      value: 'asc',
    },
    {
      label: 'Pricey',
      value: 'desc',
    },
  ],
}

const sortOptions = computed(() => sortLabels[filterForm.by]) 

watch(filterForm, debounce(() => {
  router.get(route('realtor.listing.index'), filterForm, {
    preserveScroll: true,
    preserveState: true,
  })
}, 1000))
</script>

<template>
  <div class="mb-8">
    <form class="flex gap-4 ">
      <div class="flex flex-nowrap items-center gap-2">
        <input id="deleted" v-model="filterForm.deleted" type="checkbox" class="rounded-md border-2 focus:ring-indigo-300 border-gray-300" />
        <label for="deleted">Deleted</label>
      </div>

      <div>
        <select id="" v-model="filterForm.by" class="input-filter-l">
          <option value="created_at">Added</option>
          <option value="price">Price</option>
        </select>
        <select id="" v-model="filterForm.order" class="input-filter-r">
          <option v-for="sort in sortOptions" :key="sort.value" :value="sort.value"> {{ sort.label }}</option>
        </select>
      </div>
    </form>
  </div>
</template>
