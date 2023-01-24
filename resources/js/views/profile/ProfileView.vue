<template>
    <div>
        <DashboardComponent />
        <div class="d-flex align-center flex-column w-100" v-for="(post, index) in posts" :key="index">
            <div class="w-75 mt-10">
                <v-card class="bg-transparent">
                    <div class="post d-flex flex-row">
                        <v-tabs v-model="post.tab" direction="vertical" color="pink-lighten-4"
                            class="d-flex flex-column justify-space-between">
                            <v-btn variant="outline" color="pink-lighten-4"
                                class="h-33 d-flex flex-column align-center justify-center"
                                @click.prevent="addLike(post.id, index)">
                                <!-- <v-icon start>
                                  mdi-heart-outline
                                </v-icon> -->
                                <v-icon start>
                                    mdi-heart
                                </v-icon>
                                <span> {{ post.countLikes }} </span>
                            </v-btn>
                            <v-tab class="h-33 d-flex align-center justify-center" value="option-1">
                                <v-icon large>
                                    mdi-post
                                </v-icon>
                            </v-tab>
                            <v-tab value="option-2" class="h-33 d-flex align-center justify-center">
                                <v-icon>
                                    mdi-comment-account
                                </v-icon>
                            </v-tab>
                        </v-tabs>
                        <v-window class="w-100" v-model="post.tab">
                            <v-window-item class="h-auto big_height" value="option-1">
                                <v-card class="h-auto bg-pink-lighten-3"
                                    style="align-self: stretch; align-content: stretch;" variant="tonal">
                                    <v-card-text class="w-100 d-flex px-12 py-8">
                                        <div class="w-50">
                                            <div class="d-flex w-75 align-center mb-4">
                                                <router-link class="d-flex align-center text-black"
                                                    v-if="id != post.id_user" :to="{ path: '/user/' + post.id_user }">
                                                    <v-avatar size="90" class="mr-4"
                                                        v-if="post.users.avatar == 'NULL' || post.users.avatar == '../uploads/undefined'"
                                                        image="img/no_avatar.jpg"></v-avatar>
                                                    <v-avatar size="90" class="mr-4" v-else
                                                        :image="post.users.avatar"></v-avatar>
                                                    <h4 class="text-h5 ">{{
                                                        post.users.name + " " + post.users.surname
                                                    }}</h4>
                                                </router-link>
                                                <router-link class="d-flex align-center text-black" v-else
                                                    to="/dashboard">
                                                    <v-avatar size="90" class="mr-4"
                                                        v-if="post.users.avatar == 'NULL' || post.users.avatar == '../uploads/undefined'"
                                                        image="img/no_avatar.jpg"></v-avatar>
                                                    <v-avatar size="90" class="mr-4" v-else
                                                        :image="post.users.avatar"></v-avatar>
                                                    <h4 class="text-h5 ">{{
                                                        post.users.name + " " + post.users.surname
                                                    }}</h4>
                                                </router-link>
                                            </div>
                                            <div class="d-flex justify-space-between mr-8">
                                                <p class="text-disabled mb-4">{{ getHumanDate(post.created_at) }}</p>
                                                <div>
                                                    <v-btn color="indigo" variant="plain">
                                                        Edit
                                                    </v-btn>
                                                    <v-btn color="error" variant="plain"
                                                        @click.prevent="delete_post(id = post.id)">
                                                        Delete
                                                    </v-btn>
                                                </div>

                                            </div>

                                            <p class="text-body-1 mb-4 pr-12 text-justify d-flex align-center">
                                                {{ post.text }}
                                            </p>
                                            <v-chip color="indigo" label variant="tonal">
                                                {{ post.category }}
                                            </v-chip>
                                        </div>
                                        <div v-if="post.items.length > 1" class="w-50 align-stretch" style="max-height: 25vw;">
                                            <v-carousel style="height: 100%" :show-arrows="false">
                                                <v-carousel-item v-for="item in post.items" :key="item" :src="item" cover></v-carousel-item> 
                                            </v-carousel>
                                            </div>
                                            <div v-else-if="post.items.length == 1" class="w-50 align-stretch" style="max-height: 25vw;">
                                                <img :src="post.items[0]" class="w-100 h-100" style="object-fit: cover" alt="">
                                            </div>
                                            <div v-else>
                                                <iframe width="560" height="315" :src="post.video_url" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen><img :src="post.preview" alt=""></iframe>
                                            </div>
                                    </v-card-text>
                                </v-card>
                            </v-window-item>
                            <v-window-item class="w-100 min_height" value="option-2">
                                <v-card style="align-self: stretch; align-content: stretch;"
                                    class="h-100 bg-pink-lighten-3" flat>
                                    <v-card-text class="h-100" style="min-height: 25vw;">
                                        <div class="d-flex w-100 align-center mb-4" v-if="post.comments.length != 0">
                                            <v-banner lines="three w-100" class="bg-transparent d-flex flex-column" v-for="comment in post.comments" :key="comment">
                                                <div class="d-flex align-center justify-space-between mb-2">
                                                <div class="d-flex align-center">
                                                    <router-link class="d-flex align-center text-black" v-if="id != comment.user.id"
                                                :to="{ path: '/user/' + comment.user.id }">
                                                <v-avatar size="50" class="mr-4"
                                                    v-if="comment.user.avatar == 'NULL' || comment.user.avatar == '../uploads/undefined'"
                                                    image="img/no_avatar.jpg"></v-avatar>
                                                <v-avatar size="50" class="mr-4" v-else :image="comment.user.avatar"></v-avatar>
                                                <h4 class="text-h6 ">{{ comment.user.name + " " + comment.user.surname }}</h4>
                                                </router-link>
                                                <router-link class="d-flex align-center text-black" v-else to="/profile">
                                                <v-avatar size="50" class="mr-4"
                                                    v-if="comment.user.avatar == 'NULL' || comment.user.avatar == '../uploads/undefined'"
                                                    image="img/no_avatar.jpg"></v-avatar>
                                                <v-avatar size="50" class="mr-4" v-else :image="comment.user.avatar"></v-avatar>
                                                    <h4 class="text-h6 ">{{ comment.user.name + " " + comment.user.surname }}</h4>
                                                </router-link>
                                                </div>
                                                    <p class="text-disabled mb-4 mr-2">{{ getHumanDate(comment.created_at) }}</p>
                                                </div>
                                                <p class="pl-2">{{ comment.comm }}</p>
                                            </v-banner>
                                        </div>
                                        <div v-else>
                                            Комментарии отсутствуют
                                        </div>
                                        <div class="d-flex">
                                            <v-text-field class="w-90" label="Оставьте комментарий"
                                                hint="какой должен быть коммент" v-model="comm"></v-text-field>
                                            <v-btn class="py-2 mt-3 ml-4" color="indigo" variant="outlined" icon
                                                size="small" @click.prevent="add_comm(id_post = post.id)">
                                                <v-icon>mdi-send</v-icon></v-btn>
                                        </div>
                                    </v-card-text>
                                </v-card>
                            </v-window-item>
                        </v-window>
                    </div>
                </v-card>
            </div>
        </div>
    </div>
