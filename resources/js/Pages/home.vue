<template>
    <v-app>
        <v-card class="overflow-hidden">
        <v-app-bar
        absolute
        color="#388E3C"
        dark
        shrink-on-scroll
        prominent
        src="https://www.desktopbackground.org/p/2012/03/11/356862_4k-ultra-hd-dog-wallpapers-hd-desktop-backgrounds-3840x2160_3840x2160_h.jpg"
        fade-img-on-scroll
        height="200px"
        scroll-target="#scrolling-techniques-3"
        >
        <template v-slot:img="{ props }">
            <v-img
            v-bind="props"
            gradient="to top right, rgba(75, 129, 59, 0.7), rgba(30, 72, 25, 0.7)"
            ></v-img>
        </template>

        <jet-dropdown align="left" width="48" style="padding-top: 5px; padding-right: 10px;">
            <template #trigger>
                <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                    <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                </button>

                <span v-else class="inline-flex rounded-md">
                    <button type="button"  style="color: black" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        {{ $page.props.user.name }}

                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            </template>

            <template #content>
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    Configuración del perfil
                </div>

                <jet-dropdown-link :href="route('profile.show')">
                    Perfil
                </jet-dropdown-link>

                <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                    API Tokens
                </jet-dropdown-link>

                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <form @submit.prevent="logout">
                    <jet-dropdown-link as="button" style="color: black">
                        Cerrar Sesión
                    </jet-dropdown-link>
                </form>
            </template>
        </jet-dropdown>

        <template>
            <v-row style="margin: 0; display: flex; justify-content: flex-end; padding-top:30px; padding-left:30px;">
                <div style="background: none; color: white; padding-top: 3px; display:flex; max-height: 50px !important;">
                    <v-row>
                        <div class="d-lg-none d-md-none d-sm-none">
                        <v-toolbar-title>C.A.C</v-toolbar-title>
                        </div>
                        <div class="d-none d-lg-none d-md-none d-sm-block">
                            <v-toolbar-title>CENTRO DE ADIESTRAMIENTO CANINO</v-toolbar-title>
                        </div>
                        <div class="d-none d-lg-block d-md-block">
                            <v-toolbar-title>CENTRO DE ADIESTRAMIENTO CANINO (C.A.C)</v-toolbar-title>
                        </div>
                    </v-row>
                </div>
            </v-row>
        </template>

        <v-row style="margin: 0; display: flex; justify-content: flex-end;">
            <v-btn icon>
            <v-icon>mdi-facebook</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-instagram</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-twitter</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-whatsapp</v-icon>
            </v-btn>
        </v-row>
        

        <template v-slot:extension>
            <v-tabs align-with-title>
                <v-row style="margin:0px">
                    <v-tab href="home">HOME</v-tab>
                    <v-tab href="one">ONE</v-tab>
                    <v-tab href="two">TWO</v-tab>
                </v-row>
            </v-tabs>
        </template>
        
        </v-app-bar>

        <v-sheet
        id="scrolling-techniques-3"
        class="overflow-y-auto"
        max-height="710"
        >
        <v-container style="height: 1500px;">
            <div>
            <v-spacer style="height: 350px;"></v-spacer>
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
        </v-card>
    </v-app>

</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        computed: {
    },
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
        data: () => ({
            v0: false,
            v1: false,
            v2: false,
            v3: false,
            v4: false,
            v5: false,
            v6: false,
    }),

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>