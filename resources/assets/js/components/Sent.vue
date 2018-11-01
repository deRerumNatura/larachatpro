<template>
    <div class="sending-form">
         <span v-show="message.typing" class="help-block" style="font-style: italic;">
            {{ message.typingUser }} is typing...
        </span>
        <div v-show="sendButton" transition="slide" class="alert alert-danger">Wait for 15 second, to send next message.</div>
        <form @submit.prevent.keyup="sent" class="d-flex mt-3">
            <div class="form-group w-100 input-field">
                <textarea type="text" class="form-control h-100" v-model="message.message" @keyup="isTyping"></textarea>
            </div>
            <div class="form-group mx-3 d-flex align-items-center">
                <button :disabled="sendButton" type="submit" class="btn btn-danger bmd-btn-fab is-disabled">
                    <i class="far fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data: function() {
            return {
                message: {
                    message: '',
                    user: this.user,
                    typing: false,
                    typingUser: '',
                },
                sendButton: false
            }
        },
        created() {
            window.Echo.private('chat-room')
                .listenForWhisper('typing', (e) => {
                    this.message.typing = e.typing

                    setTimeout(() => {
                        this.message.typing = false
                    }, 3000);

                    this.message.typingUser = e.user.name
                });
        },
        methods: {
            sent () {
                this.$emit('messagesent', this.message)
                this.message = {
                    message: '',
                    user: this.user,
                    typingUser: '',
                    typing: false
                };
                this.settingTimeout()
            },
            isTyping () {
                let channel = window.Echo.private('chat-room')
                    channel.whisper('typing', {
                        user: this.user,
                        typing: true
                    });
            },
            settingTimeout () {
                let timeOfDelay = 15000;

                this.sendButton = true

                setTimeout(() => {
                    this.sendButton = false
                }, timeOfDelay);
            }
        }
    }
</script>
