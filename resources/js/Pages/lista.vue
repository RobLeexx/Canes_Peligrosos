<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de propietarios
            </h2>
        </template>

        <v-app>
        <div class="py-12" style="background: #4a6813">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="padding-left: 10px; position: absolute; top: 10px">
                    <v-btn v-if="($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Secretaría')"
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
                    <!-- REPORTES -->
                    <v-col cols="12" sm="12" style="display: flex; justify-content: end; padding-top: 0">
                        <v-btn :disabled="($page.props.user.rol != 'Administrador') && ($page.props.user.rol != 'Secretaría')" @click="downloadReporte" color='primary' small style="margin-right: 20px">REPORTE</v-btn>
                    </v-col>
                        
                    <v-data-table style="padding-inline: 20px"
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
                        <template v-slot:item.canesDatos="{ item }">
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
                                :color="getColor(item.grupo)"
                                dark>
                                {{ item.grupo }}
                            </v-chip>
                        </template>
                        <template v-slot:item.conDatos="{ item }">
                            <div style="display: flex; align-items: center; height: 60px; text-align: center">
                                <div v-if="item.celular" class="text-sm font-medium text-gray-900">
                                    {{ item.celular }}
                                </div>
                                <div v-else-if="item.telefono" class="text-sm font-medium text-gray-900">
                                    {{ item.telefono }}
                                </div>
                                <div v-else-if="item.email" class="text-sm font-medium text-gray-900">
                                    {{ item.email }}
                                </div>
                                <div v-else-if="item.contactoAlterno" class="text-sm font-medium text-gray-900">
                                    {{ item.contactoAlterno }}
                                </div>
                            </div>
                        </template>
                        <template v-slot:item.adj="{ item }">
                            <div style="display: flex; align-items: center; justify-content: center">
                                <v-progress-circular
                                :value="100"
                                :color="colorPen(item.num)"
                                :size="40"
                                :width="5"
                                >{{ item.num }}</v-progress-circular>    
                            </div>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <div style="display: flex; align-items: center; justify-content: center">
                                <v-btn fab text :href="route('registros.show', item.id)"><v-icon>mdi-eye</v-icon></v-btn>
                                <v-btn fab text :disabled="($page.props.user.rol != 'Administrador') && ($page.props.user.username != item.creado_por)" :href="route('registros.edit', item.id)"><v-icon>mdi-pencil</v-icon></v-btn>
                            </div>
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
    import jsPDF from 'jspdf'
    import 'jspdf-autotable'
    import moment from 'moment'
    
    export default {
        props: {
            propietarios: Array,
            canes: Array,
            capacitaciones: Array,
            memo: Array,
            seguro: Array,
            antecedentes: Array,
        },
        data: function () {
            return {
                depFil: this.$page.props.user.departamento,
                search: '',
                registros: [],
                estadoCap: '',
                headers: [{ text: "PROPIETARIO", value: "propietarioDatos", sortable: false },
                        { text: "CAN", value: "canesDatos", sortable: false },
                        { text: "CAPACITACIÓN", value: "docExp", sortable: false, align: 'center' },
                        { text: "CONTACTOS", value: "conDatos", sortable: false },
                        { text: "C.A.C", value: "departamento", sortable: false, filter: this.depFilter },
                        { text: "PENDIENTES", value: "adj", sortable: false, align: 'center' },
                        { text: 'ACCIONES', value: 'actions', sortable: false, align: 'center' }],
                dep: ['La Paz', 'Cochabamba', 'Santa Cruz', 'Chuquisaca', 'Oruro', 'Potosí', 'Tarija', 'Beni', 'Pando'],
                diaLocal: [],
                mesLocal: [],
                anioLocal: [],
                grado: [],
            }
        },
        created () {
            /* Merge Canes y Propietarios en Registro */
            let mergedSubjects = this.propietarios.map(subject => {
            let canesID = this.canes.find(element => element.id === subject.id)
            let capID = this.capacitaciones.find(element => element.id === subject.id)
            let memoID = this.memo.find(element => element.id === subject.id)
            let segID = this.seguro.find(element => element.id === subject.id)
            let antID = this.antecedentes.find(element => element.id === subject.id)
            const reg = {...subject, ...canesID, ...capID, ...memoID, ...segID, ...antID}
            this.registros.push(reg)})
            /* Grados  */
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
                const propDatos = registro.paterno.concat(space,registro.materno,space,registro.nombres,registro.documento)
                const canDatos = registro.nomPerro.concat(space,registro.razaCan)
                const creacion = moment(String(registro.created_at)).format('YYYY-MM-DD hh:mm')
                /* Estado de capacitación */
                if(registro.estado == 'Sin Comenzar')
                {
                    registro.grupo = 'Sin Comenzar';
                }
                else if(registro.estado == 'En Curso')
                {
                    registro.grupo = 'En Curso'
                }
                else if(registro.estado == 'Finalizado')
                {
                    registro.grupo = 'Finalizado'
                }
                /* Adjuntos Pendientes */
                let numPen = 0;
                if(!registro.memoFile){
                    numPen += 1 }
                if(!registro.docFile){
                    numPen += 1 }
                if(!registro.boleta){
                    numPen += 1 }
                if(!registro.aCanesFile){
                    numPen += 1 }
                if(!registro.aFelccFile){
                    numPen += 1 }
                if(!registro.aFelcvFile){
                    numPen += 1 }
                if(!registro.aRejapFile){
                    numPen += 1 }
                if(!registro.aFelcnFile){
                    numPen += 1 }
                if(!registro.seguroFile){
                    numPen += 1 }
                if(!registro.vacFile){
                    numPen += 1 }
                if(!registro.estFile){
                    numPen += 1 }
            return {
                id: registro.id,
                propietarioDatos: propDatos,
                canesDatos: canDatos,
                fotoProp: registro.fotoProp,
                paterno: registro.paterno,
                materno: registro.materno,
                nombres: registro.nombres,
                documento: registro.documento,
                docExp: registro.docExp,

                nombreCom: registro.nombres + ' ' + registro.paterno + ' '  + registro.materno,

                celular: registro.celular,
                telefono: registro.telefono,
                email: registro.email,
                contactoAlterno: registro.contactoAlterno,
                creado_por: registro.creado_por,

                fotoCan: registro.fotoCan,
                fotoCan2: registro.fotoCan2,
                can: registro.nomPerro,
                raza: registro.razaCan,

                grupo: registro.grupo,
                departamento: registro.cac,
                actions: registro.id,

                /* PENDIENTES */
                docFile: registro.docFile,
                memoFile: registro.memoFile,
                boleta: registro.boleta,
                aCanesFile: registro.aCanesFile,
                aRejapFile: registro.aRejapFile,
                aFelccFile: registro.aFelccFile,
                aFelcvFile: registro.aFelcvFile,
                aFelcnFile: registro.aFelcnFile,
                seguroFile: registro.seguroFile,
                vacFile: registro.vacFile,
                estFile: registro.estFile,
                num: numPen,

                /* CREACION */
                creacion: creacion,
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
            getColor(grupo) {
                switch(grupo){
                    case 'Sin Comenzar': return 'red'
                    case 'En Curso': return 'orange darken-2'
                    case 'Finalizado': return 'green'
                }
            },
            colorPen(num) {
                switch(true){
                    case num > 3: return 'red'
                    case num <= 3 && num != 0 : return 'orange darken-2'
                    case num == 0: return 'green'
                }
            },
            downloadReporte(){
                /* Legal 22*36 
                   Legal PRUEBA REAL 21.7*33 */
                var pdf = new jsPDF('p', 'mm', [360, 217]);
                var img = new Image();
                var diaCell = this.diaLocal;
                var mesCell = this.mesLocal;
                var anioCell = this.anioLocal;
                const columns = [
                    { title: "Documento", dataKey: "documento" },
                    { title: "Nombre Completo", dataKey: "nombreCom" },
                    { title: "Can", dataKey: "can" },
                    { title: "Raza", dataKey: "raza" },
                    { title: "Fecha de Registro", dataKey: "creacion" }
                ];

                /*  Izquierda */
                pdf.setFontSize(9).text(this.grado + this.$page.props.user.nombres + ' ' + this.$page.props.user.paterno + ' ' + this.$page.props.user.materno, 10, 15);
                pdf.setFontSize(9).text(diaCell + ' de ' + mesCell + ' de ' + anioCell, 10, 20);

                /* Derecha */
                switch (this.$page.props.user.departamento)
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
                img.src = '/storage/img/logoPol.png';
                pdf.addImage(img, 'png', 181, 5, 14, 18);
                pdf.setFont(undefined, 'bold').setFontSize(7).text('CENTRO DE ADIESTRAMIENTO', 170, 27);
                pdf.setFont(undefined, 'bold').setFontSize(7).text('DE CANES (C.A.C)', 179, 30);
                pdf.setFont(undefined, 'bold').setFontSize(7).text(cac, 175, 33);
                
                /* Tabla */
                pdf.autoTable({
                    columns,
                    theme: 'grid',
                    body: this.registros,
                    margin: { left: 15, top: 40 }
                });

                /* Guardado */
                pdf.save('Reporte_' + this.$page.props.user.paterno)
            },
        },
        mounted() {
            this.reenviarRegistros();
            /* Fechas */
            var today = new Date();
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
            this.diaLocal = dia;
            this.mesLocal = mes;
            this.anioLocal = anio;
        },
        computed: {
        },
        components: {
            AppLayout,
            jsPDF,
            moment,
        },
    }
</script>
