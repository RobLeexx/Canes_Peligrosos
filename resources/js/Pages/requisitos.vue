<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Registro de Requisitos
            </h2>
        </template>

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
                                                v-model="form.first"
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
                                                v-model="form.last"
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
                                                        width="300px"
                                                        >
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-text-field
                                                            v-model="dateMemo"
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
                                                            v-model="dateMemo"
                                                            scrollable
                                                            locale="es"
                                                            :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                            min="2014-01-01"
                                                        ><v-spacer></v-spacer>
                                                            <v-btn
                                                                color="primary"
                                                                @click="$refs.menuMemo.save(dateMemo)"
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
                                <v-card-actions>
                                    <v-btn
                                    :disabled="!form1IsValid"
                                    color="primary"
                                    @click="e6 = 2"
                                    >
                                    Continuar
                                    </v-btn>
                                </v-card-actions>
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
                                                        width="300px"
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
                                                <v-overflow-btn
                                                v-model="form.doc"
                                                :items= "doc"
                                                label="Tipo de Documento de Identidad"
                                                :rules="vacio"
                                                outlined
                                                >
                                                </v-overflow-btn>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                v-model="form.documento"
                                                :rules="vacio"
                                                label="Documento de Identidad"
                                                placeholder="Documento con lugar de expedición"
                                                outlined
                                                ></v-text-field>
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
                                                <v-dialog v-model="dialog" width="50%" height="100%">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-btn fab color="primary" v-bind="attrs" v-on="on" @click="toggleCamera" :loading="dialog">
                                                            <v-icon>
                                                                mdi-camera-plus
                                                            </v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <v-card>
                                                        <v-card-title class="text-h5 grey lighten-2" style="display: flex; justify-content: center">
                                                            Foto Frontal del Propietario
                                                        </v-card-title>

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
                                                                <video v-show="!isPhotoTaken" ref="camera" :width="450" :height="337.5" autoplay></video>
                                                                <canvas v-show="isPhotoTaken" id="photoTaken" ref="canvas" :width="450" :height="337.5"></canvas>
                                                            </div>
                                                            
                                                            <v-row style="display: flex; flex-direction: column">
                                                                <div v-if="isCameraOpen && !isLoading && !isPhotoTaken" style="text-align: center; padding: 50px">
                                                                    <v-btn fab color="success" @click="takePhoto">
                                                                        <v-icon>
                                                                            mdi-camera
                                                                        </v-icon>
                                                                    </v-btn>
                                                                </div>
                                                                <div v-if="isCameraOpen && !isLoading && isPhotoTaken" style="text-align: center; padding: 50px">
                                                                    <v-btn fab color="warning" @click="takePhoto">
                                                                        <v-icon>
                                                                            mdi-reload
                                                                        </v-icon>
                                                                    </v-btn>
                                                                </div>
                                                                
                                                                <div v-if="isPhotoTaken && isCameraOpen" style="padding: 50px; text-align: center">
                                                                    <a id="downloadPhoto" download="my-photo.jpg" class="button" role="button" @click="downloadImage">
                                                                        <v-icon color="primary">
                                                                            mdi-download
                                                                        </v-icon>
                                                                        Descargar
                                                                    </a>
                                                                </div>
                                                            </v-row>
                                                        </v-row>

                                                        <v-divider></v-divider>
                                                        <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn style="padding: 10px" color="error" @click.prevent="dialog = false" @click="toggleCamera">
                                                            Cerrar
                                                        </v-btn>
                                                        </v-card-actions>
                                                    </v-card>
                                                    </v-dialog>
                                            </v-col>
                                            <v-col cols="12" lg="5" md="5" sm="5">
                                                <template>
                                                    <v-file-input
                                                        label="Foto del Propietario"
                                                        outlined
                                                        dense
                                                        show-size
                                                        prepend-icon="mdi-face"
                                                    ></v-file-input>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" lg="12" sm="6">
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
                                <v-card-actions>
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
                                </v-card-actions>
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
                                                    <v-text-field :rules="vacio" outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model"
                                                        width="580"
                                                        height="100%">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar"
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
                                                                        v-model="dateModel"
                                                                        width="280"
                                                                        locale="es"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex style="display:block; text-align: center" xs12 sm6>
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen" 
                                                                        v-model="timeModel" 
                                                                        color="primary"
                                                                        width="280"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen = false">Cancelar</v-btn>
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
                                                <v-col cols="12" sm="1">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchCANES == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>
                                                    
                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes CANES</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchCANES == '1'" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else solo disabled label="Ninguno"></v-textarea>
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
                                                    <v-text-field outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model"
                                                        width="580"
                                                        height="100%">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar"
                                                                readonly
                                                                outlined
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel"
                                                                        width="280"
                                                                        locale="es"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex style="display:block; text-align: center" xs12 sm6>
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen" 
                                                                        v-model="timeModel" 
                                                                        color="primary"
                                                                        width="280"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen = false">Cancelar</v-btn>
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
                                                    v-model="switchCANES"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="1">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchCANES == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>

                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes REJAP</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchCANES == '1'" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else solo disabled label="Ninguno"></v-textarea>
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
                                                    <v-text-field outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model"
                                                        width="580"
                                                        height="100%">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar"
                                                                readonly
                                                                outlined
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel"
                                                                        width="280"
                                                                        locale="es"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex style="display:block; text-align: center" xs12 sm6>
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen" 
                                                                        v-model="timeModel" 
                                                                        color="primary"
                                                                        width="280"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen = false">Cancelar</v-btn>
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
                                                    v-model="switchCANES"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="1">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchCANES == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>

                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes FELCC</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchCANES == '1'" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else solo disabled label="Ninguno"></v-textarea>
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
                                                    <v-text-field outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model"
                                                        width="580"
                                                        height="100%">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar"
                                                                readonly
                                                                outlined
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel"
                                                                        width="280"
                                                                        locale="es"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex style="display:block; text-align: center" xs12 sm6>
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen" 
                                                                        v-model="timeModel" 
                                                                        color="primary"
                                                                        width="280"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen = false">Cancelar</v-btn>
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
                                                    v-model="switchCANES"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="1">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchCANES == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>

                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes FELCN</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchCANES == '1'" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else solo disabled label="Ninguno"></v-textarea>
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
                                                    <v-text-field outlined label="Número de Registro" placeholder="Número de Registro del Antecedente o Sanción"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <div>
                                                    <v-dialog
                                                        ref="menu"
                                                        v-model="dropdownOpen"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="model"
                                                        width="580"
                                                        height="100%">
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                v-model="displayDate"
                                                                label="Fecha y hora del registro"
                                                                prepend-icon="mdi-calendar"
                                                                readonly
                                                                outlined
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                            
                                                        <div style="background: white;padding:15px">
                                                            <v-layout row wrap>
                                                                <v-flex xs12 sm6 style="justify-content: center">
                                                                    <v-date-picker 
                                                                        v-model="dateModel"
                                                                        width="280"
                                                                        locale="es"
                                                                        color="primary"></v-date-picker>
                                            
                                                                </v-flex>
                                                                <v-flex style="display:block; text-align: center" xs12 sm6>
                                                                    <v-time-picker 
                                                                        v-if="dropdownOpen" 
                                                                        v-model="timeModel" 
                                                                        color="primary"
                                                                        width="280"
                                                                        format="ampm"
                                                                        scrollable></v-time-picker>
                                            
                                                                    <h3 style="text-align: center; padding: 10px; font-weight: bold;">{{ currentSelection }}</h3>
                                                                </v-flex>
                                            
                                                                <v-flex style="justify-content: center; padding: 15px">
                                                                    <v-btn color="primary" @click="confirm()">Ok</v-btn>
                                                                    <v-btn text @click="dropdownOpen = false">Cancelar</v-btn>
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
                                                    v-model="switchCANES"
                                                    inset
                                                    label="¿Tiene Sanciones o Antecedentes?"
                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="12" sm="1">
                                                    <v-card-text style="margin-top:5px; text-align: center" v-if="switchCANES == '1'">Sí</v-card-text>
                                                    <v-card-text style="margin-top:5px; text-align: center" v-else>No</v-card-text>
                                                </v-col>
                                            </v-row>

                                            <!-- Si tuviera antecedentes -->
                                            <v-subheader>Antecedentes FELCV</v-subheader>
                                            <v-col cols="12" sm="12" style="padding:20px">
                                                <v-textarea v-if="switchCANES == '1'" outlined filled placeholder="Especifique los Antecedentes o Sanciones del Propietario"></v-textarea>
                                                <v-textarea v-else solo disabled label="Ninguno"></v-textarea>
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
                                            <v-btn
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
                                            <v-btn
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
                                            <v-btn
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
                                            <v-btn
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
                                            <v-btn
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
                                <v-btn
                                    color="primary"
                                    @click="e6 = 4"
                                >
                                    Continuar
                                </v-btn>
                                <v-btn @click="e6 = 2">
                                    Atrás
                                </v-btn>
                                </v-stepper-content>

                                <!-- 4. Seguro Obligatorio de Responsabilidad Civil -->
                                <v-stepper-step 
                                :complete="e6 > 4"
                                step="4">
                                Seguro Obligatorio de Responsabilidad Civil
                                </v-stepper-step>

                                <v-stepper-content step="4">
                                <v-card
                                    color="grey lighten-1"
                                    class="mb-12"
                                    height="200px"
                                ></v-card>
                                <v-btn
                                    color="primary"
                                    @click="e6 = 5"
                                >
                                    Continuar
                                </v-btn>
                                <v-btn @click="e6 = 3">
                                    Atrás
                                </v-btn>
                                </v-stepper-content>

                                <!-- 5. Datos del Can Peligroso -->
                                <v-stepper-step step="5">
                                Datos del Can Peligroso
                                </v-stepper-step>

                                <v-stepper-content step="5">
                                <v-card
                                    color="grey lighten-1"
                                    class="mb-12"
                                    height="200px"
                                ></v-card>
                                <v-btn
                                    color="primary"
                                    @click="e6 = 1"
                                >
                                    Continuar
                                </v-btn>
                                <v-btn @click="e6 = 4">
                                    Atrás
                                </v-btn>
                                </v-stepper-content>
                            </v-stepper>
                        </template>
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
        },
        data () {
            const defaultForm = Object.freeze({
            doc: 'CI',
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
            dialog: false,
            isCameraOpen: false,
            isPhotoTaken: false,
            isShotPhoto: false,
            isLoading: false,
            link: '#',
            length: 5,
            onboarding: 0,
            datetime: new Date(),
            switchCANES: false,
            switchREJAP: false,
            switchFELCC: false,
            switchFELCN: false,
            switchFELCV: false,
            dropdownOpen: false,
            displayDate: '',
            dateModel: '',
            timeModel: '',
            }
            
        },
        computed: {
        form1IsValid () {
            return (
            this.form.first &&
            this.form.last &&
            this.dateMemo &&
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
            (this.form.cel || this.form.tel || this.form.em || this.form.cel2)
            )
        },
         model: {
            get() {return this.value;},
            set(model) {} },
        
        
            currentSelection() {
            let selectedTime = this.timeModel;
            return this.formatDate(this.dateModel) + ' ' + selectedTime;
            }
        },

        methods: 
        {
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
            toggleCamera() {
                if(this.isCameraOpen) {
                    this.isCameraOpen = false;
                    this.isPhotoTaken = false;
                    this.isShotPhoto = false;
                    this.stopCameraStream();
                } else {
                    this.isCameraOpen = true;
                    this.createCameraElement();
                }
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
                        })
                        .catch(error => {
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
                if(!this.isPhotoTaken) {
                    this.isShotPhoto = true;

                    const FLASH_TIMEOUT = 50;

                    setTimeout(() => {
                    this.isShotPhoto = false;
                    }, FLASH_TIMEOUT);
                }
                
                this.isPhotoTaken = !this.isPhotoTaken;
                
                const context = this.$refs.canvas.getContext('2d');
                context.drawImage(this.$refs.camera, 0, 0, 450, 337.5);
                },
                
                downloadImage() {
                const download = document.getElementById("downloadPhoto");
                const canvas = document.getElementById("photoTaken").toDataURL("image/jpeg")
                .replace("image/jpeg", "image/octet-stream");
                download.setAttribute("href", canvas);
                },

                /* DateTimeExtension */                
                formatDate(date) {
                if (!date) return '';
            
                const [year, month, day] = date.split('-');
                return `${year}-${month}-${day}`;
                },
            
                // Confirm the datetime selection and close the popover
                confirm() {
                this.onUpdateDate();
                this.dropdownOpen = false;
                },
            
                // Format the date and trigger the input event
                onUpdateDate() {
                if (!this.dateModel || !this.timeModel) return false;
            
                let selectedTime = this.timeModel;
                this.displayDate = this.formatDate(this.dateModel) + ' ' + selectedTime;
                this.$emit('input', this.dateModel + ' ' + selectedTime);
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
            this.timeModel = currentTime;
            this.dateModel = d.toISOString().substr(0, 10);
        },

        props: 
        {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>