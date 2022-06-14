<template>
    <div>
        <v-toolbar dense>
            <v-toolbar-title>SPA</v-toolbar-title>

            <v-spacer></v-spacer>

            <router-link
                v-for="item in items"
                :key="item.title"
                :to="item.to"
                v-if="item.show"
            >
                <v-btn color="deep-black lighten-2" text>
                    {{ item.title }}
                </v-btn>
            </router-link>
        </v-toolbar>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [
                { title: "Forum", to: "/forum", show: true },
                { title: "Ask Question", to: "/ask", show: User.loggedIn() },
                { title: "Category", to: "/category", show: User.admin() },
                { title: "Login", to: "/login", show: !User.loggedIn() },
                { title: "Logout", to: "/logout", show: User.loggedIn() },
            ],
        };
    },
    created() {
        EventBus.$on("logout", () => {
            User.logout();
        });
    },
};
</script>

<style></style>
