import Vue from 'vue';
import VueRouter from 'vue-router';
import Main from "./components/allTodos/Main";
import Complete from "./components/completedTodos/Complete";
import Incomplete from "./components/incompleteTodos/Incomplete";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            component: Main
        },
        {
            path: '/complete',
            component: Complete
        },
        {
            path: '/active',
            component: Incomplete
        }
    ],
    mode: 'history'
});
