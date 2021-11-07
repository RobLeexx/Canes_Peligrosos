<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Registro de Requisitos
            </h2>
        </template>

        <head>
            <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.1/mapbox-gl.css" type="text/css" />
            <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
            <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
        </head>

        <div class="py-12" style="background: #33691E">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <v-app>
                        <h1 style="
                            display: flex;
                            justify-content: center;
                            font-size: x-large;
                            padding: 50px" >
                            ART No.12: DOCUMENTOS A PRESENTAR POR EL PROPIETARIO DEL PERRO PELIGROSO</h1>
                        <template>
                            <v-stepper
                                v-model="e6"
                                vertical
                            >
                                <!-- 1. Datos del Memorial -->
                                <v-stepper-step
                                :complete="e6 > 1"
                                step="1"
                                >
                                Datos del Memorial
                                </v-stepper-step>

                                <v-stepper-content step="1">
                                <v-card
                                    class="mb-12"
                                    height="100%"
                                >

                                <template>
                                    <v-card flat>
                                        <v-form
                                        ref="form"
                                        @submit.prevent="submit"
                                        >
                                        <v-container>
                                            <v-row>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                id="comandante"
                                                v-model="form.comandante"
                                                :rules="vacio"
                                                label="Comandante Departamental"
                                                placeholder="Rango y nombre del Comandante Departamental"
                                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 192 && event.charCode <= 255) || (event.charCode == [209]) || (event.charCode == [241]) || (event.charCode == [32]) || (event.charCode == [39]) || (event.charCode == [46]))"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                id="referencia"
                                                v-model="form.referencia"
                                                :rules="vacio"
                                                label="Referencia"
                                                placeholder="Referencia adjuntada en el memorial"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                             <v-col cols="12" sm="6">
                                                <template>
                                                    <div>
                                                        <v-dialog
                                                        ref="menuMemo"
                                                        v-model="menuMemo"
                                                        :width="anchoDate"
                                                        >
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-text-field
                                                            v-model="form.dateMemo"
                                                            prepend-icon="mdi-calendar"
                                                            label="Fecha de expedición del Memorial"
                                                            :rules="vacio"
                                                            readonly
                                                            outlined
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            >
                                                            </v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                            v-model="form.dateMemo"
                                                            scrollable
                                                            locale="es"
                                                            :width="anchoDate"
                                                            :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                            min="2014-01-01"
                                                        ><v-spacer></v-spacer>
                                                            <v-btn
                                                                color="primary"
                                                                @click="$refs.menuMemo.save(form.dateMemo)"
                                                            >
                                                                OK
                                                            </v-btn></v-date-picker>
                                                        </v-dialog>
                                                    </div>
                                                </template>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <template>
                                                <v-file-input style="height: 45px"
                                                    outlined
                                                    dense
                                                    show-size
                                                ><template v-slot:label>
                                                    <div>
                                                    Memorial Adjuntado<small> (opcional)</small>
                                                    </div>
                                                    </template></v-file-input>
                                                <v-subheader style="
                                                    display: flex;
                                                    align-items: flex-start;
                                                    justify-content: flex-end;">
                                                    *Solo se admite un elemento</v-subheader>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" style="padding-top: 0;">
                                                <v-checkbox
                                                v-model="form.terms"
                                                color="green"
                                                >
                                                <template v-slot:label>
                                                    <div @click.stop="" style="padding-top: 15px">
                                                    El Propietario del Can Peligroso dispone de su cooperación para cumplir con los requisitos y capacitaciones dispuestos en la
                                                    <a
                                                        href="553"
                                                        @click.prevent="terms = true"
                                                    >Ley No.553</a>
                                                    inherente al tratamiento con animales domésticos. 
                                                    </div>
                                                </template>
                                                </v-checkbox>
                                            </v-col>
                                            </v-row>
                                        </v-container>
                                        </v-form>
                                        <v-dialog
                                        v-model="terms"
                                        width="70%"
                                        >
                                        <v-card>
                                            <v-card-title class="text-h6">
                                            Ley No.553
                                            </v-card-title>
                                            <v-card-text
                                            v-for="n in 5"
                                            :key="n"
                                            >
                                            {{ content }}
                                            </v-card-text>
                                            <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                text
                                                @click="terms = false"
                                            >
                                                Ok
                                            </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                        </v-dialog>
                                    </v-card>
                                </template>

                                </v-card>
                                <div style="padding: 15px">
                                    <v-btn
                                    :disabled="!form1IsValid"
                                    color="primary"
                                    @click="e6 = 2"
                                    >
                                    Continuar
                                    </v-btn>
                                </div>
                                </v-stepper-content>

                                <!-- 2. Datos del Propietario -->
                                <v-stepper-step
                                :complete="e6 > 2"
                                step="2"
                                editable
                                >
                                Datos del Propietario
                                </v-stepper-step>

                                <v-stepper-content step="2">
                                <v-card
                                    class="mb-12"
                                    height="100%"
                                >

                                <template>
                                    <v-card flat>
                                        <v-form
                                        ref="form"
                                        @submit.prevent="submit"
                                        >
                                        <v-container fluid>
                                            <v-row>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                v-model="form.paterno"
                                                :rules="vacio"
                                                label="Apellido Paterno"
                                                placeholder="Apellido Paterno del Propietario"
                                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 192 && event.charCode <= 255) || (event.charCode == [209]) || (event.charCode == [241]) || (event.charCode == [32]) || (event.charCode == [39]) || (event.charCode == [46]))"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                v-model="form.materno"
                                                :rules="vacio"
                                                label="Apellido Materno"
                                                placeholder="Apellido Materno (de no tener, repetir el apellido Paterno)"
                                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 192 && event.charCode <= 255) || (event.charCode == [209]) || (event.charCode == [241]) || (event.charCode == [32]) || (event.charCode == [39]) || (event.charCode == [46]))"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                v-model="form.nombres"
                                                :rules="vacio"
                                                label="Nombres"
                                                placeholder="Nombre o Nombres del Propietario"
                                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 192 && event.charCode <= 255) || (event.charCode == [209]) || (event.charCode == [241]) || (event.charCode == [32]) || (event.charCode == [39]) || (event.charCode == [46]))"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                             <v-col cols="12" sm="6">
                                                <template>
                                                    <div>
                                                        <v-dialog
                                                        ref="menuProp"
                                                        v-model="menuProp"
                                                        :width="anchoDate"
                                                        >
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-text-field
                                                            v-model="dateProp"
                                                            prepend-icon="mdi-calendar"
                                                            label="Fecha de expedición del Memorial"
                                                            :rules="vacio"
                                                            readonly
                                                            outlined
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            >
                                                            </v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                            v-model="dateProp"
                                                            scrollable
                                                            locale="es"
                                                            :width="anchoDate"
                                                            :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                            min="1930-01-01"
                                                        ><v-spacer></v-spacer>
                                                            <v-btn
                                                                color="primary"
                                                                @click="$refs.menuProp.save(dateProp)"
                                                            >
                                                                OK
                                                            </v-btn></v-date-picker>
                                                        </v-dialog>
                                                    </div>
                                                </template>
                                            </v-col>

                                            <v-col cols="12" sm="6">
                                                <v-autocomplete
                                                v-model="form.doc"
                                                :items= "doc"
                                                placeholder="Tipo de Documento de Identidad"
                                                :rules="vacio"
                                                outlined
                                                >
                                                </v-autocomplete>
                                            </v-col>
                                            <v-col cols="12" sm="4">
                                                <v-text-field
                                                v-model="form.documento"
                                                :rules="vacio"
                                                label="Documento de Identidad"
                                                placeholder="Documento de Identidad"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="2">
                                                <v-select 
                                                v-model="form.docExp"
                                                :items= "docExp"
                                                placeholder="Departamento"
                                                :rules="vacio"
                                                outlined></v-select>
                                            </v-col>
                                            <v-col cols="12" lg="6" sm="6">
                                                <template>
                                                    <v-file-input style="height: 45px"
                                                        outlined
                                                        dense
                                                        show-size
                                                    ><template v-slot:label>
                                                        <div>
                                                        Foto o escaneo del Documento<small> (opcional)</small>
                                                        </div>
                                                        </template></v-file-input>
                                                    <v-subheader style="
                                                        display: flex;
                                                        align-items: flex-start;
                                                        justify-content: flex-end;">
                                                        *Solo se admite un elemento</v-subheader>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" lg="1" sm="1" style="display: flex; justify-content: center; padding: 0">
                                                <v-dialog persistent fullscreen hide-overlay transition="dialog-bottom-transition" v-model="dialog">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-btn fab v-if="!photoTaken" color="primary" v-bind="attrs" v-on="on" @click="toggleCamera" :loading="dialog">
                                                            <v-icon>
                                                                mdi-camera-plus
                                                            </v-icon>
                                                        </v-btn>
                                                        <v-btn fab v-else color="success" v-bind="attrs" v-on="on" @click.prevent="dialog = true" :loading="dialog">
                                                            <v-icon>
                                                                mdi-image
                                                            </v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <v-card>
                                                        <v-toolbar
                                                        dark
                                                        color="primary"
                                                        >
                                                        <v-toolbar-title>Foto Frontal del Propietario</v-toolbar-title>
                                                        <v-spacer></v-spacer>
                                                        <v-toolbar-items>
                                                            <v-btn large v-if="!photoTaken" style="padding: 10px" text @click.prevent="dialog = false" @click="toggleCamera">
                                                                Cerrar
                                                            </v-btn>
                                                            <v-btn large v-else style="padding: 10px" text @click.prevent="dialog = false">
                                                                Guardar
                                                            </v-btn>
                                                        </v-toolbar-items>
                                                        </v-toolbar>

                                                        <div v-show="isCameraOpen && isLoading">
                                                            <ul>
                                                            <li></li>
                                                            <li></li>
                                                            <li></li>
                                                            </ul>
                                                        </div>
                                                        
                                                        <v-row style="padding:12px; margin-right: 5px">
                                                            <div v-if="isCameraOpen" v-show="!isLoading" :class="{ 'flash' : isShotPhoto }">
                                                                <div :class="{'flash' : isShotPhoto}"></div>
                                                                <video v-if="!photoTaken" ref="camera" :width="canvasWidth" :height="canvasHeight" autoplay id="player"></video>
                                                                <canvas v-show="photoTaken" ref="canvas" :width="canvasWidth" :height="canvasHeight"></canvas>
                                                            </div>
                                                            <v-row style="display: flex; flex-direction: column">
                                                                <div v-if="isCameraOpen && !isLoading && !photoTaken" style="text-align: center; padding: 50px">
                                                                    <v-btn fab color="success" @click="takePhoto">
                                                                        <v-icon>
                                                                            mdi-camera
                                                                        </v-icon>
                                                                    </v-btn>
                                                                </div>
                                                                <select style="padding:20px; margin-right: 20px; margin-left: 20px" v-show="!photoTaken" id="camaras"></select>
                                                                <div v-if="isCameraOpen && !isLoading && photoTaken" style="text-align: center; padding: 50px">
                                                                    <v-btn fab color="warning" @click="retryPhoto">
                                                                        <v-icon>
                                                                            mdi-reload
                                                                        </v-icon>
                                                                    </v-btn>
                                                                </div>
                                                            </v-row>
                                                        </v-row>
                                                        <v-divider></v-divider>
                                                    </v-card>
                                                </v-dialog>
                                            </v-col>
                                            <v-col cols="12" lg="5" md="5" sm="5">
                                                <template>
                                                    <v-text-field style="height: 45px"
                                                        disabled
                                                        :value="fotoProp"
                                                        label="Foto del Propietario"
                                                        outlined
                                                        dense
                                                        prepend-icon="mdi-face"
                                                    ></v-text-field>
                                                    <v-subheader style="
                                                        display: flex;
                                                        align-items: flex-start;
                                                        justify-content: flex-end;
                                                        color: grey">
                                                        *Solo se admite una foto</v-subheader>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="12">
                                                <v-subheader>Domicilio del propietario en Google Maps</v-subheader>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field 
                                                        v-model="form.ubiProp"
                                                        outlined
                                                        label="Domicilio"
                                                        placeholder="Departamento/Ciudad/Zona/Calle"
                                                        :rules="vacio"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" style="display:flex; align-items: center">
                                                <v-row>
                                                     <div style="padding-bottom: 25px; padding-left: 35px;"
                                                        id="longlat"
                                                    ></div>
                                                </v-row>
                                            </v-col>
                                            <v-col cols="12" sm="12">
                                                <div style="height: 500px" id="map"></div>
                                            </v-col>
                                            <v-col cols="12" sm="12">
                                                <v-subheader>Contactos *al menos un campo es obligatorio</v-subheader>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                    <v-text-field
                                                        v-model="form.cel"
                                                        :rules="cel"
                                                        label="Celular"
                                                        prepend-icon="mdi-phone"
                                                        placeholder="Teléfono móvil del proietario"
                                                        outlined
                                                        type="number"
                                                    ></v-text-field>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                    <v-text-field
                                                        v-model="form.tel"
                                                        :rules="tel"
                                                        label="Télefono"
                                                        prepend-icon="mdi-phone-classic"
                                                        placeholder="Télefono fijo del propietario"
                                                        outlined
                                                        type="number"
                                                    ></v-text-field>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                    <v-text-field
                                                        v-model="form.em"
                                                        label="Correo Elctrónico"
                                                        prepend-icon="mdi-at"
                                                        :rules="email"
                                                        placeholder="Correo Elctrónico del propietario"
                                                        outlined
                                                    ></v-text-field>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                    <v-text-field
                                                        v-model="form.cel2"
                                                        label="Otro Número de Contacto"
                                                        prepend-icon="mdi-phone-plus"
                                                        placeholder="Otro número de contacto del propietario"
                                                        outlined
                                                        type="number"
                                                    ></v-text-field>
                                                </template>
                                            </v-col>
                                            </v-row>
                                        </v-container>
                                        </v-form>
                                    </v-card>
                                </template>

                                </v-card>
                                <div style="padding: 15px">
                                    <v-btn
                                    :disabled="!form2IsValid"
                                    color="primary"
                                    @click="e6 = 3"
                                    >
                                    Continuar
                                    </v-btn>
                                    <v-btn @click="e6 = 1">
                                    Atrás
                                    </v-btn>
                                </div>
                                </v-stepper-content>

                                <!-- 3. Antecedentes del Propietario -->
                                <v-stepper-step
                                :complete="e6 > 3"
                                step="3"
                                editable
                                >
                                Antecedentes del Propietario
                                </v-stepper-step>

                                <v-stepper-content step="3">
                                <v-card
                                    color="grey lighten-1"
                                    class="mb-12"
                                    height="100%"
                                >
                                <template>
                                    <v-card
                                        flat
                                        tile
                                    >
                                        <v-window
                                        v-model="onboarding"
                                        >
                                        <v-window-item
                                            :key="`card-${1}`"
                                        >
                                            <v-card
                                            height="100%"
                                            >
                                            <v-row style="padding: 20px; justify-content: space-between"><v-btn text @click="prev">
                                                <v-icon>mdi-chevron-left</v-icon>
                                            </v-btn>
                                            <h1 style="text-align: center; font-size: large; padding-top: 5px">Privación o Suspensión Temporal Previa a la Autorización o Licencia de Crianza</h1>
                                            <v-btn text @click="next">
                                                <v-icon>mdi-chevron-right</v-icon>
                                            </v-btn></v-row>
                                            <v-divider></v-divider>
                                            
                                            <v-row style="padding: 20px">
                                                <v-col cols="12" sm="6">
                                                    <v-text-field v-model="form.aCanes" :rules="vacio" outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen1"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model1"
                                                        :width="anchoDate2a">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate1"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar-clock"
                                                                readonly
                                                                outlined
                                                                :rules="vacio"
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel1"
                                                                        :width="anchoDate2b"
                                                                        locale="es"
                                                                        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex xs12 sm6 style="display:block; text-align: center">
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen1" 
                                                                        v-model="timeModel1" 
                                                                        color="primary"
                                                                        :width="anchoDate2b"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection1 }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm1()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen1 = false">Cancelar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        outlined
                                                        dense
                                                        show-size
                                                    ><template v-slot:label>
                                                        <div>
                                                        Antecedentes CANES Adjuntados<small> (opcional)</small>
                                                        </div>
                                                        </template></v-file-input>
                                                    <v-subheader style="
                                                        display: flex;
                                                        align-items: flex-start;
                                                        justify-content: flex-end;">
                                                        *Solo se admite un elemento</v-subheader>
                                                    </template>
                                                </v-col>
                                                <v-col cols="12" sm="4">
                                                    <v-switch style="padding-left: 30px; display: flex; justify-content: flex-end"
                                                    v-model="switchCANES"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="2" style="padding-top: 10">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchCANES == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>
                                                    
                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes CANES</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchCANES == '1'" v-model="eCanes" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else v-model="eCanes" solo disabled></v-textarea>
                                            </v-col>

                                            </v-card>
                                        </v-window-item>
                                        <v-window-item
                                            :key="`card-${2}`"
                                        >
                                            <v-card
                                            height="100%"
                                            >
                                            <v-row style="padding: 20px; justify-content: space-between"><v-btn text @click="prev">
                                                <v-icon>mdi-chevron-left</v-icon>
                                            </v-btn>
                                            <h1 style="text-align: center; font-size: large; padding-top: 5px">Certificado de Registro Judicial de Antecedentes Penales - REJAP</h1>
                                            <v-btn text @click="next">
                                                <v-icon>mdi-chevron-right</v-icon>
                                            </v-btn></v-row>
                                            <v-divider></v-divider>
                                            
                                            <v-row style="padding: 20px">
                                                <v-col cols="12" sm="6">
                                                    <v-text-field v-model="form.aRejap" outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen2"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model2"
                                                        :width="anchoDate2a">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate2"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar-clock"
                                                                readonly
                                                                outlined
                                                                :rules="vacio"
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel2"
                                                                        :width="anchoDate2b"
                                                                        locale="es"
                                                                        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex xs12 sm6 style="display:block; text-align: center">
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen2" 
                                                                        v-model="timeModel2" 
                                                                        color="primary"
                                                                        :width="anchoDate2b"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection2 }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm2()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen2 = false">Cancelar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        outlined
                                                        dense
                                                        show-size
                                                    ><template v-slot:label>
                                                        <div>
                                                        Antecedentes REJAP Adjuntados<small> (opcional)</small>
                                                        </div>
                                                        </template></v-file-input>
                                                    <v-subheader style="
                                                        display: flex;
                                                        align-items: flex-start;
                                                        justify-content: flex-end;">
                                                        *Solo se admite un elemento</v-subheader>
                                                    </template>
                                                </v-col>
                                                <v-col cols="12" sm="4">
                                                    <v-switch style="padding-left: 30px; display: flex; justify-content: flex-end"
                                                    v-model="switchREJAP"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="2" style="padding-top: 10">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchREJAP == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>

                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes REJAP</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchREJAP == '1'" v-model="eRejap" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else v-model="eRejap" solo disabled label="Ninguno"></v-textarea>
                                            </v-col>

                                            </v-card>
                                        </v-window-item>
                                        <v-window-item
                                            :key="`card-${3}`"
                                        >
                                            <v-card
                                            height="100%"
                                            >
                                            <v-row style="padding: 20px; justify-content: space-between"><v-btn text @click="prev">
                                                <v-icon>mdi-chevron-left</v-icon>
                                            </v-btn>
                                            <h1 style="text-align: center; font-size: large; padding-top: 5px">Certificado de Antecedentes Policiales: Fuerza Especial de Lucha Contra el Crimen (F.E.L.C.C)</h1>
                                            <v-btn text @click="next">
                                                <v-icon>mdi-chevron-right</v-icon>
                                            </v-btn></v-row>
                                            <v-divider></v-divider>
                                            
                                            <v-row style="padding: 20px">
                                                <v-col cols="12" sm="6">
                                                    <v-text-field v-model="form.aFelcc" outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen3"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model3"
                                                        :width="anchoDate2a">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate3"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar-clock"
                                                                readonly
                                                                outlined
                                                                :rules="vacio"
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel3"
                                                                        :width="anchoDate2b"
                                                                        locale="es"
                                                                        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex xs12 sm6 style="display:block; text-align: center">
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen3" 
                                                                        v-model="timeModel3" 
                                                                        color="primary"
                                                                        :width="anchoDate2b"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection3 }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm3()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen3 = false">Cancelar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        outlined
                                                        dense
                                                        show-size
                                                    ><template v-slot:label>
                                                        <div>
                                                        Antecedentes FELCC Adjuntados<small> (opcional)</small>
                                                        </div>
                                                        </template></v-file-input>
                                                    <v-subheader style="
                                                        display: flex;
                                                        align-items: flex-start;
                                                        justify-content: flex-end;">
                                                        *Solo se admite un elemento</v-subheader>
                                                    </template>
                                                </v-col>
                                                <v-col cols="12" sm="4">
                                                    <v-switch style="padding-left: 30px; display: flex; justify-content: flex-end"
                                                    v-model="switchFELCC"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="2" style="padding-top: 10">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchFELCC == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>

                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes FELCC</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchFELCC == '1'" v-model="eFelcc" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else v-model="eFelcc" solo disabled label="Ninguno"></v-textarea>
                                            </v-col>

                                            </v-card>
                                        </v-window-item>
                                        <v-window-item
                                            :key="`card-${4}`"
                                        >
                                            <v-card
                                            height="100%"
                                            >
                                            <v-row style="padding: 20px; justify-content: space-between"><v-btn text @click="prev">
                                                <v-icon>mdi-chevron-left</v-icon>
                                            </v-btn>
                                            <h1 style="text-align: center; font-size: large; padding-top: 5px">Certificado de Antecedentes Policiales: Fuerza Especial de Lucha Contra el Narcotráfico (F.E.L.C.N)</h1>
                                            <v-btn text @click="next">
                                                <v-icon>mdi-chevron-right</v-icon>
                                            </v-btn></v-row>
                                            <v-divider></v-divider>
                                            
                                            <v-row style="padding: 20px">
                                                <v-col cols="12" sm="6">
                                                    <v-text-field v-model="form.aFelcn" outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen4"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model4"
                                                        :width="anchoDate2a">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate4"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar-clock"
                                                                readonly
                                                                outlined
                                                                :rules="vacio"
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel4"
                                                                        :width="anchoDate2b"
                                                                        locale="es"
                                                                        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex xs12 sm6 style="display:block; text-align: center">
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen4" 
                                                                        v-model="timeModel4" 
                                                                        color="primary"
                                                                        :width="anchoDate2b"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection4 }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm4()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen4 = false">Cancelar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        outlined
                                                        dense
                                                        show-size
                                                    ><template v-slot:label>
                                                        <div>
                                                        Antecedentes FELCN Adjuntados<small> (opcional)</small>
                                                        </div>
                                                        </template></v-file-input>
                                                    <v-subheader style="
                                                        display: flex;
                                                        align-items: flex-start;
                                                        justify-content: flex-end;">
                                                        *Solo se admite un elemento</v-subheader>
                                                    </template>
                                                </v-col>
                                                <v-col cols="12" sm="4">
                                                    <v-switch style="padding-left: 30px; display: flex; justify-content: flex-end"
                                                    v-model="switchFELCN"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="2" style="padding-top: 10">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchFELCN == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>

                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes FELCN</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchFELCN == '1'" v-model="eFelcn" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else v-model="eFelcn" solo disabled label="Ninguno"></v-textarea>
                                            </v-col>

                                            </v-card>
                                        </v-window-item>
                                        <v-window-item
                                            :key="`card-${5}`"
                                        >
                                            <v-card
                                            height="100%"
                                            >
                                            <v-row style="padding: 20px; justify-content: space-between"><v-btn text @click="prev">
                                                <v-icon>mdi-chevron-left</v-icon>
                                            </v-btn>
                                            <h1 style="text-align: center; font-size: large; padding-top: 5px">Certificado de Antecedentes Policiales: Fuerza Especial de Lucha Contra la Violencia (F.E.L.C.V)</h1>
                                            <v-btn text @click="next">
                                                <v-icon>mdi-chevron-right</v-icon>
                                            </v-btn></v-row>
                                            <v-divider></v-divider>
                                            
                                            <v-row style="padding: 20px">
                                                <v-col cols="12" sm="6">
                                                    <v-text-field v-model="form.aFelcv" outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen5"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model5"
                                                        :width="anchoDate2a">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate5"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar-clock"
                                                                readonly
                                                                outlined
                                                                :rules="vacio"
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel5"
                                                                        :width="anchoDate2b"
                                                                        locale="es"
                                                                        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex xs12 sm6 style="display:block; text-align: center">
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen5" 
                                                                        v-model="timeModel5" 
                                                                        color="primary"
                                                                        :width="anchoDate2b"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection5 }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm5()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen5 = false">Cancelar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        outlined
                                                        dense
                                                        show-size
                                                    ><template v-slot:label>
                                                        <div>
                                                        Antecedentes FELCV Adjuntados<small> (opcional)</small>
                                                        </div>
                                                        </template></v-file-input>
                                                    <v-subheader style="
                                                        display: flex;
                                                        align-items: flex-start;
                                                        justify-content: flex-end;">
                                                        *Solo se admite un elemento</v-subheader>
                                                    </template>
                                                </v-col>
                                                <v-col cols="12" sm="4">
                                                    <v-switch style="padding-left: 30px; display: flex; justify-content: flex-end"
                                                    v-model="switchFELCV"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="2" style="padding-top: 10">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchFELCV == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>

                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes FELCV</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchFELCV == '1'" v-model="eFelcv" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else solo v-model="eFelcv" disabled label="Ninguno"></v-textarea>
                                            </v-col>

                                            </v-card>
                                        </v-window-item>
                                        </v-window>

                                        <v-divider></v-divider>
                                        <v-card-actions style="display: flex; justify-content: center">
                                        <v-item-group
                                            v-model="onboarding"
                                            class="d-none d-sm-block"
                                            mandatory
                                        >
                                            <v-item
                                            :key="`btn-${1}`"
                                            v-slot="{ active, toggle }"
                                            >
                                            <v-btn v-if="canesCheck"
                                                :input-value="active"
                                                text
                                                color="success"
                                                @click="toggle"
                                            >
                                                CANES
                                                <v-icon right>
                                                mdi-check
                                                </v-icon>
                                            </v-btn>
                                            <v-btn v-else
                                                :input-value="active"
                                                text
                                                color="primary"
                                                @click="toggle"
                                            >
                                                CANES
                                            </v-btn>
                                            </v-item>
                                            <v-item
                                            :key="`btn-${2}`"
                                            v-slot="{ active, toggle }"
                                            >
                                            <v-btn v-if="rejapCheck"
                                                :input-value="active"
                                                text
                                                color="success"
                                                @click="toggle"
                                            >
                                                REJAP
                                                <v-icon right>
                                                mdi-check
                                                </v-icon>
                                            </v-btn>
                                            <v-btn v-else
                                                :input-value="active"
                                                text
                                                color="primary"
                                                @click="toggle"
                                            >
                                                REJAP
                                            </v-btn>
                                            </v-item>
                                            <v-item
                                            :key="`btn-${3}`"
                                            v-slot="{ active, toggle }"
                                            >
                                            <v-btn v-if="felccCheck"
                                                :input-value="active"
                                                text
                                                color="success"
                                                @click="toggle"
                                            >
                                                FELCC
                                                <v-icon right>
                                                mdi-check
                                                </v-icon>
                                            </v-btn>
                                            <v-btn v-else
                                                :input-value="active"
                                                text
                                                color="primary"
                                                @click="toggle"
                                            >
                                                FELCC
                                            </v-btn>
                                            </v-item>
                                            <v-item
                                            :key="`btn-${4}`"
                                            v-slot="{ active, toggle }"
                                            >
                                            <v-btn v-if="felcnCheck"
                                                :input-value="active"
                                                text
                                                color="success"
                                                @click="toggle"
                                            >
                                                FELCN
                                                <v-icon right>
                                                mdi-check
                                                </v-icon>
                                            </v-btn>
                                            <v-btn v-else
                                                :input-value="active"
                                                text
                                                color="primary"
                                                @click="toggle"
                                            >
                                                FELCN
                                            </v-btn>
                                            </v-item>
                                            <v-item
                                            :key="`btn-${5}`"
                                            v-slot="{ active, toggle }"
                                            >
                                            <v-btn v-if="felcvCheck"
                                                :input-value="active"
                                                text
                                                color="success"
                                                @click="toggle"
                                            >
                                                FELCV
                                                <v-icon right>
                                                mdi-check
                                                </v-icon>
                                            </v-btn>
                                            <v-btn v-else
                                                :input-value="active"
                                                text
                                                color="primary"
                                                @click="toggle"
                                            >
                                                FELCV
                                            </v-btn>
                                            </v-item>
                                        </v-item-group>
                                        </v-card-actions>
                                    </v-card>
                                </template>
                                </v-card>
                                <div style="padding: 15px">
                                    <v-btn
                                        :disabled="!form3IsValid"
                                        color="primary"
                                        @click="e6 = 4"
                                    >
                                        Continuar
                                    </v-btn>
                                    <v-btn @click="e6 = 2">
                                        Atrás
                                    </v-btn>
                                </div>
                                </v-stepper-content>

                                <!-- 4. Seguro Obligatorio de Responsabilidad Civil -->
                                <v-stepper-step 
                                :complete="e6 > 4"
                                step="4"
                                editable>
                                Seguro Obligatorio de Responsabilidad Civil
                                </v-stepper-step>

                                <v-stepper-content step="4">
                                <v-card
                                    class="mb-12"
                                    height="100%"
                                >

                                <v-container fluid>
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <v-text-field 
                                        v-model="form.nomAgencia"
                                        :rules="vacio"
                                        label="Agencia"
                                        placeholder="Nombre de la Agencia" 
                                        outlined></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <v-text-field 
                                        v-model="form.ubiAgencia"
                                        placeholder="Departamento/Ciudad/Zona/Calle" 
                                        outlined>
                                        <template v-slot:label>
                                            <div>
                                            Ubicación<small> (opcional)</small>
                                            </div>
                                        </template>
                                        </v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <template>
                                            <div>
                                                <v-dialog
                                                ref="menuExpSeg"
                                                v-model="menuExpSeg"
                                                :width="anchoDate"
                                                >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                    v-model="dateExpSeg"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Expedición del Seguro"
                                                    :rules="vacio"
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="dateExpSeg"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    min="2000-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuExpSeg.save(dateExpSeg)"
                                                    >
                                                        OK
                                                    </v-btn></v-date-picker>
                                                </v-dialog>
                                            </div>
                                        </template>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <template>
                                            <div>
                                                <v-dialog
                                                ref="menuLimSeg"
                                                v-model="menuLimSeg"
                                                :width="anchoDate"
                                                >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                    v-model="dateLimSeg"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Expiración del Seguro"
                                                    :rules="vacio"
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="dateLimSeg"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :min="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    max="2040-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuLimSeg.save(dateLimSeg)"
                                                    >
                                                        OK
                                                    </v-btn></v-date-picker>
                                                </v-dialog>
                                            </div>
                                        </template>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <v-text-field 
                                        v-model="form.resAgencia"
                                        placeholder="Agente Responsable del Trámite" 
                                        outlined>
                                        <template v-slot:label>
                                            <div>
                                            Responsable<small> (opcional)</small>
                                            </div>
                                        </template></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <v-text-field 
                                        v-model="form.resAgenciaNum"
                                        type="number"
                                        placeholder="Número de Referencia de la Agencia o Agente Responsable" 
                                        outlined>
                                        <template v-slot:label>
                                            <div>
                                            Número de Referencia<small> (opcional)</small>
                                            </div>
                                        </template></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <template>
                                            <v-file-input style="height: 45px"
                                                outlined
                                                dense
                                                show-size
                                            ><template v-slot:label>
                                                <div>
                                                Seguro Adjuntado<small> (opcional)</small>
                                                </div>
                                                </template></v-file-input>
                                            <v-subheader style="
                                                display: flex;
                                                align-items: flex-start;
                                                justify-content: flex-end;">
                                                *Solo se admite un elemento</v-subheader>
                                            </template>
                                        </v-col>
                                    </v-row>
                                </v-container>
                                
                                </v-card>
                                <div style="padding: 15px">
                                    <v-btn
                                        :disabled="!form4IsValid"
                                        color="primary"
                                        @click="e6 = 5"
                                    >
                                        Continuar
                                    </v-btn>
                                    <v-btn @click="e6 = 3">
                                        Atrás
                                    </v-btn>
                                </div>
                                </v-stepper-content>

                                <!-- 5. Datos del Can Peligroso -->
                                <v-stepper-step step="5" editable>
                                Datos del Can Peligroso
                                </v-stepper-step>

                                <v-stepper-content step="5">
                                <v-card
                                    class="mb-12"
                                    height="100%"
                                >
                                <v-container fluid>
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <v-text-field 
                                        v-model="form.nomPerro"
                                        :rules="vacio"
                                        label="Nombre"
                                        placeholder="Nombre del Can" 
                                        outlined></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <template>
                                            <div>
                                                <v-dialog
                                                ref="menuNacPerro"
                                                v-model="menuNacPerro"
                                                :width="anchoDate"
                                                >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                    v-model="dateNacPerro"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Nacimiento del Can o Aproximada"
                                                    :rules="vacio"
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="dateNacPerro"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    min="2000-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuNacPerro.save(dateNacPerro)"
                                                    >
                                                        OK
                                                    </v-btn></v-date-picker>
                                                </v-dialog>
                                            </div>
                                        </template>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <v-autocomplete
                                            v-model="form.sexoCan"
                                            :items= "sexoCan2"
                                            placeholder="Sexo del Can"
                                            :rules="vacio"
                                            outlined
                                            >
                                        </v-autocomplete>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <v-text-field 
                                        v-model="form.procedenciaCan"
                                        :rules="vacio"
                                        label="Procedencia"
                                        placeholder="Procedencia de la Adquisición del Can" 
                                        outlined></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12">
                                            <v-subheader>Caracterísicas de Raza del Can</v-subheader>
                                        </v-col>
                                        <v-col cols="12" sm="12">
                                            <h1 style="text-align: center; font-size: 20px">ART No.4 (LEY No 553): DEFINICIÓN DE CAN PELIGROSO SEGÚN SU RAZA</h1>
                                        </v-col>
                                        <v-col cols="12" sm="1"></v-col>
                                        <v-col cols="12" sm="10" class="d-none d-sm-block">
                                            <template>
                                            <v-carousel>
                                                <v-carousel-item
                                                v-for="(raza,i) in razas"
                                                :key="i"
                                                :src="raza.src">
                                                </v-carousel-item>
                                            </v-carousel>
                                            </template>
                                        </v-col>
                                        <v-col cols="12" sm="8" class="d-block d-sm-none">
                                            <template>
                                            <v-carousel hide-delimiters width="auto" height="auto">
                                                <v-carousel-item
                                                v-for="(raza,i) in razas"
                                                :key="i"
                                                :src="raza.src">
                                                </v-carousel-item>
                                            </v-carousel>
                                            </template>
                                        </v-col>
                                        <v-col cols="12" sm="1"></v-col>
                                        <v-col cols="12" sm="3" style="display: flex; align-items: center; justify-content: center; padding: 0">
                                            <v-switch
                                            v-model="switchPuro"
                                            inset
                                            label="¿Es Pedigree?">
                                            </v-switch>
                                        </v-col>
                                        <v-col cols="12" sm="1" style="display: flex; align-items: center; justify-content: center; padding: 0">
                                            <v-tooltip bottom>
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-icon right v-bind="attrs" v-on="on">mdi-help-circle</v-icon>
                                                </template>
                                                <span>¿Es un Can de Raza Pura?</span>
                                            </v-tooltip>
                                        </v-col>
                                        <v-col cols="12" sm="2" style="display: flex; align-items: center; justify-content: flex-start">
                                            <v-card-text style="margin-top:5px; text-align: center" v-if="switchPuro == '1'">Sí</v-card-text>
                                            <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                        </v-col>
                                        <v-col cols="12" sm="6" style="padding-top: 38px">
                                            <v-autocomplete v-if="switchPuro == '1'"
                                                v-model="form.razaCan"
                                                :raza="razas"
                                                :items= "razasNames"
                                                :rules="vacio"
                                                placeholder="Especifique la Raza del Can"
                                                outlined>
                                            </v-autocomplete>
                                            <v-text-field v-else
                                                v-model="form.razaCan"
                                                :rules="vacio"
                                                label="Raza"
                                                placeholder="Especifique la Raza o Cruce de Razas del Can"
                                                outlined>
                                            </v-text-field>
                                        </v-col>
                                        </v-row>
                                        <v-row>
                                        <v-col cols="12" sm="6">
                                            <v-autocomplete v-model="form.tamCan" :items= "tamCan" :rules="vacio" outlined placeholder="Tamaño del Can"></v-autocomplete>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-text-field v-model="form.colorCan" outlined label="Color" :rules="vacio" placeholder="Color o Colores Característicos del Can">
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12">
                                            <v-textarea v-model="form.sinCan" outlined label="Singularidades del Can" :rules="vacio" placeholder="Rasgos Característicos del Can, ej: cicatrices, color de ojos, etc.">
                                            </v-textarea>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" sm="12">
                                            <v-subheader>Estado de Salud del Can</v-subheader>
                                        </v-col>
                                        <v-col cols="12" sm="4" style="display: flex; justify-content: center">
                                            <v-switch
                                            v-model="switchVac"
                                            inset
                                            label="¿Está Vacunado?">
                                            </v-switch>
                                        </v-col>
                                        <v-col cols="12" sm="2">
                                            <v-card-text style="margin-top:5px; text-align: center" v-if="switchVac == '1'">Sí</v-card-text>
                                            <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <template>
                                            <div>
                                                <v-dialog
                                                ref="menuVacPerro"
                                                v-model="menuVacPerro"
                                                :width="anchoDate"
                                                >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                    v-model="dateVacPerro"
                                                    :disabled="!switchVac"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Vacunación del Can o Aproximada"
                                                    :rules="vacio"
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="dateVacPerro"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    min="2000-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuVacPerro.save(dateVacPerro)"
                                                    >
                                                        OK
                                                    </v-btn></v-date-picker>
                                                </v-dialog>
                                            </div>
                                        </template>
                                        </v-col>
                                        <v-col cols="12" sm="4" style="display: flex; justify-content: center" >
                                            <v-switch
                                            v-model="switchEst"
                                            inset
                                            label="¿Está Esterilizado?">
                                            </v-switch>
                                        </v-col>
                                        <v-col cols="12" sm="2">
                                            <v-card-text style="margin-top:5px; text-align: center" v-if="switchEst == '1'">Sí</v-card-text>
                                            <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <template>
                                            <div>
                                                <v-dialog
                                                ref="menuEstPerro"
                                                v-model="menuEstPerro"
                                                :width="anchoDate"
                                                >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                    v-model="dateEstPerro"
                                                    :disabled="!switchEst"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Esterilización del Can o Aproximada"
                                                    :rules="vacio"
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="dateEstPerro"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    min="2000-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuEstPerro.save(dateEstPerro)"
                                                    >
                                                        OK
                                                    </v-btn></v-date-picker>
                                                </v-dialog>
                                            </div>
                                            </template>
                                        </v-col>
                                        <v-col cols="12" sm="12"><v-row v-if="switchEst && switchVac">
                                            <v-col cols="12" sm="6" style="display: flex;align-items: center;justify-content: flex-end;padding-left: 10px">
                                                <v-switch
                                                v-model="switchVet"
                                                inset
                                                label="¿Mismo Veterinario?">
                                                </v-switch>
                                            </v-col>
                                            <v-col cols="12" sm="1" style="display: flex; align-items: center; justify-content: center; padding: 0">
                                                <v-tooltip bottom>
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-icon right v-bind="attrs" v-on="on">mdi-help-circle</v-icon>
                                                    </template>
                                                    <span>¿Es el mismo veterinario que vacunó y esterilizó al Can?</span>
                                                </v-tooltip>
                                            </v-col>
                                            <v-col cols="12" sm="2" style="display: flex; align-items: center; justify-content: center">
                                                <v-card-text style="margin-top:5px; text-align: center" v-if="switchVet == '1'">Sí</v-card-text>
                                                <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                            </v-col>
                                        </v-row></v-col>
                                        
                                        <v-row v-if="!switchVet || (switchVac && !switchEst)">
                                            <v-col cols="12" sm="12">
                                            <v-subheader>Datos de Referencia de la Vacuna</v-subheader>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchVac" :rules="vacio" v-model="vetNom1" outlined label="Veterinaria o Unidad Móvil" placeholder="Nombre de la Veterinaria o Entidad donde se Vacunó al Can">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchVac" v-model="vetUbi1" outlined  placeholder="Departamento/Ciudad/Zona/Calle"><template v-slot:label><div>Ubicación<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchVac" v-model="vetNum1" type="number" outlined placeholder="Teléfono de Referencia de la Veterinaria o Referente"><template v-slot:label><div>Número de Contacto<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                <v-file-input style="height: 45px"
                                                    :disabled="!switchVac"
                                                    outlined
                                                    dense
                                                    show-size
                                                ><template v-slot:label>
                                                    <div>
                                                    Certificado de Vacunación Adjuntado<small> (opcional)</small>
                                                    </div>
                                                    </template></v-file-input>
                                                <v-subheader style="
                                                    display: flex;
                                                    align-items: flex-start;
                                                    justify-content: flex-end;">
                                                    *Solo se admite un elemento</v-subheader>
                                                </template>
                                            </v-col>
                                        </v-row>
                                        <v-row v-if="!switchVet || (switchEst && !switchVac)">
                                            <v-col cols="12" sm="12">
                                            <v-subheader>Datos de Referencia de la Esterilización</v-subheader>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchEst" :rules="vacio" v-model="vetNom2" outlined label="Veterinaria" placeholder="Nombre de la Veterinaria donde se Esterilizó al Can">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchEst" v-model="vetUbi2" outlined placeholder="Departamento/Ciudad/Zona/Calle"><template v-slot:label><div>Ubicación<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchEst" v-model="vetRes2" outlined placeholder="Nombre del Responsable a Cargo de la Esterilización"><template v-slot:label><div>Responsable<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchEst" v-model="vetNum2" outlined type="number" placeholder="Teléfono de Referencia de la Veterinaria o Responsable"><template v-slot:label><div>Número de Contacto<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                <v-file-input style="height: 45px"
                                                    :disabled="!switchEst"
                                                    outlined
                                                    dense
                                                    show-size
                                                ><template v-slot:label>
                                                    <div>
                                                    Certificado de Esterilización Adjuntado<small> (opcional)</small>
                                                    </div>
                                                    </template></v-file-input>
                                                <v-subheader style="
                                                    display: flex;
                                                    align-items: flex-start;
                                                    justify-content: flex-end;">
                                                    *Solo se admite un elemento</v-subheader>
                                                </template>
                                            </v-col>
                                        </v-row>
                                        <v-row v-if="switchVet && switchVac && switchEst">
                                            <v-col cols="12" sm="12">
                                            <v-subheader>Datos de Referencia de la Veterinaria</v-subheader>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="vetNom1" :rules="vacio" outlined label="Veterinaria" placeholder="Nombre de la Veterinaria donde se Trató al Can">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="vetUbi1" outlined label="Ubicación" placeholder="Departamento/Ciudad/Zona/Calle"><template v-slot:label><div>Ubicación<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="vetRes2" outlined placeholder="Nombre del Responsable a Cargo de la Vacuna O Esterilización"><template v-slot:label><div>Responsable<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="vetNum1" type="number" outlined placeholder="Teléfono de Referencia de la Veterinaria o Responsable"><template v-slot:label><div>Número de Contacto<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="12">
                                                <template>
                                                <v-file-input style="height: 45px"
                                                    outlined
                                                    dense
                                                    show-size
                                                    multiple
                                                    chips
                                                ><template v-slot:label>
                                                    <div>
                                                    Certificado de Vacuna y Esterilización Adjuntados<small> (opcional)</small>
                                                    </div>
                                                    </template></v-file-input>
                                                <v-subheader style="
                                                    display: flex;
                                                    align-items: flex-start;
                                                    justify-content: flex-end;">
                                                    *Para adjuntar más de un elemento haga una selcción múltiple</v-subheader>
                                                </template>
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col cols="12" sm="12"><v-subheader>Microchip</v-subheader></v-col>
                                            <v-col cols="12" sm="3" style="display: flex; align-items: center; justify-content: center; padding: 0">
                                            <v-switch
                                            v-model="switchMicro"
                                            inset
                                            label="¿Tiene Microchip?">
                                            </v-switch>
                                            </v-col>
                                            <v-col cols="12" sm="1" style="display: flex; align-items: center; justify-content: center; padding: 0">
                                                <v-tooltip bottom>
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-icon right v-bind="attrs" v-on="on">mdi-help-circle</v-icon>
                                                    </template>
                                                    <span>¿Tiene implantado un Microchip de registro por una entidad regulada por un Gobierno Autónomo Municipal?</span>
                                                </v-tooltip>
                                            </v-col>
                                            <v-col cols="12" sm="2" style="display: flex; align-items: center; justify-content: flex-start">
                                                <v-card-text style="margin-top:5px; text-align: center" v-if="switchMicro == '1'">Sí</v-card-text>
                                                <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                            </v-col>
                                            <v-col cols="12" sm="6" style="padding-top: 38px">
                                                <v-text-field :disabled="!switchMicro"
                                                    v-model="microCan"
                                                    :rules="vacio"
                                                    label="Número de Microchip"
                                                    placeholder="Número de Identitifación del Microchip"
                                                    outlined>
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col cols="12" sm="12"><v-subheader>Cuidadores o Tenedores Eventuales *al menos un nombre con contacto es obligatorio</v-subheader></v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.canEven1" outlined :rules="vacio" label="Cuidador Eventual" placeholder="Nombre del Cuidador o Tenedor Eventual que conviva o conozca al Can a parte del Propietario"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.canEvenNum1" outlined :rules="vacio" type="number" label="Número de Contacto" placeholder="Número de Contacto del Cuidador Eventual"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.canEven2" outlined label="Cuidador Eventual" placeholder="Nombre del Cuidador o Tenedor Eventual que conviva o conozca al Can a parte del Propietario"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.canEvenNum2" outlined type="number" label="Número de Contacto" placeholder="Número de Contacto del Cuidador Eventual"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.canEven3" outlined label="Cuidador Eventual" placeholder="Nombre del Cuidador o Tenedor Eventual que conviva o conozca al Can a parte del Propietario"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.canEvenNum3" outlined type="number" label="Número de Contacto" placeholder="Número de Contacto del Cuidador Eventual"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.canEven4" outlined label="Cuidador Eventual" placeholder="Nombre del Cuidador o Tenedor Eventual que conviva o conozca al Can a parte del Propietario"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.canEvenNum4" outlined type="number" label="Número de Contacto" placeholder="Número de Contacto del Cuidador Eventual"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="12"><v-subheader>Tenencia del Can</v-subheader></v-col>
                                            <v-col cols="12" sm="12"><v-textarea v-model="form.canCon" :rules="vacio" outlined label="Motivos de Convivencia con el Can Peligroso" placeholder="Motivos por los cuales se domestica al Perro Peligroso"></v-textarea></v-col>
                                        </v-row>
                                    </v-row>
                                </v-container>
                                </v-card>
                                <div style="padding: 15px">
                                    <v-btn
                                        :disabled="!form5IsValid"
                                        color="primary"
                                        @click="e6 = 1"
                                    >
                                        Finzalizar
                                    </v-btn>
                                    <v-btn @click="e6 = 4">
                                        Atrás
                                    </v-btn>
                                </div>
                                </v-stepper-content>
                            </v-stepper>
                        </template>
                        <v-btn
                        color="primary"
                        style="padding: 30px"
                        @click="submitData"
                        >Guardar</v-btn>
                    </v-app>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import axios from 'axios'
    import mapboxgl from 'mapbox-gl'
    import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder'

    export default 
    {
        components: 
        {
            AppLayout,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            axios,
            mapboxgl,
            MapboxGeocoder,
        },
        data () {
        const defaultForm = Object.freeze({
            doc: 'CI',
            docExp: 'LP',
            terms: false,})
        return {
            e6: 1,
            form: Object.assign({}, defaultForm),
            vacio: [v => !!v || 'Este campo es obligatorio'],
            cel: [
                v => (v && v.length >= 8) || 'El número de dígitos debe ser mínimo de 8',
                v => (v && v.length <= 15) || 'El número de dígitos debe ser máximo de 15'
                ],
            tel: [
                v => (v && v.length >= 6) || 'El número de dígitos debe ser mínimo de 6',
                v => (v && v.length <= 12) || 'El número de dígitos debe ser máximo de 12'
                ],
            email: [v => /.+@.+\..+/.test(v) || 'El Correo Electrónico no es válido'],
            conditions: false,
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.',
            terms: false,
            defaultForm,
            dateMemo: null,
            dateProp: null,
            menuMemo: false,
            menuProp: false,
            doc: ['CI', 'Pasaporte'],
            docExp: ['CH','LP','CB','OR','PT','TJ','SC','BE','PD', 'Extranjero'],
            dialog: false,
            dialog2: false,
            isCameraOpen: false,
            isShotPhoto: false,
            isLoading: false,
            showDevices: false,
            link: '#',
            length: 5,
            onboarding: 0,
            datetime: new Date(),
            switchCANES: false,
            switchREJAP: false,
            switchFELCC: false,
            switchFELCN: false,
            switchFELCV: false,
            switchPuro: false,
            dropdownOpen1: false,
            dropdownOpen2: false,
            dropdownOpen3: false,
            dropdownOpen4: false,
            dropdownOpen5: false,
            displayDate1: '',
            displayDate2: '',
            displayDate3: '',
            displayDate4: '',
            displayDate5: '',
            dateModel1: '',
            dateModel2: '',
            dateModel3: '',
            dateModel4: '',
            dateModel5: '',
            timeModel1: '',
            timeModel2: '',
            timeModel3: '',
            timeModel4: '',
            timeModel5: '',
            aCanes: '',
            eCanes: 'Ninguno',
            aRejap: '',
            eRejap: 'Ninguno',
            aFelcc: '',
            eFelcc: 'Ninguno',
            aFelcn: '',
            eFelcn: 'Ninguno',
            aFelcv: '',
            eFelcv: 'Ninguno',
            nomAgencia: '',
            ubiAgencia: '',
            menuExpSeg: null,
            menuLimSeg: null,
            dateExpSeg: null,
            dateLimSeg: null,
            resAgencia: '',
            resAgenciaNum: '',
            nomPerro: '',
            menuNacPerro: null,
            dateNacPerro: null,
            sexoCan: null,
            procedenciaCan: null,
            sexoCan2: ['Macho', 'Hembra'],
            razas: [
                {
                    src: '/storage/img/pre/uno.jpg',
                },
                {
                    src: '/storage/img/pre/dos.jpg',
                },
                {
                    src: '/storage/img/pre/tres.jpg',
                },
                {
                    src: '/storage/img/pre/cuatro.jpg',
                },
                {
                    src: '/storage/img/pre/cinco.jpg',
                },
                {
                    src: '/storage/img/pre/seis.jpg',
                },
                {
                    src: '/storage/img/pre/siete.jpg',
                },
                {
                    src: '/storage/img/pre/ocho.jpg',
                },
                {
                    src: '/storage/img/pre/nueve.jpg',
                },
                {
                    src: '/storage/img/pre/diez.jpg',
                },
                {
                    src: '/storage/img/pre/once.jpg',
                },
            ],
            razasNames: [
            'American Staffordshire Terrier',
            'American Staffordshire Bull Terrier',
            'Pit Bull Terrier',
            'Bull Terrier',
            'Bullmastiff',
            'Doberman',
            'Dogo Argentino',
            'Dogo de Burdeos',
            'Fila Brasilero',
            'Rottweiler',
            'Tosa Inu',
            ],
            switchPuro: false,
            razaCan: '',
            colorCan: '',
            tamCan: ['Pequeño','Mediano','Grande'],
            sinCan: '',
            menuVacPerro: null,
            dateVacPerro: null,
            switchVac: null,
            dateEstPerro: null,
            menuEstPerro: null,
            switchEst: null,
            switchVet: null,
            vetNom1: '',
            vetUbi1: '',
            vetNum1: '',
            vetNom2: '',
            vetUbi2: '',
            vetRes2: '',
            vetNum2: '',
            switchMicro: '',
            microCan:'',
            canEven1: '',
            canEvenNum1: '',
            canEven2: '',
            canEvenNum2: '',
            canEven3: '',
            canEvenNum3: '',
            canEven4: '',
            canEvenNum4: '',
            canCon: '',
            canvasHeight:600,
            canvasWidth:800,
            photoTaken: false,
            itemPhotoProp: [],
            fotoProp: null,
            camarasList: [],
            firstSwitch: true,
            ubiProp: null,
            form: {
                comandante: null,
                referencia: null,
                dateMemo: null,
            },
            }
        },
        computed: {
        form1IsValid () {
            return (
            this.form.comandante &&
            this.form.referencia &&
            this.form.dateMemo &&
            this.form.terms
            )
        },
        form2IsValid () {
            return (
            this.form.paterno &&
            this.form.materno &&
            this.form.nombres &&
            this.dateProp &&
            this.form.documento &&
            this.form.docExp &&
            (this.form.cel || this.form.tel || this.form.em || this.form.cel2)
            )
        },
        canesCheck () {
            return (
            this.form.aCanes &&
            this.displayDate1 &&
            this.eCanes
            )
        },
        rejapCheck () {
            return (
            this.form.aRejap &&
            this.displayDate2 &&
            this.eRejap
            )
        },
        felccCheck () {
            return (
            this.form.aFelcc &&
            this.displayDate3 &&
            this.eFelcc
            )
        },
        felcnCheck () {
            return (
            this.form.aFelcn &&
            this.displayDate4 &&
            this.eFelcn
            )
        },
        felcvCheck () {
            return (
            this.form.aFelcv &&
            this.displayDate5 &&
            this.eFelcv
            )
        },
        form3IsValid () {
            return (
            this.form.aCanes &&
            this.displayDate1 &&
            this.eCanes &&
            this.form.aRejap &&
            this.displayDate2 &&
            this.eRejap &&
            this.form.aFelcc &&
            this.displayDate3 &&
            this.eFelcc &&
            this.form.aFelcn &&
            this.displayDate4 &&
            this.eFelcn &&
            this.form.aFelcv &&
            this.displayDate5 &&
            this.eFelcv            )
        },
        form4IsValid () {
            return (
            this.form.nomAgencia &&
            this.dateExpSeg &&
            this.dateLimSeg
            )
        },
        form5IsValid () {
            return (
            this.form.nomPerro &&
            this.dateNacPerro &&
            this.form.sexoCan &&
            this.form.procedenciaCan &&
            this.form.razaCan &&
            this.form.tamCan &&
            this.form.colorCan &&
            this.form.sinCan &&
            this.form.canEven1 &&
            this.form.canEvenNum1 &&
            this.form.canCon
            )
        },
        model1: {
            get() {return this.value;},
            set(model1) {} },
        model2: {
            get() {return this.value;},
            set(model2) {} },
        model3: {
            get() {return this.value;},
            set(model3) {} },
        model4: {
            get() {return this.value;},
            set(model4) {} },
        model5: {
            get() {return this.value;},
            set(model5) {} },

        currentSelection1() {
        let selectedTime1 = this.timeModel1;
        return this.formatDate(this.dateModel1) + ' ' + selectedTime1;
        },
        currentSelection2() {
        let selectedTime2 = this.timeModel2;
        return this.formatDate(this.dateModel2) + ' ' + selectedTime2;
        },
        currentSelection3() {
        let selectedTime3 = this.timeModel3;
        return this.formatDate(this.dateModel3) + ' ' + selectedTime3;
        },
        currentSelection4() {
        let selectedTime4 = this.timeModel4;
        return this.formatDate(this.dateModel4) + ' ' + selectedTime4;
        },
        currentSelection5() {
        let selectedTime5 = this.timeModel5;
        return this.formatDate(this.dateModel5) + ' ' + selectedTime5;
        },

        anchoDate() {
            switch (this.$vuetify.breakpoint.name) {
                case 'xs': return 220
                case 'sm': return 400
                case 'md': return 500
                case 'lg': return 600
                case 'xl': return 800
            }
            },
        anchoDate2a() {
            switch (this.$vuetify.breakpoint.name) {
                case 'xs': return 300
                case 'sm': return 600
                case 'md': return 600
                case 'lg': return 600
                case 'xl': return 800
            }
            },
        anchoDate2b() {
            switch (this.$vuetify.breakpoint.name) {
                case 'xs': return 260
                case 'sm': return 300
                case 'md': return 300
                case 'lg': return 300
                case 'xl': return 400
            }
            },
        },

        methods: 
        {
            submitData() {
                this.$inertia.post(route('memorials.store'),this.form);
            },
            switchToTeam(team) 
            {
                this.$inertia.put(route('current-team.update'), 
                {
                    'team_id': team.id
                }, 
                {
                    preserveState: false
                })
            },

            logout() 
            {
                this.$inertia.post(route('logout'));
            },
            submit () {
                this.snackbar = true
            },
            save (dateMemo) {
                this.$refs.menuMemo.save(dateMemo)
            },
            save (dateProp) {
                this.$refs.menuProp.save(dateProp)
            },
            save (dateExpSeg) {
                this.$refs.menuExpSeg.save(dateExpSeg)
            },
            save (dateLimSeg) {
                this.$refs.menuLimSeg.save(dateLimSeg)
            },
            save (dateNacPerro) {
                this.$refs.menuNacPerro.save(dateNacPerro)
            },
            save (dateVacPerro) {
                this.$refs.menuVacPerro.save(dateVacPerro)
            },
            save (dateEstPerro) {
                this.$refs.menuEstPerro.save(dateEstPerro)
            },
            save (dateEstPerro) {
                this.$refs.menuEstPerro.save(dateEstPerro)
            },
            
            toggleCamera() {
                if(this.isCameraOpen) {
                    this.isCameraOpen = false;
                    this.isShotPhoto = false;
                    this.stopCameraStream();
                    this.firstSwitch = false;
                    console.clear();
                } else {
                    this.isCameraOpen = true;
                    this.showDevices = true;
                    this.createCameraElement();
                    this.switchCamara();
                }
            },
            switchCamara(){
                navigator.mediaDevices.enumerateDevices().then((devices) => {
                let videoSourcesSelect = document.getElementById("camaras");
                let videoPlayer = document.getElementById("player");
                let MediaStreamHelper = {
                // Property of the object to store the current stream
                _stream: null,
                // This method will return the promise to list the real devices
                getDevices: function() {
                    return navigator.mediaDevices.enumerateDevices();
                },
                // Request user permissions to access the camera and video
                requestStream: function() {
                    if (this._stream) {
                        this._stream.getTracks().forEach(track => {
                            track.stop();
                        });
                    }

                    const videoSource = videoSourcesSelect.value;
                    const constraints = {
                        video: {
                            deviceId: videoSource ? {exact: videoSource} : undefined
                        }
                    };
                
                    return navigator.mediaDevices.getUserMedia(constraints);
                }
            };
                    videoSourcesSelect.onchange = function(){
                    MediaStreamHelper.requestStream().then(function(stream){
                        MediaStreamHelper._stream = stream;
                        videoPlayer.srcObject = stream;
                    });
                };
            devices.forEach((device) => {
                let option = new Option();
                option.value = device.deviceId;

                switch(device.kind){
                    // Append device to list of Cameras
                    case "videoinput":
                        if(this.firstSwitch){
                        option.text = device.label || `Camera ${videoSourcesSelect.length + 1}`;
                        videoSourcesSelect.appendChild(option);
                        console.log(device);
                        }
                        break;
                }
            });
            })
            .catch(function(err) {
            console.log(err.name + ": " + err.message);
            });
            },

            createCameraElement() {
                this.isLoading = true;
                const constraints = (window.constraints = {
                            audio: false,
                            video: true
            });
            navigator.mediaDevices
            .getUserMedia(constraints)
            .then(stream => {
            this.isLoading = false;
            this.$refs.camera.srcObject = stream;
            }).catch(error => {
            this.isLoading = false;
                alert("El navegador o el dispositivo no permiten Cámara Web");
            });
            },
            stopCameraStream() {
            let tracks = this.$refs.camera.srcObject.getTracks();
            tracks.forEach(track => {
                track.stop();
            });
            },
            
            takePhoto() {
                const FLASH_TIMEOUT = 50;
                let self = this;
                setTimeout(() => {
                this.showDevices = false;
                this.photoTaken = true;
                this.firstSwitch = false;
                const context = this.$refs.canvas.getContext('2d');
                context.drawImage(this.$refs.camera, 0, 0, this.canvasWidth, this.canvasHeight);
                const dataUrl = this.$refs.canvas.toDataURL("image/jpeg")
                    .replace("image/jpeg", "image/octet-stream");
                this.addToPhotoGallery(dataUrl);
                this.uploadPhoto(dataUrl);
                this.stopCameraStream();
                }, FLASH_TIMEOUT);
            },
            retryPhoto() {
                console.clear();
                this.itemPhotoProp.splice(),
                this.showDevices = true;
                this.photoTaken = false,
                this.isCameraOpen = true,
                this.fotoProp = null,
                this.switchCamara(),
                this.createCameraElement()
            },

            addToPhotoGallery(dataURI) {
            this.itemPhotoProp.push(
                {
                    src: dataURI,
                    thumbnail: dataURI,
                    w: this.canvasWidth,
                    h: this.canvasHeight,
                    alt: 'some numbers on a grey background' // optional alt attribute for thumbnail image
                }
            )
            },
            uploadPhoto(dataURL){
            let uniquePictureName = this.generateCapturePhotoName();
            let capturedPhotoFile = this.dataURLtoFile(dataURL, uniquePictureName+'.jpg')
            this.fotoProp = uniquePictureName;
            let formData = new FormData()
            formData.append('file', capturedPhotoFile)
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
            console.log("File", capturedPhotoFile);
            },
                generateCapturePhotoName(){
            return  Math.random().toString(36).substring(2, 15)
            },

            dataURLtoFile(dataURL, filename) {
                let arr = dataURL.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new File([u8arr], filename, {type: mime});
            },

            /* DateTimeExtension */                
            formatDate(date) {
            if (!date) return '';
        
            const [year, month, day] = date.split('-');
            return `${year}-${month}-${day}`;
            },
        
            // Confirm the datetime selection and close the popover
            confirm1() {
            this.onUpdateDate1();
            this.dropdownOpen1 = false;
            },
            confirm2() {
            this.onUpdateDate2();
            this.dropdownOpen2 = false;
            },
            confirm3() {
            this.onUpdateDate3();
            this.dropdownOpen3 = false;
            },
            confirm4() {
            this.onUpdateDate4();
            this.dropdownOpen4 = false;
            },
            confirm5() {
            this.onUpdateDate5();
            this.dropdownOpen5 = false;
            },
        
            // Format the date and trigger the input event
            onUpdateDate1() {
            if (!this.dateModel1 || !this.timeModel1) return false;
            let selectedTime1 = this.timeModel1;
            this.displayDate1 = this.formatDate(this.dateModel1) + ' ' + selectedTime1;
            this.$emit('input', this.dateModel1 + ' ' + selectedTime1);
            },
            
            onUpdateDate2() {
            if (!this.dateModel2 || !this.timeModel2) return false;
            let selectedTime2 = this.timeModel2;
            this.displayDate2 = this.formatDate(this.dateModel2) + ' ' + selectedTime2;
            this.$emit('input', this.dateModel2 + ' ' + selectedTime2);
            },
            
            onUpdateDate3() {
            if (!this.dateModel3 || !this.timeModel3) return false;
            let selectedTime3 = this.timeModel3;
            this.displayDate3 = this.formatDate(this.dateModel3) + ' ' + selectedTime3;
            this.$emit('input', this.dateModel3 + ' ' + selectedTime3);
            },
            
            onUpdateDate4() {
            if (!this.dateModel4 || !this.timeModel4) return false;
            let selectedTime4 = this.timeModel4;
            this.displayDate4 = this.formatDate(this.dateModel4) + ' ' + selectedTime4;
            this.$emit('input', this.dateModel4 + ' ' + selectedTime4);
            },
            
            onUpdateDate5() {
            if (!this.dateModel5 || !this.timeModel5) return false;
            let selectedTime5 = this.timeModel5;
            this.displayDate5 = this.formatDate(this.dateModel5) + ' ' + selectedTime5;
            this.$emit('input', this.dateModel5 + ' ' + selectedTime5);
            },
            

        /* Antecedentes */
        next () {
            this.onboarding = this.onboarding + 1 === this.length
            ? 0
            : this.onboarding + 1
        },
        prev () {
            this.onboarding = this.onboarding - 1 < 0
            ? this.length - 1
            : this.onboarding - 1
        },
        },
         mounted() {
            // Set the current date and time as default value_DateTime
            var d = new Date();
            var currentHour = d.getHours() % 12; // AM,PM format
            var minutes = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
            var currentTime = currentHour + ':' + minutes;
            this.timeModel1 = currentTime;
            this.dateModel1 = d.toISOString().substr(0, 10);
            
            this.timeModel2 = currentTime;
            this.dateModel2 = d.toISOString().substr(0, 10);

            this.timeModel3 = currentTime;
            this.dateModel3 = d.toISOString().substr(0, 10);

            this.timeModel4 = currentTime;
            this.dateModel4 = d.toISOString().substr(0, 10);

            this.timeModel5 = currentTime;
            this.dateModel5 = d.toISOString().substr(0, 10);
                
            mapboxgl.accessToken = 'pk.eyJ1Ijoicm9ibGVlOTkiLCJhIjoiY2t2Z25tdDZxMDZ0OTJ2cGYzNndzZHJ3NyJ9.pBGTzYuYUmbU2dbF5TW8zQ';
            const map = new mapboxgl.Map({
                container: 'map', // container ID
                style: 'mapbox://styles/mapbox/streets-v11', // style URL
                center: [-63, -17], // starting position [lng, lat]
                zoom: 4.5 // starting zoom
            });

            var marker = new mapboxgl.Marker();

            function add_marker (event) {
            var coordinates = event.lngLat;
            marker.setLngLat(coordinates).addTo(map);
            document.getElementById('longlat').innerHTML =
                    // `e.lngLat` is the longitude, latitude geographical position of the event.
                    JSON.stringify(event.lngLat.wrap());
            }

            map.on('click', add_marker);

            // Add the control to the map.
            map.addControl(
                new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl,
                placeholder: "Buscar",
                bbox: [-69.6443959706429,
                        -22.9003899973618,
                        -57.4533040073047,
                        -9.66484828841838], // Boundary for Bolivia
                proximity: {
                    longitude: -73.990593,
                    latitude: 40.740121
                } // Coordinates of Bolivia
            }));

            map.addControl(new mapboxgl.FullscreenControl());
            // Add geolocate control to the map.
            map.addControl(
                new mapboxgl.GeolocateControl({
                positionOptions: {
                enableHighAccuracy: true
                },
                // When active the map will receive updates to the device's location as it changes.
                trackUserLocation: true,
                // Draw an arrow next to the location dot to indicate which direction the device is heading.
                showUserHeading: true
                })
            );
            
        },

        props: 
        {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
            errors: Object,
        }
    }
</script>
