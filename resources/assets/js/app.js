
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-chat-scroll'))
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding     components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('message', require('./components/Message.vue'));
Vue.component('sent-message', require('./components/Sent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        messages: [],
    },
    created(){
        this.fetchMessages();
        window.Echo.private('chat-room')
            .listen('ReceivedMessage', (e) => {
                this.fetchMessages();
            });
    },
    methods: {
        addMessage(message) {
            this.messages.push(message)
            window.axios.post('/messages', message).then(response => { //todo look!!

            })
        },
        fetchMessages() {
            window.axios.get('/messages').then(response => {
                this.messages = response.data
            })
        }

    }

});
