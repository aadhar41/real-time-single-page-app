<template>
    <v-container>
        <v-card class="my-4 pa-4">
            <v-form @submit.prevent="login">
                <v-text-field
                    v-model="form.email"
                    label="E-mail"
                    type="email"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="form.password"
                    label="Password"
                    required
                    type="password"
                    name="input-10-1"
                    hint="At least 8 characters"
                    counter
                ></v-text-field>

                <v-btn color="primary" type="submit" class="mr-4">
                    login
                </v-btn>

                <router-link to="/signup">
                    <v-btn text> Sign Up </v-btn>
                </router-link>
            </v-form>
        </v-card>
    </v-container>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            form: {
                email: null,
                password: null,
            },
        };
    },
    created() {
        if (User.loggedIn()) {
            this.$router.push({ name: "forum" });
        }
    },
    methods: {
        login() {
            User.login(this.form);
        },
    },
};
</script>

<style></style>
