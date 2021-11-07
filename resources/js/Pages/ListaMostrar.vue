<template>
    <app-layout>
    <v-app>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mostrar
            </h2>
        </template>

        <div class="py-12" style="background: #33691E">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                </div>
            </div>
        </div>
    </v-app>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            memorials: Array
        },
        components: {
            AppLayout,
        },
    }
</script>