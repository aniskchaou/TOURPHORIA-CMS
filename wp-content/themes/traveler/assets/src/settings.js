import Vue from 'vue'
import router from './settings/router'

import App from './settings/App.vue'
require ('./settings/customfields')
window.$= window.jQuery;
new Vue({
    el: '#traveler_settings_app',
    router,
    render: h => h(App),
});
