import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Students from "../views/Students.vue";
import Sports from "../views/Sports.vue";
import NotFound from "../views/NotFound.vue";

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
    {
        path: "/:pathMatch(.*)*",
        name: "Not Found",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
