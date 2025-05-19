<script setup>
import {Link, router} from '@inertiajs/vue3'

defineProps({events: Array})

const deleteEvent = (id) => {
    if (confirm('Are you sure?')) {
        router.delete(`/events/${id}`)
    }
}
</script>

<template>
    <div>
        <h1 class="text-2xl mb-4">Events</h1>
        <Link href="/events/create" class="btn">Create New</Link>

        <table class="mt-4 w-full border-2 table-auto">
            <thead>
            <tr>
                <th>Title</th>
                <th>Capacity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="event in events" :key="event.id" class="text-center border-1">
                <td>{{ event.title }}</td>
                <td>{{ event.capacity }}</td>
                <td>{{ event.price }}</td>
                <td>{{ event.date }}</td>
                <td>
                    <Link :href="`/events/${event.id}/edit`" class="p-1">Edit</Link>
                    <button @click="deleteEvent(event.id)" class="ml-5 p-1">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
