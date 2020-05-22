<template>
    <div>
        <ArticleList :endpoint="'/api/my_articles'"></ArticleList>
    </div>
</template>

<script>
    import ArticleList from "../components/ArticleList";

    export default {
        name: "MyArticles",

        components: {
            ArticleList
        }
    }
</script>
