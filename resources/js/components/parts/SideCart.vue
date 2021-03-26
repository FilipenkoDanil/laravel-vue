<template>
    <div>
        <b-sidebar id="sidebar-right" aria-labelledby="sidebar-right-title" no-header shadow right backdrop
                   width="380px">
            <template #default="{ hide }">
                <b-navbar toggleable="lg" type="dark" variant="danger">
                    <b-container>
                        <b-navbar-brand href="#">Корзина</b-navbar-brand>
                        <b-navbar-nav class="ml-auto">
                            <b-button variant="danger" v-b-toggle.sidebar-right>x</b-button>
                        </b-navbar-nav>
                    </b-container>
                </b-navbar>

                <div class="p-3" v-if="badge > 0">
                    <table>
                        <tr v-for="item in cart">
                            <td><img style="max-width: 100px; min-height: 100px"
                                     :src="'storage/' + item.img">
                            </td>
                            <td><b>{{ item.title }}</b><h6 style="font-size: 10px">{{ item.description }}</h6>
                            </td>
                            <td>
                                <div class="mt-3">
                                    <b-button-group size="sm">
                                        <b-button @click="cartUpdateCount(item.id, 'minus')" variant="success">-
                                        </b-button>
                                        <b-button variant="success" disabled>{{ item.count }}</b-button>
                                        <b-button @click="cartUpdateCount(item.id, 'plus')" variant="success">+
                                        </b-button>
                                    </b-button-group>
                                    <p style="color: darkred" class="text-center">{{ item.productTotal }}₴</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <hr/>
                    <div class="float-right">
                        <h4>{{ totalprice }}₴
                            <b-button pill variant="danger" :to="{ name: 'checkout' }">Оформить</b-button>
                        </h4>

                    </div>
                </div>
                <div class="p-3" v-else>
                    Нет продуктов в корзине
                </div>
            </template>
        </b-sidebar>
    </div>
</template>

<script>
import {eventEmitter} from '../../app'

export default {
    name: "SideCart",
    data() {
        return {
            cart: [],
            cartadd: {
                id: '',
                title: '',
                description: '',
                img: '',
                price: '',
                count: '',
            },
            badge: 0,
            totalprice: 0,
        }
    },
    methods: {
        cartUpdateCount(prodId, type) {
            let product = this.cart.findIndex(item => item.id === prodId);
            if (product !== -1) {
                if (type === 'plus') {
                    this.cart[product].count += 1
                    this.cart[product].productTotal = this.cart[product].count * this.cart[product].price
                } else if (this.cart[product].count <= 1) {
                    this.cart.splice(product, 1);

                } else {
                    this.cart[product].count -= 1
                    this.cart[product].productTotal = this.cart[product].count * this.cart[product].price
                }
                eventEmitter.$emit('cartUpdate', this.cart)
                this.storeCart()
            }
        },

        viewCart() {
            if (localStorage.getItem('carts')) {
                this.cart = JSON.parse(localStorage.getItem('carts'))
                this.badge = this.cart.length
                this.totalprice = this.cart.reduce((total, item) => {
                    return total + item.count * item.price;
                }, 0)
            }
        },

        removeCart(pro) {
            this.cart.splice(pro, 1)
            this.storeCart()
        },
        storeCart() {
            let parsed = JSON.stringify(this.cart)
            localStorage.setItem('carts', parsed)
            this.viewCart()
        },
    },
    mounted() {
        this.viewCart()
        eventEmitter.$emit('cartUpdate', this.cart)

        eventEmitter.$on('productAddToCart', pro => {
            let item = this.cart.findIndex(item => item.id === pro.id);
            if (item !== -1) {
                this.cart[item].count += 1
                this.cart[item].productTotal = this.cart[item].count * this.cart[item].price
            } else {
                this.cartadd.id = pro.id
                this.cartadd.title = pro.title
                this.cartadd.description = pro.description
                this.cartadd.img = pro.img
                this.cartadd.price = pro.price
                this.cartadd.count = 1
                this.cartadd.productTotal = pro.price

                this.cart.push(this.cartadd)
                this.cartadd = {}
            }
            this.storeCart()
            eventEmitter.$emit('cartUpdate', this.cart)
        })
    }
}
</script>

<style scoped>

</style>
