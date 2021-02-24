<template>
    <div>
        <div class="alert alert-danger">
            <ul>
                <li v-for="(error, index) in validationErrors" :key="index">{{ error }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "ValidationErrors",
    props: ['errors'],
    computed: {
        validationErrors() {
            let errors = Object.values(this.errors)
            errors = errors.flat()

            return errors
        }
    }
}
</script>

<style scoped>

</style>
