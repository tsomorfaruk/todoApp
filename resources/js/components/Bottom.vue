<template>
    <ul>
        <li>{{itemsLeft}} items left</li>

        <div class="links">
            <li><router-link to="/">All</router-link></li>
            <li><router-link to="active">Active</router-link></li>
            <li><router-link to="complete">Completed</router-link></li>
        </div>

        <li><a href="#" @click.prevent="deleteCompleted">Clear Completed</a></li>
    </ul>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Bottom",
        props: [
            'itemsLeft'
        ],
        methods: {
            deleteCompleted(){
                axios('http://todo.to/api/delete/completed')
                .then(res => {
                    if (res.data>0){
                        this.$emit('deletedCompleted');
                    }
                });
            }
        }
    }
</script>

<style scoped lang="scss">
    ul{
        list-style: none;
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        color: #aaa;
        font-size: .9rem;
        font-weight: 600;
        .links{
            display: flex;
            a{
                margin-right: 10px;
                padding: 0 5px;
            }
        }
        a{
            text-decoration: none;
            color: #aaa;
            font-size: .9rem;
            font-weight: 600;
        }
    }
</style>
