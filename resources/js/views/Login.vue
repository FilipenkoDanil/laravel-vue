<template>
    <div>
        <b-container class="bg-light rounded mt-4">
            <div class="p-3">
                <h1 class="text-center">Авторизация</h1>
                <validation-errors v-if="validationErrors" :errors="validationErrors"></validation-errors>
                <div class="row justify-content-center align-items-center">
                    <form class="col-4">
                        <div class="form-group">
                            <label for="email">Email адрес</label>
                            <input type="email" class="form-control" id="email"
                                   aria-describedby="emailHelp" placeholder="Введите email"
                                   v-model="form.email">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password"
                                   placeholder="Введите пароль"
                                   v-model="form.password">
                        </div>
                        <button @click.prevent="login" type="submit" class="btn btn-primary float-right">Войти</button>
                    </form>
                </div>
            </div>
        </b-container>
    </div>
</template>

<script>
import ValidationErrors from "../components/parts/ValidationErrors";
export default {
    name: "Register",
    components: {ValidationErrors},
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
            validationErrors: ''
        }
    },
    methods: {
        login() {
            axios.post(`${this.$root.baseURL}/api/login`, this.form).then((response) => {
                this.validationErrors = response.data.error
                this.$router.push({name: 'admin-index'})
            }).catch(error => {
                this.validationErrors = error.response.data.errors
            })
        }
    }
}
</script>

<style scoped>

</style>
