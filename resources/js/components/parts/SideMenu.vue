<template>
    <div>
        <div>
            <b-sidebar id="sidebar-1" title="Категории" shadow width="380px" bg-variant="dark"
                       text-variant="light" no-close-on-route-change>
                <div class="px-3 py-2">
                    <b-list-group>
                        <b-list-group-item variant="secondary" to="/" exact>
                            Главная
                        </b-list-group-item>
                        <b-list-group-item variant="secondary" v-for="category in categories" :key="category.id"
                                           :to="{ name: 'productsByCategory', params: { category: category.alias }}">
                            {{ category.title }}
                        </b-list-group-item>
                    </b-list-group>
                </div>
            </b-sidebar>
        </div>
    </div>
</template>

<script>
export default {
    name: "SideMenu",
    data() {
        return {
            categories: {},
        }
    },
    methods: {
        loadCategories() {
            axios.get(`${this.$root.baseURL}/api/categories/`).then(response => {
                this.categories = response.data.categories
            })
        },
    },
    mounted() {
        this.loadCategories()
    }
}
</script>

<style scoped>

</style>
