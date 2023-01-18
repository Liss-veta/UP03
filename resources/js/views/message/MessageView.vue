<template>
        <div class="d-flex justify-center mt-12">
            <!-- Левая часть мессенджера -->
            <div class="w-50 ml-12">
                <DialogComponent/>
            </div>
            <!-- Правая часть мессенджера -->
            <div class="w-25 border-pink mb-6 pt-4">
                <DialogFriendsComponent/>
            </div>
        </div>
</template>

<script>
import DialogComponent from '../../components/MessageComponents/DialogComponent.vue';
import DialogFriendsComponent from '../../components/MessageComponents/DialogFriendsComponent.vue';
export default {
    components:{
        DialogComponent,
        DialogFriendsComponent
    },
    mounted() {
        document.title = "Сообщения";
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
