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
                <div class="w-97">
                    <div class="d-flex justify-end pa-4">
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
        <div class="w-97">
            <router-view></router-view>
                        <div
                    v-if="
                        this.$route.path === '/register' ||
                        this.$route.path === '/login' ||
                        this.$route.path === '/admin'
                    "
                ></div>
                <FooterComponentVue v-else></FooterComponentVue>
        </div>
</template>
<script>
import HeaderComponentVue from "../../components/header_footer/HeaderComponent.vue";
import FooterComponentVue from "../../components/header_footer/FooterComponent.vue";
export default {
    components: { HeaderComponentVue, FooterComponentVue },

    data() {
        return {};
    },

    computed: {
        headerTab() {
            if (this.$route.path === "/register") {
                HeaderComponentVue;
            }
        },
    },
};
</script>
<style lang="css">
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
