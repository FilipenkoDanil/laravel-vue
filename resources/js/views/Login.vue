<template>
    <div>
        <b-container class="bg-light rounded mt-4">
            <div class="p-3">
                <h1 class="text-center">Авторизация</h1>
                <form>
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
                    <button @click.prevent="login" type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </b-container>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        login() {
            axios.post('api/login', this.form).then(() => {
                this.$router.push({name: 'admin-index'})
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
