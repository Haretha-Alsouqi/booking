<script setup>
import EventForm from './Form.vue'
defineProps({ event: Object })
</script>

<template>
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Event</h1>
        <EventForm :event="event" />
    </div>
</template>
