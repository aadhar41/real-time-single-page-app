<template>
    <v-card class="mx-auto mb-3" max-width="600">
        <v-card-title>
            <router-link :to="data.path">
                {{ data.title }}
            </router-link>
        </v-card-title>

        <v-card-subtitle class="pb-0">
            {{ data.user }} @
            {{ data.created_at }}
        </v-card-subtitle>

        <v-card-text class="text--primary">
            <div>{{ data.body }}</div>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    props: ["data"],
};
</script>

<style></style>
