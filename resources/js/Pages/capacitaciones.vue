<template>
    <app-layout v-if="($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Capacitador')">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis capacitaciones
            </h2>
        </template>

        <v-app>
        <div class="py-12" style="background: #4a6813">
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
                                v-model="form.integrantes"
                                :items="people"
                                outlined
                                chips
                                label="Seleccionar Integrantes"
                                item-text="paterno"
                                item-value="id"
                                multiple
                                >
                                <template v-slot:selection="data">
                                    <v-chip
                                    v-bind="data.attrs"
                                    :input-value="data.selected"
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
                                v-model="form.tipo"
                                :items="tipoCap"
                                outlined
                                placeholder="Tipo de Capacitación">
                                </v-autocomplete>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-autocomplete
                                v-model="form.turno"
                                :items="tipoTurno"
                                outlined
                                placeholder="Turno">
                                </v-autocomplete>
                            </v-col>
                            <v-col cols="12" sm="12">
                                <v-subheader>Horario de Capacitación</v-subheader>
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
                                        <v-text-field :disabled="form.turno==null"
                                            v-model="end"
                                            outlined
                                            label="Termina:"
                                            prepend-icon="mdi-clock-time-four-outline"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field :disabled="form.turno==null"
                                            v-model="start"
                                            outlined
                                            label="Empieza:"
                                            prepend-icon="mdi-clock-time-four-outline"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </v-col>
                                    </template>
                                    <div style="background-color: white">
                                        <v-card style="text-align: center">
                                            <v-card-title style="display: flex; justify-content: center">
                                                Turno: {{ form.turno }}
                                            </v-card-title>
                                            <div style="padding-bottom: 15px">
                                                <div v-if="form.turno == 'Mañana'">
                                                    Horas habilitadas: 06:00 - 12:59
                                                </div>
                                                <div v-else-if="form.turno == 'Tarde'">
                                                    Horas habilitadas: 12:00 - 17:59
                                                </div>
                                                <div v-else-if="form.turno == 'Noche'">
                                                    Horas habilitadas: 18:00 - 20:59
                                                </div>
                                            </div>
                                        </v-card>
                                        <v-form ref="horas">
                                        <v-row style="margin: 0">
                                            <v-col cols="12" sm="6">
                                                <v-time-picker scrollable :color="getColor()"
                                                    v-if="time"
                                                    v-model="start"
                                                    full-width
                                                    format="24hr"
                                                    :min="minH()"
                                                    :max="maxH()"
                                                ></v-time-picker>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-time-picker scrollable :color="getColor()"
                                                    v-if="time"
                                                    v-model="end"
                                                    full-width
                                                    format="24hr"
                                                    :min="minH()"
                                                    :max="maxH()"
                                                ></v-time-picker>
                                            </v-col>
                                        </v-row>
                                        </v-form>
                                        <v-spacer></v-spacer>
                                        <div style="padding: 15px; text-align: center">
                                            <v-btn
                                                text
                                                color="primary"
                                                @click="close1()">
                                                Cancelar
                                            </v-btn>
                                            <v-btn
                                                :disabled="!dialog1IsValid"
                                                color="primary"
                                                @click.prevent="$refs.dialog.save(start)"
                                                @click="horario()">
                                                Guardar
                                            </v-btn>
                                        </div>
                                    </div>
                                </v-dialog>
                                <v-col cols="12" sm="12">
                                    <v-subheader>Fechas de Capacitación</v-subheader>
                                </v-col>
                                <template>
                                <v-dialog
                                    ref="dialog3"
                                    v-model="fecha"
                                    :return-value.sync="form.inicio"
                                    persistent
                                    width="50%"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                            v-model="form.fin"
                                            outlined
                                            label="Termina:"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                            v-model="form.inicio"
                                            outlined
                                            label="Empieza:"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </v-col>
                                    </template>
                                    <div style="background-color: white">
                                        <v-row style="margin: 0">
                                            <v-col cols="12" sm="6">
                                                <v-date-picker scrollable
                                                    v-if="fecha"
                                                    v-model="form.inicio"
                                                    full-width
                                                    locale="es"
                                                    :min="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                ></v-date-picker>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-date-picker scrollable
                                                    v-if="fecha"
                                                    v-model="form.fin"
                                                    full-width
                                                    locale="es"
                                                    :min="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                ></v-date-picker>
                                            </v-col>
                                        </v-row>
                                        <v-spacer></v-spacer>
                                        <div style="padding: 15px; text-align: center">
                                            <v-btn
                                                text
                                                color="primary"
                                                @click="fecha = false">
                                                Cancelar
                                            </v-btn>
                                            <v-btn
                                                :disabled="!dialog3IsValid"
                                                color="primary"
                                                @click="$refs.dialog3.save(form.inicio)">
                                                Guardar
                                            </v-btn>
                                        </div>
                                    </div>
                                </v-dialog>
                                </template>
                            </v-row>
                        </v-form>
                        </v-container>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions style="display: flex; justify-content: end">
                        <div>
                            <v-btn
                                color="primary"
                                text
                                @click="closeDelete">
                                Cancelar
                            </v-btn>
                            <v-btn
                                :disabled="!dialog2IsValid"
                                color="primary"
                                @click.prevent="close"
                                @click="submitData">
                                Guardar
                            </v-btn>
                        </div>
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
                    :items="uno"
                    :search="search"
                    no-data-text="Sin Datos"
                    no-results-text="Sin Resultados"
                    :footer-props="{'items-per-page-options':[5,10,15,30],'items-per-page-text':'Usuarios por Página','pageText':'{0}-{1} de {2}'}">
                        <template v-slot:item.actions="{ item }">
                            <div style="display: flex; align-items: center; justify-content: center">
                                <v-btn fab text :href="route('grupos.show', item.id)"><v-icon>mdi-eye</v-icon></v-btn>
                            </div>
                        </template>
                    </v-data-table>
                    <!-- Finalizados -->
                    <v-subheader style="padding: 20px; padding-top: 40px">
                        Finalizados
                    </v-subheader>
                     <v-divider></v-divider>
                    <v-data-table style="padding-inline: 20px"
                    :headers="headers"
                    :items="tres"
                    :search="search"
                    no-data-text="Sin Datos"
                    no-results-text="Sin Resultados"
                    :footer-props="{'items-per-page-options':[5,10,15,30],'items-per-page-text':'Usuarios por Página','pageText':'{0}-{1} de {2}'}">
                        <template v-slot:item.actions="{ item }">
                            <div style="display: flex; align-items: center; justify-content: center">
                                <v-btn fab text :href="route('grupos.show', item.id)"><v-icon>mdi-eye</v-icon></v-btn>
                            </div>
                        </template>
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
    import moment from 'moment'

    export default {
        props: {
            propietarios: Array,
            canes: Array,
            users: Array,
            en_curso: Array,
            completos: Array,
        },
        data: function () {
            return {
                dialog: false,
                dialog2: false,
                start: null,
                end: null,
                time: false,
                fecha: false,
                tipoCap: ['Solo al Propietario','Propietario y Canino'],
                tipoTurno: ['Mañana','Tarde','Noche'],
                depFil: this.$page.props.user.departamento,
                search: '',
                headers: [{ text: "GRUPO", value: "id", sortable: true, align: 'center' },
                        { text: "INTEGRANTES", value: "numInt", sortable: true, align: 'center' },
                        { text: "TIPO", value: "tipo", sortable: true},
                        { text: "HORARIO", value: "horario", sortable: true },
                        { text: "FIN", value: "fin", sortable: true },
                        { text: "TURNO", value: "turno", sortable: true},
                        { text: 'ACCIONES', value: 'actions', sortable: false, align: 'center' }],
                dep: ['La Paz', 'Cochabamba', 'Santa Cruz', 'Chuquisaca', 'Oruro', 'Potosí', 'Tarija', 'Beni', 'Pando'],
                people: [],
                uno: [],
                tres: [],
                form: {
                    capacitador: this.$page.props.user.username,
                    integrantes: null,
                    tipo: null,
                    turno: null,
                    horario: null,
                    inicio: null,
                    fin: null,
                    completos: null,
                    incompletos: null,
                    estado: 'En Curso',
                },
            }
        },
        created () {
            /* Merge Canes y Propietarios */
            let mergedSubjects = this.propietarios.map(subject => {
            let otherSubject = this.canes.find(element => element.id === subject.id)
            const reg = {...subject, ...otherSubject}
            this.people.push(reg)
        })
        },
        computed: {
        dialog1IsValid () {
            return (
            this.start &&
            this.end
            )
        },
        dialog3IsValid () {
            return (
            this.form.inicio &&
            this.form.fin
            )
        },
        dialog2IsValid () {
            return (
            this.form.integrantes &&
            this.form.tipo &&
            this.form.turno &&
            this.start &&
            this.end &&
            this.form.inicio &&
            this.form.fin
            )
        },
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
            submitData() {
                /* subir datos */
                this.form.integrantes = this.form.integrantes.toString();
                this.$inertia.post(route('grupos.store'),this.form);
                window.location.reload();
            },
            closeDelete () {
                this.$refs.form.reset()
                this.dialog = false
            },
            close () {
                this.dialog = false
            },
            close1 () {
                this.$refs.horas.reset()
                this.time = false
            },
            save () {
                this.close()
            },
            remove (item) {
                const index = this.form.integrantes.indexOf(item.paterno)
                if (index >= 0) this.form.integrantes.splice(index, 1)
            },
            reenviarRegistros() {
                    this.people = this.people.map(this.getDisplayRegistros);
                    this.uno = this.en_curso.map(this.getDisplayUno);
                    this.tres = this.completos.map(this.getDisplayTres);
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
                };
            },
            /* Grupos */
            getDisplayUno(en_curso) {
                const numIntegrantes = en_curso.integrantes.split(",").length;
                const horario = en_curso.horario.replace(',',' -');
                return {
                        id: en_curso.id,
                        numInt: numIntegrantes,
                        integrantes: en_curso.integrantes,
                        tipo: en_curso.tipo,
                        turno: en_curso.turno,
                        horario: horario,
                        inicio: en_curso.inicio,
                        fin: en_curso.fin,
                        estado: en_curso.estado,
                        actions: en_curso.id,
                    }
            },
            getDisplayTres(completos) {
                const numIntegrantes = completos.integrantes.split(",").length;
                const horario = completos.horario.replace(',',' -');
                return {
                        id: completos.id,
                        numInt: numIntegrantes,
                        integrantes: completos.integrantes,
                        tipo: completos.tipo,
                        turno: completos.turno,
                        horario: horario,
                        inicio: completos.inicio,
                        fin: completos.fin,
                        estado: completos.estado,
                        actions: completos.id,
                    }
            },
            horario(){
                this.form.horario = this.start + ', ' + this.end
            },

                getColor () {
                    switch(this.form.turno)
                    {
                        case 'Mañana': return '#e4cd4d'
                        case 'Tarde': return 'orange lighten-1'
                        case 'Noche': return 'black lighten-1'
                    }
                },
                minH() {
                    switch(this.form.turno)
                    {
                        case 'Mañana': return '6:00'
                        case 'Tarde': return '12:00'
                        case 'Noche': return '18:00'
                    }
                },
                maxH() {
                    switch(this.form.turno)
                    {
                        case 'Mañana': return '12:59'
                        case 'Tarde': return '17:59'
                        case 'Noche': return '20:59'
                    }
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
            moment,
        },
    }
</script>
