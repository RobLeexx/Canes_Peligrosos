<template>
    <app-layout v-if="($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Capacitador')">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis capacitaciones
            </h2>
        </template>

        <v-app>
        <div class="py-12" style="background: #33691E">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="padding-left: 10px; position: absolute; top: 10px">
                    <v-dialog
                    v-model="dialog"
                    persistent
                    max-width="70%"
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn 
                            fab
                            color="primary"
                            v-bind="attrs"
                            v-on="on"
                            ><v-icon>mdi-plus</v-icon>
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                        <span class="text-h5">Nuevo Grupo</span>
                        </v-card-title>

                        <v-card-text>
                        <v-container>
                        <v-form
                        ref="form">
                            <v-row>
                            <v-col cols="12">
                                <v-autocomplete
                                v-model="integrantes"
                                :items="people"
                                outlined
                                chips
                                label="Seleccionar integrantes"
                                item-text="paterno"
                                item-value="paterno"
                                multiple
                                >
                                <template v-slot:selection="data">
                                    <v-chip
                                    v-bind="data.attrs"
                                    :input-value="data.selected"
                                    close
                                    @click="data.select"
                                    @click:close="remove(data.item)"
                                    >
                                    <v-avatar left>
                                        <v-img v-bind:src="'/storage/images/propietarios/' + data.item.fotoProp"></v-img>
                                    </v-avatar>
                                    {{ data.item.paterno }}
                                    </v-chip>
                                </template>
                                <template v-slot:item="data">
                                    <template>
                                    <v-list-item-avatar>
                                        <img v-bind:src="'/storage/images/propietarios/' + data.item.fotoProp">
                                    </v-list-item-avatar>
                                    <v-list-item-content>
                                        <v-list-item-title v-html="data.item.paterno"></v-list-item-title>
                                        <v-list-item-subtitle v-html="data.item.can"></v-list-item-subtitle>
                                    </v-list-item-content>
                                    </template>
                                </template>
                                </v-autocomplete>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-autocomplete
                                v-model="tipo"
                                :items="tipoCap"
                                outlined
                                placeholder="Tipo de Capacitación">
                                </v-autocomplete>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-autocomplete
                                v-model="turno"
                                :items="tipoTurno"
                                outlined
                                placeholder="Turno">
                                </v-autocomplete>
                            </v-col>
                                <v-dialog
                                    ref="dialog"
                                    v-model="time"
                                    :return-value.sync="start"
                                    persistent
                                    width="50%"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                            v-model="end"
                                            outlined
                                            label="Empieza:"
                                            prepend-icon="mdi-clock-time-four-outline"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                            v-model="start"
                                            outlined
                                            label="Termina:"
                                            prepend-icon="mdi-clock-time-four-outline"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </v-col>
                                    </template>
                                    <div style="background-color: white">
                                        <v-row style="margin: 0">
                                            <v-col cols="12" sm="6">
                                                <v-time-picker scrollable
                                                    v-if="time"
                                                    v-model="start"
                                                    full-width
                                                    :max="end"
                                                ></v-time-picker>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-time-picker scrollable
                                                    v-if="time"
                                                    v-model="end"
                                                    full-width
                                                    :min="start"
                                                ></v-time-picker>
                                            </v-col>
                                        </v-row>
                                        <v-spacer></v-spacer>
                                        <div style="padding: 15px; text-align: center">
                                            <v-btn
                                                text
                                                color="primary"
                                                @click="time = false">
                                                Cancelar
                                            </v-btn>
                                            <v-btn
                                                color="primary"
                                                @click="$refs.dialog.save(start)">
                                                Guardar
                                            </v-btn>
                                        </div>
                                    </div>
                                </v-dialog>
                            </v-row>
                        </v-form>
                        </v-container>
                        </v-card-text>

                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="primary"
                            text
                            @click="close"
                        >
                            Cancelar
                        </v-btn>
                        <v-btn
                            color="primary"
                            @click="save"
                        >
                            Guardar
                        </v-btn>
                        </v-card-actions>
                    </v-card>
                    </v-dialog>
                </div>
                <v-card style="box-shadow: 0px 0px 30px; border-radius: 10px; position: initial">
                    <v-card-title style="padding: 0; padding-inline: 20px">
                        <v-col cols="12" sm="4" style="margin-top: 30px; padding: 0">
                            <v-select v-model="depFil"
                                disabled
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
                    <!-- En curso -->
                    <v-subheader style="padding: 20px; padding-top: 30px">
                        En curso
                    </v-subheader>
                     <v-divider></v-divider>
                    <v-data-table style="padding-inline: 20px"
                    :headers="headers"
                    :items="people"
                    
                    :search="search"
                    no-data-text="Sin Datos"
                    no-results-text="Sin Resultados"
                    :footer-props="{'items-per-page-options':[5,10,15,30],'items-per-page-text':'Usuarios por Página','pageText':'{0}-{1} de {2}'}">
                    </v-data-table>
                    <!-- Incompletos -->
                    <v-subheader style="padding: 20px; padding-top: 40px">
                        Incompletos
                    </v-subheader>
                     <v-divider></v-divider>
                    <v-data-table style="padding-inline: 20px"
                    :headers="headers"
                    :items="people"
                    
                    :search="search"
                    no-data-text="Sin Datos"
                    no-results-text="Sin Resultados"
                    :footer-props="{'items-per-page-options':[5,10,15,30],'items-per-page-text':'Usuarios por Página','pageText':'{0}-{1} de {2}'}">
                    </v-data-table>
                    <!-- Finalizados -->
                    <v-subheader style="padding: 20px; padding-top: 40px">
                        Finalizados
                    </v-subheader>
                     <v-divider></v-divider>
                    <v-data-table style="padding-inline: 20px"
                    :headers="headers"
                    :items="people"
                    
                    :search="search"
                    no-data-text="Sin Datos"
                    no-results-text="Sin Resultados"
                    :footer-props="{'items-per-page-options':[5,10,15,30],'items-per-page-text':'Usuarios por Página','pageText':'{0}-{1} de {2}'}">
                    </v-data-table>
                </v-card>
            </div>
        </div>
        </v-app>
    </app-layout>
    <div v-else style="display: flex; justify-content: center; align-items: center; font-size: 50px; background-color:#DCEDC8;position: absolute;height: 100%;width: 100%">
        Sin Permisos Suficientes
    </div>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            propietarios: Array,
            canes: Array,
            users: Array,
        },
        data: function () {
            return {
                dialog: false,
                integrantes: null,
                tipo: null,
                turno: null,
                start: null,
                end: null,
                time: false,
                time2: null,
                tipoCap: ['Solo al Propietario','Propietario y Canino'],
                tipoTurno: ['Mañana','Tarde','Noche'],
                editedItem: {
                    name: '',
                    calories: '',
                    fat: '',
                },
                depFil: this.$page.props.user.departamento,
                search: '',
                headers: [{ text: "GRUPO", value: "propietarioDatos", sortable: false },
                        { text: "INTEGRANTES", value: "canesDatos", sortable: false },
                        { text: "TURNO", value: "docExp", sortable: false},
                        { text: "HORARIO", value: "conDatos", sortable: false },
                        { text: "ESTADO", value: "departamento", sortable: false },
                        { text: 'ACCIONES', value: 'actions', sortable: false, align: 'center' }],
                dep: ['La Paz', 'Cochabamba', 'Santa Cruz', 'Chuquisaca', 'Oruro', 'Potosí', 'Tarija', 'Beni', 'Pando'],
                people: [],
            }
        },
        created () {
            let mergedSubjects = this.propietarios.map(subject => {
            let otherSubject = this.canes.find(element => element.id === subject.id)
            const reg = {...subject, ...otherSubject}
            this.people.push(reg)
        })
        },
        computed: {
            
        },

        watch: {
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
        },

        methods: {
        close () {
            this.$refs.form.reset()
            this.dialog = false
            this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
            })
        },
        save () {
            if (this.editedIndex > -1) {
            Object.assign(this.desserts[this.editedIndex], this.editedItem)
            } else {
            this.desserts.push(this.editedItem)
            }
            this.close()
        },
        remove (item) {
            const index = this.integrantes.indexOf(item.paterno)
            if (index >= 0) this.integrantes.splice(index, 1)
        },
        reenviarRegistros() {
                this.people = this.people.map(this.getDisplayRegistros);
            },
        getDisplayRegistros(people) {
            return {
                id: people.id,
                fotoProp: people.fotoProp,
                paterno: people.paterno,
                materno: people.materno,
                nombres: people.nombres,
                documento: people.documento,

                can: people.nomPerro,

                actions: people.id,
            };
            },
        },
        mounted() {
            this.reenviarRegistros();
            // Set the current date and time as default value_DateTime
            var d = new Date();
            var currentHour = d.getHours() % 12; // AM,PM format
            var minutes = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
            var currentTime = currentHour + ':' + minutes;

            this.start = currentTime;
            this.start = null;
            this.end = currentTime;
            this.end = null;
        },

        components: {
            AppLayout,
        },
    }
</script>