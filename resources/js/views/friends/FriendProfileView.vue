<template>
    <div>
        <h4>{{ this.user['name']}}</h4>
        <h4>{{ this.user['surname'] }}</h4>
        <h4>{{this.user['email']}}</h4>
        <img :src="this.user['avatar']" alt="user profile"> <br>
        <button @click.prevent="addFriend">Добавить в друзья</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: [],
            }
        },
        mounted(){
            this.parseURL()
            this.getUser()
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
                })
            }
        },
    }
</script>

<style lang="css" scoped>
    div{
        margin-left: 20%;
        color: white;
    }
</style>
