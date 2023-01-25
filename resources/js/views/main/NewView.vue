<template>
  <div class="mt-12 d-flex flex-column align-center justify-center">
    <!-- ДОБАВЛЕНИЕ ПОСТОВ -->
    <div class="w-75">
      <div class="w-100 d-flex align-strtech">
        <v-text-field v-model="text" label="Добавить пост" append-inner-icon="mdi-plus"
          class="text-pink-lighten-4 w-75"></v-text-field>
        <div class="w-25 h-100 d-flex justify-end align-center">
          <v-btn class="w-75 pa-4" variant="outlined" color="pink-lighten-4" @click.prevent="add_post">
            Добавить
          </v-btn>
        </div>
      </div>
      <div class="d-flex align-stretch justify-space-between">
        <v-row>
          <v-col cols="12" sm="4">
            <v-select v-model="category" class="text-pink-lighten-4" label="Select" :items="tags"></v-select>
          </v-col>
          <v-col cols="12" sm="4">
            <v-file-input v-on:change="handleFileUpload()" v-if="!show" multiple ref="file" id="file" name="file"
              label="Добавьте фотографию" variant="filled" class="text-pink-lighten-4"></v-file-input>
          </v-col>
          <v-col cols="12" sm="4">
            <v-text-field label="Вставьте ссылку на видео" append-inner-icon="mdi-youtube" class="text-pink-lighten-4"
              v-model="video_url" @click.prevent="show = !show"></v-text-field>
          </v-col>
        </v-row>
      </div>
    </div>
    <v-divider></v-divider>
    <!-- КАТЕГОРИИ -->
    <div class="d-flex justify-center w-75 mt-12">
      <v-sheet class="bd pa-2 w-100">
        <v-slide-group show-arrows class="d-flex justify-center w-100">
          <v-slide-group-item v-for="n in 1" :key="n" class="w-100">
            <v-chip-group v-model="amenities" column multiple :color="isSelected ? 'green' : 'pink-lighten-4'">
              <v-chip filter variant="outlined" v-for="tag in tags" :key="tag">
                  {{ tag }}
              </v-chip>
            </v-chip-group>
          </v-slide-group-item>
        </v-slide-group>
      </v-sheet>
    </div>
    <v-divider></v-divider>
    <!-- ПОСТЫ -->
    <div class="w-100 mb-12"  v-if="posts.length > 0">
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
                    <span> {{ post.comments.length }} </span>
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
                            <router-link class="d-flex align-center text-black" v-else to="/profile">
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
                            <div class="w-100 d-flex justify-space-between">
                                <p class="pl-2 text-body-1">{{ comment.comm }}</p>
                                <v-btn color="error" variant="plain" v-if="id == comment.user.id" @click.prevent="del_comm(comment.id)">
                                    Delete
                                </v-btn>
                            </div>

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
    <div class="w-75 mt-16 text-center" v-else>
        <h4 class="mt-16 text-h5 text-pink-lighten-4">Новостей нет.<br> Добавьте запись, будьте первыми.</h4>
      </div>
  </div>
</template>
<script>
import moment from 'moment';
export default {
  data() {
    return {
      show: false,
      src_video: '',
      amenities: [1, 4],
      neighborhoods: [1],
      tags: [
      ],
      items: [],
      text: '',
      category: '',
      file: '',
      preview: '',
      posts: [],
      comments: [],
      id: localStorage.getItem('id'),
      select_filter: ''
    };
  },
  mounted() {
    console.log(this.posts)
    document.title = "Новости",
      this.all_post();
      this.categories()

  },
  methods: {
    del_comm(id){
      axios.post(`/api/del_comm/${id}`)
        .then(res =>{
          this.all_post();
        })
    },
    getFilter(tag){
        this.select_filter = tag;
    },
    categories(){
      axios.get('/api/category')
        .then(res =>{
          for (let index = 0; index < res.data.length; index++) {
             this.tags.push(res.data[index].category);
          }
        })
    },
    add_comm(_id_post) {
      let formData = new FormData();
      formData.append('comm', this.comm);
      formData.append('id_post', this.id_post);
      axios.post('/api/add_comm', formData)
        .then(_res => {
          this.comm = '';
          this.all_post()
        })
    },
    getHumanDate: function (date) {
      return moment(date).fromNow();
    },
    handleFileUpload() {
      this.file = this.$refs.file.files;
    },
    add_post() {
      let formData = new FormData();
      formData.append('text', this.text);
      formData.append('category', this.category);
      formData.append('video_url', this.video_url);

      for (let index = 0; index < this.file.length; index++) {
        let image = this.file[index];
        formData.append('image[]', image);
      }
      axios.post('/api/add_post',
        formData,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        },
      ).then(_r => {
        this.text = ''
        this.category = ''
        this.file = ''
        this.all_post();
      })
        .catch(function () {
          console.log('FAILURE!!');
        });
    },
    all_post() {
      axios.get('/api/all_posts')
        .then(res => {
          if (res.data.data != []) {
            this.posts = res.data.data;
          }

          console.log(this.posts);
          this.posts.forEach(post => {
            post.tab = "option-1";
            post.countLikes = post.likes.length;
          });
          console.log(this.posts);
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
  }
};
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
.v-chip-group{
  color: #6d606d;
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
