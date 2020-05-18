<template>
    <section>
        <material-transition-group tag="div">
            <article :key="product.id" :data-index="index" v-for="(product, index) in products">
                <div class="row">
                    <div class="col-10">
                        <strong>{{ product.title }}</strong>
                    </div>
                    <div class="col-2">
                        <strong>{{ product.humanPrice }}</strong>
                    </div>
                </div>
            </article>

        </material-transition-group>

        <article class="total card-product">
            <div class="row">
                <div class="col-10">
                    <strong>Total</strong>
                </div>
                <div class="col-2">
                    {{ total }}
                </div>
            </div>
        </article>
    </section>
</template>

<script>
    import MaterialCollectionComponent from "../animations/MaterialCollectionComponent";
    export default {
        components: {MaterialCollectionComponent},
        data() {
            return {
                endpoint: '/cart/products',
                products: []
            }
        },

        created() {
            this.fetchProducts()
        },

        computed: {
            total() {
                let cents = this.products.reduce((acumulator, currentObj) => {
                    return acumulator + currentObj.numberPrice
                }, 0)

                return `$${cents/100}.00`;
            }
        },

        methods: {
            fetchProducts() {
                axios.get(this.endpoint).then(response => {
                    this.products = response.data.data
                    console.log(response.data.data)
                })
            }
        }
    }
</script>
