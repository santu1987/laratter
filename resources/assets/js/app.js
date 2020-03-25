window._ = require('lodash');
import Popper from 'popper.js/dist/umd/popper.js';
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 * Include the Popper.js library, since Boostrap 4 requires it
 */
try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = Popper;
    require('bootstrap');
} catch (e) {
}
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('responses', require('./components/Responses.vue'));
Vue.component('notifications', require('./components/Notifications.vue'));

const app = new Vue({
    el: '#app'
});
