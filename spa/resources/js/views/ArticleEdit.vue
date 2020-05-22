<template>
    <div>
        <ArticleForm action="update" :article="article"></ArticleForm>
    </div>
</template>

<script>
    import ArticleForm from "../components/ArticleForm";

    export default {
        data() {
            return {
                article: {}
            }
        },

        created() {
            this.fetch();
        },

        components: {
            ArticleForm
        },

        methods: {
            fetch() {
                axios.get(`/api/articles/${this.$route.params.slug}`).then(response => {
                    this.article = response.data;
                }).catch(err => console.log(err));
            }
        }
    }
</script>
