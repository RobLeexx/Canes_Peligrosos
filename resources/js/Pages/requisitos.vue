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
                                        <v-container fluid>
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
                                                        <v-menu
                                                        ref="menuMemo"
                                                        v-model="menuMemo"
                                                        :close-on-content-click="false"
                                                        transition="scale-transition"
                                                        offset-y
                                                        min-width="auto"
                                                        >
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-text-field
                                                            v-model="dateMemo"
                                                            prepend-icon="mdi-calendar"
                                                            label="Fecha de expedición del Memorial"
                                                            readonly
                                                            outlined
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            >
                                                            </v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                            v-model="dateMemo"
                                                            :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                            min="2014-01-01"
                                                            @change="save"
                                                        ></v-date-picker>
                                                        </v-menu>
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
                                                    <div @click.stop="">
                                                    El Propietario del Can Peligroso está dispuesto a cumplir con las capacitaciones respectivas, sobre la
                                                    <a
                                                        href="#"
                                                        @click.prevent="terms = true"
                                                    >normativa legal</a>
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
                                            Terms
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
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                             <v-col cols="12" sm="6">
                                                <template>
                                                    <div>
                                                        <v-menu
                                                        ref="menuProp"
                                                        v-model="menuProp"
                                                        :close-on-content-click="false"
                                                        transition="scale-transition"
                                                        offset-y
                                                        min-width="auto"
                                                        >
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-text-field
                                                            v-model="dateProp"
                                                            label="Fecha de nacimiento"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            outlined
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                            v-model="dateProp"
                                                            :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                                            min="2014-01-01"
                                                            @change="save"
                                                        ></v-date-picker>
                                                        </v-menu>
                                                    </div>
                                                </template>
                                            </v-col>

                                            <v-col cols="12" sm="6">
                                                <v-overflow-btn
                                                v-model="form.doc"
                                                :items= "doc"
                                                label="Tipo de Documento"
                                                :rules="vacio"
                                                outlined
                                                >
                                                </v-overflow-btn>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                v-model="form.documento"
                                                :rules="vacio"
                                                label="Documento"
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
                                >
                                Antecedentes del Propietario
                                </v-stepper-step>

                                <v-stepper-content step="3">
                                <v-card
                                    color="grey lighten-1"
                                    class="mb-12"
                                    height="200px"
                                ></v-card>
                                <v-btn
                                    color="primary"
                                    @click="e6 = 4"
                                >
                                    Continue
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
                                    Continue
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
            first: '',
            last: '',
            paterno: '',
            materno: '',
            nombres: '',
            documento: '',
            terms: false,})
        return {
            e6: 1,
            form: Object.assign({}, defaultForm),
            vacio: [v => !!v || 'Este campo es obligatorio'],
            conditions: false,
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.',
            terms: false,
            defaultForm,
            dateMemo: null,
            dateProp: null,
            menuMemo: false,
            menuProp: false,
            doc: ['CI', 'RUT', 'Pasaporte'],
            dialog: false,
            isCameraOpen: false,
            isPhotoTaken: false,
            isShotPhoto: false,
            isLoading: false,
            link: '#'
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
            this.form.doc &&
            this.form.documento
            )
        },
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
                }

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