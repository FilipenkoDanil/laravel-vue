<template>
    <div>
        <b-container>
            <b-row>
                <div class="col-12 col-sm-8 col-md-6 col-lg-4" v-for="product in products" :key="product.id">
                    <div class="card mt-3">
                        <img class="card-img"
                             :src="'storage/' + product.img"
                             style="max-height: 230px"
                             alt="">

                        <div class="card-body">
                            <h4 class="card-title">{{ product.title }}</h4>
                            <h6 class="card-subtitle mb-2 text-muted">{{ product.description }}</h6>


                            <div class="buy d-flex justify-content-between align-items-center">
                                <div class="price text-success"><h5 class="mt-4">{{ product.price }}₴</h5></div>
                                <button class="btn btn-danger mt-3"
                                        v-on:click="cartAdd(product)"><i
                                    class="fas fa-shopping-cart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </b-row>
        </b-container>
    </div>
</template>

<script>
import {eventEmitter} from '../../app'

export default {
    name: "Product",
    data() {
        return {
            products: {},
        }
    },
    methods: {
        loadProducts(alias) {
            axios.get(`${this.$root.baseURL}/api/products/${alias ? alias : ''}`).then(response => {
                this.products = response.data.products

                let title = alias ? response.data.products[0].category.title : ''
                eventEmitter.$emit('changeTitle', title)

            }).catch((error) => {
                console.log(error)
            })
        },
        cartAdd(pro) {
            eventEmitter.$emit('productAddToCart', pro)
            this.$bvModal.msgBoxOk(`${pro.title} - добавлено в корзину.`, {
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'success',
                headerClass: 'p-2 border-bottom-0',
                footerClass: 'p-2 border-top-0',
                centered: true
            })
        },
    },
    mounted() {
        this.loadProducts(this.$route.params.category)
    }
}
</script>

<style scoped>
.card > .card-img {
    transition: 0.2s linear;
}

.card:hover > .card-img {
    transform: scale(1.03);
}
</style>
