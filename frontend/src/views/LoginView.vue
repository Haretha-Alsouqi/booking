<template>
  <div class="p-4 max-w-md mx-auto">
    <h2 class="text-xl font-bold mb-4">Login</h2>
    <form @submit.prevent="login">
      <input v-model="email" type="email" placeholder="Email" class="input" />
      <input v-model="password" type="password" placeholder="Password" class="input mt-2" />
      <button class="btn mt-4" type="submit">Login</button>
      <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '@/api'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const error = ref(null)
const auth = useAuthStore()
const router = useRouter()

const login = async () => {
  try {
    const res = await api.post('/login', { email: email.value, password: password.value })
    auth.login(res.data.access_token)
    router.push('/')
  } catch (e) {
    error.value = 'Login failed'
  }
}
</script>
