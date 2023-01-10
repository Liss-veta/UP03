<template>
    <div class="d-flex justify-center align-center h-100vw">
        <div class="w-50 h-50vw bg-pink-lighten-4 d-flex align-center">
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
                ></v-text-field>
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    label="Ваше имя"
                    append-inner-icon="mdi-account"
                ></v-text-field>
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    type="password"
                    label="Придумайте пароль"
                    append-inner-icon="mdi-lock"
                ></v-text-field>
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    type="password"
                    label="Повторите пароль"
                    append-inner-icon="mdi-lock"
                ></v-text-field>
                <v-checkbox
                    v-model="ex4"
                    label="Нажимая на кнопку, я соглашаюсь с политикой конфинденциальности"
                    color="indigo-darken-3"
                    value="indigo-darken-3"
                    class="w-75 mx-auto"
                    hide-details
                ></v-checkbox>
                <div class="d-flex align-center ma-auto pt-4">
                    <v-btn>
                        Создать
                    </v-btn>
                    <p>или <router-link to="/login">войдите в систему</router-link></p>
                </div>
            </form>
        </div>
        <!-- <div class="form">
            <div style="width: 80%">
                <router-link to="/"
                    ><img src="img/logo.png" alt=""
                /></router-link>
                <p class="welcome">Добро пожаловать!!!</p>
                <h1>Регистрация</h1>
            </div>

            <form>
                <div>
                    <label for="name">Имя</label>
                    <input
                        v-model="name"
                        type="text"
                        name="name"
                        placeholder="Введите имя"
                    />
                </div>

                <div>
                    <label for="surname">Фамилия</label>
                    <input
                        v-model="surname"
                        type="text"
                        name="surname"
                        placeholder="Введите фамилию"
                    />
                </div>

                <div>
                    <label for="email">Email</label>
                    <input
                        v-model="email"
                        type="email"
                        name="email"
                        placeholder="Введите почту"
                    />
                </div>

                <div>
                    <label for="password">Пароль</label>
                    <input
                        v-model="password"
                        type="password"
                        name="password"
                        placeholder="Придумайте пароль"
                    />
                </div>

                <div>
                    <label for="password_confirmation">Повторите пароль</label>
                    <input
                        v-model="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Повторите пароль"
                    />
                </div>

                <button @click.prevent="register">Зарегистрироваться ⇀</button>
                <p>
                    Уже есть аккаунт?
                    <router-link to="/login" href="">Войдите</router-link>
                </p>
            </form>
        </div>
        <div class="people">
            <img src="img/people_reg_log.png" alt="" />
        </div> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            surname: "",
            email: "",
            password: "",
            password_confirmation: "",
        };
    },

    mounted() {
        document.title = "Регистрация";
    },

    methods: {
        register() {
            axios.get("/sanctum/csrf-cookie").then((Response) => {
                axios
                    .post("/register", {
                        name: this.name,
                        surname: this.surname,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                    })
                    .then((r) => {
                        console.log(r);
                        this.name = "";
                        this.surname = "";
                        this.email = "";
                        this.password = "";
                        this.password_confirmation = "";
                        localStorage.setItem(
                            "x_xsrf_token",
                            r.config.headers["X-XSRF-TOKEN"]
                        );
                        localStorage.setItem("name", r.data["name"]);
                        localStorage.setItem("surname", r.data["surname"]);
                        localStorage.setItem("email", r.data["email"]);
                        localStorage.setItem("id", r.data["id"]);
                        localStorage.setItem("avatar", r.data["avatar"]);
                        localStorage.setItem("adress", r.data["adress"]);
                        localStorage.setItem("number", r.data["number"]);
                        this.$router.push("/dashboard");
                    });
            });
        },
    },
};
</script>

<style>
.w-90{
    width: 80%;
}
.w-65{
    width: 55%;
}
.h-50vw{
    height: 70vh;
}
.h-100vw{
    height: 100vh;
}
.v-selection-control--inline .v-label {
    font-size: 14px;
}
.logo-auth{
    object-fit: contain;
    align-self: flex-end;
    justify-self: start;
}
</style>
