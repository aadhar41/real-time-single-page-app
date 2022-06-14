<template>
    <v-container fluid>
        <v-card class="mx-auto my-4">
            <v-card-text>
                <div>Question</div>
                <p class="text-h4 text--primary">
                    {{ data.title }}

                    <v-badge color="error" class="float-right" bordered overlap>
                        <span slot="badge"> {{ data.reply_count }} </span>
                        <v-btn class="white--text" color="primary" depressed>
                            Replies
                        </v-btn>
                    </v-badge>
                </p>
                <p>{{ data.user }} @ {{ data.created_at }}</p>
                <div class="text--primary" v-html="body"></div>
            </v-card-text>
            <v-card-actions v-if="own">
                <v-btn
                    class="ma-2"
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
                    class="ma-2"
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
        </v-card>
    </v-container>
</template>

<script>
export default {
    props: ["data"],
    data() {
        return {
            own: User.own(this.data.user_id),
        };
    },
    computed: {
        body() {
            return md.parse(this.data.body);
        },
    },
    methods: {
        destroy() {
            axios
                .delete(`/api/question/${this.data.slug}`)
                .then((res) => {
                    this.$router.push("/forum");
                })
                .catch((err) => console.log(err.response.data));
        },
        edit() {
            EventBus.$emit("startEditing");
        },
    },
};
</script>

<style></style>
