<template>
    <div>
        <input-todo @entered="addTodo"></input-todo>
        <div class="list" :class="{'d-none':todoList.length===0}">
            <todo-check v-for="(todo, i) in todoList" :key="todo.id" :todo="todo" @deleted="deleted(i)" @completed="updateStatus(i)" ></todo-check>
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
        name: "Todo",
        components: {
            InputTodo,
            TodoCheck,
            Bottom,
        },
        data(){
            return {
                todoList: [],
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
                        this.todoList.unshift(res.data.data);
                        this.itemsLeft++;
                    });
                }
            },
            deleted(i){
                if (this.todoList[i].status === 'incomplete'){
                    this.itemsLeft--;
                }
                this.todoList.splice(i, 1);
            },
            clearCompleted(){
                this.todoList = this.todoList.filter(val => val.status === 'incomplete');
                // console.log(incomplete);
            },
            updateStatus(i){
                this.itemsLeft--;
                this.todoList[i].status = 'complete';
            }
        },
        mounted() {
            axios('/api/showall')
            .then(res => {
                this.todoList = res.data.data;
                const incomplete = this.todoList.filter(e => e.status === 'incomplete');
                this.itemsLeft = incomplete.length;
            });
        }
    }
</script>

<style lang="scss">
    /*this style is for main,incomplete and complete components*/
    .list{
        background-color: #fff;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.4);
        width: 540px;
        margin: 0 auto;
        padding: 15px 0;
        position: relative;
        .first, .second{
            position: absolute;
            height: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.4);
        }
        .first{
            width: 98%;
            left: 1%;
            bottom: -5px;
            z-index: -1;
        }
        .second{
            width: 96%;
            left: 2%;
            bottom: -10px;
            z-index: -2;
        }
    }
    .d-none{
        display: none;
    }
</style>
