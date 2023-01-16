<template>
    <div class="w-90 mt-6">
        <div class="tab-adap">
            <v-tabs
            class="mb-4"
            v-model="tab"
            >
            <!-- Счетчик количества друзей -->
                <v-tab class="text-white" link slider-color="pink-lighten-4" value="one">
                    Мои друзья <v-badge :content="col_true" color="pink-lighten-4" inline class="ml-6"></v-badge>
                </v-tab>
                <!-- Счетчик заявок в друзья -->
                <v-tab class="text-white" slider-color="pink-lighten-4" value="two">
                    Заявки в друзья <v-badge :content="col_false" color="success" inline class="ml-6"></v-badge>
                </v-tab>
                <!-- Счетчик заявок в друзья -->
                <v-tab class="text-white" slider-color="pink-lighten-4" value="three">
                    Черный список <v-badge :content="col_block" inline class="ml-6"></v-badge>
                </v-tab>
                <v-tab class="text-white" slider-color="pink-lighten-4" value="four">
                    Возможные друзья
                </v-tab>
            </v-tabs>
        </div>
        <div class="tab-adap2">
            <v-tabs
            class="mb-4"
            v-model="tab"
            grow
            >
            <!-- Счетчик количества друзей -->
            <v-tab class="text-white" link slider-color="pink-lighten-4" value="one">
                <v-icon size="40">mdi-account-multiple</v-icon><v-badge :content="col_true" color="pink-lighten-4" inline class="ml-4"></v-badge>
            </v-tab>
            <!-- Счетчик заявок в друзья -->
            <v-tab class="text-white" link slider-color="pink-lighten-4" value="two">
                <v-icon size="40">mdi-account-multiple-plus</v-icon> <v-badge :content="col_false" color="success" inline class="ml-4"></v-badge>
            </v-tab>
            <!-- Счетчик чс -->
            <v-tab class="text-white" link slider-color="pink-lighten-4" value="three">
                <v-icon size="40">mdi-account-cancel</v-icon> <v-badge :content="col_block" inline class="ml-4"></v-badge>
            </v-tab>
            <!-- Возможные друзья -->
            <v-tab class="text-white" link slider-color="pink-lighten-4" value="four">
                <v-icon size="40">mdi-account-question</v-icon>
            </v-tab>
            </v-tabs>
        </div>

            <div class="w-100 d-flex">
            <v-window class="mt-6 w-76" v-model="tab">
                <!-- Список друзей -->
                <v-window-item value="one">
                    <div class="d-flex pb-6" v-for="request in requests_0" :key="request">
                        <row class="px-2 px-sm-4 px-md-4 px-lg-4 px-xl-4 py-1 d-flex align-center border-pink-hov w-100" v-if="request.status == 'true'">
                                <!-- Аватарка друга -->
                                <!-- Добавить ссылку -->
                                <router-link :to="{ path: '/user/'+request.id_user }"><v-col cols="2" sm="2" md="1" lg="1" xl="1" >
                                    <v-avatar v-if="request.avatar === 'NULL'" image="img/no_avatar.jpg" size="50" class="mr-2"></v-avatar>
                                    <v-avatar v-else :image="request.avatar" size="50" class="mr-2"></v-avatar>
                                </v-col></router-link>
                                <!-- Имя фамилия друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="5" sm="5" md="7" lg="7" xl="7">
                                    <router-link :to="{ path: '/user/'+request.id_user }"><h4>{{ request.name + ' ' + request.surname}}</h4></router-link>
                                </v-col>
                                <!-- Добавить в чс -->
                                <v-col cols="2.5" sm="3" md="2" lg="2" xl="2">
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text" @click.prevent="block_friend(request.id)">Заблокировать</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-account-cancel">
                                    </v-btn>
                                </v-col>
                                <!-- Удалить из друзей -->
                                <v-col cols="2.5" sm="2" md="2" lg="2" xl="2" >
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text" @click.prevent="delete_friend(request.id)">Удалить</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-trash-can">
                                    </v-btn>
                                </v-col>
                        </row>
                    </div>
                    <div class="d-flex pb-6" v-for="request in requests_1" :key="request">
                        <row class="px-2 px-sm-4 px-md-4 px-lg-4 px-xl-4 py-1 d-flex align-center border-pink-hov w-100" v-if="request.status == 'true'">
                                <!-- Аватарка друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="2" sm="2" md="1" lg="1" xl="1" >
                                    <v-avatar v-if="request.avatar === 'NULL'" image="img/no_avatar.jpg" size="50" class="mr-2"></v-avatar>
                                    <v-avatar v-else :image="request.avatar" size="50" class="mr-2"></v-avatar>
                                </v-col>
                                <!-- Имя фамилия друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="5" sm="5" md="7" lg="7" xl="7">
                                    <router-link :to="{ path: '/user/'+request.id_friend }"><h4>{{ request.name + ' ' + request.surname}}</h4></router-link>
                                </v-col>
                                <!-- Добавить в чс -->
                                <v-col cols="2.5" sm="3" md="2" lg="2" xl="2">
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text" @click.prevent="block_friend(request.id)">Заблокировать</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-account-cancel">
                                    </v-btn>
                                </v-col>
                                <!-- Удалить из друзей -->
                                <v-col cols="2.5" sm="2" md="2" lg="2" xl="2" >
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text" @click.prevent="delete_friend(request.id)">Удалить</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-trash-can">
                                    </v-btn>
                                </v-col>
                        </row>
                    </div>
                </v-window-item>
                <!-- Список заявок в друзья -->
                <v-window-item value="two">
                    <div class="d-flex pb-6" v-for="request in requests_0" :key="request">
                        <row class="px-4 py-1 d-flex align-center border-pink-hov w-100" v-if="request.status == 'false'">
                                <!-- Аватарка друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="2" sm="2" md="1" lg="1" xl="1">
                                    <v-avatar v-if="request.avatar === 'NULL'" image="img/no_avatar.jpg" size="50" class="mr-2"></v-avatar>
                                    <v-avatar v-else :image="request.avatar" size="50" class="mr-2"></v-avatar>
                                </v-col>
                                <!-- Имя фамилия друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="7" sm="7"  md="9" lg="9" xl="9">
                                    <h4>{{ request.name + ' ' + request.surname}}</h4>
                                </v-col>
                                <!-- Принять в друзья -->
                                <v-col cols="3" sm="4"  md="2" lg="2" xl="2">
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text" @click.prevent="accept_friend(request.id)">Принять</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-check">
                                    </v-btn>
                                </v-col>
                        </row>
                    </div>
                </v-window-item>
                <!-- Черный список -->
                <v-window-item value="three">
                    <!-- Цикл перебора списка -->
                    <div class="d-flex pb-6" v-for="request in requests_0" :key="request">
                        <row class="px-4 py-1 d-flex align-center border-pink-hov w-100"  v-if="request.status == 'block'">
                                <!-- Аватарка друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="2" sm="2" md="1" lg="1" xl="1">
                                    <v-avatar v-if="request.avatar === 'NULL'" image="img/no_avatar.jpg" size="50" class="mr-2"></v-avatar>
                                    <v-avatar v-else :image="request.avatar" size="50" class="mr-2"></v-avatar>
                                </v-col>
                                <!-- Имя фамилия друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="7" sm="7"  md="9" lg="9" xl="9">
                                    <h4>{{ request.name + ' ' + request.surname}}</h4>
                                </v-col>
                                <!-- Вытащить из чс -->
                                <v-col cols="3" sm="4" md="2" lg="2" xl="2">
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text" @click.prevent="accept_friend(request.id)">Разблокировать</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-account-check">
                                    </v-btn>
                                </v-col>
                        </row>
                    </div>
                    <!-- Черный список -->
                    <div class="d-flex pb-6" v-for="request in requests_1" :key="request">
                        <row class="px-4 py-1 d-flex align-center border-pink-hov w-100"  v-if="request.status == 'block'">
                                <!-- Аватарка друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="2" sm="2" md="1" lg="1" xl="1">
                                    <v-avatar v-if="request.avatar === 'NULL'" image="img/no_avatar.jpg" size="50" class="mr-2"></v-avatar>
                                    <v-avatar v-else :image="request.avatar" size="50" class="mr-2"></v-avatar>
                                </v-col>
                                <!-- Имя фамилия друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="7" sm="7"  md="9" lg="9" xl="9">
                                    <h4>{{ request.name + ' ' + request.surname}}</h4>
                                </v-col>
                                <!-- Вытащить из чс -->
                                <v-col cols="3" sm="4" md="2" lg="2" xl="2">
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text" @click.prevent="accept_friend(request.id)">Разблокировать</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-account-check">
                                    </v-btn>
                                </v-col>
                        </row>
                    </div>
                </v-window-item>
                <v-window-item value="four">
                    <!-- Цикл перебора списка -->
                    <div class="d-flex pb-6">
                        <div class="all_users">
                            <div v-for="user in users" :key="user">
                                <router-link v-if="this.id != user.id" :to="{ path: '/user/'+user.id }"><p>{{ user.name + ' ' + user.surname }}</p></router-link>
                            </div>
                        </div>
                    </div>
                </v-window-item>
            </v-window>
            </div>
    </div>
