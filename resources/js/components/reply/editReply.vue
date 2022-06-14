<template>
    <div class="mb-4">
        <v-md-editor v-model="reply.reply" height="400px"></v-md-editor>
        <v-card-actions>
            <v-btn
                outlined
                small
                fab
                color="green"
                elevation="2"
                plain
                text
                @click="update"
            >
                <v-icon>mdi-content-save</v-icon>
            </v-btn>

            <v-btn
                outlined
                small
                fab
                color="black"
                elevation="2"
                plain
                text
                @click="cancel"
            >
                <v-icon>mdi-cancel</v-icon>
            </v-btn>
        </v-card-actions>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ["reply"],
    data() {
        return {
            form: {
                body: "",
            },
        };
    },
    methods: {
        cancel() {
            EventBus.$emit("cancelEditing");
        },
        update() {
            axios
                .patch(
                    `/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,
                    { body: this.reply.reply }
                )
                .then((res) => {
                    this.cancel();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style></style>
