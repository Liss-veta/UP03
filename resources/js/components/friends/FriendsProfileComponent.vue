<template>
    <div class="d-flex flex-column">
        <div class="w-100 d-flex justify-end flex-column">
            <div class="w-100 bg-grad d-flex flex-column justify-end align-end pb-4">
                <!-- Имя Возраст пользователя друга -->
                <h2 class="text-h3 mb-2 w-60"><span>{{ user.name + " " + }}</span>, <span>{{ this.$store.state.check_profile.age }}</span></h2>
                <!-- Город пользователя -->
                <h3 class="text-h4 w-60">{{ user['city'] }}</h3>
            </div>
            <div class="d-flex flex-row align-end">
                <img class="avatar" src="../../../../public/img/no_avatar.jpg"
                    v-if="
                       this.$store.state.check_profile.avatar === 'NULL' ||
                       this.$store.state.check_profile.avatar === 'undefined'"
                    alt=""/>
                <img class="avatar" :src="this.$store.state.check_profile.avatar"
                    alt=""  v-else />
            </div>
        </div>
    <v-btn class="w-25" @click.prevent="addFriend">Добавить в друзья</v-btn>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: []
            }
        },
        mounted(){
            document.title = 'Профиль'
            console.log(this.$store.state.check_profile.avatar)
        },
        methods: {
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
            },
        }
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
