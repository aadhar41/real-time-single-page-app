/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import Vuetify from 'vuetify'
import router from "./Router/router.js";

Vue.use(Vuetify)


import VueMarkdownEditor from '@kangc/v-md-editor';

// Prism
import Prism from 'prismjs';
// highlight code
import 'prismjs/components/prism-json';
import vuepressTheme from '@kangc/v-md-editor/lib/theme/vuepress.js';
import enUS from '@kangc/v-md-editor/lib/lang/en-US';

VueMarkdownEditor.use(vuepressTheme, {
    Prism,
});

VueMarkdownEditor.lang.use('en-US', enUS);

Vue.use(VueMarkdownEditor);
import md from "marked";
window.md = md;

import User from './Helpers/User'
window.User = User

window.EventBus = new Vue();

const vuetify = new Vuetify();


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('AppHome', require('./components/AppHome.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify,
    router
});
