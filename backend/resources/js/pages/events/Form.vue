<script setup>
import { useForm } from '@inertiajs/vue3'
const props = defineProps(['event'])
const form = useForm({
    title: props.event?.title || '',
    capacity: props.event?.capacity || '',
    price: props.event?.price || '',
    date: props.event?.date || ''
})

const submit = () => {
    if (props.event) {
        form.put(`/events/${props.event.id}`)
    } else {
        form.post('/events')
    }
}
</script>

<template>
    <form @submit.prevent="submit" class="space-y-4">
        <div>
            <label class="block font-medium">Title</label>
            <input v-model="form.title" type="text" class="border p-2 w-full rounded" />
        </div>
        <div>
            <label class="block font-medium">Capacity</label>
            <input v-model="form.capacity" class="border p-2 w-full rounded" />
        </div>
        <div>
            <label class="block font-medium">Price</label>
            <input v-model="form.price" class="border p-2 w-full rounded" />
        </div>
        <div>
            <label class="block font-medium">Date</label>
            <input v-model="form.date" type="date" class="border p-2 w-full rounded" />
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
</template>
