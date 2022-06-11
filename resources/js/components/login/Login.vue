<template>
    <v-container>
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

            <v-btn color="primary" type="submit" class="mr-4"> Submit </v-btn>
        </v-form>
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
    methods: {
        login() {
            User.login(this.form);
        },
    },
};
</script>

<style></style>
