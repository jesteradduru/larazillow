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
          <Link class="" href="/listing">Listings</Link>&nbsp;
        </div>
        <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
          LaraZillow
        </div>
        <div class="bg-indigo-600 p-2 rounded-md text-gray-100 dark:text-gray-100 hover:bg-indigo-700 hover:text-gray-300 cursor-auto">
          <Link href="/listing/create">+ New Listing</Link>
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
