<template>
    <div>
        <v-md-editor v-model="body" height="400px"></v-md-editor>
        <v-btn class="mt-4" tile color="success" @click="submit">
            <v-icon left> mdi-reply </v-icon>
            Reply
        </v-btn>
    </div>
</template>

<script>
export default {
    props: ["questionSlug"],
    data() {
        return {
            form: {
                body: "",
            },
        };
    },
    methods: {
        submit() {
            axios
                .post(`/api/question/${this.questionSlug}/reply`, {
                    body: this.body,
                })
                .then((res) => {
                    this.body = "";
                    EventBus.$emit("newReply", res.data.reply);
                    window.scrollTo(0, 0);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style></style>
