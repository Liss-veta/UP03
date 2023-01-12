<template>
    <div class="d-flex justify-center align-center h-100vw">
        <div class="w-55 h-50vw bg-pink-lighten-4 d-flex align-center">
            <div class="h-100-log d-flex flex-column justify-space-between">
                <h1 class="pt-2 pt-sm-14 pt-md-14 pt-lg-14 pt-xl-14 text-h2 w-100 text-center">Ithiantes</h1>
                <img class="w-90 logo-auth" src="img/logo-gol.png" alt="">
            </div>
            <form class="w-65 d-flex flex-column justify-center">
                <!-- Input email -->
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    label="Электронная почта"
                    append-inner-icon="mdi-email"
                    v-model="email"
                ></v-text-field>
                <!-- Input name -->
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    label="Ваше имя"
                    append-inner-icon="mdi-account"
                    v-model="name"
                ></v-text-field>
                <!-- Input surname -->
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    label="Ваша фамилия"
                    append-inner-icon="mdi-account"
                    v-model="surname"
                ></v-text-field>
                <!-- Input password -->
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    type="password"
                    label="Придумайте пароль"
                    append-inner-icon="mdi-lock"
                    v-model="password"
                ></v-text-field>
                <!-- Input password confirm -->
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    type="password"
                    label="Повторите пароль"
                    append-inner-icon="mdi-lock"
                    v-model="password_confirmation"
                ></v-text-field>
                <!-- Checkbox politikal -->
                <v-checkbox
                    label="Нажимая на кнопку, я соглашаюсь с политикой конфинденциальности"
                    color="indigo-darken-3"
                    class="w-75 mx-auto"
                    hide-details
                    :model-value="true"
                ></v-checkbox>
                <!-- Button -->
                <div class="w-75 d-flex align-center ma-auto pt-4">
                    <v-btn @click.prevent="register">
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
            email: "",
            surname: "",
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
                        localStorage.setItem("age", r.data["age"]);
                        localStorage.setItem("city", r.data["city"]);
                        this.$router.push("/profile");
                    });
            });
        },
    },
};
</script>

<style>
.w-90{
    width: 90%;
}
.h-100-log{
    height: 100%;
}
.w-65{
    width: 55%;
}
.w-55{
    width: 70%;
}
.h-50vw{
    height: 70%;
    justify-content: space-between
}
.h-100vw{
    height: 100vh;
}
.v-selection-control--inline .v-label {
    font-size: 14px;
    opacity: 60%;
}
.logo-auth{
    object-fit: contain;
    align-self: flex-start;
}
@media screen and (min-width: 1500px){
    .w-65{
        width: 45%;
    }
}
@media screen and (max-width: 1400px){
    .w-55{
        width: 80%;
    }
}
@media screen and (max-width: 1000px){
    .w-55{
        width: 90%;
    }
}
@media screen and (max-width: 800px){
    .w-55{
        width: 100%;
    }
}
@media screen and (max-width: 600px){
    .logo-auth{
        display: none;
    }
    .h-50vw{
        flex-direction: column;
        justify-content: space-evenly;
        height: 90%;
    }
    .h-100-log{
        height: auto;
    }
    .w-65{
        width: 90%;
    }
}
@media screen and (max-width: 400px){
    .w-65{
        width: 100%;
    }
}
</style>
