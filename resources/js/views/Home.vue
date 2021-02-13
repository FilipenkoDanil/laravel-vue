<template>
    <div>
        <navbar></navbar>
        <product ref="productComp"></product>
        <side-cart></side-cart>
        <side-menu></side-menu>
    </div>
</template>

<script>
import Navbar from "../components/parts/Navbar";
import Product from "../components/parts/Product";
import SideCart from "../components/parts/SideCart";
import SideMenu from "../components/parts/SideMenu";

export default {
    name: "Home",
    components: {SideMenu, SideCart, Product, Navbar},
    data() {
        return {}
    },
    watch: {
        $route() {
            // загрузить товары выбраной категории
            this.$refs.productComp.loadProducts(this.$route.params.category);
        }
    },
}
</script>

<style scoped>

</style>
