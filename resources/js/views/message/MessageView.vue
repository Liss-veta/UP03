<template>
    <div class="w-100 d-flex justify-center">
         <div class="d-flex justify-space-between w-75 mt-12 h-d">
            <!-- Левая часть мессенджера -->
            <div class="w-75">
                <DialogComponent :idRoom="this.focusRoom.id" v-if="this.$store.state.isFocusRoom"/>
            </div>
            <!-- Правая часть мессенджера -->
            <div class="w-25 border-pink mb-6 pt-4">
                <div style="overflow-y: scroll" class="h-100">
                    <div class="w-75 mx-auto" v-for="room in rooms" :key="room" @click="setFocusRoom(room)">
                        <DialogFriendsComponent style='cursor:pointer;' v-for="room in rooms" :key="room" 
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
            focusRoom: {},
        }
    },
    mounted() {
        document.title = "Сообщения";
        this.getRooms();
        this.$store.state.user.id = window.localStorage.getItem('id');
        console.log('Фокус рум');
    },
    methods: {
        getRooms(){
            axios.get('/api/rooms').then(response =>{
                this.rooms = response.data.data;
                console.log('asdhdkjd')
                console.log(this.rooms);
            })
        },
        setFocusRoom(room){
            this.focusRoom = room;
            this.$store.state.isFocusRoom = true;
            console.log(this.focusRoom);
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
