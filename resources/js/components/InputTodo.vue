<template>
    <div>
        <input type="text" placeholder="What needs to be done?" v-model="todo" @keypress.enter="addTodo">
    </div>
</template>

<script>
    export default {
        name: "InputTodo",
        data(){
            return {
                todo: "",
            }
        },
        methods: {
            addTodo(){
                this.$emit('entered', this.todo);
                this.todo = "";
            }
        }
    }
</script>

<style scoped lang="scss">
    input[type=text]{
        background-color: #fff;
        width: 500px;
        padding: 15px 20px;
        font-size: 1rem;
        border: none;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.4);
        &:focus{
            outline: none;
        }
    }
</style>
