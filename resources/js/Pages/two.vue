<template>
    <div>
        <v-card class="overflow-hidden">
        <v-app-bar
        absolute
        color="#388E3C"
        dark
        shrink-on-scroll
        prominent
        src="https://www.desktopbackground.org/p/2012/03/11/356862_4k-ultra-hd-dog-wallpapers-hd-desktop-backgrounds-3840x2160_3840x2160_h.jpg"
        fade-img-on-scroll
        scroll-target="#scrolling-techniques-3"
        >
        <template v-slot:img="{ props }">
            <v-img
            v-bind="props"
            gradient="to top right, rgba(124, 201, 100, 0.7), rgba(30, 72, 25, 0.7)"
            ></v-img>
        </template>

        <v-app-bar-nav-icon></v-app-bar-nav-icon>

        <v-app-bar-title>Centro de adiestramiento canino (C.A.C) </v-app-bar-title>

        <v-spacer></v-spacer>

        <v-btn
        v-for="(social, i) in socials"
        :key="i"
        :color="social.color"
        class="white--text"
        fab
        icon
        small
        >
        <v-icon>{{ social.icon }}</v-icon>
        </v-btn>
        <v-btn icon>
            <v-icon>mdi-facebook</v-icon>
        </v-btn>

        <v-btn icon>
            <v-icon>mdi-heart</v-icon>
        </v-btn>

        <v-btn icon>
            <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>

        <template v-slot:extension>
            <v-tabs align-with-title style="margin-left: 50px">
            <jet-nav-link class="navBar" :href="route('home')" :active="route().current('home')">
                                        home
            </jet-nav-link>
            <jet-nav-link class="navBar" :href="route('one')" :active="route().current('one')">
                                        one
            </jet-nav-link>
            <jet-nav-link class="navBar" :href="route('two')" :active="route().current('two')">
                                        two
            </jet-nav-link>
            </v-tabs>
        </template>
        </v-app-bar>

        <v-sheet
        id="scrolling-techniques-3"
        class="overflow-y-auto"
        max-height="600"
        >
        <v-container style="height: 1000px;">
            
        </v-container>
        </v-sheet>
        </v-card>
    </div>

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
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

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