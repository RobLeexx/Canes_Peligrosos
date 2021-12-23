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
                var pdf = new jsPDF('p', 'mm', [340, 220]);
                var img = new Image()

                /* LogoIzq */
                img.src = '/storage/img/logoPol.png'
                pdf.addImage(img, 'png', 17, 5, 14, 18)
                pdf.setFontSize(9).text('POLICÍA BOLIVIANA', 10, 27);
                pdf.setFontSize(6).text('Dir. Nal. De Fiscalización', 13, 31);
                pdf.setFontSize(6).text('y Recaudaciones', 16, 34);

                /* Centro */
                pdf.setFontSize(9).text('N°' + this.propietario.id.toString(), 107, 29.5);
                pdf.setFontSize(9).text('Serie A-', 105, 33);
                pdf.setFontSize(12).text('- AUTORIZACIÓN -', 92, 40);
                pdf.setFontSize(12).text('PARA LA TENENCIA DE CAN PELIGROSO', 67, 45);

                /* Derecha */
                pdf.setFont(undefined, 'bold').setFontSize(7).text('CENTRO DE ADIESTRAMIENTO', 173, 6);
                pdf.setFont(undefined, 'bold').setFontSize(7).text('DE CANES (C.A.C)', 181, 9);
                pdf.setFont(undefined, 'bold').setFontSize(9).text('Costo Bs.', 176, 16);
                
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