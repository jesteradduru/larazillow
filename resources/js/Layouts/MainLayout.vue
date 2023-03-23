<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const flashSuccess = computed(() => usePage().props.flash.success)
</script>

<template>
  <header class="p-3 border-b border-gray-300 bg-gray-100 dark:bg-gray-900 dark:border-gray-600">
    <div class="container mx-auto">
      <nav class="flex justify-between items-center">
        <div class="text-lg font-medium">
          <Link class="" :href="route('listing.index')">Listings</Link>&nbsp;
        </div>
        <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
          <Link :href="route('listing.index')">LaraZillow</Link>
        </div>
        <div class="btn-primary">
          <Link :href="route('listing.create')">+ New Listing</Link>
        </div>
      </nav>
    </div>
  </header>
    
  <main class="container mx-auto p-3">
    <div v-if="flashSuccess" class="p-2 border rounded-md border-green-500 bg-green-100 dark:bg-green-900 dark:border-green-700 shadow-md mb-2">
      {{ flashSuccess }}
    </div>
    <slot />
  </main>
</template>
