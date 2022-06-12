<template>
    <v-container>
        <v-card class="my-4 pa-4">
            <v-form @submit.prevent="update">
                <v-text-field
                    v-model="form.title"
                    label="Title"
                    type="text"
                    required
                ></v-text-field>

                <v-md-editor v-model="form.body" height="450px"></v-md-editor>

                <v-spacer></v-spacer>
                <v-card-actions>
                    <v-btn
                        color="teal"
                        elevation="2"
                        fab
                        outlined
                        plain
                        text
                        class="my-2"
                        small
                        type="submit"
                    >
                        <v-icon>mdi-content-save</v-icon>
                    </v-btn>
                    <v-btn
                        color="gray"
                        elevation="2"
                        fab
                        outlined
                        plain
                        text
                        class="my-2"
                        small
                        @click="cancel"
                    >
                        <v-icon>mdi-close-circle</v-icon>
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    props: ["data"],
    data() {
        return {
            form: {
                title: null,
                body: null,
            },
        };
    },
    methods: {
        cancel() {
            EventBus.$emit("cancelEditing");
        },
        update() {
            axios
                .patch(`/api/question/${this.form.slug}`, this.form)
                .then((result) => {
                    this.cancel();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    mounted() {
        this.form = this.data;
    },
};
</script>

<style></style>
