<template>
    <div class="w-100 d-flex justify-center">
         <div class="d-flex justify-space-between my-12 ml-12 h-d" style="width: 90%">
            <!-- Левая часть мессенджера -->
            <div class="w-75">
                <!-- <DialogComponent :idRoom="this.$store.state.focusRoom.id" v-if="this.$store.state.isFocusRoom"/> -->
                <!-- Блок диалога -->
                <div v-if="this.$store.state.isFocusRoom" class="d-flex pb-6 mr-8 h-d">
                    <v-responsive aspect-ratio="4 / 3" class="border-pink py-4 position-relative">
                        <div class="w-100 text-center text-pink-lighten-4 py-auto pb-4" style="border-bottom: 1px solid #f8bbf8">
                            <h4 v-if="name_second.user.id == this.$store.state.user.id">{{ name_second.userSecond.name }} {{ name_second.userSecond.surname }}</h4>
                            <h4 v-else>{{ name_second.user.name }} {{ name_second.userSecond.surname }}</h4>
                        </div>
                        <div class="d-flex flex-column w-100 pa-4" style="height: 80%; overflow-y:auto;">
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
                                            <v-avatar size="40" :image="message.user.avatar" class="ml-2"></v-avatar>
                                        </span>
                                        <span class="text-end">{{ getHumanDate(message.created_at) }}</span>
                                    </p>
                                </div>
                            </div>

                        </div>
                            <div class="d-flex position-absolute text-pink-lighten-4 pl-4" style="width: 96%; bottom: 0;left:auto;">
                                <v-text-field class="w-90" label="Сообщение..."
                                    @keyup.enter="sendMessage(this.$store.state.focusRoom.id)"
                                    v-model="textMessage"></v-text-field>
                                <v-btn class="py-2 mt-3 ml-4" color="indigo" variant="outlined" icon size="small" 
                                    @click.prevent="sendMessage(this.$store.state.focusRoom.id)">
                                    <v-icon>mdi-send</v-icon></v-btn>
                            </div>
                    </v-responsive>
                </div>
            </div>
            <!-- Правая часть мессенджера -->
            <div class="w-25 border-pink mb-6 pt-4">
                <div style="overflow-y: auto" class="h-100">
                    <div class="w-75 mx-auto" style="position: relative; z-index: 100;" v-for="room in rooms" :key="room" @click.prevent="setFocusRoom(room)">
                        <DialogFriendsComponent
                            :room="room"
                            :id="room.user.id"
                            :name="room.user.name"
                            :avatar="room.user.avatar"
                            :nameSecond="room.userSecond.name"
                            :avatarSecond="room.userSecond.avatar" />
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
import moment from 'moment';
import DialogComponent from '../../components/MessageComponents/DialogComponent.vue';
import DialogFriendsComponent from '../../components/MessageComponents/DialogFriendsComponent.vue';
export default {
    components:{
        DialogComponent,
        DialogFriendsComponent
    },
    data(){
        return {
            rooms: [],
            messages: [],
            textMessage: '',
            name_second: '',
        }
    },
    mounted() {
        document.title = "Сообщения";
        this.getRooms();
        this.$store.state.user.id = window.localStorage.getItem('id');
    },
    methods: {
        getRooms(){
            axios.get('/api/rooms').then(response =>{
                let rooms = response.data.data;
                for (let index = 0; index < rooms.length; index++) {
                    if(rooms[index].user.id !== Number(localStorage.getItem('id'))){
                        if(rooms[index].userSecond.id !== Number(localStorage.getItem('id'))){
                            // console.log('--------');
                            // console.log(rooms[index].user.id);
                            // console.log(rooms[index].userSecond.id);
                            // console.log(localStorage.getItem('id'))
                            // console.log('--------');
                            rooms.splice(index,1);
                        }
                    }
                }
                this.rooms = rooms;
                console.log(this.rooms);
            })
        },
        setFocusRoom(room){
            console.log('Клик')
            console.log(room)
            this.name_second = room;
            console.log(this.name_second)
            delete this.$store.state.focusRoom;
            this.$store.state.focusRoom = room;
            this.$store.state.isFocusRoom = true;

            this.fetchMessages(this.$store.state.focusRoom.id);

            window.Echo.channel('chat')
                .listen('MessageSend', (e) => {
                    this.messages.push({
                        message: e.message.message,
                        user: e.user,
                        'id_user': e.user.id,
                    })
                    console.log(e);
                });
        },
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
}
</script>

<style scoped>
.h-d{
    height: 80vh;
}
.border-pink{
    border: 1px solid #F8BBD0;
}
.w-60{
    width: 60%;
}
.w-97{
    width: 97vw;
}
</style>
