import {createApp} from 'vue'
//import './style.css'
import './bootstrap';
import './main.scss'
import App from './App.vue'
import router from './router'
import store from "./stores";

let app = createApp(App)
app.use(store)
app.use(router)
app.mount('#app')

