<template>
  <div class="border p-4 rounded shadow mb-4 columns-3">
    <h2 class="text-xl">{{ event.title }}</h2>

    <div>
      <p>Date: {{ event.date }}</p>
      <p>Price: {{ event.price }}</p>
    </div>

    <button
      @click="$emit('book', event.id)"
      :disabled="loading || !event.is_available"
      class="mt-2 bg-blue-600 text-white px-4 py-2 rounded"
    >
      {{ loading ? 'Booking...' : 'Book Now' }}
    </button>
  </div>
</template>

<script setup>
defineProps(['event', 'loading'])
defineEmits(['book'])
</script>
