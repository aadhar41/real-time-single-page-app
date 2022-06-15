<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn icon :color="color" dark v-bind="attrs" v-on="on">
                    <v-icon>mdi-bell-plus</v-icon>{{ unreadCount }}
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="(item, index) in unread" :key="index">
                    <router-link :to="item.path">
                        <v-list-item-title @click="readIt(item)">
                            {{ item.question }}
                        </v-list-item-title>
                    </router-link>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            read: {},
            unread: {},
            unreadCount: 0,
        };
    },
    created() {
        if (User.loggedIn()) {
            this.getNotifications();
        }
    },
    methods: {
        getNotifications() {
            axios
                .post(`/api/notifications`)
                .then((res) => {
                    this.read = res.data.read;
                    this.unread = res.data.unread;
                    this.unreadCount = res.data.unread.length;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        readIt(notification) {
            axios
                .post(`/api/markAsRead`, { id: notification.id })
                .then((res) => {
                    this.unread.splice(notification, 1);
                    this.read.push(notification);
                    this.unreadCount--;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    computed: {
        color() {
            return this.unreadCount > 0 ? "red" : "red lighten-4";
        },
    },
};
</script>

<style></style>
