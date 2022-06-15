<template>
    <div>
        <v-badge bordered :color="color" :icon="count" overlap>
            <v-btn
                class="white--text"
                depressed
                icon
                :color="color"
                @click="likeIt"
            >
                <v-icon>mdi-heart</v-icon>
            </v-btn>
        </v-badge>
    </div>
</template>

<script>
export default {
    props: ["content"],
    data() {
        return {
            liked: this.content.liked,
            count: this.content.like_count,
        };
    },
    computed: {
        color() {
            return this.liked ? "red" : "red lighten-4";
        },
    },
    methods: {
        likeIt() {
            if (User.loggedIn()) {
                this.liked ? this.decr() : this.incr();
                this.liked = !this.liked;
            }
        },
        incr() {
            axios
                .post(`/api/like/${this.content.id}`)
                .then((res) => {
                    this.count++;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        decr() {
            axios
                .delete(`/api/like/${this.content.id}`)
                .then((res) => {
                    this.count--;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style></style>
