<template>
    <div class="d-flex flex-column">
        <div class="w-100 d-flex justify-end flex-column">
            <div class="w-100 bg-grad d-flex flex-column justify-end align-end pb-4">
                <!-- Имя Возраст пользователя друга -->
                <h2 class="text-h3 mb-2 w-60"><span>{{ user['name'] + " " + user['surname'] }}</span>, <span>{{
                user['age'] }}</span></h2>
                <!-- Город пользователя -->
                <h3 class="text-h4 w-60">{{ user['city'] }}</h3>
            </div>
            <div class="d-flex flex-row align-end">
                <img class="avatar" src="../../../../public/img/no_avatar.jpg" v-if="
                user['avatar'] === 'NULL' ||
                user['avatar'] === 'undefined'" alt="" />
                <img class="avatar" :src="user['avatar']" alt="" v-else />
            </div>
        </div>
        <div class="w-100 d-flex justify-end">
            <div class="w-60 d-flex justify-space-between">
                <v-btn :variant="but" color="pink-lighten-4" :disabled="check_add" class="w-25 mt-n12" id="add"
                    @click.prevent="addFriend">{{ request_status }}</v-btn>
                <div class="w-50 text-pink-lighten-4 d-flex text-h4 justify-space-around mr-12 mt-min">
                    <p class="d-flex flex-column align-center">
                        <span>{{ col_true }}</span>
                        <span>дру{{ ending }}</span>
                    </p>
                    <p class="d-flex flex-column align-center">
                        <span>{{ posts_count }}</span>
                        <span>{{ post_ending }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-center flex-column w-100" 
     v-if="request_status != 'В черном списке' && request_status != 'Вы в черном списке'"
     >
     <div class="d-flex align-center flex-column w-100" v-for="(post, index) in posts" :key="index">
      <div class="w-75 mt-10">
        <v-card class="bg-transparent">
          <div class="post d-flex flex-row">
            <v-tabs v-model="post.tab" direction="vertical" color="pink-lighten-4"
              class="d-flex flex-column justify-space-between">
              <v-btn variant="outline" color="pink-lighten-4"
                class="h-33 d-flex flex-column align-center justify-center" @click.prevent="addLike(post.id, index)">
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
                <v-card class="h-auto bg-pink-lighten-3" style="align-self: stretch; align-content: stretch;" variant="tonal">
                  <v-card-text class="w-100 d-flex px-12 py-8">
                    <div class="w-50">
                      <div class="d-flex w-75 align-center mb-4">
                        <router-link class="d-flex align-center text-black" v-if="id != post.id_user"
                          :to="{ path: '/user/' + post.id_user }">
                          <v-avatar size="90" class="mr-4"
                            v-if="post.users.avatar == 'NULL' || post.users.avatar == '../uploads/undefined'"
                            image="img/no_avatar.jpg"></v-avatar>
                          <v-avatar size="90" class="mr-4" v-else :image="post.users.avatar"></v-avatar>
                          <h4 class="text-h5 ">{{ post.users.name + " " + post.users.surname }}</h4>
                        </router-link>
                        <router-link class="d-flex align-center text-black" v-else to="/dashboard">
                          <v-avatar size="90" class="mr-4"
                            v-if="post.users.avatar == 'NULL' || post.users.avatar == '../uploads/undefined'"
                            image="img/no_avatar.jpg"></v-avatar>
                          <v-avatar size="90" class="mr-4" v-else :image="post.users.avatar"></v-avatar>
                          <h4 class="text-h5 ">{{ post.users.name + " " + post.users.surname }}</h4>
                        </router-link>
                      </div>
                      <p class="text-disabled mb-4">{{ getHumanDate(post.created_at) }}</p>
                      <p class="text-body-1 mb-4 pr-12 text-justify d-flex align-center">
                        {{ post.text}}
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
                <v-card style="align-self: stretch; align-content: stretch;" class="h-100 bg-pink-lighten-3" flat>
                  <v-card-text class="h-100 d-flex flex-column justify-space-between" style="min-height: 25vw; max-height: 25vw;">
                    <div class="d-flex flex-column w-100 h-100" style=" overflow-y: auto;">
                        <div class="d-flex flex-column w-100 align-center mb-4" v-if="post.comments.length != 0">
                      <v-banner lines="three w-100" class="bg-transparent d-flex flex-column" v-for="comment in post.comments" :key="comment">
                        <div class="d-flex align-center justify-space-between mb-2">
                          <div class="d-flex align-center">
                            <router-link class="d-flex align-center text-black" v-if="my_id != comment.user.id" :to="{ path: '/user/' + comment.user.id }">
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
                    <div v-else class="ma-auto mt-16 pt-16">
                      <h4 class="text-h5">Комментарии отсутствуют</h4>
                    </div>
                    </div>

                    <div class="d-flex position-sticky">
                      <v-text-field class="w-90" label="Оставьте комментарий" hint="какой должен быть коммент"
                        v-model="comm"></v-text-field>
                      <v-btn class="py-2 mt-3 ml-4" color="indigo" variant="outlined" icon size="small"
                        @click.prevent="add_comm(id_post = post.id)">
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
    <div v-else>
        Вы не можете просматривать записи!
    </div>
</template>

<script>
import moment from 'moment';
export default {
    data() {
        return {
            user: [],
            id: '',
            my_id: localStorage.getItem('id'),
            request_status: 'Добавить в друзья',
            check_add: false,
            but: 'outlined',
            col_true: 0,
            ending: '',
            posts: [],
            comments: [],
            posts_count: 0,
            post_ending: 'постов'
        }
    },
    mounted() {
        this.parseURL()
        this.getUser()
        this.friends_request()
        this.friends_request2()
        this.all_post()
        this.getPosts_user()
    },
    methods: {
        add_comm(_id_post) {
            let formData = new FormData();
            formData.append('comm', this.comm);
            formData.append('id_post', this.id_post);
            axios.post('/api/add_comm', formData)
                .then(_res => {
                    this.comm = '';
                    this.output_comm();
                })
        },
        getHumanDate: function (date) {
            return moment(date).fromNow();
        },
        addLike(idPost, index) {
            axios.post('/api/likes/create', {
                'id_post': idPost
            }).then(res => {
                this.posts[index].countLikes = res.data.count;
            });
        },
        getPosts_user() {
            axios.get(`/api/posts_user_view/${this.id}`)
                .then(res => {
                    this.posts_count = 0
                    this.posts_count = res.data.data.length;
                    // let i = this.posts_count;
                    // if (i > 100) {
                    //     i = i % 100
                    //     if (i == 1) {
                    //         this.post_ending = 'пост'
                    //     }
                    //     else if(i > 1 && i < 5){
                    //         this.post_ending = 'поста'
                    //     }
                    //     else{
                    //         this.post_ending = 'постов'
                    //     }

                    // }
                    // else if (i > 20 && i < 100) {
                    //     i = i % 10
                    //     if (i == 1) {
                    //         this.post_ending = 'пост'
                    //     }
                    //     else if(i > 1 && i < 5){
                    //         this.post_ending = 'поста'
                    //     }
                    //     else{
                    //         this.post_ending = 'постов'
                    //     }

                    // }
                    // else if (i > 10 && i < 20) {
                    //     i = i % 10
                    //         this.post_ending = 'постов'
                    // }
                    // else {
                    //     if (i == 1) {
                    //         this.post_ending = 'пост'
                    //     }
                    //     else if(i > 1 && i < 5){
                    //         this.post_ending = 'поста'
                    //     }
                    //     else{
                    //         this.post_ending = 'постов'
                    //     }
                    // }
                })
        },
        all_post() {
            axios.get(`/api/posts_user_view/${this.id}`)
                .then(res => {
                    this.posts = res.data.data;
                    console.log(this.posts);
                    this.posts.forEach(post => {
                        post.tab = null;
                        post.countLikes = post.likes.length;
                    });
                    for (let index = 0; index < this.posts.length; index++) {
                        this.posts[index]['items'] = res.data.data[index]['images'].split(',');
                        this.posts[index]['items'].pop();
                        // console.log(this.items);               
                    }
                })
        },
        getUser() {
            axios.get(`/api/view/${this.id}`)
                .then(res => {
                    this.user = res.data
                    document.title = this.user['name']
                })
        },

        parseURL() {
            let url = window.location.pathname
            this.id = url.split('/')[2]
        },

        addFriend() {
            let formData = new FormData();
            formData.append('id_user', localStorage.getItem('id'));
            formData.append('id_friend', this.user['id']);
            axios.post('/api/addFriend', formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                },
            )
                .then(_res => {
                    // console.log(res);
                    this.friends_request()
                })
        },

        friends_request2() {
            axios.get(`/api/friends/${this.id}`)
                .then(res => {
                    this.col_true = 0;
                    // console.log(res.data);
                    for (let index = 0; index < res.data.data.length; index++) {
                        if (res.data.data[index] != 0) {
                            if (res.data.data[index]['status'] == 'true') {
                                this.col_true++;
                            }
                        }
                    }

                    if (this.col_true == 1) {
                        this.ending = 'г'
                    }
                    else if (this.col_true > 1 && this.col_true < 5) {
                        this.ending = 'га'
                    }
                    else {
                        this.ending = 'зей'
                    }
                })
        },

        friends_request() {
            axios.get(`/api/friends/${this.id}`)
                .then(res => {
                    // console.log(res.data.data);                    

                        for (let index = 0; index < res.data.data.length; index++) {
                            if (this.user['id'] == res.data.data[index]['id_friend'] || this.user['id'] == res.data.data[index]['id_user']) {
                                if (res.data.data[index]['status'] == 'false') {
                                    this.request_status = 'Заявка отправлена'
                                }

                                if (res.data.data[index]['status'] == 'true') {
                                    this.request_status = 'У вас в друзьях'
                                }

                                if (res.data.data[index]['status'] == 'block') {
                                    this.request_status = 'В черном списке'
                                }

                                if (res.data.data[index]['status'] == 'invisible') {
                                    this.request_status = 'Вы в черном списке'
                                }
                            }
                        }

                    if (this.request_status == 'Заявка отправлена' || this.request_status == 'В черном списке' || this.request_status == 'У вас в друзьях' || this.request_status == 'Вы в черном списке') {
                        this.check_add = true;
                        this.but = 'tonal';
                    }
                    else {
                        this.check_add = false;
                        this.but = 'outlined';
                    }
                })
        },
    },
}
</script>

<style scoped>
.w-60 {
    width: 67%;
}

.mt-min {
    margin-top: -7%
}

.bg-grad {
    height: 300px;
    background: #7986CB;
}

.avatar {
    width: 300px;
    height: 300px;
    margin-top: -10%;
    margin-left: 10%;
    border: 2px rgba(255, 255, 255, 0.5) solid;
    object-fit: cover;
}
</style>
