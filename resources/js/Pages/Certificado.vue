<template>
    <app-layout>
        <v-app>
            <h1>{{ propietario.id }}</h1>
        </v-app>
    </app-layout>
</template>

<script>
/*import html2canvas from "html2canvas"
import jsPDF from "jspdf" */
    export default {
        props: {
            propietario: Object,
            memoriales: Array,
            antecedentes: Array,
            seguros: Array,
            canes: Array,
        },
        methods: {
            /*makePDF(){
                window.html2canvas = html2canvas;
                var doc = new jsPDF("p","pt","a4");
                doc.html(document.querySelector(#app), {
                    callback: function(pdf) {
                        pdf.save("Certificado.pdf")
                    }
                });
            }*/
        },
        mounted() {
            
        },
        components: {
        },
    }
</script>