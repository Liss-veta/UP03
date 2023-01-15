<template>
    <div class="d-flex flex-column">
        <div class="w-100 d-flex justify-end flex-column">
            <div class="w-100 bg-grad d-flex flex-column justify-end align-end pb-4">
                <!-- Имя Возраст пользователя друга -->
                <h2 class="text-h3 mb-2 w-60"><span>{{user['name']}}</span>, <span>{{ user['age'] }}</span></h2>
                <!-- Город пользователя -->
                <h3 class="text-h4 w-60">{{ user['city'] }}</h3>
            </div>
            <div class="d-flex flex-row align-end">
                <img class="avatar" src="../../../../public/img/no_avatar.jpg"
                    v-if="
                       user['avatar'] === 'NULL' ||
                       user['avatar'] === 'undefined'"
                    alt=""/>
                <img class="avatar" :src="user['avatar']"
                    alt=""  v-else />
            </div>
        </div>
    <v-btn class="w-25" id="add" @click.prevent="addFriend">{{ request_status }}</v-btn>    
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: [],
                id: '', 
                my_id: localStorage.getItem('id'),
                request_status: 'Добавить в друзья'
            }
        },
        mounted(){
            this.parseURL()
            this.getUser()
            this.friends_request()
        },
        methods: {
            getUser(){
                axios.get(`/api/view/${this.id}`)   
                    .then(res =>{
                        this.user = res.data
                        document.title = this.user['name']
                    })
            },

            parseURL(){
                let url = window.location.pathname
                this.id = url.split('/')[2]
            },

            addFriend(){
                let formData = new FormData();
                formData.append('id_user', localStorage.getItem('id'));
                formData.append('id_friend', this.user['id']);
                axios.post('/api/addFriend', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    },
                )
                .then(res => {
                    console.log(res);
                    this.friends_request()
                })
            },
            friends_request(){
                axios.get(`/api/friends/${this.my_id}`)
                    .then(res => {
                        console.log(res.data);
                            this.requests_0 = res.data[0];
                            this.requests_1 = res.data[1];

                            if(res.data[0].length == 0){
                                for (let index = 0; index < res.data[1].length; index++) {
                                    // console.log(res.data[1][index]);
                                    if(this.user['id'] == res.data[1][index]['id_friend'] || this.user['id'] == res.data[1][index]['id_user']){
                                        if(res.data[1][index]['status'] == 'false'){
                                            this.request_status = 'Заявка отправлена'                                
                                        }

                                        if(res.data[1][index]['status'] == 'true'){
                                            this.request_status = 'У вас в друзьях'                                
                                        }

                                        if(res.data[1][index]['status'] == 'block'){
                                            this.request_status = 'В черном списке'                                
                                        }
                                    }
                                }
                                
                            }

                            if(res.data[1].length == 0){
                                for (let index = 0; index < res.data[0].length; index++) {
                                    if(this.user['id'] == res.data[0][index]['id_friend'] || this.user['id'] == res.data[0][index]['id_user']){
                                        if(res.data[0][index]['status'] == 'false'){
                                            this.request_status = 'Заявка отправлена'                                
                                        }

                                        if(res.data[0][index]['status'] == 'true'){
                                            this.request_status = 'У вас в друзьях'                                
                                        }

                                        if(res.data[0][index]['status'] == 'block'){
                                            this.request_status = 'В черном списке'                                
                                        }
                                    }
                                }
                                
                            }

                            
                           
                            // console.log(this.requests_0);
                            // console.log(this.requests_1);
                    })
            },
        },
    }
</script>

<style scoped>
.w-60{
    width: 67%;
}
.bg-grad{
    height: 300px;
    background: #7986CB;
}
.avatar {
    width: 300px;
    height: 300px;
    margin-top: -10%;
    margin-left: 10%;
    border: 2px rgba(255, 255, 255, 0.5) solid;
    object-fit: cover;
}
</style>
