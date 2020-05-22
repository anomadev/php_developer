<template>
    <div class="h-screen bg-white">
        <nav id="header" class="fixed w-full z-10 top-0 bg-white border-b border-gray-400">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-4">
                <div class="pl-4 flex items-center">
                    SPA Laravel
                </div>


                <div class="w-full flex-grow lg:flex lg:content-center lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 z-20" id="nav-content">
                    <div class="flex-1 w-full mx-auto max-w-sm content-center py-4 lg:py-0"></div>
                    <ul class="list-reset lg:flex justify-end items-center">
                        <li class="mr-3 py-2 lg:py-0">
                            <router-link to="/articles" class="inline-block py-2 px-4 text-gray-900 font-bold no-underline">Articles</router-link>
                        </li>
                        <li class="mr-3 py-2 lg:py-0">
                            <router-link to="/my_articles" class="inline-block py-2 px-4 text-gray-900 font-bold no-underline">My Articles</router-link>
                        </li>
                        <li class="mr-3 py-2 lg:py-0">
                            <router-link to="/articles/create" class="inline-block py-2 px-4 text-gray-900 font-bold no-underline">Create</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container justify-center w-full flex flex-wrap mx-auto px-2 pt-2 lg:pt-16 mt-2">
            <div class="w-full p-8 mt-6 text-gray-900">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        created() {
            window.id = this.user.id;

            axios.interceptors.request.use((config) => {
                if(config.method === 'get') {
                    if(config.url.match('/\?./')) {
                        let url = config.url.split("?");
                        let page = url[1];
                        url = url[0];

                        config.url = `${url}?api_token=${this.user.api_token}&${page}`;
                        return config;
                    }
                    config.url = config.url + "?api_token=" + this.user.api_token;
                } else {
                    config.data = {
                        ...config.data,
                        api_token: this.user.api_token
                    }
                }

                return config;
            });
        }
    }
</script>

