<script setup>

import { reactive, watch } from 'vue'
import { router } from '@inertiajs/vue3'
const filterForm = reactive({
  deleted: false,
})

watch(filterForm, () => {
  router.get(route('realtor.listing.index'), filterForm, {
    preserveScroll: true,
    preserveState: true,
  })
})
</script>

<template>
  <div class="mb-8">
    <form>
      <div class="flex flex-nowrap items-center gap-2">
        <input id="deleted" v-model="filterForm.deleted" type="checkbox" class="rounded-md border-2 focus:ring-indigo-300 border-gray-300" />
        <label for="deleted">Deleted</label>
      </div>
    </form>
  </div>
</template>
