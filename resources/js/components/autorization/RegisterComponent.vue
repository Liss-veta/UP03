<template>
    <div class="d-flex justify-center align-center h-100vw">
        <div class="w-55 h-50vw bg-pink-lighten-4 d-flex align-center">
            <div class="h-100-log d-flex flex-column justify-space-between">
                <h1 class="pt-2 pt-sm-14 pt-md-14 pt-lg-14 pt-xl-14 text-h2 w-100 text-center">Ithiantes</h1>
                <img class="w-90 logo-auth" src="img/logo-gol.png" alt="">
            </div>
            <form class="w-65 d-flex flex-column justify-center">
                <!-- Input email -->
                <div :class="{ error: v$.email.$errors.length }">
                    <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    label="Ваша почта"
                    append-inner-icon="mdi-email"
                    v-model="v$.email.$model"
                    ></v-text-field>
                    <div class="w-75 mx-auto text-red input-errors" v-for="(error, index) of v$.email.$errors" :key="index">
                        <div class="error-msg">{{ error.$message }}</div>
                    </div>
                </div>
                <!-- Input name -->
                <div :class="{ error: v$.name.$errors.length }">
                    <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    label="Ваше имя"
                    append-inner-icon="mdi-account"
                    v-model="v$.name.$model"
                ></v-text-field>
                <div class="w-75 mx-auto text-red input-errors" v-for="(error, index) of v$.name.$errors" :key="index">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
                </div>

                <!-- Input surname -->
                <div :class="{ error: v$.surname.$errors.length }">
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    label="Ваша фамилия"
                    append-inner-icon="mdi-account"
                    v-model="v$.surname.$model"
                ></v-text-field>
                <div class="w-75 mx-auto text-red input-errors" v-for="(error, index) of v$.surname.$errors" :key="index">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
                </div>
                <!-- Input password -->
                <div :class="{ error: v$.password.$errors.length }">
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    type="password"
                    label="Придумайте пароль"
                    append-inner-icon="mdi-lock"
                    v-model="v$.password.$model"
                ></v-text-field>
                <div class="w-75 mx-auto text-red input-errors" v-for="(error, index) of v$.password.$errors" :key="index">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
                </div>
                <!-- Input password confirm -->
                <div :class="{ error: v$.password_confirmation.$errors.length }">
                <v-text-field
                    class="w-75 mx-auto"
                    variant="underlined"
                    type="password"
                    label="Повторите пароль"
                    append-inner-icon="mdi-lock"
                    v-model="v$.password_confirmation.$model"
                ></v-text-field>
                <div class="w-75 mx-auto text-red input-errors" v-for="(error, index) of v$.password_confirmation.$errors" :key="index">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
                </div>
                <!-- Checkbox politikal -->
                <v-checkbox
                    label="Нажимая на кнопку, я соглашаюсь с политикой конфинденциальности"
                    color="indigo-darken-3"
                    class="w-75 mx-auto"
                    hide-details
                    required
                    :model-value="true"
                ></v-checkbox>
                <!-- Button   -->

                <v-dialog
                    v-model="dialog"
                    persistent
                    class="d-flex justify-center"
                    >
                <template v-slot:activator="{ props }">
                        <div class="w-75 d-flex align-center ma-auto pt-4">
                                    <v-btn v-bind="props">
                                        Создать
                                    </v-btn>
                                    <p>или <router-link to="/login">войдите в систему</router-link></p>
                                </div>
                </template>
                <v-card class="w-25 bg-pink-lighten-4">
                    <v-card-text class="w-100 pa-10">
                        <v-container>
                            <v-row class="d-flex flex-column">
                                <div :class="{ error: v$.age.$errors.length }">
                                    <v-text-field v-model="v$.age.$model" type="text" label="Возраст"></v-text-field>
                                    <div class="w-75 mx-auto text-red input-errors" v-for="(error, index) of v$.age.$errors" :key="index">
                                        <div class="error-msg">{{ error.$message }}</div>
                                    </div>
                                </div>
                                <div :class="{ error: v$.city.$errors.length }">
                                    <v-text-field v-model="v$.city.$model" type="text" label="Город"></v-text-field>
                                    <div class="w-75 mx-auto text-red input-errors" v-for="(error, index) of v$.city.$errors" :key="index">
                                        <div class="error-msg">{{ error.$message }}</div>
                                    </div>
                                </div>
                            <v-col cols="12">
                                <!-- <label for="file">Выберите аватарку</label> -->
                                <v-file-input type="file"
                                    id="file"
                                    ref="file"
                                    required
                                    v-on:change="handleFileUpload()" clearable label="Выберите аватарку" variant="underlined"></v-file-input>
                                <!-- <p v-show="file.name">{{ file.name }}</p> -->
                                <!-- <button @click.prevent="submitFile()">
                                    Загрузить
                                </button> -->
                            </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="indigo"
                        variant="outline"
                        @click.prevent="register"
                        :disabled="v$.$invalid"
                    >
                    <!-- <button style="opacity: 0" @click.prevent="submitFile()"></button> -->
                        Save
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
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
import useVuelidate from "@vuelidate/core"
import { required, email, minLength, helpers, numeric } from "@vuelidate/validators"
export function validName(name) {
  let validNamePattern = new RegExp("^[а-яА-Я]+(?:[-'\\s][а-яА-Я]+)*$");
  if (validNamePattern.test(name)){
    return true;
  }
  return false;
}

