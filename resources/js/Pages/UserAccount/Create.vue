<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: null,
  email: null,
  password: null,
  password_confirmation: null,
})

const register = () => form.post(route('user-account.store'))
</script>

<template>
  <form class="w-1/2 mx-auto flex flex-col gap-5" @submit.prevent="register">
    <div>
      <label class="label" for="name">Your name</label>
      <input id="name" v-model="form.name" type="text" class="input-text" />
    </div>
    <div>
      <label class="label" for="email">Email</label>
      <input id="email" v-model="form.email" type="text" class="input-text" />
      <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
    </div>
    <div>
      <label class="label" for="password">Password</label>
      <input id="password" v-model="form.password" type="password" class="input-text" />
      <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
    </div>
    <div>
      <label class="label" for="password_confirmation">Confirm Password</label>
      <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="input-text" />
    </div>
    <div>
      <button type="submit" class="btn-primary w-full">Create Account</button>
    </div>
  </form>
</template>