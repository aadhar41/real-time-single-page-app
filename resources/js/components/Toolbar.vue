<template>
    <div>
        <v-toolbar dense>
            <v-app-bar-nav-icon></v-app-bar-nav-icon>

            <v-toolbar-title>SPA</v-toolbar-title>

            <v-spacer></v-spacer>

            <router-link to="/forum">
                <v-btn text> Forum </v-btn>
            </router-link>

            <v-btn text> Ask Question </v-btn>
            <v-btn text> Categories </v-btn>
            <router-link to="/login">
                <v-btn text> Login </v-btn>
            </router-link>

            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-heart</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
        </v-toolbar>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
