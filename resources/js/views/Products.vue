<template>
    <div>
        <navbar></navbar>

        <b-container class="bg-light rounded">
            <div class="mt-4 p-3">
                <h2>Все товары</h2>
                <b-button variant="success" class="mb-3" @click="show = !show">Добавить</b-button>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Категория</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products">
                        <th scope="row">{{ product.id }}</th>
                        <td>{{ product.title }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.price }}₴</td>
                        <td>{{ product.category.title }}</td>
                        <td>
                            <b-button class="mb-1" variant="warning" @click="showEdit(product)">Редактировать</b-button>
                            <b-button variant="danger" @click="deleteProduct(product.id)">Удалить</b-button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </b-container>

        <b-modal v-model="show" :title="isEdit ? 'Редактирование' : 'Добавление нового товара'"
                 id="modal"
                 @hidden="resetModal"
                 @ok="handleOk">
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <validation-errors v-if="validationErrors" :errors="validationErrors"></validation-errors>
                <b-form-group
                    label="Название"
                    label-for="title">
                    <b-form-input
                        id="title"
                        v-model="product.title"
                        @blur="$v.product.title.$touch()"
                        :class="{'is-invalid': $v.product.title.$error }"
                        required>
                    </b-form-input>
                </b-form-group>

                <b-form-group
                    label="Описание"
                    label-for="description">
                    <b-form-input
                        id="description"
                        v-model="product.description"
                        @blur="$v.product.description.$touch()"
                        :class="{'is-invalid': $v.product.description.$error }"
                        required>
                    </b-form-input>
                </b-form-group>

                <b-form-group
                    label="Цена"
                    label-for="price">
                    <b-form-input
                        id="price"
                        v-model="product.price"
                        @blur="$v.product.price.$touch()"
                        :class="{'is-invalid': $v.product.price.$error }"
                        required>
                    </b-form-input>
                </b-form-group>

                <b-form-group
                    label="Изображение (URL)"
                    label-for="img">
                    <b-form-input
                        id="img"
                        v-model="product.img"
                        @blur="$v.product.img.$touch()"
                        :class="{'is-invalid': $v.product.img.$error }"
                        required>
                    </b-form-input>
                </b-form-group>

                <b-form-group
                    label="Категория"
                    label-for="category_id">
                    <b-form-select
                        id="category_id"
                        v-model="product.category_id"
                        class="mb-3">
                        <b-form-select-option v-for="cat in categories" :key="cat.id" :value="cat.id">{{
                                cat.title
                            }}
                        </b-form-select-option>
                    </b-form-select>
                </b-form-group>
            </form>
        </b-modal>
    </div>
</template>

<script>
import Navbar from "../components/parts/admin/Navbar";
import ValidationErrors from "../components/parts/ValidationErrors";
import {required, minLength, numeric, url} from 'vuelidate/lib/validators'

export default {
    name: "Products",
    components: {ValidationErrors, Navbar},
    data() {
        return {
            products: [],
            categories: [],
            product: {
                id: '',
                title: '',
                description: '',
                price: '',
                img: '',
                category_id: '',
            },
            show: false,
            isEdit: false,
            validationErrors: ''
        }
    },
    validations: {
        product: {
            title: {
                required,
                minLength: minLength(3),
            },
            description: {
                required,
                minLength: minLength(2),
            },
            price: {
                required,
                numeric
            },
            img: {
                required,
                url
            },
            category_id: {
                required
            }
        }
    },
    methods: {
        loadProducts() {
            axios.get(`${this.$root.baseURL}/api/products`).then((response) => {
                this.products = response.data.products
            })
            axios.get(`${this.$root.baseURL}/api/categories/`).then(response => {
                this.categories = response.data.categories
            })
        },
        deleteProduct(id) {
            axios.delete(`${this.$root.baseURL}/api/products/${id}`)
                .then(() => {
                    this.loadProducts()
                })
        },
        showEdit(pro) {
            this.product.id = pro.id
            this.product.title = pro.title
            this.product.description = pro.description
            this.product.price = pro.price
            this.product.img = pro.img
            this.product.category_id = pro.category_id

            this.show = true
            this.isEdit = true
        },
        resetModal() {
            this.product = {}
            this.validationErrors = ''
            this.$v.$reset()
            this.isEdit = false
        },
        handleOk(bvModalEvt) {
            bvModalEvt.preventDefault()
            this.handleSubmit()
        },
        handleSubmit() {
            if (this.isEdit) {
                axios.put(`${this.$root.baseURL}/api/products/${this.product.id}`, {
                    title: this.product.title,
                    description: this.product.description,
                    price: this.product.price,
                    img: this.product.img,
                    category_id: this.product.category_id,
                }).then(() => {
                    this.loadProducts()
                    this.$nextTick(() => {
                        this.$bvModal.hide('modal')
                    })
                }).catch(error => {
                    this.validationErrors = error.response.data.errors
                })
            } else {
                axios.post(`${this.$root.baseURL}/api/products/`, {
                    title: this.product.title,
                    description: this.product.description,
                    price: this.product.price,
                    img: this.product.img,
                    category_id: this.product.category_id,
                }).then(() => {
                    this.loadProducts()
                    this.$nextTick(() => {
                        this.$bvModal.hide('modal')
                    })
                }).catch(error => {
                    this.validationErrors = error.response.data.errors
                })
            }
        }
    },
    mounted() {
        this.loadProducts()
    }
}
</script>

<style scoped>

</style>
