<template>
    <app-layout>
        <template #header>
            <v-row>
                <v-btn fab small text :href="route('registros.index')"><v-icon>mdi-arrow-left-circle</v-icon></v-btn>
                <div style="padding: 9px">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ propietario.paterno }}, {{ propietario.documento }} {{ propietario.docExp }} 
                </h2>
                </div>
            </v-row>
        </template>

        <v-app>
        <div class="py-12" style="background: #33691E">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <v-row style="height: 100%; padding: 50px; display: flex; justify-content: space-around;">
                        <v-col cols="12" sm="6">
                            <h1 style="text-align: center; padding: 20px; font-size: large; font-weight: bold">PROPIETARIO</h1>
                            <v-row style="display: flex;justify-content: space-evenly">
                                <div></div>
                                <img style="max-width: 60%; padding-bottom: 15px" v-bind:src="'/storage/images/propietarios/' + propietario.fotoProp">
                                <div></div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Datos Personales
                                    </v-subheader>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Nombres
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.nombres }}
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Apellido Paterno
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.paterno }}
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Apellido Materno
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.materno }}
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Edad
                                </div>
                                <div style="padding: 20px" id="edad">
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                <div style="padding: 20px; font-weight: bold">
                                    Documento de Identidad
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.documento }} {{ propietario.docExp }} 
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Ubicación
                                    </v-subheader>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Localidad
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.departamento }}, {{ propietario.provincia }}, {{ propietario.municipio }} 
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Domicilio
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.domicilio }}
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Georreferenciación
                                    </v-subheader>
                                    <v-btn id="link" style="padding: 20px" color="primary" text :href="'https://www.google.com.bo/maps/search/' +  propietario.latitud + '++' + propietario.longitud " target="_blank"><v-icon>mdi-map-marker</v-icon> Google Maps</v-btn>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Latitud
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.latitud }}
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                <div style="padding: 20px; font-weight: bold">
                                    Longitud
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.longitud }}
                                </div>
                            </v-row>
                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Contactos
                                    </v-subheader>
                            </v-row>
                            <v-row v-if="propietario.celular" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Celular
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.celular }}
                                </div>
                            </v-row>
                            <v-row v-if="propietario.telefono" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Teléfono
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.telefono }}
                                </div>
                            </v-row>
                            <v-row v-if="propietario.email" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Email
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.email }}
                                </div>
                            </v-row>
                            <v-row v-if="propietario.contactoAlterno" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                <div style="padding: 20px; font-weight: bold">
                                    Contacto Alterno
                                </div>
                                <div style="padding: 20px">
                                    {{ propietario.contactoAlterno }}
                                </div>
                            </v-row>
                            
                        </v-col>
                        <v-col cols="12" sm="6">
                            <div v-for="can in canes" :key="can.id">
                            <div v-if="propietario.id == can.id">
                                <h1 style="text-align: center; padding: 20px; font-size: large; font-weight: bold">CAN</h1>
                                <v-row style="display: flex; justify-content: space-evenly">
                                    <div></div>
                                    <img style="max-width: 60%; padding-bottom: 15px" v-if="can.fotoCan != null" v-bind:src="'/storage/images/canes/' + can.fotoCan">
                                    <img style="max-width: 60%; padding-bottom: 15px" v-else v-bind:src="'/storage/images/canes/' + can.fotoCan2">
                                    <div></div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Datos del Can
                                    </v-subheader>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Nombre del Can
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.nomPerro }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Raza
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.razaCan }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Sexo del Can
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.sexoCan }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Edad del Can
                                    </div>
                                    <div style="padding: 20px" id="edadCan">
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                    <div style="padding: 20px; font-weight: bold">
                                        Procedencia
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.procedenciaCan }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Características del Can
                                    </v-subheader>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        ¿Es Pedigree?
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.pedigree }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Tamaño del Can
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.tamCan }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Color o Colores del Can
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.colorCan }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                    <div style="padding: 20px; font-weight: bold">
                                        Singularidades del Can
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.sinCan }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Estado Médico del Can
                                    </v-subheader>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Vacunación
                                    </v-subheader>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Fecha de Vacunación
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.dateVacPerro }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Veterinaria o Unidad Móvil
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.vetNom1 }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Ubicación
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.vetUbi1 }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Responsable
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.vetRes1 }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Contacto
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.vetNum1 }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Esterilización
                                    </v-subheader>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Fecha de Esterilización
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.dateEstPerro }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Veterinaria
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.vetNom2 }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Ubicación
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.vetUbi2 }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Responsable
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.vetRes2 }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Contacto
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.vetNum2 }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <v-subheader style="padding: 20px; font-weight: bold">
                                        Veterinaria de Vacuna y Esterilzación 
                                    </v-subheader>
                                </v-row>
                            </div>
                            </div>
                        </v-col>
                    </v-row>
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <!--<div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <tr style="display: flex">
                                <td class="px-6 py-20 whitespace-nowrap">
                                    <div class="flex items-center">
                                    <div class="ml-4" style="height: 100px; padding-top: 8.5px">
                                        <div class="text-sm font-medium text-gray-900">
                                        {{ propietario.id }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                        {{ propietario.materno}}
                                        </div>
                                        <div v-for="can in canes" :key="can.id">
                                            <div v-if="propietario.id == can.id">
                                                <div class="text-sm text-gray-500">
                                                    {{ can.raza }}
                                                </div>
                                                <div class="flex-shrink-0 h-10 w-15">
                                                    <img class="h-10 w-15 rounded-full" v-if="can.fotoCan != null" v-bind:src="'/storage/images/photos/' + can.fotoCan">
                                                    <img class="h-10 w-15 rounded-full" v-else v-bind:src="'/storage/images/photos/' + can.fotoCan2">
                                                </div>
                                            </div>
                                        </div>

                                        <div v-for="memorial in memoriales" :key="memorial.id" style="height: 50px">
                                            <div v-if="propietario.id == memorial.id">
                                                <v-btn :href="route('download', memorial.memoFile)"
                                                >{{ memorial.memoFile }}</v-btn>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </div>
                    </div>-->
                </div>
            </div>
        </div>
    </v-app>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            propietario: Object,
            memoriales: Array,
            canes: Array,
        },
        methods: {
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
            
        },
        components: {
            AppLayout,
        },
    }
</script>