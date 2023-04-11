<template>
  <div>Your email must be verified</div>
  <div>
    <Link method="post" as="button" class="underline cursor-pointer text-indigo-500" :href="route('verification.send')">Resend Verification Link</Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script> 