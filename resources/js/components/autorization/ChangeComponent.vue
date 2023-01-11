<template>
    <div class="background">
        <form>
            <h2>Изенить даные</h2>
            <input v-model="name" type="text" placeholder="Имя" />
            <input v-model="email" type="text" placeholder="Email" />
            <input v-model="password" type="password" placeholder="Пароль" />
            <button @click.prevent="changeInfoUser">Сохранить</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            file: "",
            id: "",
            avatar: "",
            name: localStorage.getItem("name"),
            email: localStorage.getItem("email"),
        };
    },

    mounted() {
        this.getId();
        this.getName();
        this.getEmail();
    },

    methods: {
        changeInfoUser() {
            let formData = new FormData();
            this.getId();
            formData.append("id", this.id);
            formData.append("name", this.name);
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
                    localStorage.setItem("email", this.email);
                    localStorage.setItem("password", this.password);
                    this.name = localStorage.getItem("name");
                    this.email = localStorage.getItem("email");
                    this.getName();
                    this.getEmail();
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

        getEmail() {
            this.$store.state.user.email = localStorage.getItem("email");
        },
    },
};
</script>

<style lang="css" scoped>
.background {
    background: #202428;
    border: 3px #af3131 solid;
    width: 60vw;
    height: auto;
    border-radius: 15px;
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
    gap: 80px;
    margin: 40px 0;
}
input {
    width: 80%;
    height: 60px;
    background: #1d2023;
    border: 2px #af3131 solid;
    border-radius: 9px;
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
    border: 2px #af3131 solid;
    border-radius: 9px;
    color: white;
    font-size: 16px;
    font-family: "Comfortaa", serif;
    transition: 0.5s;
}
button:hover {
    background: #af3131;
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
