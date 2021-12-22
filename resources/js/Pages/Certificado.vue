<template>
<app-layout>
    <template #header>
        <v-row>
            <v-btn fab small text :href="route('registros.show', propietario.id)"><v-icon>mdi-arrow-left-circle</v-icon></v-btn>
            <div style="padding: 9px">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ propietario.paterno }}, {{ propietario.documento }} {{ propietario.docExp }} / Autorización para la Tenencia de Can Peligroso
            </h2>
            </div>
        </v-row>
    </template>

    <v-app>
        <div class="py-12" style="background: #33691E">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <h1>{{ propietario.id }}</h1>
                </div>
            <!-- Descargar Autorización -->
            <div style="text-align: center;padding: 50px;">
                <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    @click="downloadPDF"
                    color="primary"
                    elevation="15"
                    fab
                    x-large
                    v-bind="attrs"
                    v-on="on"
                    ><v-icon>mdi-file-download</v-icon></v-btn>
                </template>
                <span>Descargar Autorización</span>
                </v-tooltip>
            </div>
            </div>
        </div>
        
    </v-app>
</app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import jsPDF from 'jspdf'
    export default {
        name: 'pdf',
        props: {
            propietario: Object,
            memoriales: Array,
            antecedentes: Array,
            seguros: Array,
            canes: Array,
        },
        methods: {
            downloadPDF() {
                var pdf = new jsPDF();

                pdf.text(this.propietario.id.toString(), 10, 10);
                pdf.save('Autorización Nro' + this.propietario.id + '_' + this.propietario.documento + ' ' + this.propietario.docExp)
            },
        },
        mounted() {
            
        },
        components: {
            jsPDF,
            AppLayout,
        },
    }
</script>