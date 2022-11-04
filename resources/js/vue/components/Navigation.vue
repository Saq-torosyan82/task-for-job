<template>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item"><router-link class="nav-link" :to="{name: 'Home'}">Home</router-link></li>
                <li class="nav-item"><router-link class="nav-link" :to="{name: 'Students'}">Students</router-link></li>
                <li class="nav-item"><router-link class="nav-link" :to="{name: 'Sports'}">Sports</router-link></li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Navigation"
}
</script>

<style scoped>

</style>
