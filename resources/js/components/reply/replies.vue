<template>
    <div>
        <reply
            v-for="(reply, index) in content"
            v-if="content"
            :key="reply.id"
            :index="index"
            :data="reply"
        ></reply>
    </div>
</template>

<script>
import axios from "axios";
import Reply from "./reply";
export default {
    props: ["question"],
    data() {
        return {
            content: this.question.replies,
        };
    },
    components: { Reply },
    created() {
        this.listen();
    },
    methods: {
        listen() {
            EventBus.$on("newReply", (reply) => {
                this.content.unshift(reply);
            });
            EventBus.$on("deleteReply", (index) => {
                axios
                    .delete(
                        `/api/question/${this.question.slug}/reply/${this.content[index].id}`
                    )
                    .then((res) => {
                        this.content.splice(index, 1);
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            });
        },
    },
};
</script>

<style></style>
