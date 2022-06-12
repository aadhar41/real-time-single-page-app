<template>
    <div v-if="question">
        <edit-question v-if="editing" :data="question"></edit-question>
        <show-question :data="question" v-else> </show-question>
    </div>
</template>

<script>
import EditQuestion from "./editQuestion";
import ShowQuestion from "./ShowQuestion";
export default {
    components: { ShowQuestion, EditQuestion },
    data() {
        return {
            question: null,
            editing: false,
        };
    },
    created() {
        this.listen();
        this.getQuestions();
    },
    methods: {
        listen() {
            EventBus.$on("startEditing", () => {
                this.editing = true;
            });
            EventBus.$on("cancelEditing", () => {
                this.editing = false;
            });
        },
        getQuestions() {
            axios
                .get(`/api/question/${this.$route.params.slug}`)
                .then((res) => {
                    this.question = res.data.data;
                })
                .catch((err) => console.log(err));
        },
    },
};
</script>

<style></style>
