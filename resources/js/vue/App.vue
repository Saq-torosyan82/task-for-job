<template>
    <Navigation />
    <router-view />
</template>

<script>
import Navigation from "./components/Navigation";
export default {
    name: "App",
    components: {
        Navigation
    }
}
</script>

<style scoped>
</style>
