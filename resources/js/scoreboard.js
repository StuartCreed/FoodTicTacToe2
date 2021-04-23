import { createApp } from 'vue';
import ScoreBoard from './components/scoreboard/ScoreBoard.vue';
import 'sweetalert2/dist/sweetalert2.min.css';

// Mount Vue Game App
const scoreboard = createApp(ScoreBoard)
scoreboard.mount("#scoreboard")
