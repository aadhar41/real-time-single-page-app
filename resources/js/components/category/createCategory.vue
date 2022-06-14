<template>
    <v-container>
        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form.name"
                required
                label="Category Name"
                type="text"
            ></v-text-field>

            <v-btn
                class="primary white--text"
                tile
                type="submit"
                v-if="!editSlug"
            >
                <v-icon left> mdi-tag-plus </v-icon>
                Create
            </v-btn>
            <v-btn class="primary white--text" tile type="submit" v-else>
                <v-icon left> mdi-update </v-icon>
                Update
            </v-btn>
        </v-form>

        <v-card class="mx-auto ma-4">
            <v-toolbar color="blue" dark>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>

            <v-list>
                <v-list-item-group active-class="pink--text" multiple>
                    <template v-for="(category, index) in categories">
                        <v-list-item :key="category.id">
                            <v-list-item-content>
                                <v-list-item-title
                                    v-text="category.name"
                                ></v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-btn
                                    x-small
                                    fab
                                    color="orange"
                                    elevation="2"
                                    plain
                                    text
                                    @click="edit(category.slug, index)"
                                >
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>

                                <v-btn
                                    class="ml-2"
                                    x-small
                                    fab
                                    color="red"
                                    elevation="2"
                                    plain
                                    text
                                    @click="destroy(category.slug, index)"
                                >
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </v-list-item-icon>
                        </v-list-item>

                        <v-divider
                            v-if="index < categories.length - 1"
                            :key="index"
                        ></v-divider>
                    </template>
                </v-list-item-group>
            </v-list>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: null,
            },
            categories: {},
            editSlug: null,
        };
    },
    created() {
        if (!User.admin()) {
            this.$router.push("/forum");
        }
        axios
            .get("/api/category")
            .then((res) => {
                this.categories = res.data.data;
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {
        submit() {
            this.editSlug ? this.update() : this.create();
        },
        create() {
            axios
                .post("/api/category", this.form)
                .then((res) => {
                    this.categories.unshift(res.data);
                    this.form.name = null;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        update() {
            axios
                .patch(`/api/category/${this.editSlug}`, this.form)
                .then((res) => {
                    this.categories.unshift(res.data);
                    this.form.name = null;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        destroy(slug, index) {
            axios
                .delete(`/api/category/${slug}`)
                .then((res) => {
                    this.categories.splice(index, 1);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        edit(slug, index) {
            this.form.name = this.categories[index].name;
            this.editSlug = this.categories[index].slug;
            this.categories.splice(index, 1);
        },
    },
};
</script>

<style></style>
