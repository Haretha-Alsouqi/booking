<template>
  <div class="border p-4 rounded shadow mb-4 flex justify-between w-full">
    <div>
      <h2 class="text-xl">{{ event.title }}</h2>
      <p>Date: {{ event.date }}</p>
    </div>

    <div v-if="event.discount">
      <p v-if="event.discount.discount_percent">Discount: %{{ event.discount.discount_percent }}</p>
      <p>Price: {{ event.discount.discounted_price }}</p>
    </div>

    <div v-if="!event.discount">
      <p>Price: {{ event.price }}</p>
    </div>

    <button
      v-if="!userPage && event.available"
      @click="$emit('book', event.id)"
      :disabled="loading"
      class="mt-2 bg-blue-600 text-white px-4 py-2 rounded"
    >
      {{ loading ? 'Booking...' : 'Book Now' }}
    </button>

    <button
      v-if="!userPage && !event.available"
      :disabled="true"
      class="mt-2 bg-red-600 text-white px-4 py-2 rounded"
    >
      Closed
    </button>
  </div>
</template>

<script setup>
defineProps(['event', 'loading', 'userPage'])
defineEmits(['book'])
</script>
