<template>
    <div>
        <navbar></navbar>

        <check></check>

        <side-menu></side-menu>
        <side-cart></side-cart>
    </div>
</template>

<script>
import Navbar from "../components/parts/Navbar";
import SideCart from "../components/parts/SideCart";
import SideMenu from "../components/parts/SideMenu";
import Check from "../components/parts/Check";

export default {
    name: "Checkout",
    components: {Check, SideMenu, SideCart, Navbar},
    data() {
        return {}
    },
}
</script>

<style scoped>

</style>