export default {
    data() {
        return {
            file: "",
            dialog: false,
            name: "",
            email: "",
            surname: "",
            password: "",
            password_confirmation: "",
            age: '',
            city: '',
            id: ''
        };
    },
    setup: () => ({ v$: useVuelidate() }),
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
                        age: this.age,
                        city: this.city,
                    })
                    .then((r) => {

                        // console.log(r);
                        this.name = "";
                        this.surname = "";
                        this.email = "";
                        this.password = "";
                        this.password_confirmation = "";
                        this.age = "",
                        this.city = "",
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

                        this.submitFile()
                    });
            });
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },

        submitFile() {
            this.id = localStorage.getItem("id");
            // console.log(this.id)
            let formData = new FormData();
            formData.append("file", this.file);
            formData.append("id", this.id);
            axios
                .post("/api/load-avatar", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((r) => {
                    let fileName = "../uploads/" + this.file.name;
                    localStorage.setItem("avatar", fileName);
                    // console.log(fileName);
                    this.$store.state.avatar = fileName;
                    this.file = "";
                    this.$router.push("/profile");
                })
                .catch(function () {
                    console.log("FAILURE!!");
                });
        },
    },
    validations() {
    return {
        name: {
            required: helpers.withMessage('Обязательное поле для заполнения', required),
            name_validation: {
            $validator: validName,
            $message: 'Недопустимое имя. Допустимое имя содержит только русские буквы, тире (-) и пробелы'
          }
        },
        surname: {
            required: helpers.withMessage('Обязательное поле для заполнения', required),
            name_validation: {
            $validator: validName,
            $message: 'Недопустимая фамилия. Допустимая фамилия содержит только русские буквы, тире (-) и пробелы'
          }
        },
        city: {
            required: helpers.withMessage('Обязательное поле для заполнения', required),
            name_validation: {
            $validator: validName,
            $message: 'Недопустимая фамилия. Допустимая фамилия содержит только русские буквы, тире (-) и пробелы'
          }
        },
        age: {
            required: helpers.withMessage('Обязательное поле для заполнения', required),
            numeric: helpers.withMessage('Только положительные целые числа', numeric)
        },
        email: {
            required: helpers.withMessage('Обязательное поле для заполнения', required),
            email: helpers.withMessage('Значение не является действительным адресом электронной почты', email)
        },
        password: {
            required: helpers.withMessage('Обязательное поле для заполнения', required),
            min: helpers.withMessage('Минимальное количество символов 8', minLength(8))
        },
        password_confirmation: {
            required: helpers.withMessage('Обязательное поле для заполнения', required),
            // sameAsPassword: helpers.withMessage('Пароли не совпадают',sameAs('password'))
        },
      }
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
