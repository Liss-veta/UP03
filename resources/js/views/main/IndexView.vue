<template>
        <div
            v-if="
                this.$route.path === '/register' ||
                this.$route.path === '/login' ||
                this.$route.path === '/admin'
            "
        ></div>
        <div v-else>
            <HeaderComponentVue></HeaderComponentVue>
            <div class="d-flex justify-end">
                <div class="w-97 d-flex justify-space-between align-center pa-6">
                    <div class="d-flex pl-16">
                        <v-btn icon class="mr-4 bg-transparent" @click="$router.go(-1)">
                            <v-icon color="pink-lighten-4">mdi-arrow-left</v-icon>
                        </v-btn>
                        <h1 v-if="this.$route.path === '/message'" class="text-pink-lighten-4 ">Сообщения</h1>
                        <h1 v-else-if="this.$route.path === '/friends'" class="text-pink-lighten-4">Друзья</h1>
                        <h1 v-else-if="this.$route.path === '/news'" class="text-pink-lighten-4 ">Новости</h1>
                        <h1 v-else class="text-pink-lighten-4 pl-16"></h1>
                    </div>
                    <div class="d-flex justify-space-between">
                        <div class="w-10 d-flex justify-space-around">
                            <button>
                                <img src="img/search.png" alt="">
                            </button>
                            <button>
                                <img src="img/exit.png" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <router-view></router-view>
        <div class="d-flex justify-end">
            <div class="w-97">

                            <div
                        v-if="
                            this.$route.path === '/register' ||
                            this.$route.path === '/login' ||
                            this.$route.path === '/admin'
                        "
                    ></div>
                    <FooterComponentVue v-else></FooterComponentVue>
            </div>
        </div>
</template>
<script>
import HeaderComponentVue from "../../components/header_footer/HeaderComponent.vue";
import FooterComponentVue from "../../components/header_footer/FooterComponent.vue";
export default {
    components: { HeaderComponentVue, FooterComponentVue },

    computed: {
        headerTab() {
            if (this.$route.path === "/register") {
                HeaderComponentVue;
            }
        },
    },
};
</script>
<style>
.w-97{
    width: 96.3vw;
}
button > img {
    width: 50px;
    height: 50px;
}
.w-10{
    width: 10vw;
}
</style>
