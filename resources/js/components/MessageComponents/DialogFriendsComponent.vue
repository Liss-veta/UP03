<template>
    <div class="w-75 mx-auto" v-for="index in 10" :key="index">
        <div class="pa-4 d-flex text-white">
            <v-badge dot color="success">
                <!-- Аватарка друга -->
                <v-avatar image="img/avatar.png" size="50" class="mr-2"></v-avatar>
            </v-badge>
            <div class="w-90 pl-6">
                <!-- Вставить ссылку на профиль друга -->
                <h4>Имя Фамилия</h4>
                <p class="w-100 d-flex justify-space-between text-indigo-darken-2">
                    <!-- Вставить ссылку на переход к диалогу с другом -->
                    <span>Написать</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {


};
</script>

<style scoped>
.w-85{
    width: 85%;
}
.border-pink{
    border: 1px solid #f8bbd0;
}
</style>
