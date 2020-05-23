<template>
    <div class="container">
        <div class="row justify-content-center">
            <div id="searcher" class="col-sm-8 mb-4">
                <input v-model="query" type="text" name="q" class="form-control" placeholder="Buscar...">
            </div>

            <div v-for="article in articles" class="col-sm-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title" v-html="highlight(article.title, query)"></h5>
                        <p v-html="highlight(article.tags, query)"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                query: "",
                articles: {}
            }
        },

        watch: {
            query: function(val) {
                axios.get('/search?q=' + this.query).then(response => {
                    this.articles = [];
                    this.articles = response.data;
                }).catch(err => console.log(err));
            }
        },

        methods: {
            highlight: function(text, query) {
                return text.replace(query.trim(), '<span class="highlight">' + query + '</span>');
            }
        }
    }
</script>

<style>
    #searcher {
        margin-top: 100px;
    }

    .highlight {
        background: yellow;
    }
</style>
