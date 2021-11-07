<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de propietarios
            </h2>
        </template>

        <v-app>
        <div class="py-12" style="background: #33691E">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="padding-left: 10px">
                    <v-btn 
                    fab
                    color="primary"
                    :href="route('memorials.create')"
                    ><v-icon>mdi-plus</v-icon>
                </v-btn>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr style="display: flex">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" :width="anchoProp">
                                        Propietario
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider d-none d-sm-block" :width="anchoCan">
                                        Can
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider d-none d-md-block" :width="anchoCap">
                                        Capacitación
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider d-none d-md-block" :width="anchoTel">
                                        Teléfono
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Editar</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr style="display: flex" v-for="memorial in memorials" :key="memorial.id">
                                    <td class="px-6 py-4 whitespace-nowrap" :width="anchoProp">
                                        <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{ $page.props.user.username }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ memorial.comandante }}
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap d-none d-sm-block" :width="anchoCan">
                                        <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{ memorial.referencia }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ memorial.dateMemo }}
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap d-none d-md-block" :width="anchoCap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" style="margin-left: 10px; margin-top: 15px">
                                        Terminada
                                        </span>
                                    </td>
                                    <td class="px-10 py-4 text-sm text-gray-500 d-none d-md-block" style="margin-top: 15px; padding-left: 25px !important" :width="anchoTel">
                                        67163603
                                    </td>
                                    <td class="px-1 py-4 whitespace-nowrap text-right text-sm font-medium d-none d-sm-block">
                                        <v-btn fab text><v-icon>mdi-eye</v-icon></v-btn>
                                        <v-btn fab text><v-icon>mdi-pencil</v-icon></v-btn>
                                    </td>
                                    <td class="px-1 py-4 whitespace-nowrap text-right text-sm font-medium d-block d-sm-none" style="padding: 0 !important">
                                        <v-col style="display: flex; flex-direction: column; padding: 0">
                                            <v-btn fab text><v-icon>mdi-eye</v-icon></v-btn>
                                            <v-btn fab text><v-icon>mdi-pencil</v-icon></v-btn>
                                        </v-col>
                                    </td>
                                </tr>
                                <!-- More people... -->
                            </tbody>
                            </table>
                        </div>
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
            memorials: Array
        },
        data: function () {
            return {
            }
        },
        computed: {
            anchoProp() {
            switch (this.$vuetify.breakpoint.name) {
                case 'xs': return 250
                case 'sm': return 300
                case 'md': return 280
                case 'lg': return 350
            }
            },
            anchoCan() {
            switch (this.$vuetify.breakpoint.name) {
                case 'sm': return 300
                case 'md': return 230
                case 'lg': return 280
            }
            },
            anchoCap() {
            switch (this.$vuetify.breakpoint.name) {
                case 'md': return 160
                case 'lg': return 200
            }
            },
            anchoTel() {
            switch (this.$vuetify.breakpoint.name) {
                case 'md': return 160
                case 'lg': return 200
            }
            },
        },
        components: {
            AppLayout,
        },
    }
</script>
