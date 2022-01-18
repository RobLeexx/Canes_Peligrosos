<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Capacitaciones
            </h2>
        </template>

        <v-app>
        <div class="py-12" style="background: #33691E">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="padding-left: 10px; position: absolute; top: 10px">
                    <v-btn 
                        fab
                        color="primary"
                        :href="route('registros.create')"
                        ><v-icon>mdi-plus</v-icon>
                    </v-btn>
                </div>
                <v-card style="box-shadow: 0px 0px 30px; border-radius: 10px; position: initial">
                    <v-card-title style="padding: 0; padding-inline: 20px">
                        Prueba
                    </v-card-title>
                </v-card>
            </div>
        </div>
        </v-app>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
    }
</script>