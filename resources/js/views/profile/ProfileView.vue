<template>
    <div>
        <FirstSectionComponent />
    </div>
</template>

<script>
import FirstSectionComponent from '../../components/MenuComponets/FirstSectionComponent.vue';
    export default {
        components:{
            FirstSectionComponent,
        },
        mounted(){
            document.title = 'Меню'
        },

        data(){
            return{

            }
        }
    }
</script>

<style lang="css" scoped>

</style>
