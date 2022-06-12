<template>
    <v-container>
        <v-card class="my-4 pa-4">
            <v-form @submit.prevent="create">
                <v-text-field
                    v-model="form.title"
                    label="Title"
                    type="text"
                    required
                ></v-text-field>

                <v-autocomplete
                    v-model="form.category_id"
                    :items="categories"
                    item-text="name"
                    item-value="id"
                    dense
                    filled
                    label="Category"
                ></v-autocomplete>

                <v-md-editor v-model="form.body" height="400px"></v-md-editor>

                <v-spacer></v-spacer>

                <v-btn color="primary" type="submit" class="mr-4 my-4">
                    Create
                </v-btn>
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
                title: null,
                category_id: null,
                body: "",
            },
            categories: {},
            errors: {},
        };
    },
    created() {
        axios
            .get("/api/category")
            .then((result) => {
                this.categories = result.data.data;
            })
            .catch((err) => console.log(err));
    },
    methods: {
        create() {
            axios
                .post("/api/question", this.form)
                .then((res) => {
                    this.$router.push(res.data.path);
                })
                .catch((err) => {
                    this.errors = err.response.data.error;
                });
        },
    },
};
</script>

<style></style>
