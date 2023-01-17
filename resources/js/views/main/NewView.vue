<template>
  <div class="mt-12 d-flex flex-column align-center justify-center">
    <!-- ДОБАВЛЕНИЕ ПОСТОВ -->
    <div class="w-75">
        <v-text-field
            label="Добавить пост"
            append-inner-icon="mdi-plus"
            class="text-pink-lighten-4"
          ></v-text-field>
        <div class="d-flex align-stretch justify-space-between">
            <v-row>
            <v-col cols="12" sm="3">
                <v-file-input
                v-if="!show"
                    label="Добавьте фотографию"
                    variant="filled"
                    class="text-pink-lighten-4"
                ></v-file-input>
            </v-col>
            <v-col cols="12" sm="3">
           <v-text-field
                label="Вставьте ссылку на видео"
                append-inner-icon="mdi-youtube"
                class="text-pink-lighten-4"
                v-model="src_video"
                @click.prevent = "show = !show"
            ></v-text-field>
        </v-col>
        <v-col cols="12" sm="3">
            <transition name="fade">
                <v-file-input
                    v-if="show"
                    label="Добавьте превью для видео"
                    variant="filled"
                    class="text-pink-lighten-4"
                    append-inner-icon="mdi-camera-plus-outline"
                ></v-file-input>
            </transition>
        </v-col>
        <v-col cols="12" sm="3">
             <v-btn class="w-100 h-75" variant="outlined" color="pink-lighten-4">
                Добавить
            </v-btn>
        </v-col>

        </v-row>
        </div>
    </div>
    <!-- КАТЕГОРИИ -->
    <div class="d-flex justify-center w-75">
      <v-sheet
        class="bd pa-2 w-100"

  >
    <v-slide-group
      show-arrows
    >
      <v-slide-group-item
        v-for="n in 1"
        :key="n"
        class="w-100"
      >
      <v-chip-group
        v-model="amenities"
        column
        multiple
        :color="isSelected ? 'green' : 'pink-lighten-4'"
      >
        <v-chip
          filter
          variant="outlined"
          v-for="tag in tags"
            :key="tag"
        >
          {{ tag }}
        </v-chip>
      </v-chip-group>
    </v-slide-group-item>
    </v-slide-group>
  </v-sheet>
    </div>
    <v-divider></v-divider>
    <!-- ПОСТЫ -->
    <div class="w-75 mt-10">
      <v-card class="bg-transparent">
    <div class="post d-flex flex-row">
      <v-tabs
        v-model="tab"
        direction="vertical"
        color="pink-lighten-4"
        class="d-flex flex-column justify-space-between"
      >
        <v-btn variant="outline" color="pink-lighten-4" class="h-33 d-flex flex-column align-center justify-center">
          <!-- <v-icon start>
            mdi-heart-outline
          </v-icon> -->
          <v-icon start>
            mdi-heart
          </v-icon>
          <span>15</span>
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
      <v-window class="w-100" v-model="tab">
        <v-window-item class="h-auto big_height" value="option-1">
          <v-card class="h-auto bg-pink-lighten-3" style="align-self: stretch; align-content: stretch;" variant="tonal">
            <v-card-title class="px-12 py-8 d-flex justify-space-between align-center">
                <div class="d-flex w-25 align-center">
                    <v-avatar size="60" class="mr-4" image="uploads/image 13.jpg"></v-avatar>
                    <h4>Имя фамилия</h4>
                </div>
                <p class="text-disabled">22.12.2022</p>
            </v-card-title>
            <v-card-text class="w-100 d-flex px-12 pb-8">
                <div class="w-50">
                    <p class="text-body-1 pr-12 text-justify d-flex align-center">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!
                    </p>
                </div>
            <div class="w-50 align-stretch">
                <v-carousel style="height: 100%" :show-arrows="false">
                    <v-carousel-item
                    v-for="(item,i) in items"
                    :key="i"
                    :src="item.src"
                    cover
                    ></v-carousel-item>
                </v-carousel>
            </div>
            </v-card-text>
          </v-card>
        </v-window-item>
        <v-window-item class="w-100 min_height" value="option-2">
          <v-card style="align-self: stretch; align-content: stretch;" class="h-100 bg-pink-lighten-3" flat>
            <v-card-text class="h-100">
                <v-avatar image="uploads/image 13.jpg"></v-avatar>
            </v-card-text>
          </v-card>
        </v-window-item>
      </v-window>
    </div>
  </v-card>
    </div>
  </div>
</template>
<script>

export default {
  data() {
    return {
        show: false,
        src_video: '',
      tab: 'option-1',
      amenities: [1, 4],
      neighborhoods: [1],
      tags:[
        'Спорт',
        'Музыка',
        'Кино',
        'Котяры',
        'Капибары',
        'Собакены',
        'Еда',
        'Мода',
        'Еноты',
        'Игры',
        'Аниме',
        'Айти',
        'Такие как юра',
        'Такие как юра',
        'Такие как юра',
        'Киберспорт',
        'Хуйня',
      ],
      items: [
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
        ],
    };
  },

    mounted(){
        document.title = "Новости",
        this.getBiggestHeight();
    },

    methods: {
    getBiggestHeight() {
        let biggestHeight = 0;
        let elements = document.querySelector('.big_height').offsetHeight;
        // console.log(elements);
        document.querySelector('.min_height').style.height = elements + 'px';
        // console.log(document.querySelector('.min_height'))
        // console.log('biggestHeight = ' + biggestHeight + 'px');
    }
  }
};
</script>
<style scoped>
.w-20{
    width: 20%;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.v-carousel{
    height:100%
}
.bd{
  background-color: #0f1546;
}
.v-btn.v-btn--density-default {
  height: 33%;
}
.h-33{
  height: 33%;
}
.post{
  height: auto;
}
.v-slide-group__content{
  height:100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
</style>
