<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Requisitos
            </h2>
        </template>

        <div class="py-12" style="background: #DCEDC8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <v-app style="padding: 20px">
                        <template>
                        <h1 style="
                            display: flex;
                            justify-content: center;
                            font-size: x-large;
                            padding-top: 20px" >
                            ART No.12: DOCUMENTOS A PRESENTAR POR EL PROPIETARIO DEL PERRO PELIGROSO</h1>
                        <div>
                        <v-spacer style="height: 30px;"></v-spacer>
                        <!-- 1. Memorial -->
                            <v-checkbox
                                v-model="v0"
                                label=" 1. Memorial"
                                color="green"
                            ></v-checkbox>
                            <v-banner
                                v-model="v0"
                                single-line
                                transition="slide-y-transition"
                            >
                            <v-container>
                                <v-subheader>Referencia del Memorial</v-subheader>
                                <div style="display: flex; flex-wrap: wrap;">
                                    <v-col cols="12" lg="6" md="6" sm="12">
                                    <v-text-field
                                        label="Comandante Departamental"
                                        placeholder="Nombre del Comandante Departamental"
                                        solo
                                    ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" lg="6" md="6" sm="12">
                                    <v-text-field
                                        label="Referencia"
                                        placeholder="Referencia adjuntada en el memorial"
                                        solo
                                    ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" lg="12" sm="12">
                                        <v-subheader>Fecha de expedición del Memorial</v-subheader>
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
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="date"
                                            :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                            min="2014-01-01"
                                            @change="save"
                                        ></v-date-picker>
                                        </v-menu>
                                    </v-col>
                                </div>
                            </v-container>
                            <v-divider></v-divider>
                            
                            <v-container>
                                <v-subheader>Datos del Can Peligroso en el memorial</v-subheader>
                                <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Domicilio"
                                    placeholder="Domicilio y Municipio al que pertenece"
                                    solo
                                ></v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Can"
                                    placeholder="Can"
                                    solo
                                ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Cuidadores Eventuales"
                                    placeholder="Cuidadores Eventuales"
                                    solo
                                ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Disponibilidad"
                                    placeholder="Disponibilidad"
                                    solo
                                ></v-text-field>
                                </v-col>
                            </v-container>

                            </v-banner>
                            <v-divider>inset</v-divider>

                        <!-- 2. Documento de Identidad -->
                            <v-checkbox
                            v-model="v1"
                            label=" 2. Documento de Identidad"
                            color="green"
                            ></v-checkbox>
                            <v-banner
                                v-model="v1"
                                single-line
                                transition="slide-y-transition"
                            >
                            1. Memorial
                            </v-banner>
                            <v-divider>inset</v-divider>

                            <!-- 3. Antecedentes -->
                            <v-checkbox
                            v-model="v2"
                            label=" 3. Antecedentes"
                            color="green"
                            ></v-checkbox>
                            <v-banner
                                v-model="v2"
                                single-line
                                transition="slide-y-transition"
                            >
                            1. Memorial
                            </v-banner>
                            <v-divider>inset</v-divider>

                            <!-- 4. Seguro Obligatorio de Responsabilidad Civil -->
                            <v-checkbox
                            v-model="v3"
                            label=" 4. Seguro Obligatorio de Responsabilidad Civil"
                            color="green"
                            ></v-checkbox>
                            <v-banner
                            v-model="v3"
                            single-line
                            transition="slide-y-transition"
                            >
                            1. Memorial
                            </v-banner>
                            <v-divider>inset</v-divider>

                            <!-- 5. Estado de Salud del Can -->
                            <v-checkbox
                            v-model="v4"
                            label=" 5. Estado de Salud del Can"
                            color="green"
                            ></v-checkbox>
                            <v-banner
                            v-model="v4"
                            single-line
                            transition="slide-y-transition"
                            >
                            1. Memorial
                            </v-banner>
                            <v-divider>inset</v-divider>

                            <!-- 6. Especifiaciones del Domicilio -->
                            <v-checkbox
                            v-model="v5"
                            label=" 6. Especifiaciones del Domicilio"
                            color="green"
                            ></v-checkbox>
                            <v-banner
                            v-model="v5"
                            single-line
                            transition="slide-y-transition"
                            >
                            1. Memorial
                            </v-banner>
                            <v-divider>inset</v-divider>

                            <!-- 7. Datos Finales -->
                            <v-checkbox
                            v-model="v6"
                            label=" 7. Datos Finales"
                            color="green"
                            ></v-checkbox>
                            <v-banner
                            v-model="v6"
                            single-line
                            transition="slide-y-transition"
                            >
                            7. Datos Finales
                            </v-banner>
                        </div>
                        <v-spacer style="height:50px"></v-spacer>
                        <v-btn rounded color="primary" :disabled="!(v0 & v1 & v2 & v3 & v4 & v5 & v6)">
                            Siguiente
                        </v-btn>
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
            computed: {},
        },

        data() 
        {
            return {showingNavigationDropdown: false,}
        },
        data: () => ({
            v0: false,
            v1: false,
            v2: false,
            v3: false,
            v4: false,
            v5: false,
            v6: false,
            date: null,
            menu: false,
            }),

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