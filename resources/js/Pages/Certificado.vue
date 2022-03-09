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
        <div class="py-12" style="background: #4a6813">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <v-row style="width: 100%; display: flex;justify-content: space-between; padding-bottom: 10px">
                        <v-col cols="12" sm="3" style="padding-left: 20px; padding-top: 50px; text-align: center; min-height: 30px">
                            <div style="display: flex; justify-content: center; padding: 5px">
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
                            <h1 style="font-weight: bold; font-size: 13px; text-transform: uppercase">{{ propietario.cac }}</h1>
                            <h1 style="font-weight: bold; font-size: 15px; padding-top: 15px; padding-right: 80px">Costo Bs.</h1>
                            <div style="display: flex; justify-content: center; padding: 20px">
                                <img v-bind:src="'/storage/qr/' + propietario.documento + '.png'">
                                <!-- <img v-bind:src="'/storage/img/qr_img.png'"> -->
                            </div>
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
                    <table style="border: 1px solid black; width: 100%">
                        <tbody>
                            <tr>
                                <td>
                                    <div style="display: flex">
                                        <div style="width: 100%">
                                            <v-row style="display: flex; padding-left: 17px; padding-top: 15px; max-width: 380px">
                                                <div>APELLIDOS:&nbsp;</div>
                                                <div>{{ propietario.paterno }} {{ propietario.materno }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px; max-width: 380px">
                                                <div>NOMBRES:&nbsp;</div>
                                                <div>{{ propietario.nombres }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px; max-width: 380px">
                                                <div v-if="propietario.docTipo == 'CI'">CÉDULA DE IDENTIDAD:&nbsp;</div>
                                                <div v-else >PASAPORTE:&nbsp;</div>
                                                <div>{{ propietario.documento }} {{ propietario.docTipo }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px; max-width: 380px">
                                                <div>PROFESIÓN U OCUPACIÓN:&nbsp;</div>
                                                <div>{{ propietario.profesion }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px">
                                                <div>ESTADO CIVIL:&nbsp;</div>
                                                <div>{{ propietario.estCivil }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px">
                                                <div>EDAD:&nbsp;</div>
                                                <div id="edad"></div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px">
                                                <div>DOMICILIO:&nbsp;</div>
                                                <div>{{ propietario.domicilio }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px">
                                                <div>ZONA:&nbsp;</div>
                                                <div>{{ propietario.zona }}</div>
                                            </v-row>
                                            <v-row style="display: flex; padding-left: 17px; padding-bottom: 15px">
                                                <div>MUNICIPIO:&nbsp;</div>
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
                        <tbody>
                            <tr>
                                <td>
                                    <div style="display: flex">
                                        <div style="width: 100%">
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1>NOMBRE:</h1>&nbsp;{{ can.nomPerro }}</div></td>
                                            </tr>
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1>RAZA:</h1>&nbsp;{{ can.razaCan }}</div></td>
                                            </tr>
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1>SEXO:</h1>&nbsp;{{ can.sexoCan }}</div></td>
                                            </tr>
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1>EDAD:</h1>&nbsp;<div id="edadCan"></div></div></td>
                                            </tr>
                                            <tr>
                                                <td><div style="display: flex; padding-left: 5px"><h1>PROCEDENCIA:</h1>&nbsp;{{ can.procedenciaCan }}</div></td>
                                            </tr>
                                        </div>
                                        <img style="max-width: 220px; min-width: 220px; max-height: 170px" v-bind:src="'/storage/images/canes/ci_'+ propietario.documento + '/' + can.fotoCan1">
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
                        <tbody>
                            <div>
                            <tr>
                                <td style="padding-left: 5px"><h1 style="font-weight: bold">TENEDOR(ES) EVENTUAL(ES) DEL PERRO PELIGROSO:</h1>●&nbsp;{{ can.canEven1 }} {{ can.canEvenNum1 }}</td>
                            </tr>
                            <tr v-if="can.canEven2"><td style="padding-left: 5px">●&nbsp;{{ can.canEven2 }} {{ can.canEvenNum2 }}</td></tr>
                            <tr v-if="can.canEven3"><td style="padding-left: 5px">●&nbsp;{{ can.canEven3 }} {{ can.canEvenNum3 }}</td></tr>
                            <tr v-if="can.canEven4"><td style="padding-left: 5px">●&nbsp;{{ can.canEven4 }} {{ can.canEvenNum4 }}</td></tr>
                            </div>
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
                        <tbody>
                            <tr>
                                <td style="padding-left: 5px"><h1 style="font-weight: bold">OBSERVACIONES:</h1>{{ capacitacion.observaciones }}</td>
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
                            <div style="padding-left: 5px; display: flex; justify-content: end;padding: 40px"><div style="font-weight: bold">Lugar y Fecha:&nbsp;&nbsp;</div>{{ propietario.cac }},&nbsp;<div id="diaC"></div>&nbsp;de&nbsp;<div id="mesC"></div>&nbsp;de&nbsp;<div id="anioC"></div>
                        </div>
                        <v-row style="text-align: center; padding: 40px">
                            <v-col cols="12" sm="4">
                                <h1>{{ grado }} {{ $page.props.user.nombres }} {{ $page.props.user.paterno }} {{ $page.props.user.materno }}</h1>
                                <h1>Funcionario Policial</h1>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <h1>Vo. Bo.</h1>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <h1>{{ $page.props.user.director }}</h1>
                                <h1>Comandante C.A.C</h1>
                            </v-col>
                        </v-row>
                    </v-col>
                </div>
                <br>
                </div>
            <!-- Descargar Autorización -->
            <div style="text-align: center; padding: 50px">
                <v-tooltip top v-if="capacitacion.estado != 'Finalizado'">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    color="red"
                    elevation="15"
                    fab
                    x-large
                    v-bind="attrs"
                    v-on="on"
                    ><v-icon>mdi-download-lock</v-icon></v-btn>
                </template>
                <span>Capacitación sin Concluir, Finalice la Capacitación para poder descargar</span>
                </v-tooltip>
                <v-tooltip top v-else>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    :disabled="($page.props.user.rol != 'Administrador') && ($page.props.user.username != propietario.creado_por)"
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.28/jspdf.plugin.autotable.js"></script>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import jsPDF from 'jspdf'
    import 'jspdf-autotable'
    export default {
        props: {
            propietario: Object,
            memorial: Object,
            can: Object,
            capacitacion: Object,
        },
        data() {
            return {
                exp: 'Documento expedido en aplicación al Art. 8° y 9° de la Ley de Regulación de Tenencia de Perros Peligrosos para la Seguridad Ciudadana.',
                exp1: 'La presente Autorización NO CONSTITUYE DE POR SI LA "TENENCIA DEL PERRO PELIGROSO"; debiendo acudir el propietario del perro peligroso, para el efecto, ente el Gobierno Autónomo Municipal, donde se le registrara y otorgara la "Licencia de crianza del perro peligroso."',
                exp2: 'Válido y de uso exlusivo para el trámite ante el Gobierno Autónomo Municipal.',
                exp3: 'Cualquier raspadura y/o enmienda anula el presente documento.',
                exp4: 'El tiempo de validez de la presente Autorización es de dos años (2) a partir de su fecha de emisión',
                exp5: 'La presente Autorización no constituye a la Policía Boliviana en responsable civil o penal por agresiones que el perro pueda causar (sujetándose al Art. 270° Bis del Código Penal).',
                exp6: 'Prohibido su uso para personas y en perros no Autorizados y no registrados en el presente documento.',

                exp11: 'La presente Autorización NO CONSTITUYE DE POR SI LA "TENENCIA DEL PERRO PELIGROSO"; debiendo acudir el propietario del perro peligroso, para el efecto, ente el Gobierno            Autónomo Municipal, donde se le registrara y otorgara la "Licencia de crianza del perro peligroso."',
                diaLocal: [],
                mesLocal: [],
                anioLocal: [],
                grado: [],
            }
        },
        created(){
            switch (this.$page.props.user.grado)
            {
                case 'Cabo':
                    this.grado = 'Pol.';
                    break
                case 'Sargento':
                    this.grado = 'Sgto.';
                    break
                case 'Suboficial':
                    this.grado = 'Sof.';
                    break
                case 'Subteniente':
                    this.grado = 'Subtte.';
                    break
                case 'Teniente':
                    this.grado = 'Tte.';
                    break
                case 'Capitán':
                    this.grado = 'Cap.';
                    break
                case 'Mayor':
                    this.grado = 'My.';
                    break
                case 'Teniente Coronel':
                    this.grado = 'Tcnl.';
                    break
                case 'Coronel':
                    this.grado = 'Cnl.';
                    break
                case 'General':
                    this.grado = 'Gnal.';
                    break
                case 'Estudiante':
                    this.grado = 'Est.';
                    break
                case 'Técnico':
                    this.grado = 'Tec.';
                    break
                case 'Licenciado':
                    this.grado = 'Lic.';
                    break
                case 'Ingeniero':
                    this.grado = 'Ing.';
                    break
                case 'Máster':
                    this.grado = 'Msc.';
                    break
                case 'Doctor':
                    this.grado = 'Doc.';
                    break
                default:
                    this.grado = 'Funcionario';
                    break
            }
        },
        methods: {
            downloadPDF() {
                /* Legal 22*36
                   Legal PRUEBA REAL 21.7*33 */
                var pdf = new jsPDF('p', 'mm', [360, 217]);
                var img = new Image();
                var imgProp = new Image();
                var qr = new Image();
                var imgCan = new Image();
                var diaCell = this.diaLocal;
                var mesCell = this.mesLocal;
                var anioCell = this.anioLocal;

                /* Datos */
                var docu;
                if (this.propietario.docTipo == 'CI'){
                    docu = 'CÉDULA DE IDENTIDAD'
                }
                else{
                    docu = 'PASAPORTE'
                }

                /* Cálculo de edades */
                var ep;
                var ec;
                var today = new Date();
                var birthDate = new Date(this.propietario.dateProp);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                ep = age;
                var birthDateCan = new Date(this.can.dateNacPerro);
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
                    ec = monCan + " (Meses)";
                }
                else
                {
                    ec = ageCan;
                }

                /* LogoIzq */
                img.src = '/storage/img/logoPol.png';
                imgProp.src = '/storage/images/propietarios/' + this.propietario.fotoProp;
                pdf.addImage(img, 'png', 17, 5, 14, 14);
                pdf.addImage(imgProp, 'png', 62.5, 60, 45, 38);
                pdf.setFontSize(9).text('POLICÍA BOLIVIANA', 10, 25);
                pdf.setFontSize(6).text('Dir. Nal. De Fiscalización', 13, 29);
                pdf.setFontSize(6).text('y Recaudaciones', 16, 32);

                /* Centro */
                pdf.setFontSize(9).text('N°' + this.propietario.id.toString(), 107, 29.5);
                pdf.setFontSize(9).text('Serie A-', 105, 33);
                pdf.setFontSize(12).text('- AUTORIZACIÓN -', 92, 40);
                pdf.setFontSize(12).text('PARA LA TENENCIA DE CAN PELIGROSO', 67, 45);

                /* Derecha */
                switch (this.propietario.cac)
                {
                    case 'La Paz':
                        var cac = '             LA PAZ'
                        break
                    case 'Cochabamba':
                        var cac = '          COCHABAMBA'
                        break
                    case 'Santa Cruz':
                        var cac = '          SANTA CRUZ'
                        break
                    case 'Chuquisaca':
                        var cac = '          CHUQUISACA'
                        break
                    case 'Oruro':
                        var cac = '              ORURO'
                        break
                    case 'Potosí':
                        var cac = '              POTOSÍ'
                        break
                    case 'Tarija':
                        var cac = '              TARIJA'
                        break
                    case 'Beni':
                        var cac = '                BENI'
                        break
                    case 'Pando':
                        var cac = '               PANDO'
                        break
                }
                pdf.setFont(undefined, 'bold').setFontSize(7).text('CENTRO DE ADIESTRAMIENTO', 170, 6);
                pdf.setFont(undefined, 'bold').setFontSize(7).text('DE CANES (C.A.C)', 179, 9);
                pdf.setFont(undefined, 'bold').setFontSize(7).text(cac, 175, 12);
                pdf.setFont(undefined, 'bold').setFontSize(9).text('Costo Bs.', 172, 18);
                /*qr.src = '/storage/img/qr_img.png';
                pdf.addImage(qr, 'png', 180, 23, 20, 20);*/
                qr.src = '/storage/qr/' + this.propietario.documento + '.png';
                pdf.addImage(qr, 'png', 180, 23, 20, 20);

                /* Tablas */
                pdf.autoTable({theme: 'plain', startY: 50, margin: {horizontal: 12.5}, tableWidth: 97.5, tableLineColor: 20, tableLineWidth: 0.3, styles: {halign: 'center', textColor: 20, fontStyle: 'bold', fontSize: 9 },
                body: [
                ['DATOS DEL PROPIETARIO']]
                });
                pdf.autoTable({theme: 'plain', startY: 57, margin: {horizontal: 12.5}, tableWidth: 97.5, tableLineColor: 20, tableLineWidth: 0.3, styles: {halign: 'center', textColor: 20, fontStyle: 'bold'},
                body: [
                [''],[''],[''],[''],[''],[''],[''],[''],[''],['']]
                });
                pdf.autoTable({theme: 'plain', startY: 50, margin: {horizontal: 110}, tableWidth: 93, tableLineColor: 20, tableLineWidth: 0.3, styles: {halign: 'center', textColor: 20, fontStyle: 'bold', fontSize: 9},
                body: [
                ['DATOS DEL CAN PELIGROSO']]
                });
                pdf.autoTable({theme: 'plain', startY: 57, margin: {horizontal: 110}, tableWidth: 93, tableLineColor: 20, tableLineWidth: 0.3, styles: {halign: 'center', textColor: 20, fontStyle: 'bold'},
                body: [
                [''],[''],[''],[''],[''],[''],[''],[''],[''],['']]
                });

                /* Propietario */
                pdf.autoTable({theme: 'plain', startY: 57, margin: {horizontal: 12.5}, tableWidth: 50, styles: { fontSize: 7 },
                body: [
                ['APELLIDOS:' + ' ' + this.propietario.paterno + ' ' + this.propietario.materno],
                ['NOMBRES:' + ' ' + this.propietario.nombres],
                [docu + ': ' + this.propietario.documento + ' ' + this.propietario.docExp],
                ['PROFESIÓN U OCUPACIÓN:' + ' ' + this.propietario.profesion],
                ['ESTADO CIVIL:' + ' ' + this.propietario.estCivil],
                ['EDAD:' + ' ' + ep],
                ['DOMICILIO:' + ' ' + this.propietario.domicilio],
                ['ZONA:' + ' ' + this.propietario.zona],
                ['MUNICIPIO:' + ' ' + this.propietario.municipio],]
                });

                /* Can */
                imgCan.src = '/storage/images/canes/ci_'+ this.propietario.documento + '/' + this.can.fotoCan1;


                pdf.addImage(imgCan, 'png', 155.5, 60, 45, 38);
                pdf.autoTable({theme: 'plain', startY: 57, margin: {horizontal: 110}, tableWidth: 45, styles: { fontSize: 7 },
                body: [
                ['NOMBRE:' + ' ' + this.can.nomPerro],
                ['RAZA:' + ' ' + this.can.razaCan],
                ['SEXO:' + ' ' + this.can.sexoCan],
                ['EDAD:' + ' ' + ec],
                ['PROCEDENCIA:' + ' ' + this.can.procedenciaCan],
                ]});
                /* Cuidadores Eventuales */
                pdf.autoTable({theme: 'plain', startY: 133, margin: {horizontal: 12.5}, tableWidth: 190.5, tableLineColor: 20, tableLineWidth: 0.3, styles: { textColor: 20, fontStyle: 'bold', fontSize: 9},
                body: [
                ['TENEDOR(ES) EVENTUAL(ES) DEL PERRO PELIGROSO:'],
                ]});
                pdf.autoTable({theme: 'grid', startY: 140, margin: {horizontal: 12.5}, tableWidth: 190.5, tableLineColor: 20, tableLineWidth: 0.3, styles: { textColor: 20, fontSize: 7 }, bodyStyles: { lineColor: 20, lineWidth: 0.2 },
                body: [
                [this.can.canEven1, this.can.canEvenNum1],
                [this.can.canEven2, this.can.canEvenNum2],
                [this.can.canEven3, this.can.canEvenNum3],
                [this.can.canEven4, this.can.canEvenNum4],
                ]});

                /* CURSOS */
                pdf.autoTable({theme: 'plain', startY: 165.5, margin: {horizontal: 12.5}, tableWidth: 97.5, tableLineColor: 20, tableLineWidth: 0.3, styles: { halign: 'center', textColor: 20, fontStyle: 'bold', fontSize: 9},
                body: [
                ['               CURSO PREVENTIVO SOBRE LA TENENCIA                Y CUIDADO DEL PERRO PELIGROSO']
                ]});
                pdf.autoTable({theme: 'plain', startY: 165.5, margin: {horizontal: 110}, tableWidth: 93, tableLineColor: 20, tableLineWidth: 0.3, styles: { halign: 'center', textColor: 20, fontStyle: 'bold', fontSize: 9},
                body: [
                ['                               ADIESTRAMIENTO                                BÁSICO CANINO']
                ]});
                pdf.autoTable({theme: 'plain', startY: 176.5, margin: {horizontal: 12.5}, tableWidth: 97.5, tableLineColor: 20, tableLineWidth: 0.3, styles: { halign: 'center' },
                body: [
                ['Terminado']
                ]});
                pdf.autoTable({theme: 'plain', startY: 176.5, margin: {horizontal: 110}, tableWidth: 93, tableLineColor: 20, tableLineWidth: 0.3, styles: { halign: 'center' },
                body: [
                ['Óptimo']
                ]});

                /* Observaciones */
                pdf.autoTable({theme: 'plain', startY: 184, margin: {horizontal: 12.5}, tableWidth: 190.5, tableLineColor: 20, tableLineWidth: 0.3, styles: { textColor: 20, fontStyle: 'bold', fontSize: 9},
                body: [
                ['OBSERVACIONES:'],
                ]});
                pdf.autoTable({theme: 'plain', startY: 191, margin: {horizontal: 12.5}, tableWidth: 190.5, tableLineColor: 20, tableLineWidth: 0.3, styles: { textColor: 20, fontSize: 7},
                body: [
                [this.capacitacion.observaciones],
                ]});

                /* final */
                pdf.autoTable({theme: 'plain', startY: 197.5, margin: {horizontal: 12.5}, tableWidth: 190.5, tableLineColor: 20, tableLineWidth: 0.3, styles: { textColor: 20, fontStyle: 'bold', fontSize: 6}, bodyStyles: { minCellHeight: 6.23 },
                body: [
                [this.exp],
                [' - ' + this.exp11],
                [' - ' + this.exp2],
                [' - ' + this.exp3],
                [' - ' + this.exp4],
                [' - ' + this.exp5],
                [' - ' + this.exp6],
                [''],
                [''],
                [''],
                [''],
                [''],
                ]});
                pdf.autoTable({theme: 'plain', startY: 245, margin: {horizontal: 130}, tableWidth: 28, styles: { textColor: 20, fontSize: 7, fontStyle: 'bold'},
                body: [
                ['Lugar y Fecha:'],
                ]});
                pdf.autoTable({theme: 'plain', startY: 245, margin: {horizontal: 150}, tableWidth: 80, styles: { textColor: 20, fontSize: 7},
                body: [
                [this.propietario.cac + ', ' + diaCell + ' de ' + mesCell + ' de ' + anioCell],
                ]});
                pdf.autoTable({theme: 'plain', startY: 266, margin: {horizontal: 40}, tableWidth: 50, styles: { textColor: 20, fontSize: 7, fontStyle: 'bold'},
                body: [
                ['Funcionario Policial'],
                ]});
                pdf.autoTable({theme: 'plain', startY: 266, margin: {horizontal: 104}, tableWidth: 50, styles: { textColor: 20, fontSize: 7, fontStyle: 'bold'},
                body: [
                ['Vo. Bo.'],
                ]});
                pdf.autoTable({theme: 'plain', startY: 266, margin: {horizontal: 156}, tableWidth: 50, styles: { textColor: 20, fontSize: 7, fontStyle: 'bold'},
                body: [
                ['Comandante C.A.C'],
                ]});
                pdf.autoTable({theme: 'plain', startY: 260, margin: {horizontal: 25.5}, tableWidth: 55, styles: { halign: 'center', textColor: 20, fontSize: 7},
                body: [
                [this.grado + ' ' + this.$page.props.user.nombres + ' ' + this.$page.props.user.paterno + ' ' + this.$page.props.user.materno],
                ]});
                pdf.autoTable({theme: 'plain', startY: 260, margin: {horizontal: 141}, tableWidth: 55, styles: { halign: 'center', textColor: 20, fontSize: 7},
                body: [
                [this.$page.props.user.director],
                ]});

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

            var birthDateCan = new Date(this.can.dateNacPerro);
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
            this.diaLocal = dia;
            document.getElementById('mesC').innerHTML = mes;
            this.mesLocal = mes;
            document.getElementById('anioC').innerHTML = anio;
            this.anioLocal = anio;
        },
        components: {
            jsPDF,
            AppLayout,
        },
    }
</script>
