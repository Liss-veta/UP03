<template>
    <div>
        <v-card id="navig" style="z-index: 51;">
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
                    <v-list-item v-if="this.$store.state.avatar === 'NULL' || this.$store.state.avatar === '../uploads/undefined'"
                    prepend-avatar="img/no_avatar.jpg"
                    :title="this.$store.state.user.name + ' ' + this.$store.state.user.surname"
                    :subtitle="this.$store.state.user.email"
                ></v-list-item>
                    <v-list-item v-else
                    :prepend-avatar="this.$store.state.avatar"
                    :title="this.$store.state.user.name + ' ' + this.$store.state.user.surname"
                    :subtitle="this.$store.state.user.email"
                ></v-list-item>
                </router-link>
                </v-list>
            </v-navigation-drawer>
            <v-main style="height: 100%"></v-main>
            </v-layout>
        </v-card>
        <v-card id="navig2" style="z-index: 50;">
            <v-layout>
            <v-navigation-drawer
                v-model="drawer"
                :rail="rail"
                permanent
                temporary
                class="bg-pink-lighten-4 h-100"
                @click="rail = false"
            >
            <v-list-item
                    prepend-avatar="img/1098360-200 1.png"
                    title="Ithiantes"
                    nav
                >
                <template v-slot:append>
                    <v-btn
                    variant="text"
                    icon="mdi-chevron-left"
                    @click.stop="rail = !rail"
                    ></v-btn>
                </template>
                </v-list-item>

                <v-divider></v-divider>

                <v-list class="h-75 d-flex flex-column align-start justify-center" density="compact" nav>
                <router-link class="w-100" to="/message"><v-list-item prepend-icon="mdi-chat-processing" title="Сообщения" value="myfiles" class="w-100"></v-list-item></router-link>
                <router-link class="w-100" to="/news"><v-list-item prepend-icon="mdi-text-box" title="Новости" value="shared" class="w-100"></v-list-item></router-link>
                <router-link class="w-100" to="/friends"><v-list-item prepend-icon="mdi-account-multiple" title="Друзья" value="starred" class="w-100"></v-list-item></router-link>
                </v-list>
                <v-divider></v-divider>
                <v-list>
                    <router-link to="/profile">
                    <v-list-item v-if="this.$store.state.avatar === 'NULL' || this.$store.state.avatar === '../uploads/undefined'"
                    prepend-avatar="img/no_avatar.jpg"
                    :title="this.$store.state.user.name + ' ' + this.$store.state.user.surname"
                    :subtitle="this.$store.state.user.email"
                ></v-list-item>
                    <v-list-item v-else
                    :prepend-avatar="this.$store.state.avatar"
                    :title="this.$store.state.user.name + ' ' + this.$store.state.user.surname"
                    :subtitle="this.$store.state.user.email"
                ></v-list-item>
                </router-link>
                </v-list>
            </v-navigation-drawer>
            <v-main style="height: 100%"></v-main>
            </v-layout>
        </v-card>
    </div>

</template>

<script>
export default {
    data() {
        return {
            token: "",
            name: "",
            surname: "",
            width: window.innerWidth,
            rail: true,
            drawer: true,
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
        this.getSurname();
        this.getAvatar();
        this.getEmail();
        window.addEventListener("resize", function(){
            let width_window = this.innerWidth;
            // if(width_window < 1280){
            //     document.getElementById('navig').style.display = 'none'
            //     document.getElementById('navig2').style.display = 'block'
            // }
            // console.log(width_window);
            // if(width_window >= 768){
            //     document.getElementById('navig').style.display = 'flex'
            //     document.getElementById('navig').style.opacity = '1'
            // }else{
            //     document.getElementById('navig').style.display = 'none'
            //     document.getElementById('burger').style.display = 'block'
            //     document.getElementById('navig').style.opacity = '0'
            //     document.getElementById('burger').style.opacity = '1'
            // }
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
        getSurname() {
            this.$store.state.user.surname = localStorage.getItem("surname");
        },
        getAvatar() {
            this.$store.state.avatar = localStorage.getItem("avatar");
        },
        getEmail() {
            this.$store.state.user.email = localStorage.getItem("email");
        },
        display(){
            // if(document.getElementById('navig').style.opacity == '1'){
            //     document.getElementById('navig').style.opacity = '0'
            //     document.getElementById('navig').style.display = 'none'
            // }else{
            //     document.getElementById('navig').style.opacity = '1'
            //     document.getElementById('navig').style.display = 'flex'
            // }
        }
    },
};
</script>

<style scoped>
.v-navigation-drawer__content{
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-items: space-between;
}
.navig{
    display: block;
}
.navig2{
    display: none;
}
.navig2:hover{
    cursor: pointer;
}
@media screen and (max-width: 1280px){
    .navig2{
        display: block;
    }
    .navig{
        display: none;
    }
}
</style>
