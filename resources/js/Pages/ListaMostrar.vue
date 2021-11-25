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
                    <v-row style="height: 100%; padding: 50px; display: flex; justify-content: space-around;">
                        <div style="display: flex; flex-direction: column; width: 50%">
                            <h1 style="text-align: center; padding: 20px; font-size: large; font-weight: bold">PROPIETARIO</h1>
                            <v-row style="display: flex;justify-content: space-evenly">
                                <div></div>
                                <img style="max-width: 60%; padding-bottom: 15px" v-bind:src="'/storage/images/photos/' + propietario.fotoProp">
                                <div></div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 15%">
                                <div style="padding: 20px; font-weight: bold">
                                    Nombres
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.nombres }}
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 15%">
                                <div style="padding: 20px; font-weight: bold">
                                    Apellido Paterno
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.paterno }}
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 15%">
                                <div style="padding: 20px; font-weight: bold">
                                    Apellido Materno
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.materno }}
                                </div>
                            </v-row>
                        </div>
                        <div style="display: flex; flex-direction: column; width: 50%">
                            <div v-for="can in canes" :key="can.id">
                            <div v-if="propietario.id == can.id">
                                <h1 style="text-align: center; padding: 20px; font-size: large; font-weight: bold">CAN</h1>
                                <v-row style="display: flex; justify-content: space-evenly">
                                    <div></div>
                                    <img style="max-width: 60%; min-height: 280px; padding-bottom: 15px" v-if="can.fotoCan != null" v-bind:src="'/storage/images/photos/' + can.fotoCan">
                                    <img style="max-width: 60%; min-height: 280px; padding-bottom: 15px" v-else v-bind:src="'/storage/images/photos/' + can.fotoCan2">
                                    <div></div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 15%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Nombre del Can
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.nomPerro }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 15%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Raza
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.razaCan }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 15%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Apellido Materno
                                    </div>
                                    <div style="padding: 20px">
                                        {{ propietario.materno }}
                                    </div>
                                </v-row>
                            </div>
                            </div>
                        </div>
                    </v-row>
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <!--<div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <tr style="display: flex">
                                <td class="px-6 py-20 whitespace-nowrap">
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
                                                <v-btn :href="route('download', memorial.memoFile)"
                                                >{{ memorial.memoFile }}</v-btn>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </div>
                    </div>-->
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