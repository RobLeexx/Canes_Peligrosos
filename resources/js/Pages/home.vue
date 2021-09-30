<template>
    <v-app>
        <v-card class="overflow-hidden">
        <v-app-bar
        fixed
        color="#388E3C"
        dark
        shrink-on-scroll
        prominent
        src="https://www.desktopbackground.org/p/2012/03/11/356862_4k-ultra-hd-dog-wallpapers-hd-desktop-backgrounds-3840x2160_3840x2160_h.jpg"
        fade-img-on-scroll
        height="200px"
        >
        <template v-slot:img="{ props }">
            <v-img
            v-bind="props"
            gradient="to top right, rgba(75, 129, 59, 0.7), rgba(30, 72, 25, 0.7)"
            ></v-img>
        </template>

        <!-- Título Responsive -->
        <template>
            <v-row style="margin: 0; display: flex; justify-content: flex-end; padding-top:20px; padding-left:30px; margin-right: 3px">
                <div style="background: none; color: white; padding-top: 3px; display:flex; max-height: 50px !important;">
                    <v-row>
                        <div class="d-lg-none d-md-none d-sm-none">
                        <v-toolbar-title style="padding-right: 80px; cursor: pointer" @click="scrollMeTo('cac')">C.A.C</v-toolbar-title>
                        </div>
                        <div class="d-none d-lg-none d-md-none d-sm-block">
                            <v-toolbar-title style="padding-left: 100px; cursor: pointer" @click="scrollMeTo('cac')">CENTRO DE ADIESTRAMIENTO DE CANES</v-toolbar-title>
                        </div>
                        <div class="d-none d-lg-block d-md-block">
                            <v-toolbar-title style="padding-left: 200px; cursor: pointer" @click="scrollMeTo('cac')">CENTRO DE ADIESTRAMIENTO DE CANES (C.A.C)</v-toolbar-title>
                        </div>
                    </v-row>
                </div>
            </v-row>
        </template>

        <!-- Social Ads No-Mobile -->
        <v-row style="margin: 0; display: flex; text-align: end;" class="d-none d-sm-block">
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
            <div>
                <div v-if="$page.props.auth.user">
                    <jet-dropdown align="left" width="48" style="padding-top: 10px; padding-right: 10px; padding-bottom: 15px; position: fixed; top:-1px; z-index: 2">
                    <template #trigger>
                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username" />
                        </button>

                        <span v-else class="inline-flex rounded-md">
                            <button type="button"  style="color: black" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{ $page.props.user.username }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Acciones
                        </div>

                        <jet-dropdown-link :href="route('lista')">
                            Administración
                        </jet-dropdown-link>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Configuración del perfil
                        </div>

                        <jet-dropdown-link :href="route('profile.show')">
                            <h2 style="color: black">
                                Perfil
                            </h2>
                        </jet-dropdown-link>

                        <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                            API Tokens
                        </jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form @submit.prevent="logout">
                            <jet-dropdown-link as="button" style="color: red">
                                Cerrar Sesión
                            </jet-dropdown-link>
                        </form>
                    </template>
                    </jet-dropdown>
                </div>

                <div v-else>
                    <div  class="d-none d-sm-block">
                        <div style="padding-top: 15px; position: fixed; top:-1px; z-index: 2; display: flex" align="left" width="48">
                            <inertia-link :href="route('login')" style="color: white; text-decoration: none; font-size: 15px; padding-right: 22px">
                                Iniciar de Sesión
                            </inertia-link>

                            <inertia-link v-if="canRegister" :href="route('register')" class="d-none d-md-block" style="color: white; text-decoration: none; font-size: 15px">
                                Registrarse
                            </inertia-link>
                        </div>
                        <inertia-link v-if="canRegister" :href="route('register')" class="d-block d-md-none" style="color: white; text-decoration: none; padding-top: 10px; position: fixed; top:23px; z-index: 2; font-size: 15px">
                            Registrarse
                        </inertia-link>
                    </div>

                    <!-- ResponsiveMenúLogIn -->
                    <jet-dropdown  class="d-block d-sm-none" align="left" width="48" style="padding-top: 10px; padding-right: 10px; padding-bottom: 15px; position: fixed; top:-1px; z-index: 2">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button type="button"  style="color: black" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                LogIn
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <v-tab href="login" style="color: black; display: flex; justify-content: flex-start; padding: 10px; padding-left: 15px">
                            Iniciar Sesión
                        </v-tab>
                        <v-tab href="register" style="color: black; display: flex; justify-content: flex-start; padding: 10px; padding-left: 15px">
                            Registrarse
                        </v-tab>
                    </template>
                    </jet-dropdown>
                </div>

                <jet-dropdown class="d-block d-sm-none" align="left" width="48" style="padding-right: 10px; padding-bottom: 15px; position: fixed; top:60px; z-index: 1">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button type="button"  style="color: black" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            Menú
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <v-list style="background: white; ">
                        <v-list-item @click="scrollMeTo('inicio')" style="color: black; font-size: .875rem; font-weight: 500; letter-spacing: .0892857143em; margin-bottom: -10px; margin-top: -12px">
                            INICIO
                        </v-list-item>
                        <v-list-item @click="scrollMeTo('institucion')" style="color: black; font-size: .875rem; font-weight: 500; letter-spacing: .0892857143em; margin-bottom: -10px">
                            INSTITUCIÓN
                        </v-list-item>
                            <v-list-item @click="scrollMeTo('mision')" style="color: black; font-size: .875rem; font-weight: 500; letter-spacing: .0892857143em; margin-bottom: -10px">
                                - Misión
                            </v-list-item>
                            <v-list-item @click="scrollMeTo('vision')" style="color: black; font-size: .875rem; font-weight: 500; letter-spacing: .0892857143em; margin-bottom: -10px">
                                - Visión
                            </v-list-item>
                        <v-list-item @click="scrollMeTo('publicaciones')" style="color: black; font-size: .875rem; font-weight: 500; letter-spacing: .0892857143em; margin-bottom: -10px">
                            PUBLICACIONES
                        </v-list-item>
                        <v-list-item @click="scrollMeTo('capacitaciones')" style="color: black; font-size: .875rem; font-weight: 500; letter-spacing: .0892857143em; margin-bottom: -12px">
                            CAPACITACIONES
                        </v-list-item>
                    </v-list>
                </template>
                </jet-dropdown>
            </div>

            <!-- Menú -->
            <v-tabs align-with-title fixed-tabs slider-color="white">
                <v-col class="d-none d-sm-block">
                    <v-row style="margin:0px: height:50px">
                        <v-col cols="12" lg="2" md="2" sm="3" style="display: grid;"><v-btn style="color: white; background: none; box-shadow: none" @click="scrollMeTo('inicio')">INICIO</v-btn></v-col>
                        <v-col cols="12" lg="2" md="2" sm="3" style="display: grid;">
                            <v-menu open-on-hover bottom offset-y>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn v-bind="attrs" v-on="on" @click="scrollMeTo('institucion')" style="background: none; box-shadow: none">
                                    INSTITUCIÓN
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item @click="scrollMeTo('mision')">Misión</v-list-item>
                                    <v-list-item @click="scrollMeTo('vision')">Visión</v-list-item>
                                </v-list>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" lg="2" md="2" sm="3" style="display: grid;"><v-btn style="color:white; background: none; box-shadow: none" @click="scrollMeTo('publicaciones')">PUBLICACIONES</v-btn></v-col>
                        <v-col cols="12" lg="2" md="2" sm="3" style="display: grid;"><v-btn style="color:white; background: none; box-shadow: none" @click="scrollMeTo('capacitaciones')">CAPACITACIONES</v-btn></v-col>
                    </v-row>
                </v-col>
            </v-tabs>

            <div class="d-block d-sm-none">
                <v-row style="margin: 0; display: flex; flex-wrap:nowrap">
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
            </div>
        </template>
        
        </v-app-bar>

            <div>
                <div ref="cac"></div>
                <v-spacer style="height: 200px;"></v-spacer>
                <div ref="inicio" style="padding-bottom: 120px">
                </div>
                <h1>
                        INICIO
                </h1>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div ref="institucion" style="padding-bottom: 120px">
                </div>
                <h1>
                        INSTITUCIÓN
                    </h1>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div ref="mision" style="padding-bottom: 120px">
                </div>
                <h1>
                        Misión
                    </h1>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div ref="vision" style="padding-bottom: 120px">
                </div>
                <h1>
                        Visión
                    </h1>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div ref="publicaciones" style="padding-bottom: 120px">
                </div>
                <h1>
                        PUBLICACIONES
                    </h1>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div ref="capacitaciones" style="padding-bottom: 120px">
                </div>
                <h1>
                        CAPACITACIONES
                    </h1>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
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

    export default 
    {
        components: 
        {
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
            scrollMeTo(refName) {
                var element = this.$refs[refName];
                var top = element.offsetTop;
                window.scrollTo(0, top);
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