<template>
    <div>
        <input-todo @entered="addTodo"></input-todo>
        <div class="list">
            <todo-check v-for="(todo, i) in incompleteTodos" :key="todo.id" :todo="todo" @deleted="deleted(i)" @completed="updateStatus(i)" ></todo-check>
            <Bottom :itemsLeft="itemsLeft"></Bottom>
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
        name: "Incomplete",
        components: {
            InputTodo,
            TodoCheck,
            Bottom,
        },
        data(){
            return {
                todoList: [],
                incompleteTodos: [],
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
                            // this.todoList.unshift(res.data.data);
                            this.incompleteTodos.unshift(res.data.data);
                            this.itemsLeft++;
                        });
                }
            },
            deleted(i){
                if (this.todoList[i].status === 'incomplete'){
                    this.itemsLeft--;
                }
                this.incompleteTodos.splice(i, 1);
            },
            updateStatus(i){
                this.itemsLeft--;
                this.incompleteTodos[i].status = 'complete';
                this.incompleteTodos.splice(i,1);
            }
        },
        mounted() {
            axios('/api/showall')
                .then(res => {
                    this.todoList = res.data.data;
                    this.incompleteTodos = this.todoList.filter(e => e.status === 'incomplete');
                    this.itemsLeft = this.incompleteTodos.length;
                });
        }
    }
</script>
