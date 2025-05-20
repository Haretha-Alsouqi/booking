<template>
  <div class="flex flex-col gap-10">
    <div class="flex justify-between">
      <router-link v-if="!auth.isLoggedIn" to="/login" class="cursor-pointer">
        <button class="cursor-pointer">Login</button>
      </router-link>

      <router-link v-if="auth.isLoggedIn" to="/bookings">
        <button class="cursor-pointer">My Bookings</button>
      </router-link>

      <button v-if="auth.isLoggedIn" @click="logout" class="mb-4 text-sm cursor-pointer">Logout</button>
    </div>

    <div>
      <h1 class="text-2xl font-bold mb-4">Events</h1>

      <div v-if="loading">Loading events...</div>
      <div v-if="error" class="text-red-500">{{ error }}</div>

      <div class="flex flex-col gap-5">
        <EventCard
          v-for="event in events"
          :key="event.id"
          :event="event"
          @book="bookEvent"
          :loading="booking[event.id]"
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
    await api.post('/bookings', {'event_id': eventId})
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
