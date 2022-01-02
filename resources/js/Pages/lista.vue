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
                            <v-select v-model="depFil"
                                placeholder="Todos los Departamentos"
                                outlined
                                clearable
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
                        <!--
                            <div v-for="registro in registros.slice().reverse()" :key="registro.id">
                            <v-row v-if="registro.id %2 == 0" style="margin: 0; border-radius: 10px">
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
                            <v-row v-else style="background: #EFEDED; margin: 0; border-radius: 10px">
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
                         -->
                    <v-data-table style="padding: 20px"
                    :headers="headers"
                    :items="registros"
                    :custom-sort="customSort"
                    :search="search"
                    no-data-text="Sin Datos"
                    no-results-text="Sin Resultados"
                    :footer-props="{'items-per-page-options':[5,10,15,30],'items-per-page-text':'Usuarios por Página','pageText':'{0}-{1} de {2}'}">
                        <template v-slot:item.propietarioDatos="{ item }">
                            <div style="display: flex; align-items: center; height: 60px">
                                <img style="border-radius: 30px; max-width: 50px; min-width: 50px" v-bind:src="'/storage/images/propietarios/' + item.fotoProp">
                                <div style="padding-inline: 10px">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ item.paterno }} {{ item.materno }}, {{ item.nombres }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ item.documento }} {{ item.docExp }}
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-slot:item.canDatos="{ item }">
                            <div style="display: flex; align-items: center; height: 60px">
                                <img style="border-radius: 30px; max-width: 50px; min-width: 50px; max-height: 50px" v-if="item.fotoCan != null" v-bind:src="'/storage/images/canes/' + item.fotoCan">
                                <img style="border-radius: 30px; max-width: 50px; min-width: 50px" v-else-if="item.fotoCan2 != null" v-bind:src="'/storage/images/canes/' + item.fotoCan2">
                                <div style="padding-inline: 10px">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ item.can }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ item.raza }}
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-slot:item.docExp="{ item }">
                            <v-chip
                                :color="getColor(item.docExp)"
                                dark>
                                {{ item.docExp }}
                            </v-chip>
                        </template>
                    </v-data-table>
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
                depFil: 'La Paz',
                search: '',
                registros: [],
                headers: [{ text: "PROPIETARIO", value: "propietarioDatos", sortable: false },
                        { text: "CAN", value: "canDatos", sortable: false },
                        { text: "CAPACITACIÓN", value: "docExp", sortable: false, align: 'center' },
                        { text: "C.A.C", value: "departamento", sortable: false, filter: this.depFilter }],
                dep: ['La Paz', 'Cochabamba', 'Santa Cruz', 'Chuquisaca', 'Oruro', 'Potosí', 'Tarija', 'Beni', 'Pando'],
            }
        },
        created () {
            let mergedSubjects = this.propietarios.map(subject => {
            let otherSubject = this.canes.find(element => element.id === subject.id)
            const reg = {...subject, ...otherSubject}
            this.registros.push(reg)
        })
        },
        methods: {
            depFilter(value) {
            if (!this.depFil) {
            return true;
            }
            return value === this.depFil;
            },

            reenviarRegistros() {
                this.registros = this.registros.map(this.getDisplayRegistros);
            },
            getDisplayRegistros(registro) {
                const space = ' '
                const propDatos = registro.paterno.concat(space,registro.materno,space,registro.documento)
                console.log(propDatos)
            return {
                id: registro.id,
                propietarioDatos: propDatos,
                fotoProp: registro.fotoProp,
                paterno: registro.paterno,
                materno: registro.materno,
                nombres: registro.nombres,
                documento: registro.documento,
                docExp: registro.docExp,

                fotoCan: registro.fotoCan,
                fotoCan2: registro.fotoCan2,
                can: registro.nomPerro,
                raza: registro.razaCan,

                departamento: registro.departamento,
            };
            },
            customSort(items, index, isDesc) {
            items.sort((a, b) => {
                if (index === "desc") {
                if (!isDesc) {
                    return dateHelp.compare(a.desc, b.desc);
                } else {
                    return dateHelp.compare(b.desc, a.desc);
                }
                } else {
                if (!isDesc) {
                    return a[index] < b[index] ? -1 : 1;
                } else {
                    return b[index] < a[index] ? -1 : 1;
                }
                }
            });
            return items;
            },
            getColor (cap) {
                if (cap != 'LP') return 'green'
                else return 'orange'
            },
        },
        mounted() {
            this.reenviarRegistros();
        },
        computed: {
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
