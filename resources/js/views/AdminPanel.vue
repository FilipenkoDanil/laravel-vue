<template>
    <div>
        <navbar></navbar>

        <b-container class="bg-light rounded">
            <div class="mt-4 p-3">
                <div v-if="orders.length > 0">
                    <h2>Новые заказы</h2>
                    <br>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Время заказа</th>
                            <th scope="col">Сумма</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="order in orders">
                            <th scope="row">{{ order.id }}</th>
                            <td>{{ order.fio + ' ' + order.name }}</td>
                            <td>{{ order.phone }}</td>
                            <td>{{ formatDate(order['created_at']) }}</td>
                            <td>{{ order.sum }}₴</td>
                            <td>
                                <b-button variant="success" :to="{ name: 'order-info', params: { id: order.id } }">Открыть
                                </b-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <h1 class="text-center">Заказы закончились</h1>
                </div>
            </div>
        </b-container>

    </div>
</template>

<script>
import Navbar from "../components/parts/admin/Navbar";
import moment from 'moment'

export default {
    name: "AdminPanel",
    components: {Navbar},
    data() {
        return {
            orders: [],
        }
    },
    methods: {
        getOrders() {
            axios.get(`${this.$root.baseURL}/api/new-orders`).then((response) => {
                this.orders = response.data.orders
            })
        },
        formatDate(value) {
            if (value) {
                return moment(String(value)).format('MM/DD/YYYY hh:mm')
            }
        }
    },
    mounted() {
        this.getOrders()
    }
}
</script>

<style scoped>

</style>
