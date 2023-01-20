<template>
    <!-- Блок диалога -->
    <div class="d-flex pb-6 mr-8 h-d">
        <v-responsive aspect-ratio="4 / 3" class="border-pink pa-4 position-relative">
            <div class="d-flex flex-column w-100">
                <div v-for="message in messages" :key="message" class="d-flex flex-column w-100">
                    <div class="d-flex flex-column mb-6 ml-2" style="max-width: 60%;" v-if="message.user.id != this.$store.state.user.id">
                        <p class="mes1 text-body pa-4 d-flex flex-column bg-indigo-darken-4" style="align-self: baseline;">
                            <span class="d-flex align-center mb-2">
                                <v-avatar size="40" :image="message.user.avatar" class="mr-2"></v-avatar>
                                {{ message.message }}
                             </span>
                                <span class="text-end">{{ getHumanDate(message.created_at) }}</span>
                           
                        </p>
                    </div>
                    <div class="d-flex flex-column align-self-end mb-6" style="max-width: 60%;" v-else>
                        <p class="text-body pa-4 d-flex flex-column bg-indigo-darken-4" style="align-self: baseline;">
                            <span class="d-flex align-center justify-end mb-2">
                                {{ message.message }}
                                <v-avatar size="40" :image="message.user.avatar" class="mr-2"></v-avatar>
                             </span>
                            <span class="text-end">{{ getHumanDate(message.created_at) }}</span>
                        </p>
                    </div>
                </div>
                
            </div> 
                <div class="d-flex position-absolute text-pink-lighten-4 w-95" style="bottom: 0;left:auto;">
                      <v-text-field class="w-90" label="Оставьте комментарий" hint="какой должен быть коммент"
                        v-model="textMessage"></v-text-field>
                      <v-btn class="py-2 mt-3 ml-4" color="indigo" variant="outlined" icon size="small"
                        @click.prevent="sendMessage(idRoom)" @MediaKeyStatusMap.enter="sendMessage(idRoom)">
                        <v-icon>mdi-send</v-icon></v-btn>
                    </div>
        </v-responsive>
    </div>
    <!-- <div class="d-flex pb-6 mb-4" v-for="index in 10" :key="index">
        <div class="pa-6 d-flex text-white border-pink">
            Следующая строка фрагмент "content" счетчик новых сообщений
            <v-badge content="+1" color="success">
                Аватарка друга
                <v-avatar image="img/avatar.png" size="50" class="mr-2"></v-avatar>
            </v-badge>
            <div class="w-90 pl-6">
                <h4>Имя Фамилия</h4>
                <p class="w-100 d-flex justify-space-between text-indigo-darken-2">
                    Текст последнего сообщения
                    <span class="d-inline-block text-truncate" style="max-width: 80%;">Текст последнего сообщения oufheifbes fsedbfhbsredfjb srejf vjsrebde fj dsjf sdjbf vbdr</span>
                    Дата этого сообщения
                    <span class="text-disabled">22.12.2022</span>
                </p>
            </div>
        </div>
    </div> -->
</template>

<script>
import moment from 'moment';
export default {
    props: {
        idRoom: Number,
    },
    data(){
        return{
            messages: [],
            textMessage: ''
        }
    },
    mounted(){
        this.fetchMessages(this.idRoom);

        window.Echo.channel('chat')
            .listen('MessageSend', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user,
                    'id_user': e.user.id,
                })
                console.log('12132')
                console.log(e);
            });
    },
    methods: {
        getMessages(){
            axios.get(`/api/rooms/${this.idRoom}/messages`).then(response => {
                console.log(response.data);
            })
        },
        getHumanDate: function (date) {
            return moment(date).format('LT');
        },
        fetchMessages(id){
            axios.get(`/api/messages/${id}`).then(response => {
                this.messages = [];
                this.messages = response.data.data.messages;
                console.log('-----------------');
                console.log('Сообщения перерендер');
                console.log(this.messages);
                console.log('-----------------');
            })
        },
        sendMessage(id){
            axios.post('/api/messages/create',{
                message: this.textMessage,
                'id_room': id,
            }).then(r => {
                console.log(r.data);
                this.messages.push(r.data.data);
            })
            this.textMessage = '';
        }
    }
};
</script>

<style scoped>
.w-95{
    width: 95%;
}
.w-90{
    width: 90%;
}
.border-pink{
    border: 1px solid #F8BBD0;
}
.mes1::after{
    content: '';
    border: 20px solid transparent;
    border-top-width: 13px;
    border-bottom-width: 13px;
    border-right-color: #1a237e ;
    position: absolute;
    margin: -5px 0 0 -56px;
}
</style>
