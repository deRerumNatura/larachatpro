<template>
    <div class="chatroom">
        <div class="chatroom-body d-flex flex-column" v-for="message in messages" :key="message.id">
            <div class="message h-25">
                <div class="top-of-message d-flex justify-content-between">
                    <h4 class="nickname" :style="{color: message.user.color}">{{ message.user.name }}</h4>
                    <!--<span class="post_time">{{ message.created_at }}</span>-->
                </div>
                <div class="bottom-of-message">
                    <p class="body-message" :style="{color: message.user.color}">{{ message.message }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['messages'],
        updated() {
            let mes = this.messages

            let gett = mes.filter((messagee) => {
                return messagee
            })

            console.log(gett);
        }
    }
</script>

<style scoped>

</style>