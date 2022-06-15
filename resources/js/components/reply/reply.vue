<template>
    <v-card class="mb-2">
        <v-card-text>
            <div class="float-right"><Like :content="data"></Like></div>
            <edit-reply v-if="editing" :reply="data"></edit-reply>

            <p class="text--primary" v-else v-html="reply"></p>

            <v-divider></v-divider>
            <p class="mt-3">{{ data.user }} @ {{ data.created_at }}</p>

            <v-divider v-if="own"></v-divider>
            <div v-if="!editing">
                <v-card-actions v-if="own">
                    <v-btn
                        outlined
                        small
                        fab
                        color="orange"
                        elevation="2"
                        plain
                        text
                        @click="edit"
                    >
                        <v-icon>mdi-pencil</v-icon>
                    </v-btn>

                    <v-btn
                        outlined
                        small
                        fab
                        color="red"
                        elevation="2"
                        plain
                        text
                        @click="destroy"
                    >
                        <v-icon>mdi-delete</v-icon>
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import editReply from "./editReply";
import Like from "../likes/like.vue";
export default {
    components: { editReply, Like },
    props: ["data", "index"],
    data() {
        return {
            editing: false,
            beforeEditReplyBody: "",
        };
    },
    computed: {
        own() {
            return User.own(this.data.user_id);
        },
        reply() {
            return md.parse(this.data.reply);
        },
    },
    created() {
        this.listen();
    },
    methods: {
        destroy() {
            EventBus.$emit("deleteReply", this.index);
        },
        edit() {
            this.editing = true;
            this.beforeEditReplyBody = this.data.reply;
        },
        listen() {
            EventBus.$on("cancelEditing", (reply) => {
                this.editing = false;
                if (reply !== this.data.reply) {
                    this.data.reply = this.beforeEditReplyBody;
                    this.beforeEditReplyBody = "";
                }
            });
        },
    },
};
</script>

<style></style>
