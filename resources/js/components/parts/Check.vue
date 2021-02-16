<template>
    <div>
        <b-container v-if="cart.length > 0" class="bg-light rounded mt-4">
            <div class="p-3">
                <h3 style="color: #d70e21">Детали оплаты</h3>
                <form novalidate>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-4">
                            <label for="name">Имя <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                   @blur="$v.form.name.$touch()"
                                   :class="{'is-invalid': $v.form.name.$error }"
                                   v-model="form.name">
                            <div class="invalid-feedback" v-if="$v.form.name.$error">
                                Заполните это поле.
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fio">Фамилия <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="fio" name="fio"
                                   @blur="$v.form.fio.$touch()"
                                   :class="{'is-invalid': $v.form.fio.$error }"
                                   v-model="form.fio">
                            <div class="invalid-feedback" v-if="$v.form.fio.$error">
                                Заполните это поле.
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Телефон <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   @blur="$v.form.phone.$touch()"
                                   :class="{'is-invalid': $v.form.phone.$error }"
                                   v-model="form.phone">
                            <div class="invalid-feedback" v-if="$v.form.phone.$error">
                                Заполните это поле.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="address" name="address"
                               @blur="$v.form.address.$touch()"
                               :class="{'is-invalid': $v.form.address.$error }"
                               v-model="form.address">
                        <div class="invalid-feedback" v-if="$v.form.address.$error">
                            Заполните это поле.
                        </div>
                    </div>
                </form>

                <h3 class="mt-4" style="color: #d70e21">Ваш заказ</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Товар</th>
                        <th scope="col">Подитог</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in cart">
                        <td><strong>{{ item.title }} x {{ item.amount }}</strong></td>
                        <td><strong>{{ item.productTotal }}₴</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Доставка</strong></td>
                        <td><strong>Доставка бесплатная</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Итого</strong></td>
                        <td><strong>{{ totalprice }}₴</strong></td>
                    </tr>
                    </tbody>
                </table>

                <b-button @click="check" variant="danger" pill>Подтвердить заказ</b-button>
            </div>
        </b-container>
    </div>
</template>

<script>
import {eventEmitter} from '../../app'
import {required, minLength} from 'vuelidate/lib/validators'

export default {
    name: "Check",
    data() {
        return {
            form: {
                name: '',
                fio: '',
                phone: '',
                address: '',
            },
            cart: [],
            totalprice: 0,
        }
    },
    validations: {
        form: {
            name: {
                required,
                minLength: minLength(2),
            },
            fio: {
                required,
                minLength: minLength(3),
            },
            phone: {
                required,
                minLength: minLength(10),
            },
            address: {
                required,
                minLength: minLength(8),
            }
        }
    },
    methods: {
        setCart() {
            this.cart = JSON.parse(localStorage.getItem('carts'))
        },
        setTotal() {
            if (this.cart) {
                this.totalprice = this.cart.reduce((total, item) => {
                    return total + item.amount * item.price;
                }, 0)
            }
        },
        check() {
            if (!this.$v.$invalid) {
                this.send()
            } else {
                this.showMsgBoxError()
            }
        },
        send() {
            axios.post(`${this.$baseURL}/api/orders`, {
                cart: this.cart,
                form: this.form,
                total: this.totalprice,

            }).then(response => {
                localStorage.clear()
                this.form.name = ''
                this.form.fio = ''
                this.form.phone = ''
                this.form.address = ''

                this.showMsgBoxSuccess()
                setTimeout(() => {
                    this.$router.push('/')
                }, 3000)
            })
        },
        showMsgBoxSuccess() {
            this.$bvModal.msgBoxOk('Скоро вам позвонят.', {
                title: 'Заказ принят',
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'success',
                headerClass: 'p-2 border-bottom-0',
                footerClass: 'p-2 border-top-0',
                centered: true
            })
        },
        showMsgBoxError() {
            this.$bvModal.msgBoxOk('Введите корректные данные.', {
                title: 'Ошибка',
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'danger',
                headerClass: 'p-2 border-bottom-0',
                footerClass: 'p-2 border-top-0',
                centered: true
            })
        }
    },
    mounted() {
        this.setCart()
        this.setTotal()

        eventEmitter.$on('cartUpdate', cart => {
            this.cart = cart
            this.setTotal()
        })
    }
}
</script>

<style scoped>

</style>
