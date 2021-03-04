import VueRouter from 'vue-router';
import Vue from 'vue';
import Settings from "./Settings";
const router = new VueRouter({
    routes: [
        {
            path: '/', component: Settings,name:"SettingsHome"
        },
        {
            path: '/:id', component: Settings,name:"Settings"
        }
    ]
});
Vue.use(VueRouter);
export default router