<template>
    <div class="background">
        <form>
            <div class="d-flex w-100 justify-space-around">
                <div class="w-50 d-flex justify-center flex-column align-center">
                    <v-text-field class="w-75" v-model="name" type="text" label="Имя"></v-text-field>
                    <v-text-field class="w-75" v-model="surname" type="text" label="Фамилия"></v-text-field>
                    <v-text-field class="w-75" v-model="email" type="text" label="Электронная почта"></v-text-field>
                </div>
                <div class="w-50 d-flex justify-center flex-column align-center">
                    <v-text-field class="w-75" v-model="age" type="text" label="Возраст"></v-text-field>
                    <v-text-field class="w-75" v-model="city" type="text" label="Город"></v-text-field>
                    <v-text-field class="w-75" v-model="password" required type="password" label="Пароль"></v-text-field>
                </div>

            </div>


            <!-- <input type="text" placeholder="Имя" />
            <input v-model="surname" placeholder="Имя" />
            <input v-model="email" type="text" placeholder="Email" />
            <input v-model="password" required type="password" placeholder="Пароль" />
            <input v-model="age" type="text" placeholder="Введите ваш возраст" />
            <input v-model="city" type="text" placeholder="Ваш город" /> -->
            <button v-on:click.prevent="changeInfoUser(); dop_info();">Сохранить</button>
        </form>
    </div>
    <!-- <div class="background">
        <form>
            <h2>Заполните информацию о себе</h2>
            <button @click.prevent="dop_info">Отправить</button>
        </form>

    </div> -->
</template>

<script>
export default {
    data() {
        return {
            file: "",
            id: "",
            avatar: "",
            name: localStorage.getItem("name"),
            surname: localStorage.getItem("surname"),
            email: localStorage.getItem("email"),
            age: localStorage.getItem("age"),
            city: localStorage.getItem("city"),
            users: []
        };
    },

    mounted() {
        this.getId();
        this.getName();
        this.getSurname();
        this.getEmail();

        axios.get('/api/all_users')
            .then(res => {
                console.log(res.data);
                this.users = res.data;
            })
    },

    methods: {
        changeInfoUser() {
            let formData = new FormData();
            this.getId();
            formData.append("id", this.id);
            formData.append("name", this.name);
            formData.append("surname", this.surname);
            formData.append("email", this.email);
            formData.append("password", this.password);
            axios
                .post("/api/changeInfoUser", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    localStorage.setItem("name", this.name);
                    localStorage.setItem("surname", this.surname);
                    localStorage.setItem("email", this.email);
                    localStorage.setItem("password", this.password);
                    this.name = localStorage.getItem("name");
                    this.surname = localStorage.getItem("surname");
                    this.email = localStorage.getItem("email");
                    this.getName();
                    this.getSurname();
                    this.getEmail();
                });

        },

        dop_info() {
            let formData = new FormData();
            this.getId();
            formData.append("id", this.id);
            formData.append("age", this.age);
            formData.append("city", this.city);
            axios.post("/api/dop_info", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    localStorage.setItem("age", this.age);
                    localStorage.setItem("city", this.city);
                    this.age = localStorage.getItem("age");
                    this.city = localStorage.getItem("city");
                    this.getAge();
                    this.getCity();
                });

        },

        submitFile() {
            let formData = new FormData();
            formData.append("file", this.file);
            this.getId();
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
                })
                .catch(function () {
                    console.log("FAILURE!!");
                });
        },

        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },

        getId() {
            this.id = localStorage.getItem("id");
        },

        getName() {
            this.$store.state.user.name = localStorage.getItem("name");
        },

        getAge() {
            this.$store.state.user.age = localStorage.getItem("age");
        },

        getCity() {
            this.$store.state.user.city = localStorage.getItem("city");
        },

        getSurname() {
            this.$store.state.user.surname = localStorage.getItem("surname");
        },

        getEmail() {
            this.$store.state.user.email = localStorage.getItem("email");
        },
    },
};
</script>

<style scoped>
.background {
    width: 60vw;
    color: white;
}
h2 {
    font-size: 24px;
    font-family: "Comfortaa", serif;
}
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    margin: 40px 0;
}
input {
    width: 80%;
    height: 60px;
    background: #1d2023;
    border-bottom: 2px solid #f8bbd0 ;
    color: white;
    font-size: 20px;
    padding-left: 20px;
}
/* #file{
        width: 80%;
        height: 60px;
        background: #1D2023;
        border: 2px #AF3131 solid;
        border-radius: 9px;
        color: white;
    } */
input::placeholder {
    color: white;
    font-size: 20px;
}
button {
    width: 350px;
    height: 45px;
    background: #1d2023;
    border: 2px #f8bbd0 solid;
    border-radius: 9px;
    color: white;
    font-size: 16px;
    font-family: "Comfortaa", serif;
    transition: 0.5s;
}
button:hover {
    background: #f8bbd0;
    color: #1d2023;
    cursor: pointer;
}
@media screen and (max-width: 900px) {
    button{
        width: 80%;
    }
}
@media screen and (max-width: 540px) {
    .background{
        width: 100%;
    }
}
</style>
