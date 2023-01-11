<template>
        <v-card style="z-index: 50;">
            <v-layout>
            <v-navigation-drawer
                expand-on-hover
                rail
                class="bg-pink-lighten-4 h-100"
            >
                <v-list>
                <v-list-item
                    prepend-avatar="img/1098360-200 1.png"
                    title="Ithiantes"
                ></v-list-item>
                </v-list>

                <v-divider></v-divider>

                <v-list class="h-75 d-flex flex-column align-start justify-center" density="compact" nav>
                <router-link class="w-100" to="/message"><v-list-item prepend-icon="mdi-chat-processing" title="Сообщения" value="myfiles" class="w-100"></v-list-item></router-link>
                <router-link class="w-100" to="/news"><v-list-item prepend-icon="mdi-text-box" title="Новости" value="shared" class="w-100"></v-list-item></router-link>
                <router-link class="w-100" to="/friends"><v-list-item prepend-icon="mdi-account-multiple" title="Друзья" value="starred" class="w-100"></v-list-item></router-link>
                </v-list>
                <v-divider></v-divider>
                <v-list>
                <router-link to="/profile">
                    <v-list-item
                    :prepend-avatar="this.$store.state.avatar"
                    :title="this.$store.state.user.name"
                    :subtitle="this.$store.state.user.email"
                ></v-list-item>
                </router-link>
                </v-list>
            </v-navigation-drawer>
            <v-main style="height: 100%"></v-main>
            </v-layout>
        </v-card>
</template>

<script>
export default {
    data() {
        return {
            token: "",
            name: "",
            width: window.innerWidth,
        };
    },

    watch: {
        $route() {
            this.getToken();
            this.getName();
        },
    },

    mounted() {
        this.getToken();
        this.getName();
        window.addEventListener("resize", function(){
            let width_window = this.innerWidth;

            // console.log(width_window);
            if(width_window >= 768){
                document.getElementById('navig').style.display = 'flex'
                document.getElementById('navig').style.opacity = '1'
            }else{
                document.getElementById('navig').style.display = 'none'
                document.getElementById('burger').style.display = 'block'
                document.getElementById('navig').style.opacity = '0'
                document.getElementById('burger').style.opacity = '1'
            }
        }, false);
    },

    updated() {
        this.getToken();
        this.getName();
    },

    methods: {
        getToken() {
            this.token = localStorage.getItem("x_xsrf_token");
        },
        getName() {
            this.$store.state.user.name = localStorage.getItem("name");
        },
        getAvatar() {
            this.$store.state.avatar = localStorage.getItem("avatar");
        },
        getEmail() {
            this.$store.state.user.email = localStorage.getItem("email");
        },
        display(){
            if(document.getElementById('navig').style.opacity == '1'){
                document.getElementById('navig').style.opacity = '0'
                document.getElementById('navig').style.display = 'none'
            }else{
                document.getElementById('navig').style.opacity = '1'
                document.getElementById('navig').style.display = 'flex'
            }
        }
    },
};
</script>

<style lang="css" scoped>
.v-navigation-drawer__content{
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-items: space-between;
}
</style>
