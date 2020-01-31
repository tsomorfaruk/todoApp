<template>
    <div>
        <h1 class="main-heading">todos</h1>

        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style lang="scss">
    *,a,h1,h2,h3,h4,h5,h6{
        margin: 0;
        padding: 0;
        font-family: 'Nunito', sans-serif;
    }
    body{
        text-align: center;
        background-color: #FAF9FA;
    }
    h1.main-heading{
        font-size: 5rem;
        color: rgba(227, 171, 156, 0.5);
        font-weight: 600;
    }
    .router-link-exact-active{
        border: 1px solid #aaa;
    }
</style>
