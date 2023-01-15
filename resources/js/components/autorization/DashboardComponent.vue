<template>
    <div class="w-100 d-flex justify-end flex-column">
        <div class="w-100 bg-grad d-flex flex-column justify-end align-end pb-4">
            <h2 class="text-h3 mb-2 w-60"><span>{{ this.$store.state.user.name + ' ' + this.$store.state.user.surname}}</span>, <span v-if="this.$store.state.user.age != 'NULL' || this.$store.state.user.age != 'undefined'">{{ this.$store.state.user.age }}</span></h2>
            <h3 class="text-h4 w-60" v-if="this.$store.state.user.city != 'NULL'">{{this.$store.state.user.city}}</h3>
        </div>
        <div class="d-flex flex-row align-end">
            <img class="avatar" src="img/no_avatar.jpg"
                v-if="
                    this.$store.state.avatar === 'NULL' ||
                    this.$store.state.avatar === 'undefined'"
                alt=""/>
            <img class="avatar" :src="this.$store.state.avatar"
                alt=""  v-else />
            <img v-on:click="edit = 'show'" class="edit_avatar"
                src="img/Edit Profile.png" alt="" />
        </div>
        <div class="w-100 d-flex justify-end">
            <div class="w-60 d-flex justify-space-between">
                <v-btn variant="outlined" color="pink-lighten-4" class="w-25 mt-n12" v-on:click="edit_data = 'show'">Редактировать профиль</v-btn>
                <div class="w-50 mt-min text-pink-lighten-4 d-flex text-h4 justify-space-around mr-12">
                    <p class="d-flex flex-column align-center">
                        <span>{{ col_true }}</span>
                        <span>дру{{ ending }}</span>
                    </p>
                    <p class="d-flex flex-column align-center">
                        <span>55</span>
                        <span>друзей</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
     <div class="d-f">
        <div class="all_info">
             <!-- <div class="info_user"> -->
                <transition name="bounce">
                    <div v-if="edit == 'show'" class="modal_bg">
                        <div class="modal">
                            <div class="modal_header">
                                <img
                                    v-on:click="edit = 'none'"
                                    src="img/Close.png"
                                    alt=""
                                />
                            </div>
                            <div class="modal_body">
                                <img
                                    class="avatar"
                                    src="img/no_avatar.jpg"
                                    v-if="
                                        this.$store.state.avatar === 'NULL' ||
                                        this.$store.state.avatar === 'undefined'
                                    "
                                    alt=""
                                />
                                <img
                                    class="avatar ml-0"
                                    :src="this.$store.state.avatar"
                                    alt=""
                                    v-else
                                />
                                <label for="file">Выберите аватарку</label>
                                <input
                                    type="file"
                                    id="file"
                                    ref="file"
                                    required
                                    v-on:change="handleFileUpload()"
                                />
                                <p v-show="file.name">{{ file.name }}</p>
                                <button @click.prevent="submitFile()">
                                    Загрузить
                                </button>
                            </div>
                        </div>
                    </div>
                </transition>

                <!-- <p>
                    {{ this.$store.state.user.name }}
                </p>
                <p>{{ this.$store.state.user.email }}</p>
            </div> -->
        </div>
        <div>
            <!-- <div>
                <p class="pagination">
                    <router-link to="/"> Главная </router-link> / Профиль / {{ pagination }}
                </p>
                <h2>Профиль</h2>
            </div> -->
            <div class="info_data">
                <transition name="bounce">
                    <div v-if="edit_data == 'show'" class="modal_bg">
                        <div class="modal">
                            <div class="modal_header">
                                <img
                                    v-on:click="edit_data = 'none'"
                                    src="img/Close.png"
                                    alt=""
                                />
                            </div>
                            <div class="modal_body">
                                <ChangeComponent v-if="show == 'change'"></ChangeComponent>
                                <DataOrderComponent
                                    v-else-if="show == 'data_order'"
                                ></DataOrderComponent>
                            </div>
                        </div>
                    </div>
                </transition>
                <transition name="slide-fade" mode="out-in">

                </transition>
            </div>
        </div>
    </div>
</template>

