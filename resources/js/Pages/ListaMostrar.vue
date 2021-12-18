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
                                    <v-subheader style="padding: 20px">
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
                                <div style="padding: 14px; font-weight: bold">
                                    <v-btn v-if="propietario.docFile" :href="route('downloadDoc', propietario.docFile)" small color="primary" fab text
                                        ><v-icon style="padding-bottom: 3px">mdi-card-account-details</v-icon></v-btn>
                                        <v-icon v-else color="red" style="padding-bottom: 3px">mdi-alert-circle</v-icon>
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

                            <div v-for="seguro in seguros" :key="seguro.id">
                            <div v-if="propietario.id == seguro.id">
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
                            </div>

                            <v-divider style="padding-bottom: 15px"></v-divider>

                            <template>
                            <v-expansion-panels focusable>
                                <v-expansion-panel>
                                <v-expansion-panel-header disable-icon-rotate>Memorial
                                    <template v-slot:actions>
                                        <div v-for="memorial in memoriales" :key="memorial.id">
                                        <div v-if="propietario.id == memorial.id">
                                        <v-icon v-if="memorial.memoFile" color="primary">
                                        mdi-file-check
                                        </v-icon>
                                        <v-icon v-else color="orange darken-2">
                                        mdi-file-check
                                        </v-icon>
                                        </div>
                                        </div>
                                    </template>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <div v-for="memorial in memoriales" :key="memorial.id" style="padding-top: 20px">
                                    <div v-if="propietario.id == memorial.id">
                                        <v-row style="display: flex; justify-content: space-between; padding-inline: 10%">
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
                                    </div>
                                    </div>
                                </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                            </template>
                        <!-- DATOS DEL CAN -->    
                        </v-col>
                        <v-col cols="12" sm="6">
                            <div v-for="can in canes" :key="can.id">
                            <div v-if="propietario.id == can.id">
                                <h1 style="text-align: center; padding: 20px; font-size: large; font-weight: bold">CAN</h1>
                                <v-row style="display: flex; justify-content: space-evenly">
                                    <div></div>
                                    <img style="max-width: 60%; padding-bottom: 15px; min-height: 272px" v-if="can.fotoCan != null" v-bind:src="'/storage/images/canes/' + can.fotoCan">
                                    <img style="max-width: 60%; padding-bottom: 15px" v-else v-bind:src="'/storage/images/canes/' + can.fotoCan2">
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
                                <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-bottom: 29px">
                                    <div style="padding: 20px; font-weight: bold">
                                        Procedencia
                                    </div>
                                    <div style="padding: 20px">
                                        {{ can.procedenciaCan }}
                                    </div>
                                </v-row>
                                <v-divider style="padding-bottom: 25px"></v-divider>
                                <template>
                                <v-expansion-panels focusable>
                                    <v-expansion-panel>
                                    <v-expansion-panel-header disable-icon-rotate>Características del Can
                                        <template v-slot:actions>
                                            <v-icon color="primary">
                                            mdi-dog-side
                                            </v-icon>
                                        </template>
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
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
                                            <v-icon v-if="(can.vetNom1 && can.vetNom2) || can.vetNom3" color="primary">
                                            mdi-hospital-box
                                            </v-icon>
                                            <v-icon v-else-if="(!can.vetNom1 && can.vetNom2) || (can.vetNom1 && !can.vetNom2)" color="orange darken-2">
                                            mdi-hospital-box
                                            </v-icon>
                                            <v-icon v-if="!can.vetNom1 && !can.vetNom2 && !can.vetNom3" color="red">
                                            mdi-hospital-box
                                            </v-icon>
                                        </template>
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <div v-if="can.vetNom1" style="padding-bottom: 25px">
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
                                        <v-row v-else-if="!can.vetNom1 && !can.vetNom3" style="display: flex; padding-inline: 10%; padding-bottom: 25px; padding-top: 20px">
                                            <v-col cols="12" sm="4"></v-col>
                                            <v-col cols="12" sm="6">
                                                <v-subheader style="padding: 10px; font-weight: bold; text-align: center">
                                                    SIN VACUNACIÓN
                                                </v-subheader>
                                            </v-col>
                                            <v-col cols="12" sm="2"></v-col>
                                        </v-row>
                                        <div v-if="can.vetNom2" style="padding-bottom: 25px">
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
                                        <v-row v-else-if="!can.vetNom2 && !can.vetNom3" style="display: flex; padding-inline: 10%; padding-bottom: 25px">
                                            <v-col cols="12" sm="4"></v-col>
                                            <v-col cols="12" sm="6">
                                                <v-subheader style="padding: 10px; font-weight: bold; text-align: center">
                                                    SIN ESTERILIZACIÓN
                                                </v-subheader>
                                            </v-col>
                                            <v-col cols="12" sm="2"></v-col>
                                        </v-row>
                                        <div v-if="can.vetNom3" style="padding-bottom: 25px">
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
                                                    Certificado
                                                </div>
                                                <div v-if="can.vetFile" style="padding-top: 14px">
                                                    <v-btn :href="route('downloadVac', can.vetFile)" text
                                                    >{{ can.vetFile }}<v-icon style="padding-left: 10px" color="primary">mdi-download</v-icon></v-btn>
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
                                    <v-expansion-panel-header disable-icon-rotate>Microchip y Convinvecia del Can
                                        <template v-slot:actions>
                                            <v-icon color="primary">
                                            mdi-dog
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

                                <v-divider style="padding-bottom: 15px"></v-divider>

                                <template>
                                <v-expansion-panels focusable>
                                    <v-expansion-panel>
                                    <v-expansion-panel-header disable-icon-rotate>Capacitación
                                        <template v-slot:actions>
                                            <v-icon color="primary">
                                            mdi-dog
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
                            </div>
                        </v-col>
                        <v-col cols="12" sm="12">
                            <template>
                            <v-expansion-panels focusable>
                                <v-expansion-panel>
                                <v-expansion-panel-header disable-icon-rotate>Antecedentes del Propietario
                                    <template v-slot:actions>
                                        <v-icon color="#33691E">
                                        mdi-police-badge
                                        </v-icon>
                                    </template>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <div v-for="antecedente in antecedentes" :key="antecedente.id">
                                    <v-row v-if="propietario.id == antecedente.id">
                                        <v-col cols="12" sm="6">
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                <v-subheader style="padding: 20px">
                                                    CANES
                                                </v-subheader>
                                                <v-btn v-if="antecedente.aCanesFile" :href="route('downloadCanes', antecedente.aCanesFile)" small color="#33691E" fab text>
                                                    <v-icon v-if="antecedente.aCanes == 'Ninguno'">mdi-text-box-check</v-icon>
                                                    <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                </v-btn>
                                                <v-icon v-else color="red">mdi-text-box-remove</v-icon>
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
                                            <v-row style="display: flex; justify-content: space-between; padding-inline: 10%; padding-top: 20px">
                                                <v-subheader style="padding: 20px">
                                                    REJAP
                                                </v-subheader>
                                                <v-btn v-if="antecedente.aRejapFile" :href="route('downloadRejap', antecedente.aRejapFile)" small color="#33691E" fab text>
                                                    <v-icon v-if="antecedente.aRejap == 'Ninguno'">mdi-text-box-check</v-icon>
                                                    <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                </v-btn>
                                                <v-icon v-else color="red">mdi-text-box-remove</v-icon>
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
                                                <v-btn v-if="antecedente.aFelccFile" :href="route('downloadFelcc', antecedente.aFelccFile)" small color="#33691E" fab text>
                                                    <v-icon v-if="antecedente.aFelcc == 'Ninguno'">mdi-text-box-check</v-icon>
                                                    <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                </v-btn>
                                                <v-icon v-else color="red">mdi-text-box-remove</v-icon>
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
                                                <v-btn v-if="antecedente.aFelcnFile" :href="route('downloadFelcn', antecedente.aFelcnFile)" small color="#33691E" fab text>
                                                    <v-icon v-if="antecedente.aFelcn == 'Ninguno'">mdi-text-box-check</v-icon>
                                                    <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                </v-btn>
                                                <v-icon v-else color="red">mdi-text-box-remove</v-icon>
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
                                                <v-btn v-if="antecedente.aFelcvFile" :href="route('downloadFelcv', antecedente.aFelcvFile)" small color="#33691E" fab text>
                                                    <v-icon v-if="antecedente.aFelcv == 'Ninguno'">mdi-text-box-check</v-icon>
                                                    <v-icon v-else color="orange darken-2">mdi-text-box</v-icon>
                                                </v-btn>
                                                <v-icon v-else color="red">mdi-text-box-remove</v-icon>
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
                                    </v-row>
                                    </div>
                                </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                            </template>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="12" style="text-align: center;padding-bottom: 50px">
                            <v-tooltip top>
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                color="primary"
                                elevation="15"
                                fab
                                x-large
                                v-bind="attrs"
                                v-on="on"
                                ><v-icon>mdi-text-box</v-icon></v-btn>
                            </template>
                            <span>Generar Certificado</span>
                            </v-tooltip>
                        </v-col>
                    </v-row>
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
            antecedentes: Array,
            seguros: Array,
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