</template>

<script>
import DashboardComponent from '../../components/autorization/DashboardComponent.vue';
import moment from 'moment';
export default {
    data() {
        return {
            items: [
                // {
                //   src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
                // },
                // {
                //   src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
                // },
                // {
                //   src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
                // },
                // {
                //   src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
                // },
            ],
            text: '',
            category: '',
            file: '',
            posts: [],
            comm: '',
            id: localStorage.getItem('id')
        };
    },
    components: {
        DashboardComponent,
    },
    mounted() {
        document.title = 'Профиль',
            this.all_post();
            // output_comm();
    },
    methods: {
        add_comm(id_post) {
            let formData = new FormData();
            formData.append('comm', this.comm);
            formData.append('id_post', this.id_post);
            axios.post('/api/add_comm', formData)
                .then(res => {
                    this.comm = '';
                    // this.output_comm();
                })
        },
        // output_comm() {
        //     axios.get('/api/output_comm')
        //         .then(res => {
        //             // console.log(res.data);
        //             this.comments = res.data;
        //         })
        // },
        delete_post(id) {
            axios.post(`/api/delete_post/${id}`)
                .then(res => {
                    this.all_post()
                })
        },
        all_post() {
            axios.get('/api/user_post')
                .then(res => {
                    this.posts = res.data.data;
                    // console.log(this.posts);
                    this.posts.forEach(post => {
                        post.tab = "option-1";
                        post.countLikes = post.likes.length;
                    });
                    for (let index = 0; index < this.posts.length; index++) {
                        this.posts[index]['items'] = res.data.data[index]['images'].split(',');
                        this.posts[index]['items'].pop();
                        // console.log(this.items);               
                    }
                })
        },
        addLike(idPost, index) {
            axios.post('/api/likes/create', {
                'id_post': idPost
            }).then(res => {
                this.posts[index].countLikes = res.data.count;
            });
        },
        getHumanDate: function (date) {
            return moment(date).fromNow();
        },
    }
}
</script>

<style scoped>
.w-90 {
    width: 90%;
}

.w-20 {
    width: 20%;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity .5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.v-carousel {
    height: 100%
}

.bd {
    background-color: #0f1546;
}

.v-btn.v-btn--density-default {
    height: 33%;
}

.h-33 {
    height: 33%;
}

.post {
    height: auto;
}

.v-slide-group__content {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>
