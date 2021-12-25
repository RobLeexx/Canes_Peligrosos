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
                    <v-row style="width: 100%; display: flex;justify-content: space-between; padding-bottom: 10px">
                        <v-col cols="12" sm="3" style="padding-left: 20px; padding-top: 50px; text-align: center; min-height: 30px">
                            <div style="display: flex; justify-content: center">
                                <img style="width: 60px; min-width: 60px" src="/storage/img/logoPol.png">
                            </div>
                            <h1 style="font-size: 15px">POLICÍA BOLIVIANA</h1>
                            <h1 style="font-size: 10px">Dir. Nal. De Fiscalización</h1>
                            <h1 style="font-size: 10px">y Recaudaciones</h1>
                        </v-col>
                        <v-col cols="12" sm="6" style="text-align:center">
                            <h1 style="padding-top: 130px; font-size: 14px">N°{{ propietario.id }}</h1>
                            <h1 style="font-size: 14px">Serie A-</h1>
                            <h1 style="font-size: 20px; padding-top: 10px">- AUTORIZACIÓN -</h1>
                            <h1 style="font-size: 20px">PARA LA TENENCIA DE CAN PELIGROSO</h1>
                        </v-col>
                        <v-col cols="12" sm="3" style="text-align:center">
                            <h1 style="font-weight: bold; padding-top: 10px; font-size: 13px">CENTRO DE ADIESTRAMIENTO</h1>
                            <h1 style="font-weight: bold; font-size: 13px">DE CANES (C.A.C) DE</h1>
                            <h1 style="font-weight: bold; font-size: 13px; text-transform: uppercase">{{ propietario.departamento }}</h1>
                            <h1 style="font-weight: bold; font-size: 15px; padding-top: 15px; padding-right: 80px">Costo Bs.</h1>
                        </v-col>
                    </v-row>

                <!-- DATOS -->
                <div style="border: 1px solid black; padding-top: 11px; margin-inline: 25px">
                    <v-row style="padding-inline: 11px">
                    <v-col cols="12" sm="6" style="padding: 0">
                    <table id="cert">
                        <thead style="border: 1px solid black">
                            <tr>
                                <th style="width: 10%; padding: 5px; font-size: 17px">DATOS DEL PROPIETARIO</th>
                            </tr>
                        </thead>
                    </table>
                    <table  id="cert1" style="border: 1px solid black; width: 100%">
                        <tbody>
                            <tr>
                                <td>
                                    <div style="display: flex">
                                        <div style="width: 100%">
                                            <v-row style="display: flex; padding-left: 17px; padding-top: 15px; max-width: 380px">
                                                <div style="font-weight: bold">APELLIDOS:&nbsp;</div>
                                                <div>{{ propietario.paterno }} {{ propietario.materno }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px; max-width: 380px">
                                                <div style="font-weight: bold">NOMBRES:&nbsp;</div>
                                                <div>{{ propietario.nombres }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px; max-width: 380px">
                                                <div v-if="propietario.docTipo == 'CI'" style="font-weight: bold">CÉDULA DE IDENTIDAD:&nbsp;</div>
                                                <div v-else style="font-weight: bold">PASAPORTE:&nbsp;</div>
                                                <div>{{ propietario.documento }} {{ propietario.docTipo }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px; max-width: 380px">
                                                <div style="font-weight: bold">PROFESIÓN U OCUPACIÓN:&nbsp;</div>
                                                <div>{{ propietario.profesion }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px">
                                                <div style="font-weight: bold">ESTADO CIVIL:&nbsp;</div>
                                                <div>{{ propietario.estCivil }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px">
                                                <div style="font-weight: bold">EDAD:&nbsp;</div>
                                                <div id="edad"></div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px">
                                                <div style="font-weight: bold">DOMICILIO:&nbsp;</div>
                                                <div>{{ propietario.domicilio }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px">
                                                <div style="font-weight: bold">ZONA:&nbsp;</div>
                                                <div>{{ propietario.zona }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px; padding-bottom: 15px">
                                                <div style="font-weight: bold">MUNICIPIO:&nbsp;</div>
                                                <div>{{ propietario.municipio }}</div>
                                            </v-row>
                                        </div>
                                        <img style="max-width: 220px; min-width: 220px; max-height: 170px" v-bind:src="'/storage/images/propietarios/' + propietario.fotoProp">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </v-col>
                    <v-col cols="12" sm="6" style="padding: 0">
                    <table id="cert">
                        <thead style="border: 1px solid black">
                            <tr>
                                <th style="width: 10%; padding: 5px; font-size: 17px">DATOS DEL CAN PELIGROSO</th>
                            </tr>
                        </thead>
                    </table>
                    <table id="cert" style="width: 100%">
                        <tbody v-for="can in canes" :key="canes.id">
                            <tr>
                                <td>
                                    <div style="display: flex">
                                        <div style="width: 100%">
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1 style="font-weight: bold">NOMBRE:</h1>&nbsp;{{ can.nomPerro }}</div></td>
                                            </tr>
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1 style="font-weight: bold">RAZA:</h1>&nbsp;{{ can.razaCan }}</div></td>
                                            </tr>
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1 style="font-weight: bold">SEXO:</h1>&nbsp;{{ can.sexoCan }}</div></td>
                                            </tr>
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1 style="font-weight: bold">EDAD:</h1>&nbsp;<div id="edadCan"></div></div></td>
                                            </tr>
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1 style="font-weight: bold">PROCEDENCIA:</h1>&nbsp;{{ can.procedenciaCan }}</div></td>
                                            </tr>
                                        </div>
                                        <img style="max-width: 220px; min-width: 220px; max-height: 170px" v-bind:src="'/storage/images/canes/' + can.fotoCan">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </v-col>
                    </v-row>

                    <!-- CUIDADORES EVENTUALES -->
                    <v-col style="padding-inline: 0; padding-bottom: 0px">
                    <table style="border: 1px solid black; width: 100%">
                        <tbody v-for="can in canes" :key="canes.id">
                            <tr>
                                <td style="padding-left: 5px"><h1 style="font-weight: bold">TENEDOR(ES) EVENTUAL(ES) DEL PERRO PELIGROSO:</h1>●&nbsp;{{ can.canEven1 }} {{ can.canEvenNum1 }}</td>
                            </tr>
                            <tr v-if="can.canEven2"><td style="padding-left: 5px">●&nbsp;{{ can.canEven2 }} {{ can.canEvenNum2 }}</td></tr>
                            <tr v-if="can.canEven3"><td style="padding-left: 5px">●&nbsp;{{ can.canEven3 }} {{ can.canEvenNum3 }}</td></tr>
                            <tr v-if="can.canEven4"><td style="padding-left: 5px">●&nbsp;{{ can.canEven4 }} {{ can.canEvenNum4 }}</td></tr>
                        </tbody>
                    </table>
                    </v-col>
                
                <!-- CURSOS -->
                <v-row style="padding-inline: 11px">
                    <v-col cols="12" sm="6" style="text-align: center; padding-inline: 0">
                        <div style="border: 1px solid black"><h1><b>CURSO PREVENTIVO SOBRE LA TENENCIA<br>Y CUIDADO DEL PERRO PELIGROSO</b></h1></div>
                        <div style="padding: 20px; border: 1px solid black"><v-btn outlined color="black" rounded>CURSO VENCIDO</v-btn></div>
                    </v-col>
                    <v-col cols="12" sm="6" style="text-align: center; padding-inline: 0">
                        <div style="border: 1px solid black"><h1><b>ADIESTRAMIENTO BÁSICO<br>CANINO</b></h1></div>
                        <div style="padding: 20px; border: 1px solid black"><v-btn outlined color="black" rounded>ÓPTIMO</v-btn></div>
                    </v-col>
                </v-row>

                <!-- OBSERVACIONES -->
                    <v-col style="padding: 0">
                    <table style="width: 100%">
                        <tbody v-for="can in canes" :key="canes.id">
                            <tr>
                                <td style="padding-left: 5px"><h1 style="font-weight: bold">OBSERVACIONES:</h1>{{ can.canConvivencia }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </v-col>
                
                <!-- EXPEDICIÓN -->
                    <v-col style="padding: 0; border: 1px solid black; width: 100%">
                        <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">{{ exp }}</h1></div>
                        <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">NOTA.-</h1></div>
                        <div style="display: flex">
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">●</h1></div>
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">{{ exp1 }}</h1></div>
                        </div>
                        <div style="display: flex">
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">●</h1></div>
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">{{ exp2 }}</h1></div>
                        </div>
                        <div style="display: flex">
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">●</h1></div>
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">{{ exp3 }}</h1></div>
                        </div>
                        <div style="display: flex">
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">●</h1></div>
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">{{ exp4 }}</h1></div>
                        </div>
                        <div style="display: flex">
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">●</h1></div>
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">{{ exp5 }}</h1></div>
                        </div>
                        <div style="display: flex">
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">●</h1></div>
                            <div style="padding-left: 5px"><h1 style="font-weight: bold; font-size: 13px">{{ exp6 }}</h1></div>
                        </div>
                            <div style="padding-left: 5px; display: flex; justify-content: end;padding: 40px"><div>Lugar y Fecha:&nbsp;&nbsp;</div>{{ propietario.departamento }},&nbsp;<div id="diaC"></div>&nbsp;de&nbsp;<div id="mesC"></div>&nbsp;de&nbsp;<div id="anioC"></div>
                        </div>
                        <div>
                            
                        </div>
                    </v-col>
                </div>
                <br>
                </div>
            <!-- Descargar Autorización -->
            <div style="text-align: center; padding: 50px">
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
    import 'jspdf-autotable'
    export default {
        props: {
            propietario: Object,
            memoriales: Array,
            antecedentes: Array,
            seguros: Array,
            canes: Array,
        },
        data() {
            return {
                exp: 'Documento expedido en aplicación al Art. 8° y 9° de la Ley de Regulación de Tenencia de Perros Peligrosos para la Seguridad Ciudadana.',
                exp1: 'La presente Autorización NO CONSTITUYE DE POR SI LA "LA TENENCIA DEL PERRO PELIGROSO"; debiendo acudir el propietario del perro peligroso, para el efecto, ente el Gobierno Autónomo Municipal, donde se le registrara y otorgara la "Licencia de crianza del perro peligroso."',
                exp2: 'Válido y de uso exlusivo para el trámite ante el Gobierno Autónomo Municipal.',
                exp3: 'Cualquier raspadura y/o enmienda anula el presente documento.',
                exp4: 'El tiempo de validez de la presente Autorización es de dos años (2) a partir de su fecha de emisión',
                exp5: 'La presente Autorización no constituye a la Policía Boliviana en responsable civil o penal por agresiones que el perro pueda causar (sujetándose al Art. 270° Bis del Código Penal).',
                exp6: 'Prohibido su uso para personas y en perros no Autorizados y no registrados en el presente documento.',
            }
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

                /* Tablas */
                pdf.autoTable({
                theme: 'grid',
                html: '#cert'
                })
                
                /* Guardado */
                pdf.save('Autorización Nro' + this.propietario.id + '_' + this.propietario.documento + ' ' + this.propietario.docExp)
            },
        },
        mounted() {
            var today = new Date();
            var birthDate = new Date(this.propietario.dateProp);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('edad').innerHTML = age;
            for(let can of this.canes)
            {
                if(this.propietario.id == can.id)
                {
                    var birthDateCan = new Date(can.dateNacPerro);
                    var ageCan = today.getFullYear() - birthDateCan.getFullYear();
                    var monCan = today.getMonth() - birthDateCan.getMonth();
                    var m = today.getMonth() - birthDateCan.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDateCan.getDate())) {
                        ageCan--;
                    }
                    if (m < 0 || (m === 0 && today.getDate() < birthDateCan.getDate())) {
                        monCan--;
                    }
                    if (ageCan < 1)
                    {
                        document.getElementById('edadCan').innerHTML = monCan + " (Meses)";
                    }
                    else
                    {
                        document.getElementById('edadCan').innerHTML = ageCan;
                    }
                }
            }
            let dia = today.getDate();
            let mesN = today.getMonth()+1;
            let anio = today.getFullYear();
            switch (mesN) {
            case 1:
                var mes = 'Enero'
                break
            case 2:
                var mes = 'Febrero'
                break
            case 3:
                var mes = 'Marzo'
                break
            case 4:
                var mes = 'Abril'
                break
            case 5:
                var mes = 'Mayo'
                break
            case 6:
                var mes = 'Junio'
                break
            case 7:
                var mes = 'Julio'
                break
            case 8:
                var mes = 'Agosto'
                break
            case 9:
                var mes = 'Septiembre'
                break
            case 10:
                var mes = 'Octubre'
                break
            case 11:
                var mes = 'Noviembre'
                break
            case 12:
                var mes = 'Diciembre'
                break
            default:
                var mes = mesN
                break
            }
            document.getElementById('diaC').innerHTML = dia;
            document.getElementById('mesC').innerHTML = mes;
            document.getElementById('anioC').innerHTML = anio;
        },
        components: {
            jsPDF,
            AppLayout,
        },
    }
</script>