<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-container>
                <b-navbar-brand>{{ title ? title : '' }}</b-navbar-brand>
                <b-button variant="info" v-b-toggle.sidebar-1>Меню</b-button>
                <b-navbar-nav class="ml-auto">
                    <div class="text-center">
                        <b-button v-b-toggle.sidebar-right variant="danger">
                            <b-badge variant="light mr-1">{{ badge }}</b-badge>
                            {{ totalprice }}₴
                        </b-button>
                    </div>
                </b-navbar-nav>
            </b-container>
        </b-navbar>
    </div>
</template>

<script>
import { eventEmitter } from '../../app'

export default {
    name: "Navbar",
    data() {
        return {
            title: '',
            badge: 0,
            totalprice: 0,
        }
    },
    mounted() {
        eventEmitter.$on('cartUpdate', cart => {
            this.badge = cart.length
            this.totalprice = cart.reduce((total, item) => {
                return total + item.amount * item.price;
            }, 0)
        })

        eventEmitter.$on('changeTitle', title => {
            if(title !== undefined){
                this.title = title
            } else {
                this.title = ''
            }
        })
    }
}
</script>

<style scoped>

</style>
