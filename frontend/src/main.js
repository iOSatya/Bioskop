import '@/assets/base.css';
import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import { createPinia } from 'pinia';

import { register } from 'swiper/element/bundle';
register();

const app = createApp(App)

app.use(router)
app.use(createPinia());

app.mount('#app')