<script>
import HeaderComponent from "../header_footer/HeaderComponent.vue";
import ChangeComponent from "./ChangeComponent.vue";
import DataOrderComponent from "./DataOrderComponent.vue";
export default {
    components: {
        ChangeComponent,
        DataOrderComponent,
    },

    data() {
        return {
            edit: "none",
            name: "",
            surname: "",
            email: "",
            file: "",
            id: "",
            avatar: "",
            show: "change",
            pagination: " Изменить данные",
            edit_data: "none",
            col_true: 0,
            ending: ''
        };
    },

    mounted() {
        if (localStorage.getItem("x_xsrf_token")) {
            HeaderComponent.data.token = localStorage.getItem("x_xsrf_token");
        }
        this.getName();
        this.getSurame();
        this.getEmail();
        this.getAvatar();
        this.getId();
        this.getAge();
        this.getCity();
        document.title = this.$store.state.user.name;
        this.showView(this.show);
        this.friends_request()
    },

    computed: {
        counter() {
            return this.review.length;
        },
    },

    methods: {
        getId() {
            this.id = localStorage.getItem("id");
        },

        methodName() {
            this.$emit("avatar");
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
        getName() {
            this.$store.state.user.name = localStorage.getItem("name");
        },

        getSurame() {
            this.$store.state.user.surname = localStorage.getItem("surname");
        },

        getAge() {
            this.$store.state.user.age = localStorage.getItem("age");
        },

        getCity() {
            this.$store.state.user.city = localStorage.getItem("city");
        },

        getEmail() {
            this.$store.state.user.email = localStorage.getItem("email");
        },

        getId() {
            this.id = localStorage.getItem("id");
        },

        getAvatar() {
            this.$store.state.avatar = localStorage.getItem("avatar");
        },

        showView(text) {
            let btns = document.querySelectorAll(".click");
            this.show = text;
            btns.forEach((btn) => {
                btn.classList.remove("active");
                if (btn.id === "changeData" && this.show === "change") {
                    btn.classList.add("active");
                    this.pagination = "Изменить данные";
                } else if (btn.id === "orders" && this.show === "data_order") {
                    btn.classList.add("active");
                    this.pagination = "Данные для заказа";
                } else if (
                    btn.id === "historyOrders" &&
                    this.show === "historyOrders"
                ) {
                    btn.classList.add("active");
                }
            });
        },

        friends_request(){
                axios.get(`/api/friends/${this.id}`)
                    .then(res => {
                            this.requests_0 = res.data[0];
                            this.requests_1 = res.data[1];

                            this.col_true = 0;

                            for (let index = 0; index < res.data.length; index++) {
                                console.log(res.data[index]);
                                if(res.data[index] != 0){
                                    for (let index1 = 0; index1 < res.data[index].length; index1++) {
                                        if(res.data[index][index1]['status'] == 'true'){
                                            this.col_true++;
                                        }                                      
                                    }
                                }                              
                            }

                            if(this.col_true == 1){
                                this.ending = 'г'
                            } 
                            else if(this.col_true > 1 && this.col_true < 5){
                                this.ending = 'га'
                            }
                            else{
                                this.ending = 'зей'
                            }
                    })
            },
    },
};
</script>

<style scoped>
.mt-min {
    margin-top: -7%;
}
.w-60{
    width: 67%;
}
.bg-grad{
    height: 300px;
    background: #7986CB;
}
.bounce-enter-active {
    animation: bounce-in 0.5s;
}
.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.25);
    }
    100% {
        transform: scale(1);
    }
}
.modal_bg {
    width: 100%;
    height: 60vw;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #0000008a;
    /* display: none; */
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal {
    margin-top: 5%;
    padding: 20px;
    width: 60%;
    border: 4px #f8bbd0 solid;
    background: #212529;
    display: flex;
    flex-direction: column;
}
.modal input[type="file"] {
    display: none;
}
.modal label {
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 20px;
    cursor: pointer;
    transition: 0.5s;
}
.modal label:hover {
    background: #f8bbd0;
    color: #212529;
    font-weight: bold;
}
.modal button {
    width: 40%;
    height: 40px;
    background: transparent;
    border: 2px #f8bbd0 solid;
    color: white;
    font-size: 17px;
    font-family: "Comfortaa", serif;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.5s;
}
.modal button:hover {
    background: #f8bbd0;
    color: #212529;
    font-weight: bold;
}
.modal_header img {
    float: right;
    margin: 20px;
    width: 50px;
    cursor: pointer;
}
.modal_body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 1vw;
}
.modal_body label {
    border: 2px #f8bbd0 solid;
    padding: 15px 50px;
    border-radius: 10px;
}
.slide-fade-enter-active {
    transition: all 0.5s ease;
}
.slide-fade-leave-active {
    transition: all 0.5s;
}
.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateX(200px);
    opacity: 0;
}
.d-f {
    margin-top: 100px;
    display: flex;
    align-items: flex-start;
    justify-content: space-evenly;
}
.all_info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.info_user {
    background: rgba(22, 24, 27, 0.7);
    width: auto;
    height: 300px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 25px;
}
.avatar {
    width: 300px;
    height: 300px;
    margin-top: -10%;
    margin-left: 10%;
    border: 2px rgba(255, 255, 255, 0.5) solid;
    object-fit: cover;
}
.edit_avatar {
    border: none;
    cursor: pointer;
    width: 50px;
    height: 50px;
    margin-bottom: -20px;
    margin-left: -30px;
}
.info_user p {
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 20px;
}
.info_user p:last-child {
    font-family: "Roboto", sans-serif;
    font-size: 16px;
}
.click {
    width: 290px;
    height: 85px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    background: rgba(22, 24, 27, 0.7);
}
.active {
    background: rgba(175, 49, 49, 0.58);
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    transition: 0.5s;
}
.click p {
    font-size: 20px;
    font-family: "Comfortaa", serif;
    color: white;
    cursor: pointer;
}
.info_data {
    background: rgba(22, 24, 27, 0.7);
    border-radius: 15px;
    padding: 50px;
    margin-bottom: 100px;
}
.pagination,
a {
    color: #af3131;
    font-size: 18px;
    font-family: "Comfortaa", serif;
}
h2 {
    font-family: "Comfortaa", serif;
    font-size: 32px;
    color: white;
    margin-top: 15px;
    margin-bottom: 30px;
}
@media screen and (max-width: 1025px) {
    .all_info{
        width: 200px;
    }
    .info_user p{
        font-size: 17px;
    }
    .click{
        width: 200px;
    }
    .click p{
        font-size: 17px;
    }
    .avatar{
        width: 100px;
        height: 100px;
    }
}
@media screen and (max-width: 900px) {
    .d-f{
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .all_info{
        width: auto;
    }
    .info_user{
        width: 70vw;
    }
    .click{
        width: 70vw;
    }
    .pagination{
        text-align: center;
        margin-top: 50px;
    }
    h2{
        text-align: center;
        margin-bottom: 50px;
    }
    .info_data{
        padding: 30px;
    }
    .modal_body{
        gap: 10vw;
    }
    .modal label{
        font-size: 17px;
        padding: 2vw 3.5vw;
        text-align: center;
    }
    .modal button{
        padding: 2vw 3.5vw;
        font-size: 13px;
        text-align: center;
    }
}

@media screen and (max-width: 540px) {
    .d-f{
        width: 100%;
    }

}
</style>
