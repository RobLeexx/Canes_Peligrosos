<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <table class="table-auto">
                        <thead class="bg-indigo-500 text-white">
                            <th>Nombre</th>
                            <th>Email</th>
                        </thead>
                        <tbody>
                            <tr v-for="usuario in usuarios" :key="usuario.id">
                                <td>{{usuario.name}}</td>
                                <td>{{usuario.email}}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: ['usuarios']
    }
</script>
