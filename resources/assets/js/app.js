
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

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
            if (this.userHasAccess(message)) {
                this.messages.push(message)
                // sending the request to server with new message and get the response with data
                window.axios.post('/messages', message)
            }
        },
        fetchMessages() {
            window.axios.get('/messages').then(response => {
                this.messages = response.data
            })
        },

        userHasAccess (message) {
            //
            console.log('1.get user instance')
            console.log(this.getUsersStateFromMessageInstance(message))
            //
            return !this.bannedOrDisabled(this.getUsersStateFromMessageInstance(message))
        },

        userBanned(user) {
            //
            console.log('2. is banned')
            console.log(Boolean(user.baned))
            console.log('Has access?')
            //
            return Boolean(user.baned)
        },

        userDisabled(user) {
            //
            console.log('3. is disabled')
            console.log(Boolean(user.disabled))
            console.log('Has access?')
            //
            return Boolean(user.disabled)
        },

        bannedOrDisabled(user) {
            return !!(this.userBanned(user) || this.userDisabled(user))
        },

        getUsersStateFromMessageInstance(message) {
            return message.user
        },
        
    }

});
