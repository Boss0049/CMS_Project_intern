
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faChevronDown  } from '@fortawesome/free-solid-svg-icons'
import { faEye } from '@fortawesome/free-solid-svg-icons'
import { faPencilAlt } from '@fortawesome/free-solid-svg-icons'
import { faImage } from '@fortawesome/free-solid-svg-icons'
import { faTrashAlt } from '@fortawesome/free-solid-svg-icons'
import { faUndoAlt } from '@fortawesome/free-solid-svg-icons'
import { faSearch } from '@fortawesome/free-solid-svg-icons'
import { faTimes } from '@fortawesome/free-solid-svg-icons'
import { faChevronRight } from '@fortawesome/free-solid-svg-icons'
import { faChevronLeft } from '@fortawesome/free-solid-svg-icons'

library.add(faChevronDown)
library.add(faEye)
library.add(faPencilAlt)
library.add(faImage)
library.add(faTrashAlt)
library.add(faUndoAlt)
library.add(faSearch)
library.add(faTimes)
library.add(faChevronRight)
library.add(faChevronLeft)

Vue.config.productionTip = false

require('./bootstrap');

// require('./font-awesome')
import 'bootstrap/dist/css/bootstrap.css'

// import 'font-awesome/css/font-awesome.css'
window.Vue = require('vue');
var VueCookie = require('vue-cookie');
Vue.use(VueCookie);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('admin' ,require('./components/admin.vue'));
Vue.component('cms-test', require('./components/testCms.vue'));
Vue.component('edit', require('./components/edit.vue'));
Vue.component('font-awesome-icon',FontAwesomeIcon);
Vue.component('datetime',require('vuejs-datetimepicker'));
Vue.component('v-select', require('vue-select'));


const app = new Vue({
    el: '#app',
});







