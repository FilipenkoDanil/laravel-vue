<template>
    <div>
        <b-overlay :show="show" no-wrap></b-overlay>

        <div v-show="!show">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            show: true,
        }
    },
    methods: {
        loading() {
            this.show = true
            setTimeout(() => {
                this.show = false
            }, 2000)
        },
    },
    watch: {
        // вызвать оверлей при изменениях маршрута
        $route: 'loading'
    },
    mounted() {
        this.loading()
        console.log(this.baseURL)
    }
}
</script>

<style>
body {
    background: url("http://www.izmail.pizza-nys.com.ua/wp-content/themes/red-pepper/assets/img/cards-list.png") no-repeat;
    background-size: cover;
}
</style>
