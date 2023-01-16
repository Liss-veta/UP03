<template>
  <div class="mt-12 d-flex flex-column align-center justify-center">
    <div class="d-flex justify-center">
      <v-sheet
        class="bd pa-2"
        max-width="80%"
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
      <v-window class="w-100" v-model="tab" style="min-height: 40vh;">
        <v-window-item class="h-auto" value="option-1">
          <v-card class="h-auto bg-pink-lighten-3 d-flex " variant="tonal">
            <div class="w-50 pa-12">
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus voluptatum magni mollitia consequuntur, molestiae sequi distinctio ad suscipit ratione unde earum vitae consectetur praesentium quo autem laboriosam corporis quae fuga!

              </p>
            </div>
            <div class="w-50">
              <img src="../../../../public/img/avatar.png">
              <img src="../../../../public/img/avatar.png">
            </div>
          </v-card>
              
        </v-window-item>
        <v-window-item class="h-100 w-100" value="option-2">
          <v-card class="h-100 bg-pink-lighten-3" flat>
            <v-card-text class="h-100">
             2222222222222222222222222
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
        'Киберспорт',
        'Хуйня',
      ]
    };
  },

  mounted(){
        document.title = "Главная"
    },

  components: {

  },
};
</script>
<style scoped>
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
