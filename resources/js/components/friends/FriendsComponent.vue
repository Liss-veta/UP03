<template>
    <div class="w-90 mt-6">
        <div class="tab-adap">
            <v-tabs
            class="mb-4"
            v-model="tab"
            >
            <!-- Счетчик количества друзей -->
                <v-tab class="text-white" link slider-color="pink-lighten-4" value="one">
                    Мои друзья <v-badge :content="41" color="pink-lighten-4" inline class="ml-6"></v-badge>
                </v-tab>
                <!-- Счетчик заявок в друзья -->
                <v-tab class="text-white" slider-color="pink-lighten-4" value="two">
                    Заявки в друзья <v-badge :content="+3" color="success" inline class="ml-6"></v-badge>
                </v-tab>
                <!-- Счетчик заявок в друзья -->
                <v-tab class="text-white" slider-color="pink-lighten-4" value="three">
                    Черный список <v-badge :content="5" inline class="ml-6"></v-badge>
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
                <v-icon size="40">mdi-account-multiple</v-icon><v-badge :content="41" color="pink-lighten-4" inline class="ml-4"></v-badge>
            </v-tab>
            <!-- Счетчик заявок в друзья -->
            <v-tab class="text-white" link slider-color="pink-lighten-4" value="two">
                <v-icon size="40">mdi-account-multiple-plus</v-icon> <v-badge :content="+3" color="success" inline class="ml-4"></v-badge>
            </v-tab>
            <!-- Счетчик чс -->
            <v-tab class="text-white" link slider-color="pink-lighten-4" value="three">
                <v-icon size="40">mdi-account-cancel</v-icon> <v-badge :content="5" inline class="ml-4"></v-badge>
            </v-tab>
            </v-tabs>
        </div>

            <div class="w-100 d-flex">
            <v-window class="mt-6 w-76" v-model="tab">
                <!-- Список друзей -->
                <v-window-item value="one">
                    <div class="d-flex pb-6" v-for="request in requests" :key="request">
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
                                    <h4>{{ request.name + ' ' + request.surname}}</h4>
                                </v-col>
                                <!-- Добавить в чс -->
                                <v-col cols="2.5" sm="3" md="2" lg="2" xl="2">
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text">Заблокировать</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-account-cancel">
                                    </v-btn>
                                </v-col>
                                <!-- Удалить из друзей -->
                                <v-col cols="2.5" sm="2" md="2" lg="2" xl="2" >
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text">Удалить</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-trash-can">
                                    </v-btn>
                                </v-col>
                        </row>
                    </div>
                </v-window-item>
                <!-- Список заявок в друзья -->
                <v-window-item value="two">
                    <div class="d-flex pb-6" v-for="request in requests" :key="request">
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
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text">Принять</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-check">
                                    </v-btn>
                                </v-col>
                        </row>
                    </div>
                </v-window-item>
                <!-- Черный список -->
                <v-window-item value="three">
                    <!-- Цикл перебора списка -->
                    <div class="d-flex pb-6"  v-for="index in 10" :key="index">
                        <row class="px-4 py-1 d-flex align-center border-pink-hov w-100">
                                <!-- Аватарка друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="2" sm="2" md="1" lg="1" xl="1">
                                    <v-avatar @click="$router.push('/user/id')" image="img/avatar.png" size="50" class="mr-2"></v-avatar>
                                </v-col>
                                <!-- Имя фамилия друга -->
                                <!-- Добавить ссылку -->
                                <v-col cols="7" sm="7" md="9" lg="9" xl="9">
                                    <router-link to="/user/id"><h4>Имя Фамилия</h4></router-link>
                                </v-col>
                                <!-- Вытащить из чс -->
                                <v-col cols="3" sm="4" md="2" lg="2" xl="2">
                                    <v-btn class="d-none d-sm-block d-md-block d-lg-block d-xl-block" variant="text">Разблокировать</v-btn>
                                    <v-btn class="d-block d-sm-none d-md-none d-lg-none d-xl-none" variant="outlined" color="pink-lighten-4" icon="mdi-account-check">
                                    </v-btn>
                                </v-col>
                        </row>
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
            requests: [],
            // requests_1: []
        }),
        mounted() {
            this.friends_request()
        },
        methods: {
            friends_request(){
                axios.get(`/api/friends/${this.id}`)
                    .then(res => {
                        console.log(res.data)
                            this.requests = res.data;
                            // this.requests_1 = res.data[1];
                            // console.log(this.requests_0);
                            // console.log(this.requests_1);
                    })
            }
        },
    }
</script>

<style>
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
