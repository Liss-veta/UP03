<template>
    <div class="px-auto py-4 d-flex text-white" style="cursor:pointer;" v-if="id == this.$store.state.user.id">
                <v-badge :content="1" floating color="success" class="mr-2">
                    <!-- Аватарка друга -->
                    <v-avatar :image="avatarSecond" size="50" ></v-avatar>
                </v-badge>
                <div class="w-90 pl-6">
                    <!-- Вставить ссылку на профиль друга -->
                    <h4>{{ nameSecond }}</h4>
                    <p class="w-100 d-flex justify-space-between text-indigo-darken-2">
                        <!-- Вставить ссылку на переход к диалогу с другом -->
                        <span>Написать</span>
                    </p>
                </div>
            </div>
            <div class="pa-4 d-flex text-white" v-if="id != this.$store.state.user.id">
                <v-badge :content="1" floating color="success">
                    <!-- Аватарка друга -->
                    <v-avatar :image="avatar" size="50"></v-avatar>
                </v-badge>
                <div class="w-90 pl-6">
                    <!-- Вставить ссылку на профиль друга -->
                    <h4>{{ name }}</h4>
                    <p class="w-100 d-flex justify-space-between text-indigo-darken-2">
                        <!-- Вставить ссылку на переход к диалогу с другом -->
                        <span>Написать</span>
                    </p>
                </div>
            </div>
</template>
<script>
export default {
    props: {
        id: Number,
        avatar: String,
        name: String,
        nameSecond: String,
        avatarSecond: String,
        room: Object,
    },
    mounted(){

    },
    methods: {
        
    }

};
</script>

<style scoped>
.h100{
    height: 100%;
}
.w-85{
    width: 85%;
}
.border-pink{
    border: 1px solid #f8bbd0;
}
</style>
