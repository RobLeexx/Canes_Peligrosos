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
                                    color="grey lighten-1"
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
                                                :rules="rules.name"
                                                label="Comandante Departamental"
                                                placeholder="Rango y nombre del Comandante Departamental"
                                                required
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="6"
                                            >
                                                <v-text-field
                                                v-model="form.last"
                                                :rules="rules.name"
                                                label="Referencia"
                                                placeholder="Referencia adjuntada en el memorial"
                                                required
                                                outlined
                                                ></v-text-field>
                                            </v-col>
                                            <!-- --<v-col cols="12">
                                                <v-textarea
                                                v-model="form.bio"
                                                color="teal"
                                                >
                                                <template v-slot:label>
                                                    <div>
                                                    Bio <small>(optional)</small>
                                                    </div>
                                                </template>
                                                </v-textarea>
                                            </v-col>
                                             -->
                                             <v-col cols="12" sm="6">
                                                <template>
                                                    <div>
                                                        <div style="display: none" class="mb-6">Active picker: <code>{{ activePicker || 'null' }}</code></div>
                                                        <v-menu
                                                        ref="menu"
                                                        v-model="menu"
                                                        :close-on-content-click="false"
                                                        transition="scale-transition"
                                                        offset-y
                                                        min-width="auto"
                                                        >
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-text-field
                                                            v-model="date"
                                                            label="Fecha de expedición del Memorial"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            outlined
                                                            :rules="rules.dater"
                                                            required
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                            v-model="date"
                                                            :active-picker.sync="activePicker"
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
                                                    label="Memorial Adjuntado (Opcional)"
                                                    outlined
                                                    dense
                                                    show-size
                                                ></v-file-input>
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
                                    :disabled="!formIsValid"
                                    color="primary"
                                    @click="e6 = 2"
                                    type="submit"
                                    >
                                    Continuar
                                    </v-btn>
                                </v-card-actions>
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
                                    color="grey lighten-1"
                                    class="mb-12"
                                    height="200px"
                                ></v-card>
                                <v-btn
                                    color="primary"
                                    @click="e6 = 3"
                                >
                                    Continuar
                                </v-btn>
                                <v-btn @click="e6 = 1">
                                    Atrás
                                </v-btn>
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
            bio: '',
            favoriteAnimal: '',
            age: null,
            terms: false,})
        return {
            e6: 1,
            form: Object.assign({}, defaultForm),
            rules: {
            age: [
                val => val < 10 || `I don't believe you!`,
                ],
                dater: [val => (val || '').length > 3 || 'Este campo es obligatorio'],
                name: [val => (val || '').length > 0 || 'Este campo es obligatorio'],},
            conditions: false,
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.',
            terms: false,
            defaultForm,
            activePicker: null,
            date: null,
            menu: false,}
            
        },
        watch: {
            menu (val) {
                val && setTimeout(() => (this.activePicker = 'YEAR'))
            },
            },
        computed: {
        formIsValid () {
            return (
            this.form.first &&
            this.form.last &&
            this.date &&
            this.form.terms
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
            save (date) {
                this.$refs.menu.save(date)
            },
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