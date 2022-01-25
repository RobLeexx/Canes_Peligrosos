<template>
    <app-layout>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{{ propietario.paterno }}</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vuetify/2.3.10/vuetify.css"/>
        </head>

    <template #header>
        <v-row style="display: flex; justify-content: space-between">
            <div style="display: flex; align-items: center">
                <v-btn fab small text :href="route('registros.index')"><v-icon>mdi-arrow-left-circle</v-icon></v-btn>
                <div class="font-semibold text-xl text-gray-800 leading-tight">
                {{ propietario.paterno }}, {{ propietario.documento }} {{ propietario.docExp }}</div>
            </div>
            <div class="font-semibold text-xl text-gray-800 leading-tight" style="display: flex; align-items: center">
            {{ propietario.cac }} </div>
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
                                        <v-subheader style="padding: 20px">
                                            Datos Personales
                                        </v-subheader>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Apellidos
                                    </div>
                                    <div style="padding: 20px">
                                        {{ propietario.paterno }} {{ propietario.materno }}
                                    </div>
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
                                        Edad
                                    </div>
                                    <div style="padding: 20px" id="edad">
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Profesión u Ocupación
                                    </div>
                                    <div style="padding: 20px">
                                        {{ propietario.profesion }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                    <div style="padding: 20px; font-weight: bold">
                                        Estado Civil
                                    </div>
                                    <div style="padding: 20px">
                                        {{ propietario.estCivil }}
                                    </div>
                                </v-row>
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                    <div style="padding: 14px; font-weight: bold">
                                        <v-tooltip v-if="propietario.docFile" top>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn :href="route('downloadDoc', propietario.docFile)" small color="primary" fab text v-bind="attrs" v-on="on"
                                            ><v-icon style="padding-bottom: 3px">mdi-card-account-details</v-icon></v-btn>
                                        </template>
                                        <span>{{ propietario.docFile }}</span>
                                        </v-tooltip>

                                        <v-tooltip v-else top>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-icon v-bind="attrs" v-on="on" color="red" style="padding-bottom: 3px">mdi-alert-circle</v-icon>
                                        </template>
                                        <span>Sin Archivo del Documento</span>
                                        </v-tooltip>
                                        Documento de Identidad
                                    </div>
                                    <div style="padding: 20px">
                                        {{ propietario.documento }} {{ propietario.docExp }} 
                                    </div>
                                </v-row>
                                <v-divider style="padding-bottom: 25px"></v-divider>
                                <template>
                                <v-expansion-panels focusable>
                                    <v-expansion-panel>
                                    <v-expansion-panel-header disable-icon-rotate>Ubicación
                                        <template v-slot:actions>
                                            <v-icon color="primary">
                                            mdi-home-city
                                            </v-icon>
                                        </template>
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                            <div style="padding: 20px; font-weight: bold">
                                                Localidad
                                            </div>
                                            <div style="padding: 20px">
                                                {{ propietario.departamento }}, {{ propietario.provincia }}, {{ propietario.municipio }} 
                                            </div>
                                        </v-row>
                                        <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                            <div style="padding: 20px; font-weight: bold">
                                                Zona
                                            </div>
                                            <div style="padding: 20px">
                                                {{ propietario.zona }}
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
                                                <v-subheader style="padding: 20px">
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
                                    </v-expansion-panel-content>
                                    </v-expansion-panel>
                                </v-expansion-panels>
                                </template>

                                <v-divider style="padding-bottom: 15px"></v-divider>

                                <template>
                                <v-expansion-panels focusable>
                                    <v-expansion-panel>
                                    <v-expansion-panel-header disable-icon-rotate>Contactos
                                        <template v-slot:actions>
                                            <v-icon color="primary">
                                            mdi-card-account-phone
                                            </v-icon>
                                        </template>
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-row v-if="propietario.celular" style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
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
                                    </v-expansion-panel-content>
                                    </v-expansion-panel>
                                </v-expansion-panels>
                                </template>

                                <v-divider style="padding-bottom: 15px"></v-divider>

                                <div>
                                <v-expansion-panels focusable>
                                    <v-expansion-panel>
                                    <v-expansion-panel-header disable-icon-rotate>Seguro de Responsabilidad Civil
                                        <template v-slot:actions>
                                            <v-icon v-if="seguro.seguroFile" color="primary">
                                            mdi-shield-account
                                            </v-icon>
                                            <v-icon v-else color="orange darken-2">
                                            mdi-shield-account
                                            </v-icon>
                                        </template>
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Agencia
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ seguro.nomAgencia }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="seguro.ubiAgencia" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Ubicación
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ seguro.ubiAgencia }}
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Fecha de Expedición
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ seguro.dateExpSeg }}
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Fecha de Expiración
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ seguro.dateLimSeg }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="seguro.resAgencia" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Responsable
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ seguro.resAgencia }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="seguro.resAgenciaNum" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Contacto
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ seguro.resAgenciaNum }}
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Seguro
                                                </div>
                                                <div v-if="seguro.seguroFile" style="padding-top: 14px">
                                                    <v-btn :href="route('downloadSeguro', seguro.seguroFile)" text
                                                    >{{ seguro.seguroFile }}<v-icon style="padding-left: 10px" color="primary">mdi-download</v-icon></v-btn>
                                                </div>
                                                <div v-else style="padding: 20px">
                                                    SIN ADJUNTAR
                                                </div>
                                            </v-row>
                                        
                                    </v-expansion-panel-content>
                                    </v-expansion-panel>
                                </v-expansion-panels>
                                </div>

                                <v-divider style="padding-bottom: 15px"></v-divider>

                                <template>
                                <v-expansion-panels focusable>
                                    <v-expansion-panel>
                                    <v-expansion-panel-header disable-icon-rotate>Memorial
                                        <template v-slot:actions>
                                            <div>
                                                <v-icon v-if="memorial.memoFile" color="primary">
                                                mdi-file-check
                                                </v-icon>
                                                <v-icon v-else color="orange darken-2">
                                                mdi-file-check
                                                </v-icon>
                                            </div>
                                        </template>
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Comandante
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ memorial.comandante }}
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Referencia
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ memorial.referencia }}
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Fecha de Expedición
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ memorial.dateMemo }}
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Memorial
                                                </div>
                                                <div v-if="memorial.memoFile" style="padding-top: 14px">
                                                    <v-btn :href="route('downloadMemo', memorial.memoFile)" text
                                                    >{{ memorial.memoFile }}<v-icon style="padding-left: 10px" color="primary">mdi-download</v-icon></v-btn>
                                                </div>
                                                <div v-else style="padding: 20px">
                                                    SIN ADJUNTAR
                                                </div>
                                            </v-row>
                                    </v-expansion-panel-content>
                                    </v-expansion-panel>
                                </v-expansion-panels>
                                </template>
                            <!-- DATOS DEL CAN -->
                            </v-col>
                            <v-col cols="12" sm="6">
                                <div>
                                    <h1 style="text-align: center; padding: 20px; font-size: large; font-weight: bold">CAN</h1>
                                    <v-row style="display: flex; justify-content: space-evenly">
                                        <div></div>
                                            <img style="max-width: 60%; padding-bottom: 15px; min-height: 268px; max-height: 268px" v-if="can.fotoCan != null" v-bind:src="'/storage/images/canes/' + can.fotoCan">
                                            <img style="max-width: 60%; padding-bottom: 15px; min-height: 268px; max-height: 268px" v-else-if="can.fotoCan2 != null" v-bind:src="'/storage/images/canes/' + can.fotoCan2">
                                        <div></div>
                                    </v-row>
                                    <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                        <v-subheader style="padding: 20px">
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
                                    <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                        <div style="padding: 20px; font-weight: bold">
                                            Procedencia
                                        </div>
                                        <div style="padding: 20px">
                                            {{ can.procedenciaCan }}
                                        </div>
                                    </v-row>
                                    <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 29px">
                                        <div style="padding: 20px; font-weight: bold">
                                            Microchip
                                        </div>
                                        <div v-if="can.numMicro" style="padding: 20px">
                                            {{ can.numMicro }}
                                        </div>
                                        <div v-else style="padding: 20px">
                                            NO TIENE
                                        </div>
                                    </v-row>
                                    <v-divider style="padding-bottom: 25px"></v-divider>
                                    <template>
                                    <v-expansion-panels focusable>
                                        <v-expansion-panel>
                                        <v-expansion-panel-header disable-icon-rotate>Características del Can
                                            <template v-slot:actions>
                                                <v-icon color="primary">
                                                mdi-paw
                                                </v-icon>
                                            </template>
                                        </v-expansion-panel-header>
                                        <v-expansion-panel-content>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Pedigree
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
                                        </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                    </template>
                                    
                                    <v-divider style="padding-bottom: 15px"></v-divider>

                                    <template>
                                    <v-expansion-panels focusable>
                                        <v-expansion-panel>
                                        <v-expansion-panel-header disable-icon-rotate>Estado Médico del Can
                                            <template v-slot:actions>
                                                <v-icon v-if="(can.vacuna == 'No') || (can.esterilizacion == 'No')" color="red">
                                                mdi-hospital-box
                                                </v-icon>
                                                <v-icon v-else-if="((can.vacuna && can.esterilizacion) == 'Sí') && !(can.vacFile && can.estFile)" color="orange darken-2">
                                                mdi-hospital-box
                                                </v-icon>
                                                <v-icon v-else color="primary">
                                                mdi-hospital-box
                                                </v-icon>
                                            </template>
                                        </v-expansion-panel-header>
                                        <v-expansion-panel-content>
                                            <div v-if="(can.vacuna == 'Sí') && (can.mismoVeterinario == 'No')" style="padding-bottom: 25px">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                    <v-subheader style="padding: 20px">
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
                                                <v-row v-if="can.vetUbi1" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Ubicación
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetUbi1 }}
                                                    </div>
                                                </v-row>
                                                <v-row v-if="can.vetRes1" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Responsable
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetRes1 }}
                                                    </div>
                                                </v-row>
                                                <v-row v-if="can.vetNum1" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Contacto
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetNum1 }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Certificado
                                                    </div>
                                                    <div v-if="can.vacFile" style="padding-top: 14px">
                                                        <v-btn :href="route('downloadVac', can.vacFile)" text
                                                        >{{ can.vacFile }}<v-icon style="padding-left: 10px" color="primary">mdi-download</v-icon></v-btn>
                                                    </div>
                                                    <div v-else style="padding: 20px">
                                                        SIN ADJUNTAR
                                                    </div>
                                                </v-row>
                                            </div>
                                            <v-row v-else-if="can.vacuna == 'No'" style="display: flex; padding-inline: 10%; padding-bottom: 25px; padding-top: 40px">
                                                <v-col cols="12" sm="12">
                                                    <v-subheader style="padding: 10px; font-weight: bold; justify-content: center">
                                                        SIN VACUNACIÓN
                                                    </v-subheader>
                                                </v-col>
                                            </v-row>
                                            <div v-if="(can.esterilizacion == 'Sí') && (can.mismoVeterinario == 'No')" style="padding-bottom: 25px">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <v-subheader style="padding: 20px">
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
                                                <v-row v-if="can.vetUbi2" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Ubicación
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetUbi2 }}
                                                    </div>
                                                </v-row>
                                                <v-row v-if="can.vetRes2" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Responsable
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetRes2 }}
                                                    </div>
                                                </v-row>
                                                <v-row v-if="can.vetNum2" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Contacto
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetNum2 }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Certificado
                                                    </div>
                                                    <div v-if="can.estFile" style="padding-top: 14px">
                                                        <v-btn :href="route('downloadEst', can.estFile)" text
                                                        >{{ can.estFile }}<v-icon style="padding-left: 10px" color="primary">mdi-download</v-icon></v-btn>
                                                    </div>
                                                    <div v-else style="padding: 20px">
                                                        SIN ADJUNTAR
                                                    </div>
                                                </v-row>
                                            </div>
                                            <v-row v-else-if="can.esterilizacion == 'No'" style="display: flex; padding-inline: 10%; padding-bottom: 25px">
                                                <v-col cols="12" sm="12">
                                                    <v-subheader style="padding: 10px; font-weight: bold; justify-content: center">
                                                        SIN ESTERILIZACIÓN
                                                    </v-subheader>
                                                </v-col>
                                            </v-row>
                                            <div v-if="(can.mismoVeterinario == 'Sí') && !(can.esterilizacion == 'No' || can.vacuna == 'No')" style="padding-bottom: 25px">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                    <v-subheader style="padding: 20px">
                                                        Veterinaria de Vacuna y Esterilzación 
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
                                                        {{ can.vetNom3 }}
                                                    </div>
                                                </v-row>
                                                <v-row v-if="can.vetUbi3" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Ubicación
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetUbi3 }}
                                                    </div>
                                                </v-row>
                                                <v-row v-if="can.vetRes3" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Responsable
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetRes3 }}
                                                    </div>
                                                </v-row>
                                                <v-row v-if="can.vetNum3" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Contacto
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ can.vetNum3 }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Certificado de Vacuna
                                                    </div>
                                                    <div v-if="can.vacFile" style="padding-top: 14px">
                                                        <v-btn :href="route('downloadVac', can.vacFile)" text
                                                        >{{ can.vacFile }}<v-icon style="padding-left: 10px" color="primary">mdi-download</v-icon></v-btn>
                                                    </div>
                                                    <div v-else style="padding: 20px">
                                                        SIN ADJUNTAR
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Certificado de Esterilización
                                                    </div>
                                                    <div v-if="can.estFile" style="padding-top: 14px">
                                                        <v-btn :href="route('downloadEst', can.estFile)" text
                                                        >{{ can.estFile }}<v-icon style="padding-left: 10px" color="primary">mdi-download</v-icon></v-btn>
                                                    </div>
                                                    <div v-else style="padding: 20px">
                                                        SIN ADJUNTAR
                                                    </div>
                                                </v-row>
                                            </div>
                                        </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                    </template>
                                    
                                    <v-divider style="padding-bottom: 15px"></v-divider>

                                    <template>
                                    <v-expansion-panels focusable>
                                        <v-expansion-panel>
                                        <v-expansion-panel-header disable-icon-rotate>Convinvecia del Can
                                            <template v-slot:actions>
                                                <v-icon color="primary">
                                                mdi-dog
                                                </v-icon>
                                            </template>
                                        </v-expansion-panel-header>
                                        <v-expansion-panel-content>
                                            <v-divider></v-divider>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 25px">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Cuidador o Cuidadores Eventuales
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canEven1 }}
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ can.canEvenNum1 }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="can.canEven2" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canEven2 }}
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ can.canEvenNum2 }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="can.canEven3" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canEven3 }}
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ can.canEvenNum3 }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="can.canEven4" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canEven4 }}
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ can.canEvenNum4 }}
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Motivos de Convivencia con el Can Peligroso
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canConvivencia }}
                                                </div>
                                            </v-row>
                                        </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                    </template>

                                    <v-divider style="padding-bottom: 15px"></v-divider>

                                    <template>
                                    <v-expansion-panels focusable>
                                        <v-expansion-panel>
                                        <v-expansion-panel-header disable-icon-rotate>Capacitación
                                            <template v-slot:actions>
                                                <v-icon color="primary">
                                                mdi-dog-side
                                                </v-icon>
                                            </template>
                                        </v-expansion-panel-header>
                                        <v-expansion-panel-content>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 25px">
                                                <v-subheader style="padding: 20px">
                                                    Microchip
                                                </v-subheader>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                                <div style="padding: 20px; font-weight: bold">
                                                    Número de Microchip
                                                </div>
                                                <div v-if="can.numMicro" style="padding: 20px">
                                                    {{ can.numMicro }}
                                                </div>
                                                <div v-else style="padding: 20px">
                                                    NO TIENE
                                                </div>
                                            </v-row>
                                            <v-divider></v-divider>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 25px">
                                                <v-subheader style="padding: 20px">
                                                    Cuidador o Cuidadores Eventuales
                                                </v-subheader>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canEven1 }}
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ can.canEvenNum1 }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="can.canEven2" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canEven2 }}
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ can.canEvenNum2 }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="can.canEven3" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canEven3 }}
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ can.canEvenNum3 }}
                                                </div>
                                            </v-row>
                                            <v-row v-if="can.canEven4" style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canEven4 }}
                                                </div>
                                                <div style="padding: 20px">
                                                    {{ can.canEvenNum4 }}
                                                </div>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 25px">
                                                <v-subheader style="padding: 20px">
                                                    Motivos de Convivencia con el Can Peligroso
                                                </v-subheader>
                                            </v-row>
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                <div style="padding: 20px">
                                                    {{ can.canConvivencia }}
                                                </div>
                                            </v-row>
                                        </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                    </template>
                                </div>
                            </v-col>
                            <!-- ANTECEDENTES -->
                            <v-col cols="12" sm="12">
                                <v-expansion-panels focusable>
                                    <v-expansion-panel>
                                    <v-expansion-panel-header disable-icon-rotate>Antecedentes del Propietario y Boleta de Pago
                                        <template v-slot:actions>
                                            <div style="padding-right: 15px">
                                                <v-icon v-if="!antecedente.aCanesFile || !antecedente.aRejapFile || !antecedente.aFelccFile || !antecedente.aFelcnFile || !antecedente.aFelcvFile" color="red">
                                                mdi-police-badge
                                                </v-icon>
                                                <v-icon v-else-if="antecedente.aCanes != 'Ninguno' || antecedente.aRejap != 'Ninguno' || antecedente.aFelcc != 'Ninguno' || antecedente.aFelcn != 'Ninguno' || antecedente.aFelcv != 'Ninguno'" color="orange darken-2">
                                                mdi-police-badge
                                                </v-icon>
                                                <v-icon v-else color="#33691E">
                                                mdi-police-badge
                                                </v-icon>
                                            </div>
                                            <v-icon v-if="propietario.boleta" color="#33691E">
                                            mdi-account-cash
                                            </v-icon>
                                            <v-icon v-else color="red">
                                            mdi-account-cash
                                            </v-icon>
                                        </template>
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-row>
                                            <v-col cols="12" sm="6">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 25px">
                                                    <v-subheader style="padding: 20px">
                                                        CANES
                                                    </v-subheader>

                                                    <v-tooltip v-if="antecedente.aCanesFile" top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-btn :href="route('downloadCanes', antecedente.aCanesFile)" small color="#33691E" fab text v-bind="attrs" v-on="on">
                                                                <v-icon v-if="antecedente.aCanes == 'Ninguno'">mdi-text-box-check</v-icon>
                                                                <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <span>{{ antecedente.aCanesFile }}</span>
                                                    </v-tooltip>
                                                    <v-tooltip v-else top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-icon color="red" style="padding-right: 15px" v-bind="attrs" v-on="on">mdi-text-box-remove</v-icon>
                                                        </template>
                                                        <span>Sin Archivo de Antecedentes de Canes</span>
                                                    </v-tooltip>

                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Número de Registro
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.numCanes }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Fecha y Hora
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aFechaHoraCanes }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Antecedentes
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aCanes }}
                                                    </div>
                                                </v-row>
                                                <v-divider></v-divider>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 25px">
                                                    <v-subheader style="padding: 20px">
                                                        REJAP
                                                    </v-subheader>
                                                    
                                                    <v-tooltip v-if="antecedente.aRejapFile" top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-btn :href="route('downloadRejap', antecedente.aRejapFile)" small color="#33691E" fab text v-bind="attrs" v-on="on">
                                                                <v-icon v-if="antecedente.aRejap == 'Ninguno'">mdi-text-box-check</v-icon>
                                                                <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <span>{{ antecedente.aRejapFile }}</span>
                                                    </v-tooltip>
                                                    <v-tooltip v-else top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-icon color="red" style="padding-right: 15px" v-bind="attrs" v-on="on">mdi-text-box-remove</v-icon>
                                                        </template>
                                                        <span>Sin Archivo de Antecedentes de Rejap</span>
                                                    </v-tooltip>

                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Número de Registro
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.numRejap }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Fecha y Hora
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aFechaHoraRejap }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Antecedentes
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aRejap }}
                                                    </div>
                                                </v-row>
                                                <v-divider></v-divider>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                    <v-subheader style="padding: 20px">
                                                        FELCC
                                                    </v-subheader>
                                                    
                                                    <v-tooltip v-if="antecedente.aFelccFile" top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-btn :href="route('downloadFelcc', antecedente.aFelccFile)" small color="#33691E" fab text v-bind="attrs" v-on="on">
                                                                <v-icon v-if="antecedente.aFelcc == 'Ninguno'">mdi-text-box-check</v-icon>
                                                                <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <span>{{ antecedente.aFelccFile }}</span>
                                                    </v-tooltip>
                                                    <v-tooltip v-else top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-icon color="red" style="padding-right: 15px" v-bind="attrs" v-on="on">mdi-text-box-remove</v-icon>
                                                        </template>
                                                        <span>Sin Archivo de Antecedentes de Felcc</span>
                                                    </v-tooltip>

                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Número de Registro
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.numFelcc }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Fecha y Hora
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aFechaHoraFelcc }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Antecedentes
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aFelcc }}
                                                    </div>
                                                </v-row>
                                                <v-divider></v-divider>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                    <v-subheader style="padding: 20px">
                                                        FELCN
                                                    </v-subheader>

                                                    <v-tooltip v-if="antecedente.aFelcnFile" top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-btn :href="route('downloadFelcn', antecedente.aFelcnFile)" small color="#33691E" fab text v-bind="attrs" v-on="on">
                                                                <v-icon v-if="antecedente.aFelcn == 'Ninguno'">mdi-text-box-check</v-icon>
                                                                <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <span>{{ antecedente.aFelcnFile }}</span>
                                                    </v-tooltip>
                                                    <v-tooltip v-else top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-icon color="red" style="padding-right: 15px" v-bind="attrs" v-on="on">mdi-text-box-remove</v-icon>
                                                        </template>
                                                        <span>Sin Archivo de Antecedentes de Felcn</span>
                                                    </v-tooltip>

                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Número de Registro
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.numFelcn }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Fecha y Hora
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aFechaHoraFelcn }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Antecedentes
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aFelcn }}
                                                    </div>
                                                </v-row>
                                                <v-divider></v-divider>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                    <v-subheader style="padding: 20px">
                                                        FELCV
                                                    </v-subheader>
                                                    
                                                    <v-tooltip v-if="antecedente.aFelcvFile" top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-btn :href="route('downloadFelcv', antecedente.aFelcvFile)" small color="#33691E" fab text v-bind="attrs" v-on="on">
                                                                <v-icon v-if="antecedente.aFelcv == 'Ninguno'">mdi-text-box-check</v-icon>
                                                                <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <span>{{ antecedente.aFelcvFile }}</span>
                                                    </v-tooltip>
                                                    <v-tooltip v-else top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-icon color="red" style="padding-right: 15px" v-bind="attrs" v-on="on">mdi-text-box-remove</v-icon>
                                                        </template>
                                                        <span>Sin Archivo de Antecedentes de Felcv</span>
                                                    </v-tooltip>

                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Número de Registro
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.numFelcv }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Fecha y Hora
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aFechaHoraFelcv }}
                                                    </div>
                                                </v-row>
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 25px">
                                                    <div style="padding: 20px; font-weight: bold">
                                                        Antecedentes
                                                    </div>
                                                    <div style="padding: 20px">
                                                        {{ antecedente.aFelcv }}
                                                    </div>
                                                </v-row>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                    <v-subheader style="padding: 20px">
                                                        BOLETA DE PAGO
                                                    </v-subheader>
                                                    
                                                    <v-tooltip v-if="propietario.boleta" top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-btn :href="route('downloadBol', propietario.boleta)" small color="#33691E" fab text v-bind="attrs" v-on="on">
                                                                <v-icon color="#33691E">mdi-cash-check</v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <span>{{ propietario.boleta }}</span>
                                                    </v-tooltip>
                                                    <v-tooltip v-else top>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-icon color="red" style="padding-right: 15px" v-bind="attrs" v-on="on">mdi-cash-remove</v-icon>
                                                        </template>
                                                        <span>Sin Boleta de Pago Adjuntada</span>
                                                    </v-tooltip>

                                                </v-row>
                                            </v-col>
                                        </v-row>
                                    </v-expansion-panel-content>
                                    </v-expansion-panel>
                                </v-expansion-panels>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6" style="text-align: center;padding-bottom: 50px">
                                <v-tooltip top>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                    :href="route('certificado.pdf', propietario.id)"
                                    color="success"
                                    elevation="15"
                                    fab
                                    x-large
                                    v-bind="attrs"
                                    v-on="on"
                                    ><v-icon>mdi-text-box</v-icon></v-btn>
                                </template>
                                <span v-if="($page.props.user.rol == 'Administrador') && ($page.props.user.rol == 'Secretaría')">Generar Autorización</span>
                                <span>Ver Autorización</span>
                                </v-tooltip>
                            </v-col>
                            <v-col cols="12" sm="6" style="text-align: center;padding-bottom: 50px">
                                <v-tooltip top>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn :disabled="($page.props.user.rol != 'Administrador') && ($page.props.user.rol != 'Secretaría')"
                                    :href="route('registros.edit', propietario.id)"
                                    color="primary"
                                    elevation="15"
                                    fab
                                    x-large
                                    v-bind="attrs"
                                    v-on="on"
                                    ><v-icon>mdi-pencil</v-icon></v-btn>
                                </template>
                                <span>Editar Datos</span>
                                </v-tooltip>
                            </v-col>
                        </v-row>
                    </div>
                </div>
            </div>
        </v-app>
    </app-layout>
</template>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.12/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vuetify/2.3.10/vuetify.min.js"></script>
<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            propietario: Object,
            memorial: Object,
            antecedente: Object,
            seguro: Object,
            can: Object,
        },
        data() {
            return {
                moreText: [
                "This is another few sentences of text to look at it.",
                "Just testing the paragraphs to see how they format.",
                "jsPDF likes arrays for sentences.",
                "Do paragraphs wrap properly?",
                "Yes, they do!",
                "What does it look like?",
                "Not bad at all."
            ],
            items: [
                { title: "Item 1", body: "I am item 1 body text" },
                { title: "Item 2", body: "I am item 2 body text" },
                { title: "Item 3", body: "I am item 3 body text" },
                { title: "Item 4", body: "I am item 4 body text" }
            ],
            }
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
                
            
        },
        components: {
            AppLayout,
        },
    }
</script>