</template>

<script>

    export default {
        data: ()=>({
            tab: null,
            id: localStorage.getItem("id"),
            requests_0: [],
            requests_1: [],
            col_true: 0,
            col_false: 0,
            col_block: 0,
            users: [],
        }),
        mounted() {
            this.friends_request()
            axios.get('/api/all_users')
            .then(res => {
                // console.log(res.data);
                this.users = res.data;
                console.log(this.users);

                // console.log(Math.floor(Math.random() * res.data.length));

                // for(let i = 0; i < 3; i++){
                //     this.users = Math.floor(Math.random() * res.data.length);                    
                // }
            })
        },
        updated() {

        },
        
        methods: {
            friends_request(){
                axios.get(`/api/friends/${this.id}`)
                    .then(res => {
                            this.requests_0 = res.data[0];
                            this.requests_1 = res.data[1];

                            this.col_true = 0;
                            this.col_false = 0;
                            this.col_block = 0;

                            console.log(res.data)
                            for(let count = 0; res.data.length > count; count++){
                                    for(let count1 = 0; res.data[count].length > count1; count1++){
                                        if(res.data[count][count1]['status'] == 'true'){
                                            this.col_true++;
                                        }
                                        if(res.data[count][count1]['status'] == 'false'){
                                            this.col_false++;
                                        }
                                        if(res.data[count][count1]['status'] == 'block'){
                                            this.col_block++;
                                        }
                                    }
                            }


                    })
            },
            accept_friend(id){
                axios.post(`/api/friends/accept/${id}`)
                    .then(res =>{
                        this.friends_request();
                    })
            },
            delete_friend(id){
                axios.post(`/api/friends/delete/${id}`)
                    .then(res =>{
                        this.friends_request();
                    })
            },
            block_friend(id){
                axios.post(`/api/friends/block/${id}`)
                    .then(res =>{
                        this.friends_request();
                    })
            }
        },
    }
