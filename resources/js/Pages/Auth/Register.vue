<template>
    <jet-authentication-card style="background-color:#33691E;">
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <div>
            <jet-input style="background-color:#DCEDC8;" type="password" class="mt-1 block w-full" v-model="contraseña" />
        </div>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
        <v-row>
            <v-col cols="12" sm="4">
                <div class="mt-4">
                    <jet-label for="paterno" value="Apellido Paterno" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" id="paterno" type="text" class="mt-1 block w-full" v-model="form.paterno" required autofocus autocomplete="paterno" />
                </div>

                <div class="mt-4">
                    <jet-label for="materno" value="Apellido Materno" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" :counter="10" id="materno" type="text" class="mt-1 block w-full" v-model="form.materno" required autofocus autocomplete="materno" />
                </div>

                <div class="mt-4">
                    <jet-label for="nombres" value="Nombres" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" id="nombres" type="text" class="mt-1 block w-full" v-model="form.nombres" required />
                </div>
                <div class="mt-4">
                    <jet-label for="username" value="Nombre de Usuario" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" id="username" type="text" class="mt-1 block w-full" v-model="form.username" required autofocus autocomplete="username" />
                </div>
            </v-col>
            <v-col cols="12" sm="4">
                <div class="mt-4">
                    <jet-label for="grado" value="Grado" />
                    <select :disabled="contraseña!='canes1420'" name="grado" id="grado" class="mt-1 block w-full border-gray-300 focus:border-green-700 focus:ring focus:ring-green-800 focus:ring-opacity-50 rounded-md shadow-sm" style="background-color:#DCEDC8;" v-model="form.grado">
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
                </div>

                <div class="mt-4">
                    <jet-label for="rol" value="Rol" />
                    <select :disabled="contraseña!='canes1420'" name="rol" id="rol" class="mt-1 block w-full border-gray-300 focus:border-green-700 focus:ring focus:ring-green-800 focus:ring-opacity-50 rounded-md shadow-sm" style="background-color:#DCEDC8;" v-model="form.rol">
                        <option value="Administrador">Administrador</option>
                        <option value="Secretaria">Secretaría</option>
                        <option value="Capacitador">Capacitador</option>
                        <option value="POFOMA">POFOMA</option>
                    </select>
                </div>

                <div class="mt-4">
                    <jet-label for="departamento" value="Departamento" />
                    <select :disabled="contraseña!='canes1420'" name="departamento" id="departamento" class="mt-1 block w-full border-gray-300 focus:border-green-700 focus:ring focus:ring-green-800 focus:ring-opacity-50 rounded-md shadow-sm" style="background-color:#DCEDC8;" v-model="form.departamento">
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
                </div>

                <div class="mt-4">
                    <jet-label for="director" value="Director Departamental" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" id="director" type="text" class="mt-1 block w-full" v-model="form.director" required />
                </div>
            </v-col>
            <v-col cols="12" sm="4">
                <div class="mt-4">
                    <jet-label for="numContacto" value="Número de Contacto" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" id="numContacto" type="number" class="mt-1 block w-full" v-model="form.numContacto" required />
                </div>

                <div class="mt-4">
                    <jet-label for="email" value="Correo Electrónico" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                </div>

                <div class="mt-4">
                    <jet-label for="password" value="Contraseña" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <jet-label for="password_confirmation" value="Confirmar Contraseña" />
                    <jet-input :disabled="contraseña!='canes1420'" style="background-color:#DCEDC8;" id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <jet-label for="terms">
                        <div class="flex items-center">
                            <jet-checkbox name="terms" id="terms" v-model="form.terms" />

                            <div class="ml-2">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                    </jet-label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Iniciar Sesión
                    </inertia-link>

                    <jet-button v-if="contraseña=='canes1420'"style="color:white; background-color:#33691E;" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Registrar
                    </jet-button>
                </div>
            </v-col>
        </v-row>
        </form>
        
    </jet-authentication-card>

</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCardRegister'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        data() {
            return {
                contraseña: '',
                form: this.$inertia.form({
                    username: '',
                    rol: '',
                    email: '',
                    paterno: '',
                    materno: '',
                    nombres: '',
                    numContacto: '',
                    grado: '',
                    departamento: '',
                    director: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
