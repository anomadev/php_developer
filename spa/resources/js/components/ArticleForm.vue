<template>
    <div class="flex justify-center mt-6">
        <form @submit.prevent="submitForm" class="w-full max-w-xl">
            <div v-if="errors.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                <ul>
                    <li v-for="error of errors">{{ error }}</li>
                </ul>
            </div>

            <div class="md:flex md:items-center mb-6">
                <input v-model="article.attributes.title" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="title" id="inline-full-name">
            </div>
            <div class="md:flex md:items-center mb-6">
                <textarea v-model="article.attributes.content" rows="10" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-username" name="content"></textarea>
            </div>
            <div class="md:flex justify-center">
                <button class="w-64 shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    {{ buttonTitle }}
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ArticleForm",

        data() {
            return {
                errors: []
            }
        },

        props: ['action', 'article'],

        methods: {
            submitForm() {
                if(this.action === 'create')
                    this.createArticle();
                else
                    this.updateArticle();

            },

            createArticle(){
                this.article.attributes.thumbnail = 'https://picsum.photos/250/200';
                axios.post('/api/articles', this.article.attributes).then(response => {
                    let slug = response.data.slug;
                    this.$router.push({ name: 'show', params: {slug} });
                }).catch(err => {
                    if(err.response.status === 422)
                        this.getErrors(err.response.data.errors);
                    console.log(err.response);
                });
            },

            updateArticle() {
                this.article.attributes.thumbnail = 'https://picsum.photos/250/200';
                axios.put(`/api/articles/${this.article.slug}`, this.article.attributes).then(response => {
                    let slug = response.data.data.slug;
                    this.$router.push({ name: 'show', params: {slug} });
                }).catch(err => {
                    if(err.response.status === 422)
                        this.getErrors(err.response.data.errors);
                    console.log(err.response);
                });
            },

            getErrors(errors) {
                this.errors = [];
                Object.values(errors).forEach(value => {
                    this.errors.push(value[0]);
                });
            }
        },

        computed: {
            buttonTitle() {
                return this.action === 'create' ? "Create" : "Update";
            }
        }

    }
</script>