</script>

<style scoped>
.w-80{
    width: 83%;
}
.w-76{
    width: 76%;
}
.w-60{
    width: 60%;
}
.w-40{
    width: 40%;
}
.border-pink{
    border: 1px solid #f8bbd0;
}
.border-pink-hov{
    border: 1px solid #f8bbd0;
    color: #f8bbd0;
}
.border-pink-hov:hover{
    border: 1px solid #060A30;
    background-color: #f8bbd0;
    color: #060A30;
}
.border-pink-hov a{
    color: #f8bbd0;
}
.border-pink-hov:hover a {
    color: #060A30;
}
.border-pink-hov .v-avatar{
    border: 2px solid #f8bbd0 ;
}
.border-pink-hov:hover .v-avatar{
    border: 2px solid #060A30 ;
}
.tab-adap2{
    display: none;
}
.tab-adap{
    display: block;
}

@media screen and (max-width: 1000px){
    .w-76{
        width: 95%;
    }
}
@media screen and (max-width: 768px){
    .tab-adap, .tab-adap > *{
        display: none;
    }
    .tab-adap2{
        display: block;
    }
    .border-pink-hov:hover{
        border: 1px solid #f8bbd0;
        background-color: #060A30;
        color: #f8bbd0;
    }
    .border-pink-hov:hover a {
        color: #f8bbd0;
    }
    .border-pink-hov:hover .v-avatar{
        border: none ;
    }
}
@media screen and (max-width: 600px){
    .w-76{
        width: 100%;
    }
    .border-pink-hov{
        border: none;
        border-bottom: 1px solid #f8bbd0;
    }
    .border-pink-hov:hover{
        border: none;
        border-bottom: 1px solid #f8bbd0;
    }
}
</style>
