<template>
    <v-container>
        <h1>Forum</h1>
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
