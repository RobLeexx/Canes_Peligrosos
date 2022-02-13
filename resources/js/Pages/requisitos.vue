<template>
    <app-layout v-if="($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Secretaría')">
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

        <div class="py-12" style="background: #4a6813">
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
                                            <v-col cols="12" sm="2">
                                                <v-select v-model="grado"
                                                :items="gradosComan"
                                                :rules="vacio"
                                                placeholder="Grado"
                                                outlined>
                                                </v-select>
                                            </v-col>
                                            <v-col cols="12" sm="4">
                                                <v-text-field
                                                v-model="form.comandante"
                                                :rules="vacio"
                                                maxlength="30"
                                                counter="30"
                                                label="Comandante Departamental"
                                                placeholder="Nombre del Comandante Departamental"
                                                @keypress="sinNumeros($event)"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                v-model="form.referencia"
                                                :rules="vacio"
                                                label="Referencia"
                                                maxlength="50"
                                                counter="50"
                                                @keypress="sinNumeros($event)"
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
                                                        <div style="margin: 0">
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
                                                        </div>
                                                        </v-dialog>
                                                    </div>
                                                </template>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <template>
                                                <v-file-input v-model="form.memoFile"
                                                    style="height: 45px"
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
                                                        href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwi4mLbu_pv1AhW2qpUCHXwYA3MQFnoECAMQAQ&url=https%3A%2F%2Fsea.gob.bo%2Fdigesto%2FCompendioII%2FI%2F60_L_553.pdf&usg=AOvVaw3zU7Do3Xjyfm97q4UglYnp" target="_blank"
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
                                                id="paterno"
                                                v-model="form.paterno"
                                                :rules="vacio"
                                                maxlength="15"
                                                counter="15"
                                                @keypress="sinNumeros($event)"
                                                label="Apellido Paterno"
                                                placeholder="Apellido Paterno del Propietario"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                id="materno"
                                                v-model="form.materno"
                                                :rules="vacio"
                                                maxlength="15"
                                                counter="15"
                                                @keypress="sinNumeros($event)"
                                                label="Apellido Materno"
                                                placeholder="Apellido Materno (de no tener, repetir el apellido Paterno)"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                id="nombres"
                                                v-model="form.nombres"
                                                :rules="vacio"
                                                maxlength="30"
                                                counter="30"
                                                @keypress="sinNumeros($event)"
                                                label="Nombres"
                                                placeholder="Nombre o Nombres del Propietario"
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
                                                            id="dateProp"
                                                            v-model="form.dateProp"
                                                            prepend-icon="mdi-calendar"
                                                            label="Fecha de nacimiento del Propietario"
                                                            :rules="vacio"
                                                            readonly
                                                            outlined
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            >
                                                            </v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                            v-model="form.dateProp"
                                                            scrollable
                                                            locale="es"
                                                            :width="anchoDate"
                                                            :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                            min="1930-01-01"
                                                        ><v-spacer></v-spacer>
                                                            <v-btn
                                                                color="primary"
                                                                @click="$refs.menuProp.save(form.dateProp)">
                                                                OK
                                                            </v-btn></v-date-picker>
                                                        </v-dialog>
                                                    </div>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-autocomplete
                                                v-model="form.estCivil"
                                                :rules="vacio"
                                                :items= "civ"
                                                placeholder="Estado Civil del Propietario"
                                                outlined
                                                ></v-autocomplete>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                id="profesion"
                                                v-model="form.profesion"
                                                :rules="vacio"
                                                maxlength="35"
                                                counter="35"
                                                label="Profesión u Ocupación"
                                                placeholder="Profesión u Ocupación del Propietario"
                                                outlined
                                                ></v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="6">
                                                <v-autocomplete
                                                id="docTipo"
                                                v-model="form.docTipo"
                                                :items= "doc"
                                                placeholder="Tipo de Documento de Identidad"
                                                :rules="vacio"
                                                outlined
                                                >
                                                </v-autocomplete>
                                            </v-col>
                                            <v-col cols="12" sm="4">
                                                <v-text-field
                                                id="documento"
                                                maxlength="12"
                                                counter="12"
                                                v-model="form.documento"
                                                :rules="vacio"
                                                label="Documento de Identidad"
                                                placeholder="Documento de Identidad"
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="2">
                                                <v-select
                                                id="docExp"
                                                v-model="form.docExp"
                                                :items= "docExpItems"
                                                placeholder="Departamento"
                                                :rules="vacio"
                                                outlined></v-select>
                                            </v-col>
                                            <v-col cols="12" lg="6" sm="6">
                                                <template>
                                                    <v-file-input style="height: 45px"
                                                        v-model="form.docFile"
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
                                                        id="fotoPropName"
                                                        v-model="form.fotoPropName"
                                                        label="Foto del Propietario"
                                                        outlined
                                                        dense
                                                        prepend-icon="mdi-face"
                                                    ></v-text-field>
                                                    <v-text-field class="d-none"
                                                        id="fotoProp"
                                                        v-model="form.fotoProp"
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
                                                <v-subheader>Domicilio del propietario y su Georreferenciación</v-subheader>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-autocomplete
                                                v-model="form.departamento"
                                                :items= "depa"
                                                placeholder="Departamento"
                                                :rules="vacio"
                                                outlined>
                                                </v-autocomplete>
                                            </v-col>
                                                <!-- Provincias -->
                                                <v-col cols="12" sm="6">
                                                    <v-autocomplete v-if="form.departamento == null" disabled placeholder="Provincia" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'Chuquisaca'" v-model="form.provincia" :items= "provCH" placeholder="Provincia de Chuquisaca" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'La Paz'" v-model="form.provincia" :items= "provLP" placeholder="Provincia de La Paz" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'Cochabamba'" v-model="form.provincia" :items= "provCB" placeholder="Provincia de Cochabamba" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'Oruro'" v-model="form.provincia" :items= "provOR" placeholder="Provincia de Oruro" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'Potosí'" v-model="form.provincia" :items= "provPT" placeholder="Provincia de Potosí" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'Tarija'" v-model="form.provincia" :items= "provTJ" placeholder="Provincia de Tarija" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'Santa Cruz'" v-model="form.provincia" :items= "provSC" placeholder="Provincia de Santa Cruz" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'Beni'" v-model="form.provincia" :items= "provBE" placeholder="Provincia de Beni" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.departamento == 'Pando'" v-model="form.provincia" :items= "provPD" placeholder="Provincia de Pando" :rules="vacio" outlined></v-autocomplete>
                                                </v-col>

                                                <!-- Municipios de Chuquisaca -->
                                                <v-col cols="12" sm="6">
                                                    <v-autocomplete v-if="form.provincia == null" disabled placeholder="Municipio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Azurduy'" v-model="form.municipio" :items= "muniCH1" placeholder="Municipio de Azurduy" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Belisario Boeto'" v-model="form.municipio" :items= "muniCH2" placeholder="Municipio de Belisario Boeto" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Hernando Siles'" v-model="form.municipio" :items= "muniCH3" placeholder="Municipio de Hernando Siles" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Luis Calvo'" v-model="form.municipio" :items= "muniCH4" placeholder="Municipio de Luis Calvo" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Nor Cinti'" v-model="form.municipio" :items= "muniCH5" placeholder="Municipio de Nor Cinti" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Oropeza'" v-model="form.municipio" :items= "muniCH6" placeholder="Municipio de Oropeza" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Sud Cinti'" v-model="form.municipio" :items= "muniCH7" placeholder="Municipio de Sud Cinti" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Tomina'" v-model="form.municipio" :items= "muniCH8" placeholder="Municipio de Tomina" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Yamparáez'" v-model="form.municipio" :items= "muniCH9" placeholder="Municipio de Yamparáez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Zudáñez'" v-model="form.municipio" :items= "muniCH10" placeholder="Municipio de Zudáñez" :rules="vacio" outlined></v-autocomplete>
                                                <!-- Municipios de La Paz -->
                                                    <v-autocomplete v-else-if="form.provincia == 'Abel Iturralde'" v-model="form.municipio" :items= "muniLP1" placeholder="Municipio de Abel Iturralde" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Aroma'" v-model="form.municipio" :items= "muniLP2" placeholder="Municipio de Aroma" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Bautista Saavedra'" v-model="form.municipio" :items= "muniLP3" placeholder="Municipio de Bautista Saavedra" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Camacho'" v-model="form.municipio" :items= "muniLP4" placeholder="Municipio de Camacho" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Caranavi'" v-model="form.municipio" :items= "muniLP5" placeholder="Municipio de Caranavi" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Franz Tamayo'" v-model="form.municipio" :items= "muniLP6" placeholder="Municipio de Franz Tamayo" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Gualberto Villaroel'" v-model="form.municipio" :items= "muniLP7" placeholder="Municipio de Gualberto Villaroel" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Ingavi'" v-model="form.municipio" :items= "muniLP8" placeholder="Municipio de Ingavi" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Inquisivi'" v-model="form.municipio" :items= "muniLP9" placeholder="Municipio de Inquisivi" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'José Manuel Pando'" v-model="form.municipio" :items= "muniLP10" placeholder="Municipio de José Manuel Pando" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Larecaja'" v-model="form.municipio" :items= "muniLP11" placeholder="Municipio de Larecaja" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Loayza'" v-model="form.municipio" :items= "muniLP12" placeholder="Municipio de Loayza" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Los Andes'" v-model="form.municipio" :items= "muniLP13" placeholder="Municipio de Los Andes" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Manco Kapac'" v-model="form.municipio" :items= "muniLP14" placeholder="Municipio de Manco Kapac" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Muñecas'" v-model="form.municipio" :items= "muniLP15" placeholder="Municipio de Muñecas" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Murillo'" v-model="form.municipio" :items= "muniLP16" placeholder="Municipio de Murillo" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Nor Yungas'" v-model="form.municipio" :items= "muniLP17" placeholder="Municipio de Nor Yungas" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Omasuyos'" v-model="form.municipio" :items= "muniLP18" placeholder="Municipio de Omasuyos" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Pacajes'" v-model="form.municipio" :items= "muniLP19" placeholder="Municipio de Pacajes" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Sud Yungas'" v-model="form.municipio" :items= "muniLP20" placeholder="Municipio de Sud Yungas" :rules="vacio" outlined></v-autocomplete>
                                                <!-- Municipios de Cochabamba -->
                                                    <v-autocomplete v-else-if="form.provincia == 'Arani'" v-model="form.municipio" :items= "muniCB1" placeholder="Municipio de Arani" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Arque'" v-model="form.municipio" :items= "muniCB2" placeholder="Municipio de Arque" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Ayopaya'" v-model="form.municipio" :items= "muniCB3" placeholder="Municipio de Ayopaya" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Bolívar'" v-model="form.municipio" :items= "muniCB4" placeholder="Municipio de Bolívar" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Campero'" v-model="form.municipio" :items= "muniCB5" placeholder="Municipio de Campero" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Capinota'" v-model="form.municipio" :items= "muniCB6" placeholder="Municipio de Capinota" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Carrasco'" v-model="form.municipio" :items= "muniCB7" placeholder="Municipio de Carrasco" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Cercado'" v-model="form.municipio" :items= "muniCB8" placeholder="Municipio de Cercado" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Chapare'" v-model="form.municipio" :items= "muniCB9" placeholder="Municipio de Chapare" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Esteban Arce'" v-model="form.municipio" :items= "muniCB10" placeholder="Municipio de Esteban Arce" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Germán Jordán'" v-model="form.municipio" :items= "muniCB11" placeholder="Municipio de Germán Jordán" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Mizque'" v-model="form.municipio" :items= "muniCB12" placeholder="Municipio de Mizque" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Punata'" v-model="form.municipio" :items= "muniCB13" placeholder="Municipio de Punata" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Quillacollo'" v-model="form.municipio" :items= "muniCB14" placeholder="Municipio de Quillacollo" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Tapacarí'" v-model="form.municipio" :items= "muniCB15" placeholder="Municipio de Tapacarí" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Tiraque'" v-model="form.municipio" :items= "muniCB16" placeholder="Municipio de Tiraque" :rules="vacio" outlined></v-autocomplete>
                                                <!-- Municipios de Oruro -->
                                                    <v-autocomplete v-else-if="form.provincia == 'Sabaya'" v-model="form.municipio" :items= "muniOR1" placeholder="Municipio de Sabaya" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Carangas'" v-model="form.municipio" :items= "muniOR2" placeholder="Municipio de Carangas" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Cercado (Oruro)'" v-model="form.municipio" :items= "muniOR3" placeholder="Municipio de Cercado" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Eduardo Abaroa'" v-model="form.municipio" :items= "muniOR4" placeholder="Municipio de Eduardo Abaroa" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Ladislao Cabrera'" v-model="form.municipio" :items= "muniOR5" placeholder="Municipio de Ladislao Cabrera" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Litoral'" v-model="form.municipio" :items= "muniOR6" placeholder="Municipio de Litoral" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Mejillones'" v-model="form.municipio" :items= "muniOR7" placeholder="Municipio de Mejillones" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Nor Carangas'" v-model="form.municipio" :items= "muniOR8" placeholder="Municipio de Nor Carangas" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Pantaleón Dalence'" v-model="form.municipio" :items= "muniOR9" placeholder="Municipio de Pantaleón Dalence" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Poopó'" v-model="form.municipio" :items= "muniOR10" placeholder="Municipio de Poopó" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Sajama'" v-model="form.municipio" :items= "muniOR11" placeholder="Municipio de Sajama" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'San Pedro de Totora'" v-model="form.municipio" :items= "muniOR12" placeholder="Municipio de San Pedro de Totora" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Saucarí'" v-model="form.municipio" :items= "muniOR13" placeholder="Municipio de Saucarí" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Sebastián Pagador'" v-model="form.municipio" :items= "muniOR14" placeholder="Municipio de Sebastián Pagador" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Sud Carangas'" v-model="form.municipio" :items= "muniOR15" placeholder="Municipio de Sud Carangas" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Tomás Barrón'" v-model="form.municipio" :items= "muniOR16" placeholder="Municipio de Tomás Barrón" :rules="vacio" outlined></v-autocomplete>

                                                <!-- Municipios de Potosí -->
                                                    <v-autocomplete v-else-if="form.provincia == 'Alonso de Ibáñez'" v-model="form.municipio" :items= "muniPT1" placeholder="Municipio de Alonso de Ibáñez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Antonio Quijarro'" v-model="form.municipio" :items= "muniPT2" placeholder="Municipio de Antonio Quijarro" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Bernardino Bilbao'" v-model="form.municipio" :items= "muniPT3" placeholder="Municipio de Bernardino Bilbao" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Charcas'" v-model="form.municipio" :items= "muniPT4" placeholder="Municipio de Charcas" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Chayanta'" v-model="form.municipio" :items= "muniPT5" placeholder="Municipio de Chayanta" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Cornelio Saavedr'" v-model="form.municipio" :items= "muniPT6" placeholder="Municipio de Cornelio Saavedr" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Daniel Campos'" v-model="form.municipio" :items= "muniPT7" placeholder="Municipio de Daniel Campos" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Enrique Baldivieso'" v-model="form.municipio" :items= "muniPT8" placeholder="Municipio de Enrique Baldivieso" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'José María Linares'" v-model="form.municipio" :items= "muniPT9" placeholder="Municipio de José María Linares" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Modesto Omiste'" v-model="form.municipio" :items= "muniPT10" placeholder="Municipio de Modesto Omiste" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Nor Chichas'" v-model="form.municipio" :items= "muniPT11" placeholder="Municipio de Nor Chichas" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Nor Lípez'" v-model="form.municipio" :items= "muniPT12" placeholder="Municipio de Nor Lípez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Rafael Bustillo   '" v-model="form.municipio" :items= "muniPT13" placeholder="Municipio de Rafael Bustillo" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Sud Chichas'" v-model="form.municipio" :items= "muniPT14" placeholder="Municipio de Sud Chichas" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Sud Lípez'" v-model="form.municipio" :items= "muniPT15" placeholder="Municipio de Sud Lípez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Tomás Frías'" v-model="form.municipio" :items= "muniPT16" placeholder="Municipio de Tomás Frías" :rules="vacio" outlined></v-autocomplete>
                                                <!-- Municipios de Tarija -->
                                                    <v-autocomplete v-else-if="form.provincia == 'Aniceto Arce'" v-model="form.municipio" :items= "muniTJ1" placeholder="Municipio de Aniceto Arce" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Avilés'" v-model="form.municipio" :items= "muniTJ2" placeholder="Municipio de Avilés" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Cercado (Tarija)'" v-model="form.municipio" :items= "muniTJ3" placeholder="Municipio de Cercado" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Gran Chaco'" v-model="form.municipio" :items= "muniTJ4" placeholder="Municipio de Gran Chaco" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Méndez'" v-model="form.municipio" :items= "muniTJ5" placeholder="Municipio de Méndez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'O`Connor'" v-model="form.municipio" :items= "muniTJ6" placeholder="Municipio de O`Connor" :rules="vacio" outlined></v-autocomplete>
                                                <!-- Municipios de Santa Cruz -->
                                                    <v-autocomplete v-else-if="form.provincia == 'Andrés Ibáñez'" v-model="form.municipio" :items= "muniSC1" placeholder="Municipio de Andrés Ibáñez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Ángel Sandoval'" v-model="form.municipio" :items= "muniSC2" placeholder="Municipio de Ángel Sandoval" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Chiquitos'" v-model="form.municipio" :items= "muniSC3" placeholder="Municipio de Chiquitos" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Cordillera'" v-model="form.municipio" :items= "muniSC4" placeholder="Municipio de Cordillera" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Florida'" v-model="form.municipio" :items= "muniSC5" placeholder="Municipio de Florida" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Germán Busch'" v-model="form.municipio" :items= "muniSC6" placeholder="Municipio de Germán Busch" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Guarayos'" v-model="form.municipio" :items= "muniSC7" placeholder="Municipio de Guarayos" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Ichilo'" v-model="form.municipio" :items= "muniSC8" placeholder="Municipio de Ichilo" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'José Miguel de Velasco'" v-model="form.municipio" :items= "muniSC9" placeholder="Municipio de José Miguel de Velasco" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Manuel María Caballero'" v-model="form.municipio" :items= "muniSC10" placeholder="Municipio de Manuel María Caballero" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Ñuflo de Chávez'" v-model="form.municipio" :items= "muniSC11" placeholder="Municipio de Ñuflo de Chávez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Obispo Santisteban'" v-model="form.municipio" :items= "muniSC12" placeholder="Municipio de Obispo Santisteban" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Sara'" v-model="form.municipio" :items= "muniSC13" placeholder="Municipio de Sara" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Vallegrande'" v-model="form.municipio" :items= "muniSC14" placeholder="Municipio de Vallegrande" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Warnes'" v-model="form.municipio" :items= "muniSC15" placeholder="Municipio de Warnes" :rules="vacio" outlined></v-autocomplete>
                                                <!-- Municipios de Beni -->
                                                    <v-autocomplete v-else-if="form.provincia == 'Cercado (Beni)'" v-model="form.municipio" :items= "muniBE1" placeholder="Municipio de Cercado" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Iténez'" v-model="form.municipio" :items= "muniBE2" placeholder="Municipio de Iténez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'José Ballivián'" v-model="form.municipio" :items= "muniBE3" placeholder="Municipio de José Ballivián" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Mamoré'" v-model="form.municipio" :items= "muniBE4" placeholder="Municipio de Mamoré" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Marbán'" v-model="form.municipio" :items= "muniBE5" placeholder="Municipio de Marbán" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Moxos'" v-model="form.municipio" :items= "muniBE6" placeholder="Municipio de Moxos" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Vaca Díez'" v-model="form.municipio" :items= "muniBE7" placeholder="Municipio de Vaca Díez" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Yacuma'" v-model="form.municipio" :items= "muniBE8" placeholder="Municipio de Yacuma" :rules="vacio" outlined></v-autocomplete>
                                                <!-- Municipios de Pando -->
                                                    <v-autocomplete v-else-if="form.provincia == 'Abuná'" v-model="form.municipio" :items= "muniPD1" placeholder="Municipio de Abuná" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Federico Román'" v-model="form.municipio" :items= "muniPD2" placeholder="Municipio de Federico Román" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Madre de Dios'" v-model="form.municipio" :items= "muniPD3" placeholder="Municipio de Madre de Dios" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Manuripi'" v-model="form.municipio" :items= "muniPD4" placeholder="Municipio de Manuripi" :rules="vacio" outlined></v-autocomplete>
                                                    <v-autocomplete v-else-if="form.provincia == 'Nicolás Suárez'" v-model="form.municipio" :items= "muniPD5" placeholder="Municipio de Nicolás Suárez" :rules="vacio" outlined></v-autocomplete>
                                                </v-col>

                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                        id="zona"
                                                        v-model="form.zona"
                                                        outlined
                                                        maxlength="40"
                                                        counter
                                                        label="Zona"
                                                        placeholder="Zona del propietario"
                                                        :rules="vacio"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                        id="domicilio"
                                                        v-model="form.domicilio"
                                                        outlined
                                                        maxlength="40"
                                                        counter
                                                        label="Domicilio"
                                                        placeholder="Domicilio del propietario"
                                                        :rules="vacio"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="2">
                                                <div style="text-align: center">
                                                    <div style="-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;">
                                                        Latitud
                                                    </div>
                                                    <div
                                                        id="latitud"
                                                    ></div>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" sm="2">
                                                <div style="text-align: center">
                                                    <div style="-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;">
                                                        Longitud
                                                    </div>
                                                    <div
                                                        id="longitud"
                                                    ></div>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" sm="2">
                                                <v-btn
                                                color="primary"
                                                @click="saveCoord"
                                                >Guardar</v-btn>
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
                                                        id="celular"
                                                        v-model="form.celular"
                                                        :rules="cel"
                                                        maxlength="12"
                                                        counter
                                                        @keypress="soloNumeros($event)"
                                                        label="Celular"
                                                        prepend-icon="mdi-phone"
                                                        placeholder="Teléfono móvil del proietario"
                                                        outlined
                                                    ></v-text-field>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                    <v-text-field
                                                        id="telefono"
                                                        v-model="form.telefono"
                                                        label="Télefono"
                                                        :rules="tel"
                                                        maxlength="12"
                                                        counter
                                                        @keypress="soloNumeros($event)"
                                                        prepend-icon="mdi-phone-classic"
                                                        placeholder="Télefono fijo del propietario"
                                                        outlined
                                                    ></v-text-field>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                    <v-text-field
                                                        id="email"
                                                        v-model="form.email"
                                                        label="Correo Elctrónico"
                                                        maxlength="25"
                                                        counter
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
                                                        id="contactoAl"
                                                        v-model="form.contactoAlterno"
                                                        maxlength="12"
                                                        counter
                                                        @keypress="soloNumeros($event)"
                                                        label="Otro Número de Contacto"
                                                        prepend-icon="mdi-phone-plus"
                                                        placeholder="Otro número de contacto del propietario"
                                                        outlined
                                                    ></v-text-field>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="12">
                                                <v-subheader>Boleta de Pago para la emisión de la Autorización</v-subheader>
                                            </v-col>
                                            <v-col cols="12" lg="12" sm="12">
                                                <template>
                                                    <v-file-input style="height: 45px"
                                                        v-model="form.boleta"
                                                        outlined
                                                        dense
                                                        show-size
                                                    ><template v-slot:label>
                                                        <div>
                                                        Foto o escaneo de la Boleta de Pago<small> (opcional)</small>
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
                                                    <v-text-field v-model="form.numCanes" maxlength="15" counter :rules="vacio" outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
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
                                                                v-model="form.aFechaHoraCanes"
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
                                                                    <v-btn text @click="dropdownOpen1 = false">Cancelar</v-btn>
                                                                    <v-btn color="primary" @click="confirm1()">Guardar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        v-model="form.aCanesFile"
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
                                                <v-textarea v-if="switchCANES == '1'" v-model="form.aCanes" counter maxlength="150" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else v-model="form.aCanes" solo disabled></v-textarea>
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
                                                    <v-text-field v-model="form.numRejap" maxlength="15" counter outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
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
                                                                v-model="form.aFechaHoraRejap"
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
                                                                    <v-btn text @click="dropdownOpen2 = false">Cancelar</v-btn>
                                                                    <v-btn color="primary" @click="confirm2()">Guardar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        v-model="form.aRejapFile"
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
                                                <v-textarea v-if="switchREJAP == '1'" v-model="form.aRejap" counter maxlength="150" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else v-model="form.aRejap" solo disabled label="Ninguno"></v-textarea>
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
                                                    <v-text-field v-model="form.numFelcc" maxlength="15" counter outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
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
                                                                v-model="form.aFechaHoraFelcc"
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
                                                                    <v-btn text @click="dropdownOpen3 = false">Cancelar</v-btn>
                                                                    <v-btn color="primary" @click="confirm3()">Guardar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        v-model="form.aFelccFile"
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
                                                <v-textarea v-if="switchFELCC == '1'" v-model="form.aFelcc" counter maxlength="150" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else v-model="form.aFelcc" solo disabled label="Ninguno"></v-textarea>
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
                                                    <v-text-field v-model="form.numFelcn" maxlength="15" counter outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
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
                                                                v-model="form.aFechaHoraFelcn"
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
                                                                    <v-btn text @click="dropdownOpen4 = false">Cancelar</v-btn>
                                                                    <v-btn color="primary" @click="confirm4()">Guardar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        v-model="form.aFelcnFile"
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
                                                <v-textarea v-if="switchFELCN == '1'" v-model="form.aFelcn" counter maxlength="150" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else v-model="form.aFelcn" solo disabled label="Ninguno"></v-textarea>
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
                                                    <v-text-field v-model="form.numFelcv" maxlength="15" counter outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
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
                                                                v-model="form.aFechaHoraFelcv"
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
                                                                    <v-btn text @click="dropdownOpen5 = false">Cancelar</v-btn>
                                                                    <v-btn color="primary" @click="confirm5()">Guardar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        v-model="form.aFelcvFile"
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
                                                <v-textarea v-if="switchFELCV == '1'" v-model="form.aFelcv" counter maxlength="150" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else solo v-model="form.aFelcv" disabled label="Ninguno"></v-textarea>
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
                                step="4">
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
                                        id="agencia"
                                        v-model="form.nomAgencia"
                                        :rules="vacio"
                                        maxlength="25" counter
                                        label="Agencia"
                                        placeholder="Nombre de la Agencia"
                                        outlined></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                        <v-text-field
                                        id="ubiAgencia"
                                        v-model="form.ubiAgencia"
                                        maxlength="25" counter
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
                                                    v-model="form.dateExpSeg"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Expedición del Seguro"
                                                    :rules="vacio"
                                                    clearable
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="form.dateExpSeg"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    min="2000-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuExpSeg.save(form.dateExpSeg)"
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
                                                    v-model="form.dateLimSeg"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Expiración del Seguro"
                                                    :rules="vacio"
                                                    clearable
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="form.dateLimSeg"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :min="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    max="2040-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuLimSeg.save(form.dateLimSeg)"
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
                                        id="resAgencia"
                                        v-model="form.resAgencia"
                                        maxlength="25" counter
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
                                        id="resAgenciaNum"
                                        v-model="form.resAgenciaNum"
                                        maxlength="25" counter
                                        @keypress="soloNumeros($event)"
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
                                                v-model="form.seguroFile"
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
                                <v-stepper-step step="5">
                                Datos del Can Peligroso
                                </v-stepper-step>

                                <v-stepper-content step="5">
                                <v-card
                                    class="mb-12"
                                    height="100%">
                                <v-container fluid>
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            sm="6">
                                        <v-text-field
                                        id="nomPerro"
                                        v-model="form.nomPerro"
                                        :rules="vacio"
                                        label="Nombre"
                                        maxlength="15" counter
                                        placeholder="Nombre del Can"
                                        outlined></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6">
                                        <template>
                                            <div>
                                                <v-dialog
                                                ref="menuNacPerro"
                                                v-model="menuNacPerro"
                                                :width="anchoDate">
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                    v-model="form.dateNacPerro"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Nacimiento del Can o Aproximada"
                                                    :rules="vacio"
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on">
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="form.dateNacPerro"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    min="2000-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuNacPerro.save(form.dateNacPerro)">
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
                                        id="procedencia"
                                        v-model="form.procedenciaCan"
                                        :rules="vacio"
                                        label="Procedencia"
                                        maxlength="30" counter
                                        placeholder="Procedencia de la Adquisición del Can"
                                        outlined></v-text-field>
                                        </v-col>
                                        <v-col cols="12" lg="12" sm="12" style="display: flex; justify-content: space-around; padding: 0">
                                            <v-dialog persistent fullscreen hide-overlay transition="dialog-bottom-transition" v-model="dialog2">
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-btn fab v-if="!photoTaken1 || !photoTaken2 || !photoTaken3 || !photoTaken4 || !photoTaken5" color="primary" v-bind="attrs" v-on="on" @click="toggleCamera1" :loading="dialog2">
                                                        <v-icon>
                                                            mdi-camera-plus
                                                        </v-icon>
                                                    </v-btn>
                                                    <v-btn fab v-else color="success" v-bind="attrs" v-on="on" @click.prevent="dialog2 = true" :loading="dialog2">
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
                                                    <v-toolbar-title>Fotografías del Can:&nbsp;</v-toolbar-title>
                                                    <v-spacer></v-spacer>
                                                    <v-toolbar-items>
                                                        <v-btn large style="padding: 10px" text @click.prevent="dialog2 = false">
                                                            Cerrar
                                                        </v-btn>
                                                    </v-toolbar-items>
                                                    </v-toolbar>

                                                    <v-row style="padding:12px; margin-right: 5px">
                                                        <v-tabs vertical>
                                                        <v-tab>
                                                            <v-icon left>
                                                            </v-icon>
                                                            FRONTAL
                                                        </v-tab>
                                                        <v-tab @click="toggleCamera2">
                                                            <v-icon left>
                                                            </v-icon>
                                                            IZQUIERDA
                                                        </v-tab>
                                                        <v-tab @click="toggleCamera3">
                                                            <v-icon left>
                                                            </v-icon>
                                                            DERECHA
                                                        </v-tab>
                                                        <v-tab @click="toggleCamera4">
                                                            <v-icon left>
                                                            </v-icon>
                                                            POSTERIOR
                                                        </v-tab>
                                                        <v-tab @click="toggleCamera5">
                                                            <v-icon left>
                                                            </v-icon>
                                                            LATERAL
                                                        </v-tab>

                                                        <v-tab-item>
                                                            <v-card flat>
                                                            <v-card-text>
                                                                <v-row>
                                                                    <div v-if="isCameraOpen1" v-show="!isLoading1" :class="{ 'flash' : isShotPhoto1 }">
                                                                        <div :class="{'flash' : isShotPhoto1}"></div>
                                                                        <video v-if="!photoTaken1" ref="camera1" :width="canvasWidth" :height="canvasHeight" autoplay id="player1"></video>
                                                                        <canvas v-show="photoTaken1" ref="canvas1" :width="canvasWidth" :height="canvasHeight"></canvas>
                                                                    </div>
                                                                    <v-row style="display: flex; flex-direction: column">
                                                                        <div v-if="isCameraOpen1 && !isLoading1 && !photoTaken1" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="success" @click="takePhoto1">
                                                                                <v-icon>
                                                                                    mdi-camera
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                        <select style="padding:20px; margin-right: 20px; margin-left: 20px" v-show="!photoTaken1" id="camaras1"></select>
                                                                        <div v-if="isCameraOpen1 && !isLoading1 && photoTaken1" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="warning" @click="retryPhoto1">
                                                                                <v-icon>
                                                                                    mdi-reload
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                    </v-row>
                                                                </v-row>
                                                            </v-card-text>
                                                            </v-card>
                                                        </v-tab-item>
                                                        <v-tab-item>
                                                            <v-card flat>
                                                            <v-card-text>
                                                                <v-row>
                                                                    <div v-if="isCameraOpen2" v-show="!isLoading2" :class="{ 'flash' : isShotPhoto2 }">
                                                                        <div :class="{'flash' : isShotPhoto2}"></div>
                                                                        <video v-if="!photoTaken2" ref="camera2" :width="canvasWidth" :height="canvasHeight" autoplay id="player2"></video>
                                                                        <canvas v-show="photoTaken2" ref="canvas2" :width="canvasWidth" :height="canvasHeight"></canvas>
                                                                    </div>
                                                                    <v-row style="display: flex; flex-direction: column">
                                                                        <div v-if="isCameraOpen2 && !isLoading2 && !photoTaken2" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="success" @click="takePhoto2">
                                                                                <v-icon>
                                                                                    mdi-camera
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                        <select style="padding:20px; margin-right: 20px; margin-left: 20px" v-show="!photoTaken2" id="camaras2"></select>
                                                                        <div v-if="isCameraOpen2 && !isLoading2 && photoTaken2" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="warning" @click="retryPhoto2">
                                                                                <v-icon>
                                                                                    mdi-reload
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                    </v-row>
                                                                </v-row>
                                                            </v-card-text>
                                                            </v-card>
                                                        </v-tab-item>
                                                        <v-tab-item>
                                                            <v-card flat>
                                                            <v-card-text>
                                                                <v-row>
                                                                    <div v-if="isCameraOpen3" v-show="!isLoading3" :class="{ 'flash' : isShotPhoto3 }">
                                                                        <div :class="{'flash' : isShotPhoto3}"></div>
                                                                        <video v-if="!photoTaken3" ref="camera3" :width="canvasWidth" :height="canvasHeight" autoplay id="player3"></video>
                                                                        <canvas v-show="photoTaken3" ref="canvas3" :width="canvasWidth" :height="canvasHeight"></canvas>
                                                                    </div>
                                                                    <v-row style="display: flex; flex-direction: column">
                                                                        <div v-if="isCameraOpen3 && !isLoading3 && !photoTaken3" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="success" @click="takePhoto3">
                                                                                <v-icon>
                                                                                    mdi-camera
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                        <select style="padding:20px; margin-right: 20px; margin-left: 20px" v-show="!photoTaken3" id="camaras3"></select>
                                                                        <div v-if="isCameraOpen3 && !isLoading3 && photoTaken3" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="warning" @click="retryPhoto3">
                                                                                <v-icon>
                                                                                    mdi-reload
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                    </v-row>
                                                                </v-row>
                                                            </v-card-text>
                                                            </v-card>
                                                        </v-tab-item>
                                                        <v-tab-item>
                                                            <v-card flat>
                                                            <v-card-text>
                                                                <v-row>
                                                                    <div v-if="isCameraOpen4" v-show="!isLoading4" :class="{ 'flash' : isShotPhoto4 }">
                                                                        <div :class="{'flash' : isShotPhoto4}"></div>
                                                                        <video v-if="!photoTaken4" ref="camera4" :width="canvasWidth" :height="canvasHeight" autoplay id="player4"></video>
                                                                        <canvas v-show="photoTaken4" ref="canvas4" :width="canvasWidth" :height="canvasHeight"></canvas>
                                                                    </div>
                                                                    <v-row style="display: flex; flex-direction: column">
                                                                        <div v-if="isCameraOpen4 && !isLoading4 && !photoTaken4" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="success" @click="takePhoto4">
                                                                                <v-icon>
                                                                                    mdi-camera
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                        <select style="padding:20px; margin-right: 20px; margin-left: 20px" v-show="!photoTaken4" id="camaras4"></select>
                                                                        <div v-if="isCameraOpen4 && !isLoading4 && photoTaken4" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="warning" @click="retryPhoto4">
                                                                                <v-icon>
                                                                                    mdi-reload
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                    </v-row>
                                                                </v-row>
                                                            </v-card-text>
                                                            </v-card>
                                                        </v-tab-item>
                                                        <v-tab-item>
                                                            <v-card flat>
                                                            <v-card-text>
                                                                <v-row>
                                                                    <div v-if="isCameraOpen5" v-show="!isLoading5" :class="{ 'flash' : isShotPhoto5 }">
                                                                        <div :class="{'flash' : isShotPhoto5}"></div>
                                                                        <video v-if="!photoTaken5" ref="camera5" :width="canvasWidth" :height="canvasHeight" autoplay id="player5"></video>
                                                                        <canvas v-show="photoTaken5" ref="canvas5" :width="canvasWidth" :height="canvasHeight"></canvas>
                                                                    </div>
                                                                    <v-row style="display: flex; flex-direction: column">
                                                                        <div v-if="isCameraOpen5 && !isLoading5 && !photoTaken5" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="success" @click="takePhoto5">
                                                                                <v-icon>
                                                                                    mdi-camera
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                        <select style="padding:20px; margin-right: 20px; margin-left: 20px" v-show="!photoTaken5" id="camaras5"></select>
                                                                        <div v-if="isCameraOpen5 && !isLoading5 && photoTaken5" style="text-align: center; padding: 50px">
                                                                            <v-btn fab color="warning" @click="retryPhoto5">
                                                                                <v-icon>
                                                                                    mdi-reload
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </div>
                                                                    </v-row>
                                                                </v-row>
                                                            </v-card-text>
                                                            </v-card>
                                                        </v-tab-item>
                                                        </v-tabs>
                                                    </v-row>
                                                    <v-divider></v-divider>
                                                </v-card>
                                            </v-dialog>
                                            <v-btn-toggle style="padding-top: 10px" class="d-none d-sm-block"
                                              v-model="toggle_one" shaped mandatory
                                            >
                                              <v-btn v-if="!photoTaken1" disabled>
                                                Frontal
                                              </v-btn>
                                              <v-btn v-else-if="photoTaken1" tile color="success">
                                                Frontal
                                              </v-btn>

                                              <v-btn v-if="!photoTaken2" disabled>
                                                Izquierdo
                                              </v-btn>
                                              <v-btn v-else-if="photoTaken2" color="success">
                                                Izquierdo
                                              </v-btn>

                                              <v-btn v-if="!photoTaken3" disabled>
                                                Derecho
                                              </v-btn>
                                              <v-btn v-else-if="photoTaken3" color="success">
                                                Derecho
                                              </v-btn>

                                              <v-btn v-if="!photoTaken4" disabled>
                                                Posterior
                                              </v-btn>
                                              <v-btn v-else-if="photoTaken4" color="success">
                                                Posterior
                                              </v-btn>

                                              <v-btn v-if="!photoTaken5" disabled>
                                                Lateral
                                              </v-btn>
                                              <v-btn v-else-if="photoTaken5" color="success">
                                                Lateral
                                              </v-btn>
                                            </v-btn-toggle>
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
                                                id="razaCan"
                                                v-model="form.razaCan"
                                                :raza="razas"
                                                :items= "razasNames"
                                                :rules="vacio"
                                                placeholder="Especifique la Raza del Can"
                                                outlined>
                                            </v-autocomplete>
                                            <v-text-field v-else
                                                id="razaCan"
                                                v-model="form.razaCan"
                                                :rules="vacio"
                                                label="Raza"
                                                maxlength="25" counter
                                                @keypress="sinNumeros($event)"
                                                placeholder="Especifique la Raza o Cruce de Razas del Can"
                                                outlined>
                                            </v-text-field>
                                        </v-col>
                                        </v-row>
                                        <v-row>
                                        <v-col cols="12" sm="6">
                                            <v-autocomplete v-model="form.tamCan" :items= "tamCanItems" :rules="vacio" outlined placeholder="Tamaño del Can"></v-autocomplete>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-text-field id="colorCan" v-model="form.colorCan" maxlength="40" counter @keypress="sinNumeros($event)" outlined label="Color" :rules="vacio" placeholder="Color o Colores Característicos del Can">
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12">
                                            <v-textarea id="sinCan" v-model="form.sinCan" @keypress="sinNumeros($event)" outlined label="Singularidades del Can" :rules="vacio" placeholder="Rasgos Característicos del Can, ej: cicatrices, color de ojos, etc.">
                                            </v-textarea>
                                        </v-col>
                                        </v-row>

                                    <v-row style="display: flex; justify-content: center">
                                        <v-col cols="12" sm="12">
                                            <v-subheader>Antecedentes del Can</v-subheader>
                                        </v-col>
                                        <v-col cols="12" sm="4" style="display: flex; justify-content: center">
                                            <v-switch
                                            v-model="switchAnt"
                                            inset
                                            label="El Can tiene antecedentes?">
                                            </v-switch>
                                        </v-col>
                                        <v-col cols="12" sm="2">
                                            <v-card-text style="margin-top:5px; text-align: center" v-if="switchAnt == '1'">Sí</v-card-text>
                                            <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                        </v-col>
                                    </v-row>
                                    <v-row v-if="switchAnt">
                                        <v-card
                                            height="100%"
                                            width="100%"
                                            >
                                            <v-row style="padding: 20px; justify-content: center">
                                            <h1 style="text-align: center; font-size: large; padding-top: 5px">Antecedentes Del Can</h1>
                                            </v-row>
                                            <v-divider></v-divider>

                                            <v-row style="padding: 20px">
                                                <v-col cols="12" sm="6">
                                                    <v-text-field v-model="form.tipoAnt" maxlength="15" counter :rules="vacio" outlined label="Tipo de Antecente" placeholder="Tipo de Antecedente que tiene el Can"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <v-text-field v-model="form.numAnt" maxlength="15" counter :rules="vacio" outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpenCanAnt"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="modelCanAnt"
                                                        :width="anchoDate2a">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="form.fechaHoraAnt"
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
                                                                        v-model="dateModelAnt"
                                                                        :width="anchoDate2b"
                                                                        locale="es"
                                                                        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                                        color="primary"></v-date-picker>

                                                                </v-flex>
                                                                <v-flex xs12 sm6 style="display:block; text-align: center">
                                                                    <v-time-picker
                                                                        v-if="dropdownOpenCanAnt"
                                                                        v-model="timeModelAnt"
                                                                        color="primary"
                                                                        :width="anchoDate2b"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>

                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelectionAnt }}</h3>
                                                                </v-flex>

                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn text @click="dropdownOpenCanAnt = false">Cancelar</v-btn>
                                                                    <v-btn color="primary" @click="confirmCanAnt()">Guardar</v-btn>
                                                                </v-flex>
                                                            </v-layout>
                                                        </div>
                                                    </v-dialog>
                                                </div>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <template>
                                                    <v-file-input style="height: 45px"
                                                        v-model="form.canAntFile"
                                                        outlined
                                                        dense
                                                        show-size
                                                    ><template v-slot:label>
                                                        <div>
                                                        Antecedentes del Can Adjuntados<small> (opcional)</small>
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

                                            <!-- Antecedentes -->
                                            <v-subheader>Antecedentes del Can</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-model="form.canAnt" counter maxlength="150" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                            </v-col>

                                            </v-card>

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
                                                    v-model="form.dateVacPerro"
                                                    :disabled="!switchVac"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Vacunación del Can o Aproximada"
                                                    :rules="vacio"
                                                    clearable
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="form.dateVacPerro"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    min="2000-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuVacPerro.save(form.dateVacPerro)"
                                                    >
                                                        OK
                                                    </v-btn></v-date-picker>
                                                </v-dialog>
                                            </div>
                                        </template>
                                        </v-col>
                                        <v-col cols="12" sm="4" style="display: flex; justify-content: center" >
                                            <v-switch :disabled="!form.sexoCan" v-if="form.sexoCan == 'Hembra'"
                                            v-model="switchEst"
                                            inset
                                            label="¿Está Esterilizado?">
                                            </v-switch>
                                            <v-switch :disabled="!form.sexoCan" v-if="form.sexoCan == 'Macho'"
                                            v-model="switchEst"
                                            inset
                                            label="¿Está Castrado?">
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
                                                    v-model="form.dateEstPerro"
                                                    :disabled="!switchEst"
                                                    prepend-icon="mdi-calendar"
                                                    label="Fecha de Esterilización del Can o Aproximada"
                                                    :rules="vacio"
                                                    clearable
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    >
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="form.dateEstPerro"
                                                    scrollable
                                                    locale="es"
                                                    :width="anchoDate"
                                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                    min="2000-01-01"
                                                ><v-spacer></v-spacer>
                                                    <v-btn
                                                        color="primary"
                                                        @click="$refs.menuEstPerro.save(form.dateEstPerro)"
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
                                                <v-text-field :disabled="!switchVac" maxlength="20" counter v-model="form.vetNom1" :rules="vacio" outlined label="Veterinaria o Unidad Móvil" placeholder="Nombre de la Veterinaria o Entidad donde se Vacunó al Can">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchVac" maxlength="30" counter v-model="form.vetUbi1" outlined placeholder="Departamento/Ciudad/Zona/Calle"><template v-slot:label><div>Ubicación<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchVac" maxlength="30" counter @keypress="sinNumeros($event)" v-model="form.vetRes1" outlined placeholder="Nombre del Responsable a Cargo de la Vacunación"><template v-slot:label><div>Responsable<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchVac" maxlength="12" counter @keypress="soloNumeros($event)"  v-model="form.vetNum1" outlined placeholder="Teléfono de Referencia de la Veterinaria o Referente"><template v-slot:label><div>Número de Contacto<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                <v-file-input style="height: 45px"
                                                    v-model="form.vacFile"
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
                                                <v-text-field :disabled="!switchEst" maxlength="20" counter v-model="form.vetNom2" :rules="vacio" outlined label="Veterinaria" placeholder="Nombre de la Veterinaria donde se Esterilizó al Can">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchEst" maxlength="30" counter v-model="form.vetUbi2" outlined placeholder="Departamento/Ciudad/Zona/Calle"><template v-slot:label><div>Ubicación<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchEst" maxlength="30" counter @keypress="sinNumeros($event)" v-model="form.vetRes2" outlined placeholder="Nombre del Responsable a Cargo de la Esterilización"><template v-slot:label><div>Responsable<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field :disabled="!switchEst" maxlength="12" counter @keypress="soloNumeros($event)" v-model="form.vetNum2" outlined placeholder="Teléfono de Referencia de la Veterinaria o Responsable"><template v-slot:label><div>Número de Contacto<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                <v-file-input style="height: 45px"
                                                    v-model="form.estFile"
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
                                                <v-text-field v-model="form.vetNom3" maxlength="20" counter :rules="vacio" outlined label="Veterinaria" placeholder="Nombre de la Veterinaria donde se Trató al Can">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.vetUbi3" maxlength="30" counter outlined label="Ubicación" placeholder="Departamento/Ciudad/Zona/Calle"><template v-slot:label><div>Ubicación<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.vetRes3" maxlength="30" counter @keypress="sinNumeros($event)" outlined placeholder="Nombre del Responsable a Cargo de la Vacuna O Esterilización"><template v-slot:label><div>Responsable<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field v-model="form.vetNum3" maxlength="12" counter @keypress="soloNumeros($event)" outlined placeholder="Teléfono de Referencia de la Veterinaria o Responsable"><template v-slot:label><div>Número de Contacto<small> (opcional)</small></div></template>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <template>
                                                <v-file-input style="height: 45px"
                                                    v-model="form.vacFile"
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
                                            <v-col cols="12" sm="6">
                                                <template>
                                                <v-file-input style="height: 45px"
                                                    v-model="form.estFile"
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
                                                <v-card-text v-model="form.microchip" style="margin-top:5px; text-align: center" v-if="switchMicro == '1'">Sí</v-card-text>
                                                <v-card-text v-model="form.microchip" style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                            </v-col>
                                            <v-col cols="12" sm="6" style="padding-top: 38px">
                                                <v-text-field :disabled="!switchMicro"
                                                    v-model="form.numMicro"
                                                    :rules="vacio"
                                                    maxlength="12" counter
                                                    label="Número de Microchip"
                                                    placeholder="Número de Identitifación del Microchip"
                                                    outlined>
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col cols="12" sm="12"><v-subheader>Cuidadores o Tenedores Eventuales *al menos un nombre con contacto es obligatorio</v-subheader></v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field id="fullname" maxlength="30" counter @keypress="sinNumeros($event)" v-model="form.canEven1" outlined :rules="vacio" label="Cuidador Eventual" placeholder="Nombre del Cuidador o Tenedor Eventual que conozca al Can"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field id="telefono" maxlength="12" counter @keypress="soloNumeros($event)" v-model="form.canEvenNum1" outlined :rules="vacio" label="Número de Contacto" placeholder="Número de Contacto del Cuidador Eventual"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field id="fullname" maxlength="30" counter @keypress="sinNumeros($event)" v-model="form.canEven2" outlined label="Cuidador Eventual" placeholder="Nombre del Cuidador o Tenedor Eventual que conozca al Can"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field id="telefono" maxlength="12" counter @keypress="soloNumeros($event)" v-model="form.canEvenNum2" outlined label="Número de Contacto" placeholder="Número de Contacto del Cuidador Eventual"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field id="fullname" maxlength="30" counter @keypress="sinNumeros($event)" v-model="form.canEven3" outlined label="Cuidador Eventual" placeholder="Nombre del Cuidador o Tenedor Eventual que conozca al Can"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field id="telefono" maxlength="12" counter @keypress="soloNumeros($event)" v-model="form.canEvenNum3" outlined label="Número de Contacto" placeholder="Número de Contacto del Cuidador Eventual"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field id="fullname" maxlength="30" counter @keypress="sinNumeros($event)" v-model="form.canEven4" outlined label="Cuidador Eventual" placeholder="Nombre del Cuidador o Tenedor Eventual que o conozca al Can"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field id="telefono" maxlength="12" counter @keypress="soloNumeros($event)" v-model="form.canEvenNum4" outlined label="Número de Contacto" placeholder="Número de Contacto del Cuidador Eventual"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="12"><v-subheader>Tenencia del Can</v-subheader></v-col>
                                            <v-col cols="12" sm="12"><v-textarea id="canConvivencia" maxlength="45" counter v-model="form.canConvivencia" :rules="vacio" outlined label="Motivos de Convivencia con el Can Peligroso" placeholder="Motivos por los cuales se domestica al Perro Peligroso"></v-textarea></v-col>
                                        </v-row>
                                    </v-row>
                                </v-container>
                                </v-card>
                                <div style="padding: 15px">
                                    <v-btn
                                        :disabled="!form5IsValid"
                                        color="primary"
                                        @click="submitData"
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
                    </v-app>
                </div>
            </div>
        </div>
    </app-layout>
    <div v-else style="display: flex; justify-content: center; align-items: center; font-size: 50px; background-color:#DCEDC8;position: absolute;height: 100%;width: 100%">
        Sin Permisos Suficientes
    </div>
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
            terms: false,})
        return {
            e6: 1,
            gradosComan: ['Subtte.','Ttte.','Cap.','Tcnl.','Cnl.','Gnal.'],
            grado: null,
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
            menuMemo: false,
            menuProp: false,
            civ: ['Soltero', 'Casado', 'Separado', 'Divorciado', 'Viudo'],
            doc: ['CI', 'Pasaporte'],
            docExpItems: ['CH','LP','CB','OR','PT','TJ','SC','BE','PD', 'Extranjero'],
            /* Ubicación escrita */
            depa: ['Chuquisaca','La Paz','Cochabamba','Oruro','Potosí','Tarija','Santa Cruz','Beni','Pando'],
                /* Chuquisaca */
                provCH:['Azurduy','Belisario Boeto','Hernando Siles','Luis Calvo','Nor Cinti','Oropeza','Sud Cinti','Tomina','Yamparáez','Zudáñez'],
                muniCH1:['Villa Azurduy','Tarvita'],
                muniCH2:['Villa Serrano'],
                muniCH3:['Monteagudo','San Pablo de Huacareta'],
                muniCH4:['Villa Vaca Guzmán','Huacaya','Macharetí'],
                muniCH5:['Camargo','Incahuasi','San Lucas','Villa Charcas'],
                muniCH6:['Sucre','Poroma','Yotala'],
                muniCH7:['Camataqui (Villa Abecia)','Culpina','Las Carreras'],
                muniCH8:['Padilla','El Villar','Sopachuy','Tomina','Villa Alcalá'],
                muniCH9:['Tarabuco','Yamparáez'],
                muniCH10:['Villa Zudáñez','Icla','Presto','Villa Mojocoya'],
                /* La Paz */
                provLP: ['Abel Iturralde','Aroma','Bautista Saavedra','Camacho','Caranavi','Franz Tamayo','Gualberto Villaroel','Ingavi','Inquisivi', 'José Manuel Pando', 'Larecaja', 'Loayza', 'Los Andes', 'Manco Kapac', 'Muñecas', 'Murillo', 'Nor Yungas', 'Omasuyos', 'Pacajes', 'Sud Yungas'],
                muniLP1: ['Ixiamas','San buenaventura'],
                muniLP2: ['Sica Sica','Ayo Ayo','Calamarca','Collana','Colquencha','Patacamaya','Umala'],
                muniLP3: ['Charazani','Curva'],
                muniLP4: ['Puerto Acosta','Mocomoco','Puerto Carabuco','Escoma','Humanata'],
                muniLP5: ['Caranavi','Alto Beni'],
                muniLP6: ['Apolo','Pelechuco'],
                muniLP7: ['San Pedro de Curahuara','Chacarilla','Papel Pampa'],
                muniLP8: ['Viacha','Desaguadero','Guaqui','Jesús de Machaca','San Andrés de Machaca','Taraco','Tiahuanaco'],
                muniLP9: ['Inquisivi','Cajuata','Colquiri','Ichoca','Licoma Pampa','Quime'],
                muniLP10: ['Santiago de Machaca','Catacora'],
                muniLP11: ['Sorata','Combaya','Guanay','Mapiri','Quiabaya','Tacacoma','Teoponte','Tipuani'],
                muniLP12: ['Luribay','Cairoma','Malla','Sapahaqui','Yaco'],
                muniLP13: ['Pucarani','Batallas','Laja','Puerto Pérez'],
                muniLP14: ['Copacabana','San Pedro de Tiquina','Tito Yupanqui'],
                muniLP15: ['Chuma','Aucapata','Ayata'],
                muniLP16: ['Palca','Achocalla','El Alto','Ciudad de La Paz','Mecapaca'],
                muniLP17: ['Coroico','Coripata'],
                muniLP18: ['Achacachi','Ancoraimes','Chua Cocani','Huarina','Huatajata','Santiago de Huata'],
                muniLP19: ['Coro Coro','Calacoto','Caquiaviri','Charaña','Comanche','Nazacara de Pacajes','Santiago de Callapa','Waldo Ballivián'],
                muniLP20: ['Chulumani','Irupana','La Asunta','Palos Blancos','Yanacachi'],
                /* Cochabamba */
                provCB:['Arani','Arque','Ayopaya','Bolívar','Campero','Capinota','Carrasco','Cercado','Chapare','Esteban Arce','Germán Jordán','Mizque','Punata','Quillacollo','Tapacarí','Tiraque'],
                muniCB1:['Arani','Vacas'],
                muniCB2:['Arque','Tacopaya'],
                muniCB3:['Independencia','Morochata','Cocapata'],
                muniCB4:['Bolívar'],
                muniCB5:['Aiquile','Omereque','Pasorapa'],
                muniCB6:['Capinota','Santiváñez','Sicaya'],
                muniCB7:['Totora','Chimoré','Entre Ríos','Pocona','Pojo','Puerto Villarroel'],
                muniCB8:['Ciudad de Cochabamba'],
                muniCB9:['Sacaba','Colomi','Villa Tunari'],
                muniCB10:['Tarata','Anzaldo','Arbieto','Sacabamba'],
                muniCB11:['Cliza','Toco','Tolata'],
                muniCB12:['Mizque','Alalay','Vila Vila'],
                muniCB13:['Punata','Cuchumuela','San Benito','Tacachi','Villa Rivero'],
                muniCB14:['Quillacollo','Colcapirhua','Sipe Sipe','Tiquipaya','Vinto'],
                muniCB15:['Tapacarí'],
                muniCB16:['Tiraque','Shinahota'],
                /* Oruro */
                provOR:['Sabaya','Carangas','Cercado (Oruro)','Eduardo Abaroa','Ladislao Cabrera','Litoral','Mejillones','Nor Carangas','Pantaleón Dalence','Poopó','Sajama','San Pedro de Totora','Saucarí','Sebastián, Pagador','Sud Carangas','Tomás Barrón'],
                muniOR1:['Sabaya','Chipaya','Coipasa'],
                muniOR2:['Corque','Choquecota'],
                muniOR3:['Oruro','Caracollo','El Choro','Soracachi'],
                muniOR4:['Challapata','Santuario de Quillacas'],
                muniOR5:['Salinas de Garci Mendoza','Pampa Aullagas'],
                muniOR6:['Huachacalla','Cruz de Machacamarca','Escara','Esmeralda','Yunguyo del Litoral'],
                muniOR7:['La Rivera','Carangas','Todos Santos'],
                muniOR8:['Santiago de Huayllamarca'],
                muniOR9:['Villa Huanuni','Machacamarca'],
                muniOR10:['Villa Poopó','Antequera','Pazña'],
                muniOR11:['Curahuara de Carangas','Turco'],
                muniOR12:['Totora'],
                muniOR13:['Toledo'],
                muniOR14:['Santiago de Huari'],
                muniOR15:['Santiago de Andamarca','Belén de Andamarca'],
                muniOR16:['Eucaliptus'],
                /* Potosí */
                provPT:['Alonso de Ibáñez','Antonio Quijarro','Bernardino Bilbao','Charcas','Chayanta','Cornelio Saavedra','Daniel Campos','Enrique Baldivieso','José María Linares','Modesto Omiste','Nor Chichas','Nor Lípez','Rafael Bustillo','Sud Chichas','Sud Lípez','Tomás Frías'],
                muniPT1:['Sacaca','Caripuyo'],
                muniPT2:['Uyuni','Porco','Tomave'],
                muniPT3:['Arampampa','Acasio'],
                muniPT4:['San Pedro de Buena Vista','Toro Toro'],
                muniPT5:['Colquechaca','Ocurí','Pocoata','Ravelo','San Pedro de Macha'],
                muniPT6:['Betanzos','Chaquí','Tacobamba'],
                muniPT7:['Llica','Tahua'],
                muniPT8:['San Agustín'],
                muniPT9:['Puna','Caiza D','Ckochas'],
                muniPT10:['Villazón'],
                muniPT11:['Cotagaita','Vitichi'],
                muniPT12:['Colcha K','San Pedro de Quemes'],
                muniPT13:['Uncía','Chayanta','Llallagua','Chuquiuta'],
                muniPT14:['Tupiza','Atocha'],
                muniPT15:['San Pablo de Lípez','Mojinete','San Antonio de Esmoruco'],
                muniPT16:['Potosí','Tinguipaya','Urmiri','Villa de Yocalla'],
                /* Tarija */
                provTJ:['Aniceto Arce','Avilés','Cercado (Tarija)','Gran Chaco','Méndez','O`Connor'],
                muniTJ1:['Padcaya','Bermejo'],
                muniTJ2:['Uriondo','Yunchará'],
                muniTJ3:['Tarija'],
                muniTJ4:['Yacuiba','Caraparí','Villamontes'],
                muniTJ5:['San Lorenzo','El Puente'],
                muniTJ6:['Entre Ríos'],
                /* Santa Cruz */
                provSC:['Andrés Ibáñez','Ángel Sandoval','Chiquitos','Cordillera','Florida','Germán Busch','Guarayos','Ichilo','José Miguel de Velasco','Manuel María Caballero','Ñuflo de Chávez','Obispo Santisteban','Sara','Vallegrande','Warnes'],
                muniSC1:['Santa Cruz de la Sierra','Cotoca','El Torno','La Guardia'],
                muniSC2:['San Matías'],
                muniSC3:['San José de Chiquitos','Pailón','Roboré'],
                muniSC4:['Lagunillas','Bouibe','Cabezas','Camiri','Charagua','Cuevo','Gutiérrez'],
                muniSC5:['Samaipata','Mairana','Pampa Grande','Quirusillas'],
                muniSC6:['Puerto Suárez','El Carmen Rivero Tórrez','Puerto Quijarro'],
                muniSC7:['Ascensión de Guarayos','El Puente','Urubichá'],
                muniSC8:['Buena Vista','San Carlos','San Juan de Yapacaní','Yapacaní'],
                muniSC9:['San Ignacio de Velasco','San Miguel de Velasco','San Rafael de Velasco'],
                muniSC10:['Comarapa','Saipina'],
                muniSC11:['Concepción','Cuatro Cañadas','San Antonio del Lomerio','San Julián','San Ramón','San Xavier'],
                muniSC12:['Montero','General Agustín Saavedra','Minero','Fernández Alonso','San Pedro'],
                muniSC13:['Portachuelo','Colpa Bélgica','Santa Rosa del Sara'],
                muniSC14:['Vallegrande','El Trigal','Moro Moro','Postrervalle','Pucará'],
                muniSC15:['Warnes','Okinawa I'],
                /* Beni */
                provBE:['Cercado (Beni)','Iténez','José Ballivián','Mamoré','Marbán','Moxos','Vaca Díez','Yacuma'],
                muniBE1:['Trinidad','San Javier'],
                muniBE2:['Magdalena','Baures','Huacaraje'],
                muniBE3:['Reyes','Rurrenabaque','San Borja','Santa Rosa'],
                muniBE4:['San Joaquín','Pueto Siles','San Ramón'],
                muniBE5:['Loreto','San Andrés'],
                muniBE6:['San Ignacio'],
                muniBE7:['Riberalta','Guayaramerín'],
                muniBE8:['Santa Ana','Exaltación'],
                /* Pando */
                provPD:['Abuná','Federico Román','Madre de Dios','Manuripi','Nicolás Suárez'],
                muniPD1:['Santa Rosa del Abuná','Ingavi (Humaita)'],
                muniPD2:['Nueva Esperanza','Santos Mercado','Villa Nueva'],
                muniPD3:['Puerto Gonzalo Moreno','San Lorenzo','Sena'],
                muniPD4:['Puerto Rico','Filadelfia','San Pedro'],
                muniPD5:['Cobija','Porvenir','Bella Flor','Bolpebra'],

            dialog: false,
            dialog2: false,
            isCameraOpen: false,
            isCameraOpen1: false,
            isCameraOpen2: false,
            isCameraOpen3: false,
            isCameraOpen4: false,
            isCameraOpen5: false,
            isShotPhoto: false,
            isShotPhoto1: false,
            isShotPhoto2: false,
            isShotPhoto3: false,
            isShotPhoto4: false,
            isShotPhoto5: false,
            isLoading: false,
            isLoading1: false,
            isLoading2: false,
            isLoading3: false,
            isLoading4: false,
            isLoading5: false,
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
            dropdownOpen1: false,
            dropdownOpen2: false,
            dropdownOpen3: false,
            dropdownOpen4: false,
            dropdownOpen5: false,
            dropdownOpenCanAnt: false,
            dateModel1: '',
            dateModel2: '',
            dateModel3: '',
            dateModel4: '',
            dateModel5: '',
            dateModelAnt: '',
            timeModel1: '',
            timeModel2: '',
            timeModel3: '',
            timeModel4: '',
            timeModel5: '',
            timeModelAnt: '',
            menuExpSeg: null,
            menuLimSeg: null,
            menuNacPerro: null,
            toggle_one: null,

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
            tamCanItems: ['Pequeño','Mediano','Grande'],
            menuVacPerro: null,
            switchVac: false,
            switchAnt: false,
            menuEstPerro: null,
            switchEst: false,
            switchVet: false,
            switchMicro: '',
            canvasHeight:600,
            canvasWidth:800,
            photoTaken: false,
            photoTaken1: false,
            photoTaken2: false,
            photoTaken3: false,
            photoTaken4: false,
            photoTaken5: false,
            itemPhotoProp: [],
            itemPhotoProp1: [],
            itemPhotoProp2: [],
            itemPhotoProp3: [],
            itemPhotoProp4: [],
            itemPhotoProp5: [],
            firstSwitch: true,
            firstSwitch1: true,
            firstSwitch2: true,
            firstSwitch3: true,
            firstSwitch4: true,
            firstSwitch5: true,
            webFotoCan: true,
            form: {
                /* Memorial */
                comandante: null,
                referencia: null,
                dateMemo: null,
                memoFile: null,
                /* Propietario */
                paterno: null,
                materno: null,
                nombres: null,
                dateProp: null,
                profesion: null,
                estCivil: null,
                docTipo: null,
                documento: null,
                docExp: null,
                docFile: null,
                fotoProp: null,
                departamento: null,
                provincia: null,
                municipio: null,
                zona: null,
                domicilio: null,
                latitud: null,
                longitud: null,
                celular: null,
                telefono: null,
                email: null,
                contactoAlterno: null,
                boleta: null,
                /* Antecedentes */
                numCanes: null,
                aFechaHoraCanes: null,
                aCanesFile: null,
                aCanes: 'Ninguno',
                numRejap: null,
                aFechaHoraRejap: null,
                aRejapFile: null,
                aRejap: 'Ninguno',
                numFelcc: null,
                aFechaHoraFelcc: null,
                aFelccFile: null,
                aFelcc: 'Ninguno',
                numFelcn: null,
                aFechaHoraFelcn: null,
                aFelcnFile: null,
                aFelcn: 'Ninguno',
                numFelcv: null,
                aFechaHoraFelcv: null,
                aFelcvFile: null,
                aFelcv: 'Ninguno',
                /* Seguro */
                nomAgencia: null,
                ubiAgencia: null,
                dateExpSeg: null,
                dateLimSeg: null,
                resAgencia: null,
                resAgenciaNum: null,
                seguroFile: null,
                /* Can */
                nomPerro: null,
                dateNacPerro: null,
                sexoCan: 'Macho',
                procedenciaCan: null,

                fotoCan1: null,
                fotoCan2: null,
                fotoCan3: null,
                fotoCan4: null,
                fotoCan5: null,
                pedigree: null,
                razaCan: null,
                tamCan: null,
                colorCan: null,
                sinCan: null,
                vacuna: null,
                dateVacPerro: null,
                esterilizacion: null,
                dateEstPerro: null,
                mismoVeterinario: null,
                vetNom1: null,
                vetUbi1: null,
                vetRes1: null,
                vetNum1: null,
                vacFile: null,

                 /* Antecedentes Can */
                antecedentesCan: null,
                tipoAnt: null,
                numAnt: null,
                fechaHoraAnt: null,
                canAntFile: null,
                canAnt: null,

                vetNom2: null,
                vetUbi2: null,
                vetRes2: null,
                vetNum2: null,
                estFile: null,

                vetNom3: null,
                vetUbi3: null,
                vetRes3: null,
                vetNum3: null,

                numMicro: null,

                canEven1: null,
                canEvenNum1: null,
                canEven2: null,
                canEvenNum2: null,
                canEven3: null,
                canEvenNum3: null,
                canEven4: null,
                canEvenNum4: null,
                canConvivencia: null,

                /* Capacitaciones */
                capacitador: 'Ninguno',
                observaciones: 'Ninguno',
                grupoID: 'Ninguno',
                estado: 'Sin Comenzar',
                tipoCap: 'Ninguno',

                /* Auditoría */
                cac: this.$page.props.user.departamento,
                grupo: 'Ninguno',
                creado_por: this.$page.props.user.username,
            },
            }
        },
        created(){
        },
        computed: {
        form1IsValid () {
            return (
            this.grado &&
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
            this.form.dateProp &&
            this.form.profesion &&
            this.form.estCivil &&
            this.form.docTipo &&
            this.form.documento &&
            this.form.docExp &&
            this.form.fotoProp &&
            this.form.departamento &&
            this.form.provincia &&
            this.form.municipio &&
            this.form.zona &&
            this.form.domicilio &&
            this.form.latitud &&
            this.form.longitud &&
            (this.form.celular || this.form.telefono || this.form.email || this.form.contactoAlterno)
            )
        },
            canesCheck () {
                return (
                this.form.numCanes &&
                this.form.aFechaHoraCanes &&
                this.form.aCanes
                )
            },
            rejapCheck () {
                return (
                this.form.numRejap &&
                this.form.aFechaHoraRejap &&
                this.form.aRejap
                )
            },
            felccCheck () {
                return (
                this.form.numFelcc &&
                this.form.aFechaHoraFelcc &&
                this.form.aFelcc
                )
            },
            felcnCheck () {
                return (
                this.form.numFelcn &&
                this.form.aFechaHoraFelcn &&
                this.form.aFelcn
                )
            },
            felcvCheck () {
                return (
                this.form.numFelcv &&
                this.form.aFechaHoraFelcv &&
                this.form.aFelcv
                )
            },
        form3IsValid () {
            return (
            this.form.numCanes &&
            this.form.aFechaHoraCanes &&
            this.form.aCanes &&
            this.form.numRejap &&
            this.form.aFechaHoraRejap &&
            this.form.aRejap &&
            this.form.numFelcc &&
            this.form.aFechaHoraFelcc &&
            this.form.aFelcc &&
            this.form.numFelcn &&
            this.form.aFechaHoraFelcn &&
            this.form.aFelcn &&
            this.form.numFelcv &&
            this.form.aFechaHoraFelcv &&
            this.form.aFelcv            )
        },
        form4IsValid () {
            return (
            this.form.nomAgencia &&
            this.form.dateExpSeg &&
            this.form.dateLimSeg
            )
        },
        form5IsValid () {
            return (
            this.form.nomPerro &&
            this.form.dateNacPerro &&
            this.form.sexoCan &&
            (this.form.fotoCan || this.form.fotoCan2) &&
            this.form.procedenciaCan &&
            this.form.razaCan &&
            this.form.tamCan &&
            this.form.colorCan &&
            this.form.sinCan &&
            this.form.canEven1 &&
            this.form.canEvenNum1 &&
            this.form.canConvivencia
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
        modelCanAnt: {
            get() {return this.value;},
            set(modelCanAnt) {} },

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
        currentSelectionAnt() {
        let selectedTimeAnt = this.timeModelAnt;
        return this.formatDate(this.dateModelAnt) + ' ' + selectedTimeAnt;
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
        watch: {

        },

        methods:
        {
            submitData() {
                /* Asignar grado al comandante */
                this.form.comandante = this.grado + ' ' + this.form.comandante
                /* Verificar si es pedigree y si tiene antecedentes caninos*/
                if(this.switchPuro == true)
                {
                    this.form.pedigree = 'Sí'
                }
                else
                {
                    this.form.pedigree = 'No'
                }
                if(this.switchVac == true)
                {
                    this.form.vacuna = 'Sí'
                }
                else
                {
                    this.form.vacuna = 'No'
                }
                if(this.switchEst == true)
                {
                    this.form.esterilizacion = 'Sí'
                }
                else
                {
                    this.form.esterilizacion = 'No'
                }
                if(this.switchVet == true)
                {
                    this.form.mismoVeterinario = 'Sí'
                }
                else
                {
                    this.form.mismoVeterinario = 'No'
                }
                if(this.switchAnt == true)
                {
                  this.form.antecedentesCan = 'Sí'
                }
                else
                {
                  this.form.antecedentesCan = 'No'
                }

                /* subir datos */
                this.$inertia.post(route('registros.store'),this.form);
            },

            sinNumeros: function(evt)
            {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (!((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || (charCode >= 192 && charCode <= 255) || (charCode == [209]) || (charCode == [241]) || (charCode == [32]) || (charCode == [39]) || (charCode == [46]))) {
                    evt.preventDefault();
                } else {
                    return true;
                }
            },
            soloNumeros: function(evt)
            {

                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || (charCode >= 192 && charCode <= 255) || (charCode == [209]) || (charCode == [241]) || (charCode == [32]) || (charCode == [39]) || (charCode == [46])) {
                    evt.preventDefault();
                } else {
                    return true;
                }
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
                this.form.fotoProp = null,
                this.form.fotoPropName = null,
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
            let uniquePictureName = 'Fotografía Tomada'
            let capturedPhotoFile = this.dataURLtoFile(dataURL, 'PropietarioFoto' + '.jpg')
            this.form.fotoPropName = uniquePictureName;
            this.form.fotoProp = capturedPhotoFile;
            let formData = new FormData()
            formData.append('file', capturedPhotoFile)
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
            console.log("File", capturedPhotoFile);
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
            /* GALERÍA CAN */
            toggleCamera1() {
                if(!this.isCameraOpen1) {
                    this.isCameraOpen1 = true;
                    this.showDevices1 = true;
                    this.createCameraElement1();
                    this.switchCamara1();
                }
            },
            toggleCamera2() {
                if(!this.isCameraOpen2) {
                    this.isCameraOpen2 = true;
                    this.showDevices2 = true;
                    this.createCameraElement2();
                    this.switchCamara2();
                }
            },
            toggleCamera3() {
                if(!this.isCameraOpen3) {
                    this.isCameraOpen3 = true;
                    this.showDevices3 = true;
                    this.createCameraElement3();
                    this.switchCamara3();
                }
            },
            toggleCamera4() {
                if(!this.isCameraOpen4) {
                    this.isCameraOpen4 = true;
                    this.showDevices4 = true;
                    this.createCameraElement4();
                    this.switchCamara4();
                }
            },
            toggleCamera5() {
                if(!this.isCameraOpen5) {
                    this.isCameraOpen5 = true;
                    this.showDevices5 = true;
                    this.createCameraElement5();
                    this.switchCamara5();
                }
            },
            /* FRONTAL */
            switchCamara1(){
                navigator.mediaDevices.enumerateDevices().then((devices) => {
                let videoSourcesSelect1 = document.getElementById("camaras1");
                let videoPlayer1 = document.getElementById("player1");
                let MediaStreamHelper1 = {
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

                    const videoSource = videoSourcesSelect1.value;
                    const constraints = {
                        video: {
                            deviceId: videoSource ? {exact: videoSource} : undefined
                        }
                    };

                    return navigator.mediaDevices.getUserMedia(constraints);
                }
            };
                    videoSourcesSelect1.onchange = function(){
                    MediaStreamHelper1.requestStream().then(function(stream){
                        MediaStreamHelper1._stream = stream;
                        videoPlayer1.srcObject = stream;
                    });
                };
            devices.forEach((device) => {
                let option = new Option();
                option.value = device.deviceId;

                switch(device.kind){
                    // Append device to list of Cameras
                    case "videoinput":
                        if(this.firstSwitch1){
                        option.text = device.label || `Camera ${videoSourcesSelect1.length + 1}`;
                        videoSourcesSelect1.appendChild(option);
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

            createCameraElement1() {
                this.isLoading1 = true;
                const constraints = (window.constraints = {
                            audio: false,
                            video: true
            });
            navigator.mediaDevices
            .getUserMedia(constraints)
            .then(stream => {
            this.isLoading1 = false;
            this.$refs.camera1.srcObject = stream;
            }).catch(error => {
            this.isLoading1 = false;
                alert("El navegador o el dispositivo no permiten Cámara Web");
            });
            },
            stopCameraStream1() {
            let tracks = this.$refs.camera1.srcObject.getTracks();
            tracks.forEach(track => {
                track.stop();
            });
            },

            takePhoto1() {
                const FLASH_TIMEOUT = 50;
                let self = this;
                setTimeout(() => {
                this.showDevices1 = false;
                this.photoTaken1 = true;
                this.firstSwitch1 = false;
                this.webFotoCan = false;
                const context = this.$refs.canvas1.getContext('2d');
                context.drawImage(this.$refs.camera1, 0, 0, this.canvasWidth, this.canvasHeight);
                const dataUrl1 = this.$refs.canvas1.toDataURL("image/jpeg")
                    .replace("image/jpeg", "image/octet-stream");
                this.addToPhotoGallery1(dataUrl1);
                this.uploadPhoto1(dataUrl1);
                this.stopCameraStream1();
                }, FLASH_TIMEOUT);
            },
            retryPhoto1() {
                console.clear();
                this.itemPhotoProp1.splice(),
                this.showDevices1 = true;
                this.photoTaken1 = false,
                this.isCameraOpen1 = true,
                this.form.fotoProp1 = null,
                this.form.fotoPropName = null,
                this.webFotoCan = true,
                this.switchCamara1(),
                this.createCameraElement1()
            },

            addToPhotoGallery1(dataURI) {
            this.itemPhotoProp1.push(
                {
                    src: dataURI,
                    thumbnail: dataURI,
                    w: this.canvasWidth,
                    h: this.canvasHeight,
                    alt: 'some numbers on a grey background' // optional alt attribute for thumbnail image
                }
            )
            },
            uploadPhoto1(dataURL1){
            let capturedPhotoFile1 = this.dataURLtoFile1(dataURL1, 'CanFrontal' + '.jpg')
            this.form.fotoCan1 = capturedPhotoFile1;
            let formData1 = new FormData()
            formData1.append('file', capturedPhotoFile1)
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
            console.log("File", capturedPhotoFile1);
            },

            dataURLtoFile1(dataURL1, filename1) {
                let arr = dataURL1.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new File([u8arr], filename1, {type: mime});
            },
            /* IZQUIERDA */
            switchCamara2(){
                navigator.mediaDevices.enumerateDevices().then((devices) => {
                let videoSourcesSelect2 = document.getElementById("camaras2");
                let videoPlayer2 = document.getElementById("player2");
                let MediaStreamHelper2 = {
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

                    const videoSource = videoSourcesSelect2.value;
                    const constraints = {
                        video: {
                            deviceId: videoSource ? {exact: videoSource} : undefined
                        }
                    };

                    return navigator.mediaDevices.getUserMedia(constraints);
                }
            };
                    videoSourcesSelect2.onchange = function(){
                    MediaStreamHelper2.requestStream().then(function(stream){
                        MediaStreamHelper2._stream = stream;
                        videoPlayer2.srcObject = stream;
                    });
                };
            devices.forEach((device) => {
                let option = new Option();
                option.value = device.deviceId;

                switch(device.kind){
                    // Append device to list of Cameras
                    case "videoinput":
                        if(this.firstSwitch2){
                        option.text = device.label || `Camera ${videoSourcesSelect2.length + 1}`;
                        videoSourcesSelect2.appendChild(option);
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

            createCameraElement2() {
                this.isLoading2 = true;
                const constraints = (window.constraints = {
                            audio: false,
                            video: true
            });
            navigator.mediaDevices
            .getUserMedia(constraints)
            .then(stream => {
            this.isLoading2 = false;
            this.$refs.camera2.srcObject = stream;
            }).catch(error => {
            this.isLoading2 = false;
                alert("El navegador o el dispositivo no permiten Cámara Web");
            });
            },
            stopCameraStream2() {
            let tracks = this.$refs.camera2.srcObject.getTracks();
            tracks.forEach(track => {
                track.stop();
            });
            },

            takePhoto2() {
                const FLASH_TIMEOUT = 50;
                let self = this;
                setTimeout(() => {
                this.showDevices2 = false;
                this.photoTaken2 = true;
                this.firstSwitch2 = false;
                this.webFotoCan = false;
                const context = this.$refs.canvas2.getContext('2d');
                context.drawImage(this.$refs.camera2, 0, 0, this.canvasWidth, this.canvasHeight);
                const dataUrl2 = this.$refs.canvas2.toDataURL("image/jpeg")
                    .replace("image/jpeg", "image/octet-stream");
                this.addToPhotoGallery2(dataUrl2);
                this.uploadPhoto2(dataUrl2);
                this.stopCameraStream2();
                }, FLASH_TIMEOUT);
            },
            retryPhoto2() {
                console.clear();
                this.itemPhotoProp2.splice(),
                this.showDevices2 = true;
                this.photoTaken2 = false,
                this.isCameraOpen2 = true,
                this.form.fotoProp2 = null,
                this.form.fotoPropName = null,
                this.webFotoCan = true,
                this.switchCamara2(),
                this.createCameraElement2()
            },

            addToPhotoGallery2(dataURI) {
            this.itemPhotoProp2.push(
                {
                    src: dataURI,
                    thumbnail: dataURI,
                    w: this.canvasWidth,
                    h: this.canvasHeight,
                    alt: 'some numbers on a grey background' // optional alt attribute for thumbnail image
                }
            )
            },
            uploadPhoto2(dataURL2){
            let capturedPhotoFile2 = this.dataURLtoFile2(dataURL2, 'CanIzquierda' + '.jpg')
            this.form.fotoCan2 = capturedPhotoFile2;
            let formData2 = new FormData()
            formData2.append('file', capturedPhotoFile2)
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
            console.log("File", capturedPhotoFile2);
            },

            dataURLtoFile2(dataURL2, filename2) {
                let arr = dataURL2.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new File([u8arr], filename2, {type: mime});
            },
            /* DERECHA */
            switchCamara3(){
                navigator.mediaDevices.enumerateDevices().then((devices) => {
                let videoSourcesSelect3 = document.getElementById("camaras3");
                let videoPlayer3 = document.getElementById("player3");
                let MediaStreamHelper3 = {
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

                    const videoSource = videoSourcesSelect3.value;
                    const constraints = {
                        video: {
                            deviceId: videoSource ? {exact: videoSource} : undefined
                        }
                    };

                    return navigator.mediaDevices.getUserMedia(constraints);
                }
            };
                    videoSourcesSelect3.onchange = function(){
                    MediaStreamHelper3.requestStream().then(function(stream){
                        MediaStreamHelper3._stream = stream;
                        videoPlayer3.srcObject = stream;
                    });
                };
            devices.forEach((device) => {
                let option = new Option();
                option.value = device.deviceId;

                switch(device.kind){
                    // Append device to list of Cameras
                    case "videoinput":
                        if(this.firstSwitch3){
                        option.text = device.label || `Camera ${videoSourcesSelect3.length + 1}`;
                        videoSourcesSelect3.appendChild(option);
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

            createCameraElement3() {
                this.isLoading3 = true;
                const constraints = (window.constraints = {
                            audio: false,
                            video: true
            });
            navigator.mediaDevices
            .getUserMedia(constraints)
            .then(stream => {
            this.isLoading3 = false;
            this.$refs.camera3.srcObject = stream;
            }).catch(error => {
            this.isLoading3 = false;
                alert("El navegador o el dispositivo no permiten Cámara Web");
            });
            },
            stopCameraStream3() {
            let tracks = this.$refs.camera3.srcObject.getTracks();
            tracks.forEach(track => {
                track.stop();
            });
            },

            takePhoto3() {
                const FLASH_TIMEOUT = 50;
                let self = this;
                setTimeout(() => {
                this.showDevices3 = false;
                this.photoTaken3 = true;
                this.firstSwitch3 = false;
                this.webFotoCan = false;
                const context = this.$refs.canvas3.getContext('2d');
                context.drawImage(this.$refs.camera3, 0, 0, this.canvasWidth, this.canvasHeight);
                const dataUrl3 = this.$refs.canvas3.toDataURL("image/jpeg")
                    .replace("image/jpeg", "image/octet-stream");
                this.addToPhotoGallery3(dataUrl3);
                this.uploadPhoto3(dataUrl3);
                this.stopCameraStream3();
                }, FLASH_TIMEOUT);
            },
            retryPhoto3() {
                console.clear();
                this.itemPhotoProp3.splice(),
                this.showDevices3 = true;
                this.photoTaken3 = false,
                this.isCameraOpen3 = true,
                this.form.fotoProp3 = null,
                this.form.fotoPropName = null,
                this.webFotoCan = true,
                this.switchCamara3(),
                this.createCameraElement3()
            },

            addToPhotoGallery3(dataURI) {
            this.itemPhotoProp3.push(
                {
                    src: dataURI,
                    thumbnail: dataURI,
                    w: this.canvasWidth,
                    h: this.canvasHeight,
                    alt: 'some numbers on a grey background' // optional alt attribute for thumbnail image
                }
            )
            },
            uploadPhoto3(dataURL3){
            let capturedPhotoFile3 = this.dataURLtoFile3(dataURL3, 'CanDerecha' + '.jpg')
            this.form.fotoCan3 = capturedPhotoFile3;
            let formData3 = new FormData()
            formData3.append('file', capturedPhotoFile3)
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
            console.log("File", capturedPhotoFile3);
            },

            dataURLtoFile3(dataURL3, filename3) {
                let arr = dataURL3.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new File([u8arr], filename3, {type: mime});
            },
            /* POSTERIOR */
            switchCamara4(){
                navigator.mediaDevices.enumerateDevices().then((devices) => {
                let videoSourcesSelect4 = document.getElementById("camaras4");
                let videoPlayer4 = document.getElementById("player4");
                let MediaStreamHelper4 = {
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

                    const videoSource = videoSourcesSelect4.value;
                    const constraints = {
                        video: {
                            deviceId: videoSource ? {exact: videoSource} : undefined
                        }
                    };

                    return navigator.mediaDevices.getUserMedia(constraints);
                }
            };
                    videoSourcesSelect4.onchange = function(){
                    MediaStreamHelper4.requestStream().then(function(stream){
                        MediaStreamHelper4._stream = stream;
                        videoPlayer4.srcObject = stream;
                    });
                };
            devices.forEach((device) => {
                let option = new Option();
                option.value = device.deviceId;

                switch(device.kind){
                    // Append device to list of Cameras
                    case "videoinput":
                        if(this.firstSwitch4){
                        option.text = device.label || `Camera ${videoSourcesSelect4.length + 1}`;
                        videoSourcesSelect4.appendChild(option);
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

            createCameraElement4() {
                this.isLoading4 = true;
                const constraints = (window.constraints = {
                            audio: false,
                            video: true
            });
            navigator.mediaDevices
            .getUserMedia(constraints)
            .then(stream => {
            this.isLoading4 = false;
            this.$refs.camera4.srcObject = stream;
            }).catch(error => {
            this.isLoading4 = false;
                alert("El navegador o el dispositivo no permiten Cámara Web");
            });
            },
            stopCameraStream4() {
            let tracks = this.$refs.camera4.srcObject.getTracks();
            tracks.forEach(track => {
                track.stop();
            });
            },

            takePhoto4() {
                const FLASH_TIMEOUT = 50;
                let self = this;
                setTimeout(() => {
                this.showDevices4 = false;
                this.photoTaken4 = true;
                this.firstSwitch4 = false;
                this.webFotoCan = false;
                const context = this.$refs.canvas4.getContext('2d');
                context.drawImage(this.$refs.camera4, 0, 0, this.canvasWidth, this.canvasHeight);
                const dataUrl4 = this.$refs.canvas4.toDataURL("image/jpeg")
                    .replace("image/jpeg", "image/octet-stream");
                this.addToPhotoGallery4(dataUrl4);
                this.uploadPhoto4(dataUrl4);
                this.stopCameraStream4();
                }, FLASH_TIMEOUT);
            },
            retryPhoto4() {
                console.clear();
                this.itemPhotoProp4.splice(),
                this.showDevices4 = true;
                this.photoTaken4 = false,
                this.isCameraOpen4 = true,
                this.form.fotoProp4 = null,
                this.form.fotoPropName = null,
                this.webFotoCan = true,
                this.switchCamara4(),
                this.createCameraElement4()
            },

            addToPhotoGallery4(dataURI) {
            this.itemPhotoProp4.push(
                {
                    src: dataURI,
                    thumbnail: dataURI,
                    w: this.canvasWidth,
                    h: this.canvasHeight,
                    alt: 'some numbers on a grey background' // optional alt attribute for thumbnail image
                }
            )
            },
            uploadPhoto4(dataURL4){
            let capturedPhotoFile4 = this.dataURLtoFile4(dataURL4, 'CanPosterior' + '.jpg')
            this.form.fotoCan4 = capturedPhotoFile4;
            let formData4 = new FormData()
            formData4.append('file', capturedPhotoFile4)
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
            console.log("File", capturedPhotoFile4);
            },

            dataURLtoFile4(dataURL4, filename4) {
                let arr = dataURL4.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new File([u8arr], filename4, {type: mime});
            },
            /* LATERAL */
            switchCamara5(){
                navigator.mediaDevices.enumerateDevices().then((devices) => {
                let videoSourcesSelect5 = document.getElementById("camaras5");
                let videoPlayer5 = document.getElementById("player5");
                let MediaStreamHelper5 = {
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

                    const videoSource = videoSourcesSelect5.value;
                    const constraints = {
                        video: {
                            deviceId: videoSource ? {exact: videoSource} : undefined
                        }
                    };

                    return navigator.mediaDevices.getUserMedia(constraints);
                }
            };
                    videoSourcesSelect5.onchange = function(){
                    MediaStreamHelper5.requestStream().then(function(stream){
                        MediaStreamHelper5._stream = stream;
                        videoPlayer5.srcObject = stream;
                    });
                };
            devices.forEach((device) => {
                let option = new Option();
                option.value = device.deviceId;

                switch(device.kind){
                    // Append device to list of Cameras
                    case "videoinput":
                        if(this.firstSwitch5){
                        option.text = device.label || `Camera ${videoSourcesSelect5.length + 1}`;
                        videoSourcesSelect5.appendChild(option);
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

            createCameraElement5() {
                this.isLoading5 = true;
                const constraints = (window.constraints = {
                            audio: false,
                            video: true
            });
            navigator.mediaDevices
            .getUserMedia(constraints)
            .then(stream => {
            this.isLoading5 = false;
            this.$refs.camera5.srcObject = stream;
            }).catch(error => {
            this.isLoading5 = false;
                alert("El navegador o el dispositivo no permiten Cámara Web");
            });
            },
            stopCameraStream5() {
            let tracks = this.$refs.camera5.srcObject.getTracks();
            tracks.forEach(track => {
                track.stop();
            });
            },

            takePhoto5() {
                const FLASH_TIMEOUT = 50;
                let self = this;
                setTimeout(() => {
                this.showDevices5 = false;
                this.photoTaken5 = true;
                this.firstSwitch5 = false;
                this.webFotoCan = false;
                const context = this.$refs.canvas5.getContext('2d');
                context.drawImage(this.$refs.camera5, 0, 0, this.canvasWidth, this.canvasHeight);
                const dataUrl5 = this.$refs.canvas5.toDataURL("image/jpeg")
                    .replace("image/jpeg", "image/octet-stream");
                this.addToPhotoGallery5(dataUrl5);
                this.uploadPhoto5(dataUrl5);
                this.stopCameraStream5();
                }, FLASH_TIMEOUT);
            },
            retryPhoto5() {
                console.clear();
                this.itemPhotoProp5.splice(),
                this.showDevices5 = true;
                this.photoTaken5 = false,
                this.isCameraOpen5 = true,
                this.form.fotoProp5 = null,
                this.form.fotoPropName = null,
                this.webFotoCan = true,
                this.switchCamara5(),
                this.createCameraElement5()
            },

            addToPhotoGallery5(dataURI) {
            this.itemPhotoProp5.push(
                {
                    src: dataURI,
                    thumbnail: dataURI,
                    w: this.canvasWidth,
                    h: this.canvasHeight,
                    alt: 'some numbers on a grey background' // optional alt attribute for thumbnail image
                }
            )
            },
            uploadPhoto5(dataURL5){
            let capturedPhotoFile5 = this.dataURLtoFile5(dataURL5, 'CanLateral' + '.jpg')
            this.form.fotoCan5 = capturedPhotoFile5;
            let formData5 = new FormData()
            formData5.append('file', capturedPhotoFile5)
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
            console.log("File", capturedPhotoFile5);
            },

            dataURLtoFile5(dataURL5, filename5) {
                let arr = dataURL5.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new File([u8arr], filename5, {type: mime});
            },
            /* FIN GALERÍA */

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
            confirmCanAnt() {
            this.onUpdateDateAnt();
            this.dropdownOpenCanAnt = false;
            },

            // Format the date and trigger the input event
            onUpdateDate1() {
            if (!this.dateModel1 || !this.timeModel1) return false;
            let selectedTime1 = this.timeModel1;
            this.form.aFechaHoraCanes = this.formatDate(this.dateModel1) + ' ' + selectedTime1;
            this.$emit('input', this.dateModel1 + ' ' + selectedTime1);
            },

            onUpdateDate2() {
            if (!this.dateModel2 || !this.timeModel2) return false;
            let selectedTime2 = this.timeModel2;
            this.form.aFechaHoraRejap = this.formatDate(this.dateModel2) + ' ' + selectedTime2;
            this.$emit('input', this.dateModel2 + ' ' + selectedTime2);
            },

            onUpdateDate3() {
            if (!this.dateModel3 || !this.timeModel3) return false;
            let selectedTime3 = this.timeModel3;
            this.form.aFechaHoraFelcc = this.formatDate(this.dateModel3) + ' ' + selectedTime3;
            this.$emit('input', this.dateModel3 + ' ' + selectedTime3);
            },

            onUpdateDate4() {
            if (!this.dateModel4 || !this.timeModel4) return false;
            let selectedTime4 = this.timeModel4;
            this.form.aFechaHoraFelcn = this.formatDate(this.dateModel4) + ' ' + selectedTime4;
            this.$emit('input', this.dateModel4 + ' ' + selectedTime4);
            },

            onUpdateDate5() {
            if (!this.dateModel5 || !this.timeModel5) return false;
            let selectedTime5 = this.timeModel5;
            this.form.aFechaHoraFelcv = this.formatDate(this.dateModel5) + ' ' + selectedTime5;
            this.$emit('input', this.dateModel5 + ' ' + selectedTime5);
            },

            onUpdateDateAnt() {
            if (!this.dateModelAnt || !this.timeModelAnt) return false;
            let selectedTimeAnt = this.timeModelAnt;
            this.form.fechaHoraAnt = this.formatDate(this.dateModelAnt) + ' ' + selectedTimeAnt;
            this.$emit('input', this.dateModelAnt + ' ' + selectedTimeAnt);
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
        /* Guardar Coordenadas */
        saveCoord(){
            const lati = localStorage.getItem('lat');
            console.log(lati);
            const longi = localStorage.getItem('lon');
            console.log(longi);
            document.getElementById('latitud').innerHTML = lati;
            document.getElementById('longitud').innerHTML = longi;
            this.form.latitud = lati;
            this.form.longitud = longi;
        }
        },
         mounted() {
             /* Obtener Edad */

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

            this.timeModelAnt = currentTime;
            this.dateModelAnt = d.toISOString().substr(0, 10);

            mapboxgl.accessToken = 'pk.eyJ1Ijoicm9ibGVlOTkiLCJhIjoiY2t2Z25tdDZxMDZ0OTJ2cGYzNndzZHJ3NyJ9.pBGTzYuYUmbU2dbF5TW8zQ';
            const map = new mapboxgl.Map({
                container: 'map', // container ID
                style: 'mapbox://styles/mapbox/streets-v11', // style URL
                center: [-63, -17], // starting position [lng, lat]
                zoom: 4.5 // starting zoom
            });

            var marker = new mapboxgl.Marker();

            function add_marker (event) {
            var coordinates = null;
            coordinates = event.lngLat;
            marker.setLngLat(coordinates).addTo(map);
            document.getElementById('latitud').innerHTML = Object.values(coordinates)[1];
            document.getElementById('longitud').innerHTML = Object.values(coordinates)[0];
            if(localStorage.getItem('lat') == null)
            {
                localStorage.setItem("lat", Object.values(coordinates)[1]);
                localStorage.setItem("lon", Object.values(coordinates)[0]);
            }
            else
            {
                localStorage.removeItem('lat');
                localStorage.removeItem('lon');
                console.clear();
                document.getElementById('latitud').innerHTML = null;
                document.getElementById('longitud').innerHTML = null;
                localStorage.setItem("lat", Object.values(coordinates)[1]);
                localStorage.setItem("lon", Object.values(coordinates)[0]);
            }

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
