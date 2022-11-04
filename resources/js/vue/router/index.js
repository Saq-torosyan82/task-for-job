import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Students from "../views/Students.vue";
import Sports from "../views/Sports.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },{
        path: "/students",
        name: "Students",
        component: Students,
    },{
        path: "/sports",
        name: "Sports",
        component: Sports,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
