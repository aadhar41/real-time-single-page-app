<template>
    <v-card class="mx-auto ma-3">
        <v-toolbar color="blue" dark>
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>

        <v-list two-line>
            <v-list-item-group active-class="pink--text" multiple>
                <template v-for="(category, index) in categories">
                    <v-list-item :key="category.id">
                        <v-list-item-content>
                            <v-list-item-title
                                v-text="category.name"
                            ></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-divider
                        v-if="index < categories.length - 1"
                        :key="index"
                    ></v-divider>
                </template>
            </v-list-item-group>
        </v-list>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            categories: {},
        };
    },
    created() {
        axios
            .get("/api/category")
            .then((res) => {
                this.categories = res.data.data;
            })
            .catch((err) => {});
    },
};
</script>

<style></style>
