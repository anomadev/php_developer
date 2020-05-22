<template>
    <div class="text-center">
        <div class="font-sans container">
            <div v-if="can()" class="text-right">
                <button @click="destroy" class="bg-red-500 py-2 px-2 text-sm text-white rounded">Eliminar</button>
                <button @click="edit" class="bg-blue-500 py-2 px-2 text-sm text-white rounded">Editar</button>
            </div>

            <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">{{ attributes.title }}</h1>
            <p class="text-sm md:text-base font-normal text-gray-600">{{ attributes.created_at }}</p>
            <p class="py-6">{{ attributes.content }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ArticleShow",
        data() {
            return {
                article: {},
                attributes: {}
            }
        },

        created() {
            console.log(this.$route.params.slug);
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get(`/api/articles/${this.$route.params.slug}`).then(response => {
                    this.article = response.data;
                    this.attributes = response.data.attributes
                }).catch(err => console.log(err));
            },

            edit() {
                let slug = this.article.slug;
                this.$router.push({ name: 'edit', params: {slug} });
            },

            destroy() {
                axios.delete(`/api/articles/${this.article.slug}`).then(response => {
                    this.$router.push({ path: '/my_articles' });
                }).catch(err => console.log(err))
            },

            can() {
                return this.article.user_id === window.id;
            }
        }
    }
</script>
