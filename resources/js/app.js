
import './bootstrap';
import vuetify from './plugins/vuetify.js';
import IndexComponent from './views/main/IndexView.vue';
import router from './router';
import {createApp} from 'vue';
import store from './components/store';

// const app = createApp({});
// app.component(IndexComponent).use(router).use(vuetify)
//     .mount('#app');

createApp(IndexComponent).use(router).use(store).use(vuetify).mount('#app');
//require ('./bootstrap');
