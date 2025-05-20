<template>
  <div class="flex flex-col gap-10">
    <div class="flex justify-between">
      <router-link v-if="auth.isLoggedIn" to="/">
        <button class="cursor-pointer">Events</button>
      </router-link>

      <button v-if="auth.isLoggedIn" @click="logout" class="mb-4 text-sm cursor-pointer">Logout
      </button>
    </div>

    <div>
      <h1 class="text-2xl font-bold mb-4">My Bookings</h1>

      <div v-if="loading">Loading bookings...</div>
      <div v-if="error" class="text-red-500">{{ error }}</div>

      <div class="flex flex-col gap-5">
        <EventCard
          v-for="booking in bookings"
          :key="booking.id"
          :event="booking.event"
          :userPage="true"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import {ref, onMounted} from 'vue'
import {useAuthStore} from '@/stores/auth'
import {useRouter} from 'vue-router'
import api from '@/api'
import EventCard from '@/components/EventCard.vue'

const bookings = ref([])
const loading = ref(true)
const error = ref(null)
const router = useRouter()
const auth = useAuthStore()

const fetchBookings = async () => {
  try {
    const res = await api.get('/bookings')
    bookings.value = res.data
  } catch (e) {
    error.value = 'Failed to load bookings'
  } finally {
    loading.value = false
  }
}

const logout = () => {
  auth.logout()
  router.push('/login')
}

onMounted(fetchBookings)
</script>
