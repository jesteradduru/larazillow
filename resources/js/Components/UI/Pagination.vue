<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: Array,
})
</script>

<template>
  <div class="flex gap-4 my-8">
    <div v-for="(link, index) in links" :key="index">
      <Link :href="link.url" :class="link.active ? 'bg-indigo-800 px-2 py-1 rounded-md' : 'px-2 py-1 rounded-md hover:text-indigo-300 '" v-html="link.label" />
    </div>
  </div>
</template>