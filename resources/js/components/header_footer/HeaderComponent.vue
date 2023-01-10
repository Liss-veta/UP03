<template>
        <v-card>
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
                <v-list-item prepend-icon="mdi-folder" title="My Files" value="myfiles" class="w-100"></v-list-item>
                <v-list-item prepend-icon="mdi-account-multiple" title="Shared with me" value="shared" class="w-100"></v-list-item>
                <v-list-item prepend-icon="mdi-star" title="Starred" value="starred" class="w-100"></v-list-item>
                </v-list>
                <v-divider></v-divider>
                <v-list>
                <v-list-item
                    prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
                    title="Sandra Adams"
                    subtitle="sandra_a88@gmail.com"
                ></v-list-item>
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
