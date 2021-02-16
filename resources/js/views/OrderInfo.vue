<template>
    <div>
        <navbar></navbar>

        <b-container class="bg-light rounded">
            <div class="mt-4 p-3">
                <h2>Заказ #{{ order.id }}</h2>
                <p>Заказчик: <b>{{ order.fio + ' ' + order.name }}</b></p>
                <p>Номер телефона: <b>{{ order.phone }}</b></p>
                <p>Адрес: <b>{{ order.address }}</b></p>
                <p>Статус: <b>{{ order.new ? 'Новый' : 'Старый' }}
                    <b-button @click="changeStatus">Изменить</b-button>
                </b></p>
                <br>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Название</th>
                        <th scope="col">Количество</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products">
                        <th scope="row">{{ product.product.title }}</th>
                        <td>{{ product.count }}</td>
                        <td>{{ product.price }}₴</td>
                        <td>{{ product.price * product.count }}</td>
                    </tr>

                    <tr>
                        <td colspan="3">Общая стоимость:</td>
                        <td>{{ order.sum }}₴</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </b-container>
    </div>
</template>

<script>
import Navbar from "../components/parts/admin/Navbar";

export default {
    name: "OrderInfo",
    components: {Navbar},
    data() {
        return {
            order: [],
            products: []
        }
    },
    methods: {
        getOrderInfo(orderId) {
            axios.post(`${this.$baseURL}/api/show`, {
                id: orderId
            }).then((response) => {
                this.order = response.data.order
                this.products = response.data.products
            })
        },
        changeStatus() {
            axios.post(`${this.$baseURL}/api/change`, {
                id: this.order.id,
            }).then((response) => {
                this.order = '';
                this.order = response.data.order
            })
        },
    },
    mounted() {
        this.getOrderInfo(this.$route.params.id)
    }
}
</script>

<style scoped>

</style>
