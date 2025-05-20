<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Events</h1>

    <div v-if="loading">Loading events...</div>
    <div v-if="error" class="text-red-500">{{ error }}</div>

    <EventCard
      v-for="event in events"
      :key="event.id"
      :event="event"
      @book="bookEvent"
      :loading="booking[event.id]"
    />
  </div>

  <button v-if="auth.isLoggedIn" @click="logout" class="mb-4 text-sm underline">Logout</button>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import api from '@/api'
import EventCard from '@/components/EventCard.vue'

const events = ref([])
const loading = ref(true)
const error = ref(null)
const booking = ref({})
const router = useRouter()
const auth = useAuthStore()

const fetchEvents = async () => {
  try {
    const res = await api.get('/events')
    events.value = res.data
  } catch (e) {
    error.value = 'Failed to load events'
  } finally {
    loading.value = false
  }
}

const bookEvent = async (eventId) => {
  if (!auth.isLoggedIn) {
    router.push('/login')
    return
  }

  booking.value[eventId] = true
  try {
    await api.post('/bookings', { eventId })
    alert('Booking successful!')
  } catch (err) {
    alert('Booking failed.')
  } finally {
    booking.value[eventId] = false
  }
}

const logout = () => {
  auth.logout()
  router.push('/login')
}

onMounted(fetchEvents)
</script>
