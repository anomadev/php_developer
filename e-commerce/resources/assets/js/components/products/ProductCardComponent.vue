<template lang="html">
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="card">
            <header class="bg-primary padding"></header>
            <div class="card-body padding">
                <a :href="'/products/' + product.id">
                    <div class="card-title">{{ product.title }}</div>
                </a>
                <div class="card-subtitle">{{ product.humanPrice }}</div>
                <div class="card-text">{{ product.description }}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            product: {
                type: Object
            }
        }
    }
</script>
