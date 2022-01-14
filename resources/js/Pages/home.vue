<template>
    <head>
        <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.1/mapbox-gl.css" type="text/css" />
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
    </head>
</template>
<template>
    <v-app>
        <v-card class="overflow-hidden">
        <v-app-bar
        fixed
        color="#388E3C"
        dark
        shrink-on-scroll
        prominent
        src="/storage/img/port1.png"
        fade-img-on-scroll
        height="350px"
        >
        <template v-slot:img="{ props }">
            <v-img
            v-bind="props"
            gradient="to top right, rgba(75, 129, 59, 0.7), rgba(30, 72, 25, 0.7)"
            ></v-img>
        </template>
        
        <!-- Menus Responsive -->
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

                        <jet-dropdown-link :href="route('registros.index')">
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
                                <!--Registrarse-->
                            </inertia-link>
                        </div>
                        <inertia-link v-if="canRegister" :href="route('register')" class="d-block d-md-none" style="color: white; text-decoration: none; padding-top: 10px; position: fixed; top:23px; z-index: 2; font-size: 15px">
                            <!--Registrarse-->
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
                            <!--Registrarse-->
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
                        <v-list-item @click="scrollMeTo('inicio')"  style="color: black; font-size: .875rem; font-weight: 500; letter-spacing: .0892857143em; margin-bottom: -10px; margin-top: -12px">
                            INICIO
                        </v-list-item>
                        <v-list-item @click="scrollMeTo('mision')" style="color: black; font-size: .875rem; font-weight: 500; letter-spacing: .0892857143em; margin-bottom: -10px">
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
                                    <v-btn v-bind="attrs" v-on="on" @click="scrollMeTo('mision')" style="background: none; box-shadow: none">
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
                    <v-menu
                    top
                    offset-y
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon
                        v-bind="attrs"
                        v-on="on"
                        ><v-icon>mdi-facebook</v-icon>
                        </v-btn>
                    </template>

                    <v-list style="width: 200px">
                        <v-list-item href="https://www.facebook.com/Centro-De-Adiestramiento-De-Canes-122253125093342/" target="_blank">
                            <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>La Paz
                        </v-list-item>
                        <v-list-item href="https://www.facebook.com/Centro-de-Adiestramiento-de-Canes-Detectores-de-Droga-CACDD-175096869251064/" target="_blank">
                            <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>Cochabamba
                        </v-list-item>
                        <v-list-item href="https://www.facebook.com/profile.php?id=100063683831375" target="_blank">
                            <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>Santa Cruz
                        </v-list-item>
                        <v-list-item href="https://www.facebook.com/Centro-De-Adiestramiento-De-Canes-Oruro-110439807978117" target="_blank">
                            <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>Oruro
                        </v-list-item>
                        <v-list-item href="https://www.facebook.com/Polic%C3%ADa-Centro-de-Adiestramiento-de-Canes-Sucre-105968478529499/" target="_blank">
                            <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>Sucre
                        </v-list-item>
                    </v-list>
                    </v-menu>

                    <v-menu
                    top
                    offset-y
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon
                        v-bind="attrs"
                        v-on="on"
                        ><v-icon>mdi-whatsapp</v-icon>
                        </v-btn>
                    </template>

                    <v-list style="width: 200px">
                        <v-list-item>
                            <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>LP - 67156260
                        </v-list-item>
                        <v-list-item>
                            <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>CB - 2-25493
                        </v-list-item>
                        <v-list-item>
                            <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>SC - 70669842
                        </v-list-item>
                        <v-list-item>
                            <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>OR - 67715632
                        </v-list-item>
                        <v-list-item>
                            <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>CH - 78898654
                        </v-list-item>
                        <v-list-item>
                            <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>PD - 60298654
                        </v-list-item>
                        <v-list-item>
                            <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>TJ - 60585346
                        </v-list-item>
                        <v-list-item>
                            <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>BN - 70595664
                        </v-list-item>
                    </v-list>
                    </v-menu>
                </v-row>
            </div>
        </template>

        <!-- Título Responsive -->
        <template>
            <v-row style="margin: 0; display: flex; justify-content: flex-end; padding-top:20px; margin-right: 3px">
                <div style="background: none; color: white; padding-top: 3px; display:flex; max-height: 50px !important; padding-left:110px">
                    <div>
                        <v-row>
                            <v-toolbar-title class="d-none d-lg-none d-md-none d-sm-block" style="cursor: pointer; font-size: 17px" @click="scrollMeTo('cac')">POLICÍA BOLIVIANA -&nbsp;</v-toolbar-title>
                            <v-toolbar-title class="d-none d-lg-none d-md-none d-sm-block" style="cursor: pointer; font-size: 17px" @click="scrollMeTo('cac')">CENTRO DE ADIESTRAMIENTO DE CANES</v-toolbar-title>
                        </v-row>
                        <v-row>
                            <v-toolbar-title class="d-none d-lg-block d-md-block" style="cursor: pointer" @click="scrollMeTo('cac')">POLICÍA BOLIVIANA -&nbsp;</v-toolbar-title>
                            <v-toolbar-title class="d-none d-lg-block d-md-block" style="cursor: pointer" @click="scrollMeTo('cac')">CENTRO DE ADIESTRAMIENTO DE CANES (C.A.C)</v-toolbar-title>
                        </v-row>
                    </div>
                </div>

                <div class="d-lg-none d-md-none d-sm-none" style="background: none; color: white; display:flex; max-height: 50px !important;">
                    <v-row style="display: flex; flex-direction: column; flex-wrap: nowrap">
                        <div>
                            <v-toolbar-title style="cursor: pointer; font-size: 20px" @click="scrollMeTo('cac')">POLICÍA BOLIVIANA</v-toolbar-title>
                        </div>
                        <div>
                            <v-toolbar-title style="cursor: pointer; font-size: 20px" @click="scrollMeTo('cac')">C.A.C</v-toolbar-title>
                        </div>
                    </v-row>
                </div>
            </v-row>
        </template>

        <!-- Social Ads No-Mobile -->
        <v-row style="margin: 0; display: flex; text-align: end;" class="d-none d-sm-block">
            <v-menu
            top
            offset-y
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn icon
                v-bind="attrs"
                v-on="on"
                ><v-icon>mdi-facebook</v-icon>
                </v-btn>
            </template>

            <v-list style="margin-top: 40px; width: 200px">
                <v-list-item href="https://www.facebook.com/Centro-De-Adiestramiento-De-Canes-122253125093342/" target="_blank">
                    <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>La Paz
                </v-list-item>
                <v-list-item href="https://www.facebook.com/Centro-de-Adiestramiento-de-Canes-Detectores-de-Droga-CACDD-175096869251064/" target="_blank">
                    <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>Cochabamba
                </v-list-item>
                <v-list-item href="https://www.facebook.com/profile.php?id=100063683831375" target="_blank">
                    <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>Santa Cruz
                </v-list-item>
                <v-list-item href="https://www.facebook.com/Centro-De-Adiestramiento-De-Canes-Oruro-110439807978117" target="_blank">
                    <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>Oruro
                </v-list-item>
                <v-list-item href="https://www.facebook.com/Polic%C3%ADa-Centro-de-Adiestramiento-de-Canes-Sucre-105968478529499/" target="_blank">
                    <v-icon color="primary" left x-large style="left:-40px"> mdi-rectangle </v-icon>Sucre
                </v-list-item>
            </v-list>
            </v-menu>

            <v-menu
            top
            offset-y
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn icon
                v-bind="attrs"
                v-on="on"
                ><v-icon>mdi-whatsapp</v-icon>
                </v-btn>
            </template>

            <v-list style="margin-top: 40px; width: 200px">
                <v-list-item>
                    <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>LP - 67156260
                </v-list-item>
                <v-list-item>
                    <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>CB - 2-25493
                </v-list-item>
                <v-list-item>
                    <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>SC - 70669842
                </v-list-item>
                <v-list-item>
                    <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>OR - 67715632
                </v-list-item>
                <v-list-item>
                    <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>CH - 78898654
                </v-list-item>
                <v-list-item>
                    <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>PD - 60298654
                </v-list-item>
                <v-list-item>
                    <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>TJ - 60585346
                </v-list-item>
                <v-list-item>
                    <v-icon color="green" left x-large style="left:-40px"> mdi-rectangle </v-icon>BN - 70595664
                </v-list-item>
            </v-list>
            </v-menu>
        </v-row>

        
        </v-app-bar>

            <div>
                <div ref="cac" style="padding-top: 350px"></div>
                <div ref="inicio" style="padding-bottom: 120px"></div>
                <div style="height: 250px">
                    <h1 class="d-none d-sm-block" style="text-align: center; font-size: 60px; color: #388E3C; font-weight: bold; padding: 20px">BIENVENIDO</h1>
                    <h1 class="d-block d-sm-none" style="text-align: center; font-size: 40px; color: #388E3C; font-weight: bold; padding: 20px">BIENVENIDO</h1>

                    <h1 class="d-none d-sm-block" style="text-align: center; font-size: 20px; padding-inline: 20px">Bienvenido a la Página Nacional del Centro de Adiestramiento de Canes (C.A.C) de la Policía Bolviana.</h1>
                    <h1 class="d-none d-sm-block" style="text-align: center; font-size: 20px; padding-inline: 20px">A continuación podrás encontrar información relacionada al entrenamiento y capacitación de canes en todos los departamentos de Bolivia.</h1>
                    <h1 class="d-block d-sm-none" style="text-align: center; font-size: 15px; padding-inline: 20px">Bienvenido a la Página Nacional del Centro de Adiestramiento de Canes (C.A.C) de la Policía Bolviana.</h1>
                    <h1 class="d-block d-sm-none" style="text-align: center; font-size: 15px; padding-inline: 20px">A continuación podrás encontrar información relacionada al entrenamiento y capacitación de canes en todos los departamentos de Bolivia.</h1>
                </div>
                <template>
                <div class="d-lg-none d-md-none d-sm-none"></div>
                <v-parallax class="d-none d-lg-none d-md-none d-sm-block"
                    height="400"
                    src="/storage/img/port5.png"
                ></v-parallax>
                <v-parallax class="d-none d-lg-block d-md-block"
                    height="400"
                    src="/storage/img/port6.png"
                ></v-parallax>
                </template>
                <div ref="mision" style="padding-bottom: 120px">
                </div>
                <v-row style="padding-inline: 20px">
                    <div class="d-block d-sm-none">
                        <v-col cols="12" sm="12" style="padding: 20px">
                            <h1 style="font-size: 25px; color: #388E3C; font-weight: bold">
                                Misión
                            </h1>
                            <h1 style="font-size: 15px">
                                Siendo su misión ejecutar programas de adiestramiento de canes, para incorporar en la funciones policiales y de seguridad ciudadana a los canes en diferentes especialidades, canoterapia, búsqueda y localización de explosivos, búsqueda y localización de cadáveres, búsqueda y localización de personas vivas y defensa protección, con la finalidad de ayudar, cooperar, coadyuvar la labor policial, para prevenir cualquier situación de riesgo contra la seguridad e integridad de los habitantes., a partir de esta misión concordante con la misión fundamental encomendada a la policía Boliviana por la Constitución Política del Estado Art.251 de la cual surge nuestra visión.
                            </h1>
                        </v-col>
                    </div>

                    <div class="d-none d-lg-none d-md-none d-sm-block">
                        <v-col cols="12" sm="12" style="padding: 50px">
                            <h1 style="font-size: 25px; color: #388E3C; font-weight: bold">
                                Misión
                            </h1>
                            <h1 style="font-size: 20px">
                                Siendo su misión ejecutar programas de adiestramiento de canes, para incorporar en la funciones policiales y de seguridad ciudadana a los canes en diferentes especialidades, canoterapia, búsqueda y localización de explosivos, búsqueda y localización de cadáveres, búsqueda y localización de personas vivas y defensa protección, con la finalidad de ayudar, cooperar, coadyuvar la labor policial, para prevenir cualquier situación de riesgo contra la seguridad e integridad de los habitantes., a partir de esta misión concordante con la misión fundamental encomendada a la policía Boliviana por la Constitución Política del Estado Art.251 de la cual surge nuestra visión.
                            </h1>
                        </v-col>
                    </div>
                    <div class="d-none d-lg-block d-md-block" style="width: 50%; padding: 30px">
                        <h1 style="font-size: 25px; color: #388E3C; font-weight: bold">
                            Misión
                        </h1>
                        <h1 style="font-size: 20px">
                            Siendo su misión ejecutar programas de adiestramiento de canes, para incorporar en la funciones policiales y de seguridad ciudadana a los canes en diferentes especialidades, canoterapia, búsqueda y localización de explosivos, búsqueda y localización de cadáveres, búsqueda y localización de personas vivas y defensa protección, con la finalidad de ayudar, cooperar, coadyuvar la labor policial, para prevenir cualquier situación de riesgo contra la seguridad e integridad de los habitantes., a partir de esta misión concordante con la misión fundamental encomendada a la policía Boliviana por la Constitución Política del Estado Art.251 de la cual surge nuestra visión.
                        </h1>
                    </div>

                    <v-col cols="12" sm="6">
                        <img class="d-none d-lg-block d-md-block" src="/storage/img/port3.png">
                    </v-col>
                    <div class="d-none d-lg-none d-md-none d-sm-block">
                        <v-col cols="12" sm="12">
                            <img src="/storage/img/port3.png">
                        </v-col>
                    </div>
                </v-row>
                <div ref="vision" style="padding-bottom: 120px">
                </div>
                <v-row style="padding-inline: 20px">
                    <div class="d-block d-sm-none">
                        <v-col cols="12" sm="12" style="padding: 20px">
                            <h1 style="font-size: 25px; color: #388E3C; font-weight: bold">
                                Visión
                            </h1>
                            <h1 style="font-size: 15px">
                                Es fortalecer la calidad de los servicios empleando a nuestros canes adiestrados en diferentes especialidades, mejorando las capacidades técnicas, operativas y logísticas de la unidad, lo que finalmente nos llevara a la interrelación policía - sociedad, con nuestros servicios cada vez más profesionales, fortaleciendo la confianza, credibilidad y respeto de la población hacia la Policía Boliviana.
                            </h1>
                        </v-col>
                    </div>

                    <div class="d-none d-lg-none d-md-none d-sm-block">
                        <v-col cols="12" sm="12" style="padding: 50px">
                            <h1 style="font-size: 25px; color: #388E3C; font-weight: bold">
                                Visión
                            </h1>
                            <h1 style="font-size: 20px">
                                Es fortalecer la calidad de los servicios empleando a nuestros canes adiestrados en diferentes especialidades, mejorando las capacidades técnicas, operativas y logísticas de la unidad, lo que finalmente nos llevara a la interrelación policía - sociedad, con nuestros servicios cada vez más profesionales, fortaleciendo la confianza, credibilidad y respeto de la población hacia la Policía Boliviana.
                            </h1>
                        </v-col>
                    </div>
                    <v-col cols="12" sm="6">
                        <img class="d-none d-lg-block d-md-block" src="/storage/img/port2.png">
                    </v-col>
                    <div class="d-none d-lg-none d-md-none d-sm-block">
                        <v-col cols="12" sm="12">
                            <img src="/storage/img/port2.png">
                        </v-col>
                    </div>
                    <div class="d-none d-lg-block d-md-block" style="width: 50%; padding: 30px">
                        <h1 style="font-size: 25px; color: #388E3C; font-weight: bold; text-align: right">
                            Visión
                        </h1>
                        <h1 style="font-size: 20px; text-align: right">
                            Es fortalecer la calidad de los servicios empleando a nuestros canes adiestrados en diferentes especialidades, mejorando las capacidades técnicas, operativas y logísticas de la unidad, lo que finalmente nos llevara a la interrelación policía - sociedad, con nuestros servicios cada vez más profesionales, fortaleciendo la confianza, credibilidad y respeto de la población hacia la Policía Boliviana.
                        </h1>
                    </div>
                </v-row>
                <div ref="publicaciones" style="padding-bottom: 120px">
                </div>
                <h1 class="d-none d-sm-block" style="text-align: center; font-size: 40px; color: #388E3C; font-weight: bold; padding: 20px">Publicaciones de Facebook</h1>
                <h1 class="d-block d-sm-none" style="text-align: center; font-size: 40px; color: #388E3C; font-weight: bold; padding: 20px">Publicaciones de Facebook</h1>

                <v-row>
                    <v-col cols="12" sm="4" class="text-center" style="padding: 50px">
                        <v-btn
                        rounded
                        color="indigo"
                        x-large
                        dark
                        href="https://www.facebook.com/Centro-De-Adiestramiento-De-Canes-122253125093342/" target="_blank"
                        >
                        La Paz
                        </v-btn>
                    </v-col>
                    <v-col cols="12" sm="4" class="text-center" style="padding: 50px">
                        <v-btn
                        rounded
                        color="indigo"
                        x-large
                        dark
                        href="https://www.facebook.com/Centro-de-Adiestramiento-de-Canes-Detectores-de-Droga-CACDD-175096869251064/" target="_blank"
                        >
                        Cochabamba
                        </v-btn>
                    </v-col>
                    <v-col cols="12" sm="4" class="text-center" style="padding: 50px">
                        <v-btn
                        rounded
                        color="indigo"
                        x-large
                        dark
                        href="https://www.facebook.com/profile.php?id=100063683831375" target="_blank"
                        >
                        Santa Cruz
                        </v-btn>
                    </v-col>
                    <v-col cols="12" sm="6" class="text-center" style="padding: 50px">
                        <v-btn
                        rounded
                        color="indigo"
                        x-large
                        dark
                        href="https://www.facebook.com/Centro-De-Adiestramiento-De-Canes-Oruro-110439807978117" target="_blank"
                        >
                        Oruro
                        </v-btn>
                    </v-col>
                    <v-col cols="12" sm="6" class="text-center" style="padding: 50px">
                        <v-btn
                        rounded
                        color="indigo"
                        x-large
                        dark
                        href="https://www.facebook.com/Polic%C3%ADa-Centro-de-Adiestramiento-de-Canes-Sucre-105968478529499/" target="_blank"
                        >
                        Sucre
                        </v-btn>
                    </v-col>
                </v-row>
                
                <div ref="capacitaciones" style="padding-bottom: 120px">
                </div>
                <h1 class="d-none d-sm-block" style="text-align: center; font-size: 40px; color: #388E3C; font-weight: bold; padding: 20px">Capacitaciones</h1>
                <h1 class="d-block d-sm-none" style="text-align: center; font-size: 40px; color: #388E3C; font-weight: bold; padding: 20px">Capacitaciones</h1>

                <h1 style="font-size: 25px; color: #388E3C; font-weight: bold; padding: 20px">La Paz</h1>
                <v-btn text style="padding-left: 20px; font-size: 20px">CAPACITACIONES DE CANES - LA PAZ - DICIEMBRE 2021</v-btn>

                <h1 style="font-size: 25px; color: #388E3C; font-weight: bold; padding: 20px">Cochabamba</h1>
                <v-btn text style="padding-left: 20px; font-size: 20px">REGLAMENTO PARA LA EMISIÓN DE LA AUTORIZACIÓN DE LICENCIA DE CRIANZA DE CANES - COCHABAMBA - NOVIEMBRE 2021</v-btn>

                <h1 style="font-size: 25px; color: #388E3C; font-weight: bold; padding: 20px">Santa Cruz</h1>
                <v-btn text style="padding-left: 20px; font-size: 20px">NORMA DE CAPACITADORES REGLAMENTADOS PARA LA LICENCIA CAPACITACIÓN CANINA - ENERO 2021</v-btn>

                <h1 style="font-size: 25px; color: #388E3C; font-weight: bold; padding: 20px">Oruro</h1>
                <v-btn text style="padding-left: 20px; font-size: 20px">CAPACITACIONES PARA PERROS EN OBEDIENCIA Y CANOTERAPIA - ORURO - DICIEMBRE 2021</v-btn>

                <h1 style="font-size: 25px; color: #388E3C; font-weight: bold; padding: 20px">Sucre</h1>
                <v-btn text style="padding-left: 20px; font-size: 20px">REGULARIZACIÓN PARA LA CRIANZA DE PERROS AL PÚBLICO GENERAL - SUCRE - FREBRERO 2021</v-btn>

                <h1 style="font-size: 25px; color: #388E3C; font-weight: bold; padding: 20px">Potosí</h1>
                <v-btn text style="padding-left: 20px; font-size: 20px">INSCRIPCIONES DE CURSOS DE VERANO PARA EL ENTRENAMIENTO DE CANES EN POTOSÍ DE LA POLICÍA PARA EL PÚBLICO GENERAL - POTOSÍ - MARZO 2021</v-btn>
            </div>

            <h1 style="text-align: center; font-size: 30px; color: #388E3C; font-weight: bold; padding: 20px; padding: 50px">Encuétranos en tu Departamento</h1>
            <div style="padding-inline: 200px">
                <div style="height: 500px" id="map"></div>
            </div>

            <div style="padding-top: 50px">
            <v-footer padless color="#388E3C">
                <v-col
                class="text-center"
                cols="12"
                style="color: white"
                >
                {{ new Date().getFullYear() }} — <strong style="color: white">Dirección Nacional de Tecnología y Telemática</strong>
                </v-col>
            </v-footer>
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
    import axios from 'axios'
    import mapboxgl from 'mapbox-gl'
    import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder'

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
            axios,
            mapboxgl,
            MapboxGeocoder,
        },

        data() 
        {
            return {
                showingNavigationDropdown: false,
                
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
            scrollMeTo(refName) {
                var element = this.$refs[refName];
                var top = element.offsetTop;
                window.scrollTo({top, behavior: 'smooth'})
            },
        },
        mounted() {
            mapboxgl.accessToken = 'pk.eyJ1Ijoicm9ibGVlOTkiLCJhIjoiY2t2Z25tdDZxMDZ0OTJ2cGYzNndzZHJ3NyJ9.pBGTzYuYUmbU2dbF5TW8zQ';
            const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-65.017, -16.457],
            zoom: 5
            });

            map.on('load', () => {
            // Load an image from an external URL.
            map.loadImage(
            '/storage/img/port1.png',
            (error, image) => {
            if (error) throw error;
            
            // Add the image to the map style.
            map.addImage('dog', image);
            
            // Add a data source containing one point feature.
            map.addSource('point', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': [-63.292236, -18.281518]
            }
            }
            ]
            },
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': [-66.292236, -1.281518]
            }
            }
            ]
            }
            });
            
            // Add a layer to use the image to represent the data.
            map.addLayer({
            'id': 'points',
            'type': 'symbol',
            'source': 'point', // reference the data source
            'layout': {
            'icon-image': 'dog', // reference the image
            'icon-size': 0.035
            }
            });
            }
            );
            });

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