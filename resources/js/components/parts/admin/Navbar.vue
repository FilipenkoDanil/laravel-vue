<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-container>
                <b-navbar-brand :to="{ name: 'admin-index' }">Админ-панель</b-navbar-brand>
                <b-navbar-nav class="ml-auto">
                    <div class="text-center">
                        <b-button @click.prevent="logout" v-b-toggle.sidebar-right variant="danger">Выход</b-button>
                    </div>
                </b-navbar-nav>
            </b-container>
        </b-navbar>
    </div>
</template>

<script>
export default {
    name: "Navbar",
    data() {
        return {}
    },
    methods: {
        logout() {
            axios.post(`${this.$root.baseURL}/api/logout`).then(() => {
                this.$router.push({name: 'home'})
            })
        }
    },
}
</script>

<style scoped>

</style>
