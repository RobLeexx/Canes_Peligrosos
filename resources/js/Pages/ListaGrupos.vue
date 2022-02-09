<template>
    <app-layout>
    
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Grupo {{ grupo.id }}
            </h2>
        </template>
<v-app>
        <div class="py-12" style="background: #4a6813">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <v-row style="padding: 20px">
                        <v-col cols="12" sm="6">
                            Tipo de Capacitación: {{ grupo.tipo }}
                        </v-col>
                        <v-col cols="12" sm="6">
                            Turno: {{ grupo.turno }} ({{ grupo.horario }})
                        </v-col>
                        <v-col cols="12" sm="6">
                            Fechas: desde el {{ grupo.inicio }} hasta el {{ grupo.fin }}
                        </v-col>
                        <v-col cols="12" sm="6">
                            Estado: {{ grupo.estado }}
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                    <h1 style="
                            display: flex;
                            justify-content: center;
                            font-size: x-large;
                            padding: 50px" >
                            Asistencia</h1>
                    <template>
                        <v-stepper
                            v-model="e6"
                            vertical
                        >
                            <v-stepper-step
                            :complete="e6 > 1"
                            step="1"
                            editable
                            >
                            Día 1
                            </v-stepper-step>

                            <v-stepper-content step="1">
                            <v-divider></v-divider>
                            <v-data-table style="padding-inline: 20px"
                            :headers="headers"
                            :items="caps"
                            show-select
                            hide-default-footer>
                            </v-data-table>
                            <div style="padding: 20px">
                                <v-btn
                                    color="primary"
                                    @click="e6 = 2"
                                >
                                    Día Siguiente
                                </v-btn>
                            </div>
                            </v-stepper-content>
                            <v-stepper-step
                            :complete="e6 > 2"
                            step="2"
                            editable
                            >
                            Día 2
                            </v-stepper-step>

                            <v-stepper-content step="2">
                            <v-divider></v-divider>
                            <v-data-table style="padding-inline: 20px"
                            :headers="headers"
                            :items="caps"
                            show-select
                            hide-default-footer>
                            </v-data-table>
                            <div style="padding: 20px">
                                <v-btn
                                    color="primary"
                                    @click="e6 = 3"
                                >
                                    Día Siguiente
                                </v-btn>
                                <v-btn text @click="e6 = 1">
                                    Día Anterior
                                </v-btn>
                            </div>
                            </v-stepper-content>
                            <v-stepper-step
                            :complete="e6 > 3"
                            step="3"
                            editable
                            >
                            Día 3
                            </v-stepper-step>

                            <v-stepper-content step="3">
                            <v-divider></v-divider>
                            <v-data-table style="padding-inline: 20px"
                            :headers="headers"
                            :items="caps"
                            show-select
                            hide-default-footer>
                            </v-data-table>
                            <div style="padding: 20px">
                                <v-btn
                                    color="primary"
                                    @click="e6 = 4"
                                >
                                    Día Siguiente
                                </v-btn>
                                <v-btn text @click="e6 = 2">
                                    Día Anterior
                                </v-btn>
                            </div>
                            </v-stepper-content>

                            <v-stepper-step
                            :complete="e6 > 4"
                            step="4"
                            editable
                            >
                            Día 4
                            </v-stepper-step>

                            <v-stepper-content step="4">
                            <v-divider></v-divider>
                            <v-data-table style="padding-inline: 20px"
                            :headers="headers"
                            :items="caps"
                            show-select
                            hide-default-footer>
                            </v-data-table>
                            <div style="padding: 20px">
                                <v-btn
                                    color="primary"
                                    @click="e6 = 5"
                                >
                                    Día Siguiente
                                </v-btn>
                                <v-btn text @click="e6 = 3">
                                    Día Anterior
                                </v-btn>
                            </div>
                            </v-stepper-content>
                            <v-stepper-step
                            :complete="e6 > 5"
                            step="5"
                            editable
                            >
                            Día 5
                            </v-stepper-step>

                            <v-stepper-content step="5">
                            <v-divider></v-divider>
                            <v-data-table style="padding-inline: 20px"
                            :headers="headers"
                            :items="caps"
                            show-select
                            hide-default-footer>
                            </v-data-table>
                            <div style="padding: 20px">
                                <v-btn
                                    color="primary"
                                    @click="e6 = 6"
                                >
                                    Día Siguiente
                                </v-btn>
                                <v-btn text @click="e6 = 4">
                                    Día Anterior
                                </v-btn>
                            </div>
                            </v-stepper-content>
                            <v-stepper-step
                            :complete="e6 > 6"
                            step="6"
                            editable
                            >
                            Día 6
                            </v-stepper-step>

                            <v-stepper-content step="6">
                            <v-divider></v-divider>
                            <v-data-table style="padding-inline: 20px"
                            :headers="headers"
                            :items="caps"
                            show-select
                            hide-default-footer>
                            </v-data-table>
                            <div style="padding: 20px">
                                <v-btn
                                    color="primary"
                                    @click="e6 = 7"
                                >
                                    Día Siguiente
                                </v-btn>
                                <v-btn text @click="e6 = 5">
                                    Día Anterior
                                </v-btn>
                            </div>
                            </v-stepper-content>
                            <v-stepper-step
                            :complete="e6 > 7"
                            step="7"
                            editable
                            >
                            Día 7
                            </v-stepper-step>
                            <v-stepper-content step="7">
                            <v-divider></v-divider>
                            <v-data-table style="padding-inline: 20px"
                            :headers="headers"
                            :items="caps"
                            show-select
                            hide-default-footer>
                            </v-data-table>
                            <div style="padding: 20px">
                                <v-btn
                                    color="primary"
                                    @click="e6 = 8"
                                >
                                    Día Siguiente
                                </v-btn>
                                <v-btn text @click="e6 = 6">
                                    Día Anterior
                                </v-btn>
                            </div>
                            </v-stepper-content>
                            <v-stepper-step
                            :complete="e6 > 8"
                            step="8"
                            editable
                            >
                            Observaciones Finales
                            </v-stepper-step>

                            <v-stepper-content step="8">
                            <v-divider></v-divider>
                            <v-card style="padding: 50px">
                                <v-col cols="12" sm="12" style="text-align:center">
                                    Observaciones
                                </v-col>
                                <v-row v-for="cap in caps" :key="cap.id">
                                    <v-col cols="12" sm="3">
                                        <div style="padding: 25px">{{ cap.paterno }}</div>
                                    </v-col>
                                    <v-col cols="12" sm="9">
                                        <v-text-field outlined></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-card>
                            <div style="padding-top: 20px; display: flex">
                                <v-btn
                                    color="primary"
                                    @click="submitData"
                                    :disabled="finDate"
                                >
                                    Finalizar
                                </v-btn>
                                <h1 v-if="finDate" style="padding-left: 10px; padding-top: 5px">
                                    Puede finalizar {{ dias }} ({{ this.grupo.fin }})
                                </h1>
                            </div>
                            </v-stepper-content>
                        </v-stepper>
                        </template>
                </div>
            </div>
        </div>
    </v-app>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import moment from 'moment'
    
    export default {
        props: {
            grupo: Object,
            propietarios: Array,
            capacitaciones: Array,
        },
        data: function() {
            return{
                e6: 1,
                caps:[],
                dias: [],
                headers: [{ text: "GRUPO", value: "id", sortable: true, align: 'center' },
                        { text: "PATERNO", value: "paterno", sortable: true},
                        { text: "MATERNO", value: "materno", sortable: true},
                        { text: "CONTACTO", value: "celular", sortable: true },
                        { text: "OBSERVACIONES", value: "observaciones", sortable: true },
                        { text: "DOCUMENTO", value: "documento", sortable: true},
                        { text: 'ACCIONES', value: 'actions', sortable: false, align: 'center' }],
            }
        },
        created () {
            /* Merge Capacitaciones y Propietarios */
            let mergedSubjects = this.propietarios.map(subject => {
            let otherSubject = this.capacitaciones.find(element => element.id === subject.id)
            const reg = {...subject, ...otherSubject}
            this.caps.push(reg)

            this.dias = moment(this.grupo.fin, "YYYY-MM-DD").locale('es').fromNow()
        })
        },
        computed: {
            finDate(){
                var today = new Date();
                var fin = new Date(this.grupo.fin);
                var diferencia = fin.getDate()+1 - today.getDate();
                if(diferencia > 0){
                    return true;
                }
                else{
                    return false;
                }
            },
        },
        methods: {
            submitData() {
                /* subir datos */
                this.$inertia.put(route('grupos.update', this.grupo.id));
            },
            reenviarRegistros() {
                    this.caps = this.caps.map(this.getDisplayRegistros);
                },
            getDisplayRegistros(caps) {
                return {
                    id: caps.id,
                    paterno: caps.paterno,
                    materno: caps.materno,
                    celular: caps.celular,
                    observaciones: caps.observaciones,
                    documento: caps.documento,
                };
            },
            formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            },
        },
        mounted(){
            this.reenviarRegistros();
        },
        components: {
            AppLayout,
            moment,
        },
    }
</script>