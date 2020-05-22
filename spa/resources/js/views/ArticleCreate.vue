<template>
    <div>
        <h2 class="text-center text-3xl">Create Article</h2>
        <ArticleForm action="create" :article="article"></ArticleForm>
    </div>
</template>

<script>
    import ArticleForm from "../components/ArticleForm";

    export default {
        name: "ArticleCreate",

        data() {
            return {
                article: {
                    'attributes': {
                        'title': '',
                        'content': ''
                    }
                }
            }
        },

        components: {
            ArticleForm
        }
    }
</script>
