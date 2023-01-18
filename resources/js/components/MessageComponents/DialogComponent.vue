<template>
    <!-- Блок диалога -->
    <div class="d-flex pb-6 mb-4" v-for="index in 10" :key="index">
        <div class="pa-6 d-flex text-white border-pink">
            <!-- Следующая строка фрагмент "content" счетчик новых сообщений -->
            <v-badge content="+1" color="success">
                <!-- Аватарка друга -->
                <v-avatar image="img/avatar.png" size="50" class="mr-2"></v-avatar>
            </v-badge>
            <div class="w-90 pl-6">
                <h4>Имя Фамилия</h4>
                <p class="w-100 d-flex justify-space-between text-indigo-darken-2">
                    <!-- Текст последнего сообщения -->
                    <span class="d-inline-block text-truncate" style="max-width: 80%;">Текст последнего сообщения oufheifbes fsedbfhbsredfjb srejf vjsrebde fj dsjf sdjbf vbdr</span>
                    <!-- Дата этого сообщения -->
                    <span class="text-disabled">22.12.2022</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },


};
</script>

<style scoped>
.w-90{
    width: 90%;
}
.border-pink{
    border: 1px solid #F8BBD0;
}
</style>
