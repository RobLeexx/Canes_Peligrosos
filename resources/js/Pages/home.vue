<template>
    <div>
        <template>
            <head>
                <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.1/mapbox-gl.css" type="text/css" />
                <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
                <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
            </head>
        </template>

        <v-app>
            <v-card class="overflow-hidden">
                <!-- Portada y Menú -->
                <v-app-bar
                fixed
                color="#4a6813"
                dark
                shrink-on-scroll
                prominent
                src="/storage/img/porttt.png"
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
                                    <v-toolbar-title class="d-none d-lg-none d-md-none d-sm-block" style="cursor: pointer; font-size: 17px" @click="scrollMeTo('cac')">POLICÍA BOLIVIANA</v-toolbar-title>
                                </v-row>
                                <v-row>
                                    <v-toolbar-title class="d-none d-lg-block d-md-block" style="cursor: pointer" @click="scrollMeTo('cac')">POLICÍA BOLIVIANA</v-toolbar-title>
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

                <body>
                    <!-- Contenido -->
                    <div id="Contenido">
                        <div id="INICIO">
                            <div ref="cac" style="padding-top: 350px"></div>
                            <div ref="inicio" style="padding-bottom: 120px"></div>
                            <div style="height: 250px">
                                <h1 class="d-none d-sm-block" style="text-align: center; font-size: 60px; color: #4a6813; font-weight: bold; padding: 20px">BIENVENIDO</h1>
                                <h1 class="d-block d-sm-none" style="text-align: center; font-size: 40px; color: #4a6813; font-weight: bold; padding: 20px">BIENVENIDO</h1>

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
                        </div>


                        <div id="INSTITUCION">
                            <div ref="mision" style="padding-bottom: 120px"></div>
                            <v-row style="padding-inline: 20px">
                                <div class="d-block d-sm-none">
                                    <v-col cols="12" sm="12" style="padding: 20px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold">
                                            Misión
                                        </h1>
                                        <p style="font-size: 15px; text-align: justify">
                                            Ejecutar programas de adiestramiento de canes, para incorporar en las funciones policiales y de seguridad ciudadana a los canes en diferentes especialidades, canoterapia, búsqueda y localización de explosivos, búsqueda y localización de cadáveres, búsqueda y localización de personas vivas, defensa y protección, con la finalidad de ayudar, cooperar, coadyuvar la labor policial, para prevenir cualquier situación de riesgo contra la seguridad e integridad de los habitantes, a partir de esta misión concordante con la misión fundamental encomendada a la Policía Boliviana por la Constitución Política del Estado Art.251 de la cual surge nuestra visión.
                                        </p>
                                    </v-col>
                                </div>

                                <div class="d-none d-lg-none d-md-none d-sm-block">
                                    <v-col cols="12" sm="12" style="padding: 50px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold">
                                            Misión
                                        </h1>
                                        <h1 style="font-size: 20px; text-align: justify">
                                            Ejecutar programas de adiestramiento de canes, para incorporar en las funciones policiales y de seguridad ciudadana a los canes en diferentes especialidades, canoterapia, búsqueda y localización de explosivos, búsqueda y localización de cadáveres, búsqueda y localización de personas vivas, defensa y protección, con la finalidad de ayudar, cooperar, coadyuvar la labor policial, para prevenir cualquier situación de riesgo contra la seguridad e integridad de los habitantes, a partir de esta misión concordante con la misión fundamental encomendada a la Policía Boliviana por la Constitución Política del Estado Art.251 de la cual surge nuestra visión.
                                        </h1>
                                    </v-col>
                                </div>
                                <div class="d-none d-lg-block d-md-block" style="width: 50%; padding: 30px">
                                    <h1 style="font-size: 25px; color: #4a6813; font-weight: bold">
                                        Misión
                                    </h1>
                                    <h1 style="font-size: 20px; text-align: justify">
                                        Ejecutar programas de adiestramiento de canes, para incorporar en las funciones policiales y de seguridad ciudadana a los canes en diferentes especialidades, canoterapia, búsqueda y localización de explosivos, búsqueda y localización de cadáveres, búsqueda y localización de personas vivas, defensa y protección, con la finalidad de ayudar, cooperar, coadyuvar la labor policial, para prevenir cualquier situación de riesgo contra la seguridad e integridad de los habitantes, a partir de esta misión concordante con la misión fundamental encomendada a la Policía Boliviana por la Constitución Política del Estado Art.251 de la cual surge nuestra visión.
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
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold">
                                            Visión
                                        </h1>
                                        <h1 style="font-size: 15px; text-align: justify">
                                            Fortalecer la calidad de los servicios empleando a nuestros canes adiestrados en diferentes especialidades, mejorando las capacidades técnicas, operativas y logísticas de la unidad, lo que finalmente nos llevará a la interrelación policía - sociedad, con nuestros servicios cada vez más profesionales, fortaleciendo la confianza, credibilidad y respeto de la población hacia la Policía Boliviana.
                                        </h1>
                                    </v-col>
                                </div>

                                <div class="d-none d-lg-none d-md-none d-sm-block">
                                    <v-col cols="12" sm="12" style="padding: 50px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold">
                                            Visión
                                        </h1>
                                        <h1 style="font-size: 20px; text-align: justify">
                                            Fortalecer la calidad de los servicios empleando a nuestros canes adiestrados en diferentes especialidades, mejorando las capacidades técnicas, operativas y logísticas de la unidad, lo que finalmente nos llevará a la interrelación policía - sociedad, con nuestros servicios cada vez más profesionales, fortaleciendo la confianza, credibilidad y respeto de la población hacia la Policía Boliviana.
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
                                    <h1 style="font-size: 25px; color: #4a6813; font-weight: bold; text-align: right">
                                        Visión
                                    </h1>
                                    <h1 style="font-size: 20px; text-align: justify">
                                        Fortalecer la calidad de los servicios empleando a nuestros canes adiestrados en diferentes especialidades, mejorando las capacidades técnicas, operativas y logísticas de la unidad, lo que finalmente nos llevará a la interrelación policía - sociedad, con nuestros servicios cada vez más profesionales, fortaleciendo la confianza, credibilidad y respeto de la población hacia la Policía Boliviana.
                                    </h1>
                                </div>
                            </v-row>
                        </div>

                        <div id="PUBLICACIONES">
                            <div ref="publicaciones" style="padding-top: 120px">
                            <h1 class="d-none d-sm-block" style="text-align: center; font-size: 40px; color: #4a6813; font-weight: bold; padding: 20px">Publicaciones de Facebook</h1>
                            <h1 class="d-block d-sm-none" style="text-align: center; font-size: 40px; color: #4a6813; font-weight: bold; padding: 20px">Publicaciones de Facebook</h1>

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
                        </div>

                        </div>

                        <div ref="capacitaciones" id="ARTICULOS" style="padding-top: 120px">
                            <div id="TITULO">
                                <h1 class="d-none d-sm-block" style="text-align: center; font-size: 40px; color: #4a6813; font-weight: bold; padding: 20px">Capacitaciones</h1>
                                <h1 class="d-block d-sm-none" style="text-align: center; font-size: 40px; color: #4a6813; font-weight: bold; padding: 20px">Capacitaciones</h1>
                            </div>

                            <div id="DEPARTAMENTOS">
                                <div id="LAPAZ" style="padding-bottom: 15px">
                                    <v-row style="margin-left: 20px; margin-bottom: 10px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold; padding-right: 10px">La Paz</h1>
                                        <!-- Cambiar PDF La Paz -->
                                        <v-dialog v-if="$page.props.auth.user"
                                        v-model="LP"
                                        max-width="70%">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn small v-if="(($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Secretaría') && ($page.props.user.departamento == 'La Paz'))" fab color="primary" v-bind="attrs" v-on="on"
                                            ><v-icon>mdi-pencil</v-icon></v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                            <span class="text-h5">Cambiar Artículo en La Paz</span>
                                            </v-card-title>
                                            <v-container>
                                                <v-form>
                                                    <template>
                                                        <v-text-field v-model="form.artLP" outlined label="Nombre del Artículo"></v-text-field>

                                                        <v-file-input v-if="articulos.fileLP" v-model="form.fileLP" :label="articulos.fileLP" outlined></v-file-input>
                                                        <v-file-input v-else v-model="form.fileLP" outlined></v-file-input>
                                                    </template>
                                                    <v-btn
                                                        color="primary"
                                                        @click="submitData"
                                                        @click.prevent="LP = false">
                                                        Guardar
                                                    </v-btn>
                                                    <v-btn @click.prevent="LP = false" text>
                                                        Cancelar
                                                    </v-btn>
                                                </v-form>
                                            </v-container>
                                        </v-card>
                                        </v-dialog>
                                    </v-row>
                                    <v-btn v-if="articulos.fileLP" text style="padding-left: 20px; font-size: 20px" :href="route('downloadART', articulos.fileLP)">{{ articulos.artLP }}</v-btn>
                                </div>

                                <div id="COCHA" style="padding-bottom: 15px">
                                    <v-row style="margin-left: 20px; margin-bottom: 10px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold; padding-right: 10px">Cochabamba</h1>
                                        <!-- Cambiar PDF Cochabamba -->
                                        <v-dialog v-if="$page.props.auth.user"
                                        v-model="CB"
                                        max-width="70%">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn small v-if="(($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Secretaría') && ($page.props.user.departamento == 'Cochabamba'))" fab color="primary" v-bind="attrs" v-on="on"
                                            ><v-icon>mdi-pencil</v-icon></v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                            <span class="text-h5">Cambiar Artículo en Cochabamba</span>
                                            </v-card-title>
                                            <v-container>
                                                <v-form>
                                                    <template>
                                                        <v-text-field v-model="form.artCB" outlined label="Nombre del Artículo"></v-text-field>
                                                        <v-file-input v-model="form.fileCB" :label="articulos.fileCB" outlined></v-file-input>
                                                    </template>
                                                    <v-btn
                                                        color="primary"
                                                        @click="submitData"
                                                        @click.prevent="CB = false">
                                                        Guardar
                                                    </v-btn>
                                                    <v-btn @click.prevent="CB = false" text>
                                                        Cancelar
                                                    </v-btn>
                                                </v-form>
                                            </v-container>
                                        </v-card>
                                        </v-dialog>
                                    </v-row>
                                    <v-btn v-if="articulos.fileCB" text style="padding-left: 20px; font-size: 20px" :href="route('downloadART', articulos.fileCB)">{{ articulos.artCB }}</v-btn>
                                </div>

                                <div id="SANTACRUZ" style="padding-bottom: 15px">
                                    <v-row style="margin-left: 20px; margin-bottom: 10px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold; padding-right: 10px">Santa Cruz</h1>
                                        <!-- Cambiar PDF Santa Cruz -->
                                        <v-dialog v-if="$page.props.auth.user"
                                        v-model="SC"
                                        max-width="70%">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn small v-if="(($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Secretaría') && ($page.props.user.departamento == 'Santa Cruz'))" fab color="primary" v-bind="attrs" v-on="on"
                                            ><v-icon>mdi-pencil</v-icon></v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                            <span class="text-h5">Cambiar Artículo en Santa Cruz</span>
                                            </v-card-title>
                                            <v-container>
                                                <v-form>
                                                    <template>
                                                        <v-text-field v-model="form.artSC" outlined label="Nombre del Artículo"></v-text-field>
                                                        <v-file-input v-model="form.fileSC" :label="articulos.fileSC" outlined></v-file-input>
                                                    </template>
                                                    <v-btn
                                                        color="primary"
                                                        @click="submitData"
                                                        @click.prevent="SC = false">
                                                        Guardar
                                                    </v-btn>
                                                    <v-btn @click.prevent="SC = false" text>
                                                        Cancelar
                                                    </v-btn>
                                                </v-form>
                                            </v-container>
                                        </v-card>
                                        </v-dialog>
                                    </v-row>
                                    <v-btn v-if="articulos.fileSC" text style="padding-left: 20px; font-size: 20px" :href="route('downloadART', articulos.fileSC)">{{ articulos.artSC }}</v-btn>
                                </div>

                                <div id="ORURO" style="padding-bottom: 15px">
                                    <v-row style="margin-left: 20px; margin-bottom: 10px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold; padding-right: 10px">Oruro</h1>
                                        <!-- Cambiar PDF Oruro -->
                                        <v-dialog v-if="$page.props.auth.user"
                                        v-model="OR"
                                        max-width="70%">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn small v-if="(($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Secretaría') && ($page.props.user.departamento == 'Oruro'))" fab color="primary" v-bind="attrs" v-on="on"
                                            ><v-icon>mdi-pencil</v-icon></v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                            <span class="text-h5">Cambiar Artículo en Oruro</span>
                                            </v-card-title>
                                            <v-container>
                                                <v-form>
                                                    <template>
                                                        <v-text-field v-model="form.artOR" outlined label="Nombre del Artículo"></v-text-field>
                                                        <v-file-input v-model="form.fileOR" :label="articulos.fileOR" outlined></v-file-input>
                                                    </template>
                                                    <v-btn
                                                        color="primary"
                                                        @click="submitData"
                                                        @click.prevent="OR = false">
                                                        Guardar
                                                    </v-btn>
                                                    <v-btn @click.prevent="OR = false" text>
                                                        Cancelar
                                                    </v-btn>
                                                </v-form>
                                            </v-container>
                                        </v-card>
                                        </v-dialog>
                                    </v-row>
                                    <v-btn v-if="articulos.fileOR" text style="padding-left: 20px; font-size: 20px" :href="route('downloadART', articulos.fileOR)">{{ articulos.artOR }}</v-btn>
                                </div>

                                <div id="SUCRE" style="padding-bottom: 15px">
                                    <v-row style="margin-left: 20px; margin-bottom: 10px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold; padding-right: 10px">Sucre</h1>
                                        <!-- Cambiar PDF Sucre -->
                                        <v-dialog v-if="$page.props.auth.user"
                                        v-model="SU"
                                        max-width="70%">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn small v-if="(($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Secretaría') && ($page.props.user.departamento == 'Chuquisaca'))" fab color="primary" v-bind="attrs" v-on="on"
                                            ><v-icon>mdi-pencil</v-icon></v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                            <span class="text-h5">Cambiar Artículo en Sucre</span>
                                            </v-card-title>
                                            <v-container>
                                                <v-form>
                                                    <template>
                                                        <v-text-field v-model="form.artSU" outlined label="Nombre del Artículo"></v-text-field>
                                                        <v-file-input v-model="form.fileSU" :label="articulos.fileSU" outlined></v-file-input>
                                                    </template>
                                                    <v-btn
                                                        color="primary"
                                                        @click="submitData"
                                                        @click.prevent="SU = false">
                                                        Guardar
                                                    </v-btn>
                                                    <v-btn @click.prevent="SU = false" text>
                                                        Cancelar
                                                    </v-btn>
                                                </v-form>
                                            </v-container>
                                        </v-card>
                                        </v-dialog>
                                    </v-row>
                                    <v-btn v-if="articulos.fileSU" text style="padding-left: 20px; font-size: 20px" :href="route('downloadART', articulos.fileSU)">{{ articulos.artSU }}</v-btn>
                                </div>

                                <div id="POTOSÍ" style="padding-bottom: 15px">
                                    <v-row style="margin-left: 20px; margin-bottom: 10px">
                                        <h1 style="font-size: 25px; color: #4a6813; font-weight: bold; padding-right: 10px">Potosí</h1>
                                        <!-- Cambiar PDF Potosí -->
                                        <v-dialog v-if="$page.props.auth.user"
                                        v-model="PT"
                                        max-width="70%">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn small v-if="(($page.props.user.rol == 'Administrador') || ($page.props.user.rol == 'Secretaría') && ($page.props.user.departamento == 'Potosí'))" fab color="primary" v-bind="attrs" v-on="on"
                                            ><v-icon>mdi-pencil</v-icon></v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                            <span class="text-h5">Cambiar Artículo en Potosí</span>
                                            </v-card-title>
                                            <v-container>
                                                <v-form>
                                                    <template>
                                                        <v-text-field v-model="form.artPT" outlined label="Nombre del Artículo"></v-text-field>
                                                        <v-file-input v-model="form.filePT" :label="articulos.filePT" outlined></v-file-input>
                                                    </template>
                                                    <v-btn
                                                        color="primary"
                                                        @click="submitData"
                                                        @click.prevent="PT = false">
                                                        Guardar
                                                    </v-btn>
                                                    <v-btn @click.prevent="PT = false" text>
                                                        Cancelar
                                                    </v-btn>
                                                </v-form>
                                            </v-container>
                                        </v-card>
                                        </v-dialog>
                                    </v-row>
                                    <v-btn v-if="articulos.filePT" text style="padding-left: 20px; font-size: 20px" :href="route('downloadART', articulos.filePT)">{{ articulos.artPT }}</v-btn>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Mapa -->
                    <div id="Mapa">
                        <h1 style="text-align: center; font-size: 30px; color: #4a6813; font-weight: bold; padding: 20px; padding: 50px">Encuétranos en tu Departamento</h1>
                        <div style="padding-inline: 10%">
                            <div style="height: 500px" id="map"></div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div id="Footer" style="padding-top: 50px">
                    <v-footer padless color="#4a6813">
                        <v-col
                        class="text-center"
                        cols="12"
                        style="color: white"
                        >
                        {{ new Date().getFullYear() }} — <strong style="color: white">Dirección Nacional de Tecnología y Telemática</strong>
                        </v-col>
                    </v-footer>
                    </div>
                </body>
            </v-card>
        </v-app>

    </div>
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
        props:
        {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
            articulos: Object,
        },

        data()
        {
            return {
                showingNavigationDropdown: false,
                LP: false,
                CB: false,
                SC: false,
                OR: false,
                SU: false,
                PT: false,
                form: {
                    /* La Paz */
                    artLP: this.articulos.artLP,
                    fileLP: null,
                    /* Cochabamba */
                    artCB: this.articulos.artCB,
                    fileCB: null,
                    /* Santa Cruz */
                    artSC: this.articulos.artSC,
                    fileSC: null,
                    /* Oruro */
                    artOR: this.articulos.artOR,
                    fileOR: null,
                    /* Sucre */
                    artSU: this.articulos.artSU,
                    fileSU: null,
                    /* Potosí */
                    artPT: this.articulos.artPT,
                    filePT: null,
                },
                }
        },
        created(){
        },
        methods:
        {
            submitData() {
                /* subir datos */
                this.$inertia.post(route('home.store', this.form), this.form);
                window.location.reload();
            },
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
            '/storage/img/canes.jpg',
            (error, image) => {
            if (error) throw error;

            map.addImage('dog', image);

            map.addSource('point', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': [-65.292236, -16.281518]
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
            'coordinates': [-67.292236, -16.281518]
            }
            }
            ]
            }
            });
            map.addLayer({
            'id': 'points',
            'type': 'symbol',
            'source': 'point', // reference the data source
            'layout': {
            'icon-image': 'dog2', // reference the image
            'icon-size': 0.075
            }
            });
            }
            );
            });


            map.on('load', () => {
            // Load an image from an external URL.
            map.loadImage(
            '/storage/img/canes.jpg',
            (error, image) => {
            if (error) throw error;

            map.addImage('dog2', image);

            map.addSource('point2', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': [-65.292236, -16.281518]
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
            'coordinates': [-60.292236, -18.281518]
            }
            }
            ]
            }
            });
            map.addLayer({
            'id': 'points2',
            'type': 'symbol',
            'source': 'point2', // reference the data source
            'layout': {
            'icon-image': 'dog2', // reference the image
            'icon-size': 0.075
            }
            });
            }
            );
            });


            map.on('load', () => {
            // Load an image from an external URL.
            map.loadImage(
            '/storage/img/canes.jpg',
            (error, image) => {
            if (error) throw error;

            map.addImage('dog3', image);

            map.addSource('point3', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': [-65.292236, -16.281518]
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
            'coordinates': [-64.292236, -19.281518]
            }
            }
            ]
            }
            });
            map.addLayer({
            'id': 'points3',
            'type': 'symbol',
            'source': 'point3', // reference the data source
            'layout': {
            'icon-image': 'dog3', // reference the image
            'icon-size': 0.075
            }
            });
            }
            );
            });


            map.on('load', () => {
            // Load an image from an external URL.
            map.loadImage(
            '/storage/img/canes.jpg',
            (error, image) => {
            if (error) throw error;

            map.addImage('dog4', image);

            map.addSource('point4', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': [-65.292236, -16.281518]
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
            'coordinates': [-65.292236, -14.281518]
            }
            }
            ]
            }
            });
            map.addLayer({
            'id': 'points4',
            'type': 'symbol',
            'source': 'point4', // reference the data source
            'layout': {
            'icon-image': 'dog4', // reference the image
            'icon-size': 0.075
            }
            });
            }
            );
            });


            map.on('load', () => {
            // Load an image from an external URL.
            map.loadImage(
            '/storage/img/canes.jpg',
            (error, image) => {
            if (error) throw error;

            map.addImage('dog5', image);

            map.addSource('point5', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': [-65.292236, -16.281518]
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
            'coordinates': [-65.592236, -17.281518]
            }
            }
            ]
            }
            });
            map.addLayer({
            'id': 'points5',
            'type': 'symbol',
            'source': 'point5', // reference the data source
            'layout': {
            'icon-image': 'dog5', // reference the image
            'icon-size': 0.075
            }
            });
            }
            );
            });


            map.on('load', () => {
            // Load an image from an external URL.
            map.loadImage(
            '/storage/img/canes.jpg',
            (error, image) => {
            if (error) throw error;

            map.addImage('dog6', image);

            map.addSource('point6', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': [
            {
            'type': 'Feature',
            'geometry': {
            'type': 'Point',
            'coordinates': [-65.892236, -19.281518]
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
            'coordinates': [-66.892236, -20.281518]
            }
            }
            ]
            }
            });
            map.addLayer({
            'id': 'points6',
            'type': 'symbol',
            'source': 'point6', // reference the data source
            'layout': {
            'icon-image': 'dog6', // reference the image
            'icon-size': 0.075
            }
            });
            }
            );
            });

        },

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
    }
</script>
