<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const flashSuccess = computed(() => usePage().props.flash.success)
const user = computed(() => usePage().props.user)
</script>

<template>
  <header class="p-5 border-b border-gray-200 shadow bg-gray-100 dark:bg-gray-900 dark:border-gray-600">
    <div class="container mx-auto">
      <nav class="flex justify-between items-center">
        <div class="text-lg font-medium">
          <Link class="" :href="route('listing.index')">Listings</Link>&nbsp;
        </div>
        <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
          <Link :href="route('listing.index')">LaraZillow</Link>
        </div>
        <div v-if="user" class="flex gap-3 items-center">
          <div>{{ user.name }}</div>
          
          <div class="btn-primary">
            <Link :href="route('listing.create')">+ New Listing</Link>
          </div>

          <Link :href="route('logout')" method="DELETE" as="button">Logout</Link>
        </div>
        <div v-else class="flex items-center gap-2">
          <Link :href="route('user-account.create')">Register</Link>
          <Link :href="route('login')">Sign-in</Link>
        </div>
      </nav>
    </div>
  </header>
    
  <main class="container mx-auto p-3 w-full">
    <div v-if="flashSuccess" class="p-2 border rounded-md border-green-500 bg-green-100 dark:bg-green-900 dark:border-green-700 shadow-md mb-2">
      {{ flashSuccess }}
    </div>
    <slot />
  </main>
</template>
