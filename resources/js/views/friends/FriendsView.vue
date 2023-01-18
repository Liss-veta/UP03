<template>
        <div class="d-flex justify-center">
            <FriendsComponent/>
        </div>
</template>

<script>
import FriendsComponent from '../../components/friends/FriendsComponent.vue';
export default {
    components:{
        FriendsComponent,
    },
    mounted() {
        document.title = "Друзья";
    },
}
</script>

<style scoped>
.border-pink{
    border: 1px solid #F8BBD0;
}
.w-60{
    width: 60%;
}
.w-97{
    width: 97vw;
}
</style>
