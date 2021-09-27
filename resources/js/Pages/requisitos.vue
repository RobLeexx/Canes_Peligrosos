<template>
    <app-layout>
        <v-sheet
        id="scrolling-techniques-3"
        class="overflow-y-auto"
        max-height="900"
        >
        <v-container style="height: 1000px;">
            <div>
            <v-spacer style="height: 320px;"></v-spacer>
              <template>
                <h1 style="
                    display: flex;
                    justify-content: center;
                    font-size: x-large;" >
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
                    <v-row>
                        <v-col cols="12" sm="6">
                        <v-text-field
                            label="Comandante Departamental"
                            placeholder="Nombre del Comandante Departamental"
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
                    </v-row>
                    </v-container>

                    </v-banner>
                    <v-divider>inset</v-divider>

                <!-- 2. Documento de Identidad -->
                    <v-checkbox
                    v-model="v1"
                    label=" 2. Documento de Identidad"
                    ></v-checkbox>
                    <v-banner
                        v-model="v1"
                        single-line
                        transition="slide-y-transition"
                    >
                    1. Memorial
                    <template v-slot:actions="{ dismiss }">
                      <v-btn
                        text
                        color="primary"
                        @click="dismiss"
                      >
                        Cancelar
                      </v-btn>
                    </template>
                    </v-banner>
                    <v-divider>inset</v-divider>

                    <!-- 3. Antecedentes -->
                    <v-checkbox
                    v-model="v2"
                    label=" 3. Antecedentes"
                    ></v-checkbox>
                    <v-banner
                        v-model="v2"
                        single-line
                        transition="slide-y-transition"
                    >
                    1. Memorial
                    <template v-slot:actions="{ dismiss }">
                      <v-btn
                        text
                        color="primary"
                        @click="dismiss"
                      >
                        Cancelar
                      </v-btn>
                    </template>
                    </v-banner>
                    <v-divider>inset</v-divider>

                    <!-- 4. Seguro Obligatorio de Responsabilidad Civil -->
                    <v-checkbox
                    v-model="v3"
                    label=" 4. Seguro Obligatorio de Responsabilidad Civil"
                    ></v-checkbox>
                    <v-banner
                    v-model="v3"
                    single-line
                    transition="slide-y-transition"
                    >
                    1. Memorial
                    <template v-slot:actions="{ dismiss }">
                      <v-btn
                        text
                        color="primary"
                        @click="dismiss"
                      >
                        Cancelar
                      </v-btn>
                    </template>
                    </v-banner>
                    <v-divider>inset</v-divider>

                    <!-- 5. Estado de Salud del Can -->
                    <v-checkbox
                    v-model="v4"
                    label=" 5. Estado de Salud del Can"
                    ></v-checkbox>
                    <v-banner
                    v-model="v4"
                    single-line
                    transition="slide-y-transition"
                    >
                    1. Memorial
                    <template v-slot:actions="{ dismiss }">
                      <v-btn
                        text
                        color="primary"
                        @click="dismiss"
                      >
                        Cancelar
                      </v-btn>
                    </template>
                    </v-banner>
                    <v-divider>inset</v-divider>

                    <!-- 6. Especifiaciones del Domicilio -->
                    <v-checkbox
                    v-model="v5"
                    label=" 6. Especifiaciones del Domicilio"
                    ></v-checkbox>
                    <v-banner
                    v-model="v5"
                    single-line
                    transition="slide-y-transition"
                    >
                    1. Memorial
                    <template v-slot:actions="{ dismiss }">
                      <v-btn
                        text
                        color="primary"
                        @click="dismiss"
                      >
                        Cancelar
                      </v-btn>
                    </template>
                    </v-banner>
                    <v-divider>inset</v-divider>

                    <!-- 7. Datos Finales -->
                    <v-checkbox
                    v-model="v6"
                    label=" 7. Datos Finales"
                    ></v-checkbox>
                    <v-banner
                    v-model="v6"
                    single-line
                    transition="slide-y-transition"
                    >
                    7. Datos Finales
                    <template v-slot:actions="{ dismiss }">
                      <v-btn
                        text
                        color="primary"
                        @click="dismiss"
                      >
                        Cancelar
                      </v-btn>
                    </template>
                    </v-banner>

                </div>
              </template>
            </div>
        </v-container>
        </v-sheet>
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
            v6: false,}),

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