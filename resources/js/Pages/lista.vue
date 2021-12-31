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
                <div style="padding-left: 10px; position: absolute; top: 10px">
                    <v-btn 
                    fab
                    color="primary"
                    :href="route('registros.create')"
                    ><v-icon>mdi-plus</v-icon>
                </v-btn>
                </div>
                  <v-card style="box-shadow: 0px 0px 30px; border-radius: 10px; position: initial">
                    <v-card-title style="padding: 0; padding-inline: 20px">
                        <v-col cols="12" sm="4" style="margin-top: 30px; padding: 0">
                            <v-select v-model="depPred"
                            outlined
                            :items="dep"
                            persistent-hint
                            return-object
                            single-line>
                            </v-select>
                        </v-col>
                        <v-col cols="12" sm="8">
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Buscar"
                                outlined
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-col>
                    </v-card-title>
                    <div>
                        <v-row style="padding: 15px; background: #EFEDED; margin: 0">
                            <v-col cols="12" sm="4" class="text-xs font-medium text-gray-500">
                                PROPIETARIOS
                            </v-col>
                            <v-col cols="12" sm="3" class="text-xs font-medium text-gray-500">
                                CANES
                            </v-col>
                            <v-col cols="12" sm="1" style="display: flex; justify-content: center; padding-left: 15px" class="text-xs font-medium text-gray-500">
                                CAPACITACIÓN
                            </v-col>
                            <v-col cols="12" sm="2" style="display: flex; justify-content: center; padding-left: 25px" class="text-xs font-medium text-gray-500">
                                CONTACTO
                            </v-col>
                            <v-col cols="12" sm="2" style="display: flex; justify-content: center; padding-left: 35px" class="text-xs font-medium text-gray-500">
                                ACCIONES
                            </v-col>
                        </v-row>

                        <div v-if="depPred == 'Todos'">
                            <div v-for="registro in propFilter" :key="registro.id">
                                <v-row v-if="registro.id %2 == 0" style="background: #EFEDED; margin: 0; border-radius: 10px">
                                    <v-col cols="12" sm="4" style="display: flex; align-items: center">
                                        <img style="border-radius: 30px; max-width: 50px; min-width: 50px" v-bind:src="'/storage/images/propietarios/' + registro.fotoProp">
                                        <div style="padding-inline: 10px">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{ registro.paterno }} {{ registro.materno }} , {{ registro.nombres }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ registro.documento }} {{ registro.docExp }}
                                            </div>
                                        </div>
                                    </v-col>
                                    <v-col cols="12" sm="3" style="display: flex; align-items: center">
                                        <img style="border-radius: 30px; max-width: 50px; min-width: 50px; max-height: 50px" v-if="registro.fotoCan != null" v-bind:src="'/storage/images/canes/' + registro.fotoCan">
                                        <img style="border-radius: 30px; max-width: 50px; min-width: 50px" v-else-if="registro.fotoCan2 != null" v-bind:src="'/storage/images/canes/' + registro.fotoCan2">
                                        <div style="padding-inline: 10px">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{ registro.nomPerro }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ registro.razaCan }}
                                            </div>
                                        </div>
                                    </v-col>
                                    <v-col cols="12" sm="1" style="display: flex; align-items: center; justify-content: center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Terminada
                                        </span>
                                    </v-col>
                                    <v-col cols="12" sm="2" style="display: flex; align-items: center; justify-content: center">
                                        <div v-if="registro.celular" class="text-sm font-medium text-gray-900">
                                            {{ registro.celular }}
                                        </div>
                                        <div v-else-if="registro.telefono" class="text-sm font-medium text-gray-900">
                                            {{ registro.telefono }}
                                        </div>
                                        <div v-else-if="registro.email" class="text-sm font-medium text-gray-900">
                                            {{ registro.email }}
                                        </div>
                                        <div v-else-if="registro.contactoAlterno" class="text-sm font-medium text-gray-900">
                                            {{ registro.contactoAlterno }}
                                        </div>
                                    </v-col>
                                    <v-col cols="12" sm="2" style="display: flex; align-items: center; justify-content: center">
                                        <v-btn fab text :href="route('registros.show', registro.id)"><v-icon>mdi-eye</v-icon></v-btn>
                                        <v-btn fab text :href="route('registros.show', registro.id)"><v-icon>mdi-pencil</v-icon></v-btn>
                                    </v-col>
                                </v-row>
                                <v-row v-else style="margin: 0; border-radius: 10px">
                                    <v-col cols="12" sm="4" style="display: flex; align-items: center">
                                        <img style="border-radius: 30px; max-width: 50px; min-width: 50px" v-bind:src="'/storage/images/propietarios/' + registro.fotoProp">
                                        <div style="padding-inline: 10px">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{ registro.paterno }} {{ registro.materno }} , {{ registro.nombres }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ registro.documento }} {{ registro.docExp }}
                                            </div>
                                        </div>
                                    </v-col>
                                    <v-col cols="12" sm="3" style="display: flex; align-items: center">
                                        <img style="border-radius: 30px; max-width: 50px; min-width: 50px; max-height: 50px" v-if="registro.fotoCan != null" v-bind:src="'/storage/images/canes/' + registro.fotoCan">
                                        <img style="border-radius: 30px; max-width: 50px; min-width: 50px" v-else-if="registro.fotoCan2 != null" v-bind:src="'/storage/images/canes/' + registro.fotoCan2">
                                        <div style="padding-inline: 10px">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{ registro.nomPerro }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ registro.razaCan }}
                                            </div>
                                        </div>
                                    </v-col>
                                    <v-col cols="12" sm="1" style="display: flex; align-items: center; justify-content: center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Terminada
                                        </span>
                                    </v-col>
                                    <v-col cols="12" sm="2" style="display: flex; align-items: center; justify-content: center">
                                        <div v-if="registro.celular" class="text-sm font-medium text-gray-900">
                                            {{ registro.celular }}
                                        </div>
                                        <div v-else-if="registro.telefono" class="text-sm font-medium text-gray-900">
                                            {{ registro.telefono }}
                                        </div>
                                        <div v-else-if="registro.email" class="text-sm font-medium text-gray-900">
                                            {{ registro.email }}
                                        </div>
                                        <div v-else-if="registro.contactoAlterno" class="text-sm font-medium text-gray-900">
                                            {{ registro.contactoAlterno }}
                                        </div>
                                    </v-col>
                                    <v-col cols="12" sm="2" style="display: flex; align-items: center; justify-content: center">
                                        <v-btn fab text :href="route('registros.show', registro.id)"><v-icon>mdi-eye</v-icon></v-btn>
                                        <v-btn fab text :href="route('registros.show', registro.id)"><v-icon>mdi-pencil</v-icon></v-btn>
                                    </v-col>
                                </v-row>
                            </div>
                        </div>
                        <div v-else>
                            Sin Resultados
                        </div>
                    </div>
                </v-card>
            </div>
        </div>
        </v-app>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            propietarios: Array,
            canes: Array,
        },
        data: function () {
            return {
                search: '',
                propietarios: '',
                registros: [],
                depPred: 'Todos',
                dep: ['Todos', 'La Paz', 'Cochabamba', 'Chuquisaca', 'Oruro', 'Potosí', 'Tarija', 'Beni', 'Pando'],
                headers: [
                {
                    text: 'PROPIETARIOS',
                    align: 'start',
                    sortable: false,
                    value: 'paterno',
                },
                { text: 'CAN', value: 'nomPerro', sortable: false },
                { text: 'CAPACITACIÓN', value: 'cap', sortable: false },
                { text: 'CONTACTO', value: 'celular', sortable: false },
                ],
            }
        },
        created () {
            let mergedSubjects = this.propietarios.map(subject => {
                    let otherSubject = this.canes.find(element => element.id === subject.id)
                    const reg = {...subject, ...otherSubject}
                    this.registros.push(reg)
                    console.log(this.registros);
                })
        },
        methods: {
        },
        computed: {
            propFilter:function(){
                return this.registros.filter((registro) => {
                    return registro.nombres.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.paterno.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.materno.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.documento.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.docTipo.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.docExp.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.departamento.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.provincia.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.municipio.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.domicilio.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.estCivil.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.dateProp.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.profesion.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.zona.toLowerCase().indexOf(this.search.toLowerCase()) != -1

                    || registro.nomPerro.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    || registro.razaCan.toLowerCase().indexOf(this.search.toLowerCase()) != -1
                    ;
                });
            },
            anchoProp() {
            switch (this.$vuetify.breakpoint.name) {
                case 'xs': return 320
                case 'sm': return 340
                case 'md': return 350
                case 'lg': return 420
                case 'xl': return 420
            }
            },
            anchoCan() {
            switch (this.$vuetify.breakpoint.name) {
                case 'sm': return 300
                case 'md': return 200
                case 'lg': return 240
                case 'xl': return 240
            }
            },
            anchoCan2() {
            switch (this.$vuetify.breakpoint.name) {
                case 'sm': return 300
                case 'md': return 200
                case 'lg': return 202
                case 'xl': return 210
            }
            },
            anchoCap() {
            switch (this.$vuetify.breakpoint.name) {
                case 'md': return 160
                case 'lg': return 210
                case 'xl': return 210
            }
            },
            anchoTel() {
            switch (this.$vuetify.breakpoint.name) {
                case 'md': return 160
                case 'lg': return 200
                case 'xl': return 200   
            }
            },
        },
        components: {
            AppLayout,
        },
    }
</script>
