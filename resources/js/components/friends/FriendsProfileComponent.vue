<template>
    <div>
        <div class="w-100 d-flex justify-end flex-column">
        <div class="w-100 bg-grad d-flex flex-column justify-end align-end pb-4">
            <!-- Имя Возраст пользователя друга -->
            <h2 class="text-h3 mb-2 w-60"><span>Лошок</span>, <span>20</span></h2>
            <!-- Город пользователя -->
            <h3 class="text-h4 w-60">Astrahan</h3>
        </div>
        <div class="d-flex flex-row align-end mt-n16">
            <img class="avatar" src="img/no_avatar.jpg"
                v-if="
                    this.$store.state.avatar === 'NULL' ||
                    this.$store.state.avatar === 'undefined'"
                alt=""/>
            <img class="avatar" :src="this.$store.state.avatar"
                alt=""  v-else />
        </div>
    </div>
    </div>
</template>

<script>
import DashboardComponent from '../autorization/DashboardComponent.vue';
    export default {
        components:{
            DashboardComponent,
        },
        mounted(){
            document.title = 'Профиль'
        }
    }
</script>

<style scoped>

</style>
