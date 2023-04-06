<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const user = computed(() => usePage().props.user)
</script>

<template>
  <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
    <div class="container mx-auto">
      <nav class="flex justify-between items-center p-4">
        <div class="text-lg font-medium">
          <Link class="" :href="route('listing.index')">Listings</Link>&nbsp;
        </div>
        <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
          <Link :href="route('listing.index')">LaraZillow</Link>
        </div>
        <div v-if="user" class="flex gap-3 items-center">
          <div class="text-gray-500 relative pr-2 py-2 text-lg">
            🔔
            <div v-if="$page.props.user.notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
              {{ $page.props.user.notificationCount }}
            </div>
          </div>
          <Link :href="route('realtor.listing.index')">{{ user.name }}</Link>
          
          <div class="btn-primary">
            <Link :href="route('realtor.listing.create')">+ New Listing</Link>
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
    
  <main class="container mx-auto p-3 w-full px-10">
    <div v-if="$page.props.flash.success" class="p-2 border rounded-md border-green-500 bg-green-100 dark:bg-green-900 dark:border-green-700 shadow-md mb-2">
      {{ $page.props.flash.success }}
    </div>
    <slot />
  </main>
</template>
