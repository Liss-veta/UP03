<template>
        <div
            v-if="
                this.$route.path === '/register' ||
                this.$route.path === '/login' ||
                this.$route.path === '/'
            "
        ></div>
        <div v-else>
            <HeaderComponentVue v-if="this.$route.path !== '/admin'"></HeaderComponentVue>
            <div class="d-flex justify-center w-100">
                <div class="w-75 mt-8 d-flex justify-space-around justify-sm-space-between justify-md-space-between justify-lg-space-around justify-xl-space-around align-center pa-6">
                    <div class="d-flex w-75">
                        <v-btn  v-if="this.$route.path !== '/admin'" icon class="mr-3 mr-sm-4 mr-md-4 mr-lg-4 mr-xl-4 bg-transparent" @click="$router.go(-1)">
                            <v-icon color="pink-lighten-4">mdi-arrow-left</v-icon>
                        </v-btn>
                        <h1 v-if="this.$route.path === '/message'" class=" d-sm-none d-md-block d-lg-block text-h4 text-sm-h2 text-md-h2 text-lg-h2 text-xl-h2 text-pink-lighten-4 ">Сообщения</h1>
                        <h1 v-else-if="this.$route.path === '/friends'" class=" d-sm-none d-md-block d-lg-block text-h4 text-sm-h2 text-md-h2 text-lg-h2 text-xl-h2 text-pink-lighten-4">Друзья</h1>
                        <h1 v-else-if="this.$route.path === '/news'" class=" d-sm-none d-md-block d-lg-block text-h4 text-sm-h2 text-md-h2 text-lg-h2 text-xl-h2 text-pink-lighten-4 ">Новости</h1>
                        <h1 v-else-if="this.$route.path === '/admin'" class=" d-sm-none d-md-block d-lg-block text-h4 text-sm-h2 text-md-h2 text-lg-h2 text-xl-h2 text-pink-lighten-4 ">Админка</h1>
                        <h1 v-else class="text-pink-lighten-4 pl-16"></h1>
                    </div>
                    <div class="d-flex justify-end w-25">
                        <div class="w-100 d-flex justify-end">
                                <button  @click.prevent="logout" class="click">
                                    <img src="img/exit.png" alt="">
                                </button>
                            <div>
                                
                            </div>
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
                            this.$route.path === '/'
                        "
                    ></div>
            </div>
        </div>
</template>
<script>
import HeaderComponentVue from "../../components/header_footer/HeaderComponent.vue";
export default {
    data(){
        return {
            loading: false,
            items: [],
            search: null,
            select: null,
            users: [],
            states: [
                // 'Alabama',
                // 'Alaska',
                // 'American Samoa',
                // 'Arizona',
                // 'Arkansas',
                // 'California',
                // 'Colorado',
                // 'Connecticut',
                // 'Delaware',
                // 'District of Columbia',
                // 'Federated States of Micronesia',
                // 'Florida',
                // 'Georgia',
                // 'Guam',
                // 'Hawaii',
                // 'Idaho',
                // 'Illinois',
                // 'Indiana',
                // 'Iowa',
                // 'Kansas',
                // 'Kentucky',
                // 'Louisiana',
                // 'Maine',
                // 'Marshall Islands',
                // 'Maryland',
                // 'Massachusetts',
                // 'Michigan',
                // 'Minnesota',
                // 'Mississippi',
                // 'Missouri',
                // 'Montana',
                // 'Nebraska',
                // 'Nevada',
                // 'New Hampshire',
                // 'New Jersey',
                // 'New Mexico',
                // 'New York',
                // 'North Carolina',
                // 'North Dakota',
                // 'Northern Mariana Islands',
                // 'Ohio',
                // 'Oklahoma',
                // 'Oregon',
                // 'Palau',
                // 'Pennsylvania',
                // 'Puerto Rico',
                // 'Rhode Island',
                // 'South Carolina',
                // 'South Dakota',
                // 'Tennessee',
                // 'Texas',
                // 'Utah',
                // 'Vermont',
                // 'Virgin Island',
                // 'Virginia',
                // 'Washington',
                // 'West Virginia',
                // 'Wisconsin',
                // 'Wyoming',
            ],
        }
    },
    components: { HeaderComponentVue },

    computed: {
        headerTab() {
            if (this.$route.path === "/register") {
                HeaderComponentVue;
            }
        },
    },
    watch: {
      search (val) {
        val && val !== this.select && this.querySelections(val)
      },
    },
    mounted(){
        axios.get('/api/all_users')
        .then(res => {
            for (let index = 0; index < res.data.length; index++) {
                this.states.push(res.data[index]['name']+" "+res.data[index]['surname'])
                
            }
        })
    },
    methods:{
        querySelections (v) {
        this.loading = true
        // Simulated ajax query
        setTimeout(() => {
          this.items = this.states.filter(e => {
            return (e || '').toLowerCase().indexOf((v || '').toLowerCase()) > -1
          })
          this.loading = false
        }, 500)
      },
        logout() {
            axios.post("/logout").then((res) => {
                localStorage.removeItem("x_xsrf_token");
                localStorage.removeItem("name");
                localStorage.removeItem("avatar");
                localStorage.removeItem("surname");
                localStorage.removeItem("email");
                localStorage.removeItem("id");
                localStorage.removeItem("password");
                localStorage.removeItem("age");
                localStorage.removeItem("city");
                this.$router.push("/");
                // console.log(res);
            });
        },
    }
}
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
.v-input__append > .v-icon {
    font-size: 48px;
    text-align: center;

}
.v-input__append{
    padding: 0;
}
</style>
