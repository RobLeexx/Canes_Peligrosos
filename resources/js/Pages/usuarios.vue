<template>
<v-app>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios
            </h2>
        </template>

        <div class="py-12" style="background: #4a6813">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
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
                    <v-data-table style="padding-inline: 20px"
                    :headers="headers"
                    :search="search"
                    :items="usuarios"
                    no-data-text="Sin Datos"
                    no-results-text="Sin Resultados"
                    :footer-props="{'items-per-page-options':[5,10,15,30],'items-per-page-text':'Usuarios por Página','pageText':'{0}-{1} de {2}'}">
                    </v-data-table>
                </div>
            </div>
        </div>
    </app-layout>
</v-app>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            usuarios: Object,
        },
        data: function() {
            return{
                e6: 1,
                search: '',
                users:[],
                headers: [{ text: "ID", value: "id", sortable: true, align: 'center' },
                        { text: "USERNAME", value: "username", sortable: true},
                        { text: "PATERNO", value: "paterno", sortable: true},
                        { text: "MATERNO", value: "materno", sortable: true},
                        { text: 'NOMBRES', value: 'nombres', sortable: true, }],
            }
        },
        methods:{
            reenviarRegistros() {
                    this.users = this.users.map(this.getDisplayRegistros);
                },
            getDisplayRegistros(users) {
                return {
                    id: users.id,
                    username: users.username,
                    paterno: users.paterno,
                    materno: users.materno,
                    nombres: users.nombres,
                };
            },
        },
        created(){
            this.users.push(this.usuarios)
        },
        mounted(){
            this.reenviarRegistros();
        },
        components: {
            AppLayout,
        },
    }
</script>