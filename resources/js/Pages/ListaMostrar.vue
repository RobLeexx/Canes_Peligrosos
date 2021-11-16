<template>
    <app-layout>
        <template #header>
            <v-row>
                <v-btn fab small text :href="route('registros.index')"><v-icon>mdi-arrow-left-circle</v-icon></v-btn>
                <div style="padding: 9px">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ propietario.paterno }}
                </h2>
                </div>
            </v-row>
        </template>

        <v-app>
        <div class="py-12" style="background: #33691E">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <tr style="display: flex">
                                <td class="px-6 py-10 whitespace-nowrap">
                                    <div class="flex items-center">
                                    <div class="ml-4" style="height: 100px; padding-top: 8.5px">
                                        <div class="text-sm font-medium text-gray-900">
                                        {{ propietario.id }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                        {{ propietario.materno}}
                                        </div>
                                        <div v-for="can in canes" :key="can.id">
                                            <div v-if="propietario.id == can.id">
                                                <div class="text-sm text-gray-500">
                                                    {{ can.raza }}
                                                </div>
                                                <div class="flex-shrink-0 h-10 w-15">
                                                    <img class="h-10 w-15 rounded-full" v-if="can.fotoCan != null" v-bind:src="'/storage/images/photos/' + can.fotoCan">
                                                    <img class="h-10 w-15 rounded-full" v-else v-bind:src="'/storage/images/photos/' + can.fotoCan2">
                                                </div>
                                            </div>
                                        </div>

                                        <div v-for="memorial in memoriales" :key="memorial.id" style="height: 50px">
                                            <div v-if="propietario.id == memorial.id">
                                                <v-btn 
                                                >{{ memorial.memoFile }}</v-btn>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </div>
                    </div>
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
            propietario: Object,
            memoriales: Array,
            canes: Array,
        },
        methods: {
        },
        components: {
            AppLayout,
        },
    }
</script>