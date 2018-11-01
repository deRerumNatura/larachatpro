<template>
    <div class="sending-form">
         <span v-show="message.typing" class="help-block" style="font-style: italic;">
            {{ message.typingUser }} is typing...
        </span>
        <form @submit.prevent.keyup="sent">
            <div class="form-group">
                <input type="text" class="form-control" v-model="message.message" @keyup="isTyping">
            </div>
            <div class="form-group">
                <button :disabled="sendButton" type="submit" class="btn btn-danger bmd-btn-fab">Sent</button>
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
                let _this = this;

                this.sendButton = true
                setTimeout(function(){
                    _this.sendButton = false
                }, 15000);
            }
        }
    }
</script>