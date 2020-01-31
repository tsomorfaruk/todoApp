<template>
    <div class="checkbox">
        <input type="checkbox" :checked="ifChecked()" :value="todo.id" @change="updateStatus" :disabled="ifChecked()">
        <label :class="{linethrough:ifChecked()}" :value="todo.id" @dblclick="hideLabel">
            {{todo.todo}}
        </label>
        <input type="text" v-model="todo.todo" @keypress.enter="updateTodo">
        <a href="#" @click="deleteTodo"><i class="fas fa-times"></i></a>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "TodoCheck",
        props: [
            'todo'
        ],
        methods: {
            ifChecked(){
                if (this.todo.status == 'complete'){
                    return true;
                }
            },
            updateStatus(e){
                if (e.target.checked){
                    axios.put('http://todo.to/api/update/status', {
                        id : e.target.value,
                        status : 'complete',
                    })
                    .then(res => {
                        if (res.status === 200){
                            e.target.nextElementSibling.classList.add('linethrough');
                            e.target.disabled = true;
                            this.$emit('completed');
                        }
                    });
                }
            },
            deleteTodo(){
                axios.delete(`http://todo.to/api/delete/${this.todo.id}`)
                .then(res => {
                    if (res.status === 200){
                        this.$emit('deleted');
                    }
                })
            },
            updateTodo(e){
                axios.put('http://todo.to/api/update/todo', {
                    id: this.todo.id,
                    todo: this.todo.todo,
                })
                .then(res => {
                    if (res.data.data){
                        e.target.style.display = "none";
                        e.target.previousElementSibling.style.display="inline";
                    }
                });
            },

            hideLabel(e){
                if (this.todo.status === 'incomplete'){
                    e.target.style.display="none";
                    e.target.nextElementSibling.style.display="inline";
                    e.target.nextElementSibling.focus();
                }
            }
        },
    }
</script>

<style scoped lang="scss">
    .linethrough {
        text-decoration: line-through;
        color: #aaa;
    }
    .checkbox{
        text-align: left;
        border-bottom: 1px solid #ccc;
        padding: 10px 20px;
        font-size: 20px;
        &:first-of-type{
            padding-top: 0;
        }
        a{
            float: right;
            color: rgba(227, 171, 156, 0.5);
            display: none;
        }
        &:hover{
            a{
                display: inline;
            }
        }
        input[type=text]{
            display: none;
            width: 85%;
            padding: 6px 10px;
            font-size: 1.1rem;
        }
    }
</style>
