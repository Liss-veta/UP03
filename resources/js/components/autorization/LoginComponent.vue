<template>
    <div class="d-flex justify-center align-center h-100vw">
        <div class="w-50 h-50vw bg-pink-lighten-4 d-flex align-center justify-space-between ">
            <div class="h-100 d-flex flex-column justify-space-between">
                <h1 class="pt-8 text-h2 w-100 text-center">Ithiantes</h1>
                <img class="w-90 logo-auth" src="img/logo-gol.png" alt="">
            </div>
            <form class="w-65 d-flex flex-column justify-center">
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    label="Электронная почта"
                    append-inner-icon="mdi-email"
                    v-model="email"
                ></v-text-field>
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    type="password"
                    label="Введите пароль"
                    append-inner-icon="mdi-lock"
                    v-model="password"
                ></v-text-field>
                <div class="d-flex align-center ma-auto pt-4">
                    <v-btn @click.prevent="login">
                        Войти
                    </v-btn>
                    <p>или <router-link to="/register">зарегистрируйтесь</router-link></p>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    name: "Login",

    data() {
        return {
            email: null,
            password: null,
        };
    },
    mounted() {
        document.title = "Войти";
    },

    methods: {
        login() {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/login", {
                        email: this.email,
                        password: this.password,
                    })
                    .then((r) => {
                        console.log(r);
                        // this.email = "";
                        // this.password = "";


                        if (r.data["role"] == 0) {
                            localStorage.setItem(
                                "x_xsrf_token",
                                r.config.headers["X-XSRF-TOKEN"]
                            );

                            localStorage.setItem("name", r.data["name"]);
                            localStorage.setItem("surname", r.data["surname"]);
                            localStorage.setItem("email", r.data["email"]);
                            localStorage.setItem("id", r.data["id"]);
                            localStorage.setItem("avatar", r.data["avatar"]);
                            localStorage.setItem("age", r.data["age"]);
                            localStorage.setItem("city", r.data["city"]);
                            this.$router.push("/profile");
                        } else if(r.data["role"] == 1){
                            localStorage.setItem(
                                "x_xsrf_token",
                                r.config.headers["X-XSRF-TOKEN"]
                            );

                            localStorage.setItem("name", r.data["name"]);
                            localStorage.setItem("surname", r.data["surname"]);
                            localStorage.setItem("email", r.data["email"]);
                            localStorage.setItem("id", r.data["id"]);
                            localStorage.setItem("avatar", r.data["avatar"]);
                            localStorage.setItem("age", r.data["age"]);
                            localStorage.setItem("city", r.data["city"]);
                            this.$router.push("/admin");
                        } else if(r.data["role"] == 2){
                            console.log('Вы забанены!');
                            this.$router.push("/login");
                        }
                    })
            });
        },
    },
};
</script>

<style>
</style>
