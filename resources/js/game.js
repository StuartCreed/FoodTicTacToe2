import { createApp } from 'vue';
import Game from './components/game/Game.vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import axios from 'axios'
import VueAxios from 'vue-axios'

// Mount Vue Game App
const game = createApp(Game)
game.use(VueSweetalert2, VueAxios, axios);
game.mount("#game")
