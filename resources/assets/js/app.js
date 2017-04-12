
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('conversation-form', require('./components/forms/ConversationForm.vue'));
Vue.component('conversation-reply-form', require('./components/forms/ConversationReplyForm.vue'));
Vue.component('conversation-add-user-form', require('./components/forms/ConversationAddUserForm.vue'));
Vue.component('conversation', require('./components/Conversation.vue'));
Vue.component('conversations', require('./components/Conversations.vue'));
Vue.component('conversations-dashboard', require('./components/ConversationsDashboard.vue'));
//Vue.component('conversations-dashboard', require('./components/ConversationsDashboard.vue'));


import store from './store/index.js'

const app = new Vue({
    el: '#app',
    store
});
