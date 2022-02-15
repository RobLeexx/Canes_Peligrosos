<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title >
            <h2 style="color: white">
                Información del Perfil
            </h2>
        </template>

        <template #description style="color: white">
            <h2 style="color: white">
                Actualiza tu información de Usuario.
            </h2>
        </template>

        <template #form style="padding-bottom: 0">
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview">

                <jet-label for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="! photoPreview">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Select A New Photo
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto" v-if="user.profile_photo_path">
                    Remove Photo
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6" style="display: flex">
                <!-- Username -->
                <v-col cols="12" sm="6">
                    <jet-label for="username" value="Nombre de Usuario" />
                    <jet-input id="username" type="text" class="mt-1 block w-full" maxlength="15" v-model="form.username" autocomplete="username" style="background: #EFEDED"/>
                    <jet-input-error :message="form.errors.username" class="mt-2" />
                </v-col>
                <!-- Email -->
                <v-col cols="12" sm="6">
                    <jet-label for="email" value="Correo Electrónico" />
                    <jet-input id="email" type="email" class="mt-1 block w-full" maxlength="30" v-model="form.email" style="background: #EFEDED"/>
                    <jet-input-error :message="form.errors.email" class="mt-2" />
                </v-col>
            </div>
            <div class="col-span-6 sm:col-span-6" style="display: flex">
                <!-- Paterno -->
                <v-col cols="12" sm="6">
                    <jet-label for="paterno" value="Apellido Paterno (Deshabilitado)" />
                    <jet-input disabled id="paterno" type="text" class="mt-1 block w-full" v-model="form.paterno" autocomplete="paterno" style="background: #EFEDED"/>
                    <jet-input-error :message="form.errors.paterno" class="mt-2" />
                </v-col>
                <!-- Materno -->
                <v-col cols="12" sm="6">
                    <jet-label for="materno" value="Apellido Materno (Deshabilitado)" />
                    <jet-input disabled id="materno" type="text" class="mt-1 block w-full" v-model="form.materno" style="background: #EFEDED"/>
                    <jet-input-error :message="form.errors.materno" class="mt-2" />
                </v-col>
            </div>
            <div class="col-span-6 sm:col-span-6" style="display: flex">
                <!-- Nombres -->
                <v-col cols="12" sm="6">
                    <jet-label for="nombres" value="Nombres (Deshabilitado)" />
                    <jet-input disabled id="nombres" type="text" class="mt-1 block w-full" v-model="form.nombres" autocomplete="nombres" style="background: #EFEDED"/>
                    <jet-input-error :message="form.errors.nombres" class="mt-2" />
                </v-col>
                <!-- Número -->
                <v-col cols="12" sm="6">
                    <jet-label for="numContacto" value="Número de Contacto" />
                    <jet-input id="numContacto" type="text" maxlength="10" @keypress="soloNumeros($event)" class="mt-1 block w-full" v-model="form.numContacto" style="background: #EFEDED"/>
                    <jet-input-error :message="form.errors.numContacto" class="mt-2" />
                </v-col>
            </div>
            <div class="col-span-6 sm:col-span-6" style="display: flex">
                <!-- Departamento -->
                <v-col cols="12" sm="6">
                    <jet-label for="departamento" value="Departamento (Deshabilitado)" />
                    <select disabled name="departamento" id="departamento" class="mt-1 block w-full border-gray-300 focus:border-green-700 focus:ring focus:ring-green-800 focus:ring-opacity-50 rounded-md shadow-sm" style="background-color: #EFEDED" v-model="form.departamento">
                        <option value="La Paz">La Paz</option>
                        <option value="Cochabamba">Cochabamba</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Chuquisaca">Chuquisaca</option>
                        <option value="Oruro">Oruro</option>
                        <option value="Potosí">Potosí</option>
                        <option value="Tarija">Tarija</option>
                        <option value="Beni">Beni</option>
                        <option value="Pando">Pando</option>
                    </select>
                    <jet-input-error :message="form.errors.departamento" class="mt-2" />
                </v-col>
                <!-- Grado -->
                <v-col cols="12" sm="6">
                    <jet-label for="grado" value="Grado (Deshabilitado)" />
                    <select disabled name="grado" id="grado" class="mt-1 block w-full border-gray-300 focus:border-green-700 focus:ring focus:ring-green-800 focus:ring-opacity-50 rounded-md shadow-sm" style="background-color:#EFEDED" v-model="form.grado">
                        <option disabled value="Policial">POLICIAL</option>
                        <option value="Cabo">Cabo</option>
                        <option value="Sargento">Sargento</option>
                        <option value="Suboficial">Suboficial</option>
                        <option value="Subteniente">Subteniente</option>
                        <option value="Teniente">Teniente</option>
                        <option value="Capitán">Capitán</option>
                        <option value="Mayor">Mayor</option>
                        <option value="Teniente Coronel">Teniente Coronel</option>
                        <option value="Coronel">Coronel</option>
                        <option value="General">General</option>

                        <option disabled value="Civil">CIVIL</option>
                        <option value="Estudiante">Estudiante</option>
                        <option value="Técnico">Técnico</option>
                        <option value="Licenciado">Licenciado</option>
                        <option value="Ingeniero">Ingeniero</option>
                        <option value="Máster">Máster</option>
                        <option value="Doctor">Doctor</option>
                    </select>
                    <jet-input-error :message="form.errors.grado" class="mt-2" />
                </v-col>
            </div>
            <div class="col-span-6 sm:col-span-6" style="display: flex">
                <!-- Rol -->
                <v-col cols="12" sm="6">
                    <jet-label value="Rol (Deshabilitado)" />
                    <jet-input class="mt-1 block w-full" disabled style="background: #EFEDED" type="text" :value="form.rol" />
                </v-col>
            </div>

        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Guardado con éxito
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" style="color:white; background-color:#4a6813;">
                Guardar
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    username: this.user.username,
                    email: this.user.email,
                    paterno: this.user.paterno,
                    materno: this.user.materno,
                    nombres: this.user.nombres,
                    numContacto: this.user.numContacto,
                    departamento: this.user.departamento,
                    director: this.user.director,
                    grado: this.user.grado,
                    rol: this.user.rol,
                    photo: null,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => (this.photoPreview = null),
                });
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
        },
    }
</script>
