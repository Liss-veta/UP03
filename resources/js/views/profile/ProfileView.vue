<template>
    <div>
        <DashboardComponent />
    </div>
</template>

<script>
import DashboardComponent from '../../components/autorization/DashboardComponent.vue';
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
