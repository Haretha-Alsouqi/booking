<script setup>

defineProps({users: Array})

</script>

<template>
    <div>
        <h1 class="text-2xl mb-4">Users</h1>

        <table class="mt-4 w-full border-2 table-auto">
            <thead>
            <tr>
                <th>Name</th>
                <th>email</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id" class="text-center border-1">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
