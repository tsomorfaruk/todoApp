<template>
    <div>
        <input-todo @entered="addTodo"></input-todo>
        <div class="list">
            <todo-check v-for="(todo, i) in completedTodos" :key="todo.id" :todo="todo" @deleted="deleted(i)"></todo-check>
            <Bottom :itemsLeft="itemsLeft" @deletedCompleted="clearCompleted"></Bottom>
            <div class="first"></div>
            <div class="second"></div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import InputTodo from "../InputTodo";
    import TodoCheck from "../TodoCheck";
    import Bottom from "../Bottom";

    export default {
        name: "Complete",
        components: {
            InputTodo,
            TodoCheck,
            Bottom,
        },
        data(){
            return {
                todoList: [],
                completedTodos: [],
                itemsLeft: '',
            }
        },
        methods: {
            addTodo(val){
                if (val !== ""){
                    axios.post('/api/store', {
                        todo : val,
                    })
                        .then(res => {
                            this.itemsLeft++;
                        });
                }
            },
            deleted(i){
                this.completedTodos.splice(i, 1);
            },
            clearCompleted(){
                this.completedTodos = [];
            },
        },
        mounted() {
            axios('/api/showall')
                .then(res => {
                    this.todoList = res.data.data;
                    const incomplete = this.todoList.filter(e => e.status === 'incomplete');
                    this.completedTodos = this.todoList.filter(e => e.status === 'complete');
                    this.itemsLeft = incomplete.length;
                });
        }
    }
</script>
