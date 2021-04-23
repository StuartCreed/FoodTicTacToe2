<template>
    <app-button text="Start New Game" @click="startNewGame"></app-button>
    <score-panel :score="score.Computer" userName="Computer" :currentGo="currentGo"></score-panel>
    <board
        ref="board"
        :currentGo="currentGo"
        :users="users"
        :cells="cells"
        :cellSelectedByComp="cellSelectedByComp"
        :allGoesTaken="allGoesTaken"
        :gameWon="gameWon"
        @cellClickedOn="updateGameState"
        @gameWon="updateGameWon"
        @allGoesTaken="resetBoard"
    >
    </board>
    <score-panel :score="score.Player" userName="Player" :currentGo="currentGo"></score-panel>
</template>

<script>
import Board from './Board.vue';
import ScorePanel from './ScorePanel.vue';
import AppButton from '../AppButton.vue';
import axios from 'axios';

export default {
    components: {
        Board, ScorePanel, AppButton
    },
    name: "Game.vue",
    data: function() {
        return {
            currentGo: 'Player',
            score: this.freshScores(),
            cells: this.freshCells(),
            users: {
                'Computer': {
                     cellsClicked: []
                },
                'Player': {
                    cellsClicked: []
                }
            },
            allGoesTaken: false,
            cellSelectedByComp: null,
            gameWon: false,
        }
    },
    methods: {
        updateGameWon: async function(user) {
            this.gameWon = true;
            this.updateScore(user);
            this.storeResult(user);
            await this.$swal(`${user} wins!`);
            this.resetBoard();
        },
        updateScore: function(user) {
            this.score[user]++
        },
        toggleGo: function() {
            this.isComputerGo ? this.currentGo = 'Player' : this.currentGo = 'Computer'
        },
        startNewGame: function() {
            this.resetGame();
            this.showStartingPopup();
        },
        resetGame: function() {
            this.resetBoard()
            this.score = this.freshScores();
            this.allGoesTaken = false
        },
        resetBoard: function() {
            this.currentGo = 'Player'
            this.$refs.board.gameFinished = false
            this.cells = this.freshCells();
            this.resetCellsClicked();
            this.allGoesTaken = false
        },
        showStartingPopup: function() {
            this.$swal('Lets start a new game');
        },
        freshCells: function() {
            return [0, 1, 2, 3, 4, 5, 6, 7, 8].map(number => {
                return {
                    id: number,
                    value: 'empty', // Can be 'empty', 'Computer', 'Player'
                    clickedOn: false
                }
            })
        },
        freshScores: function() {
            return {
                Computer: 0,
                Player: 0
            }
        },
        resetCellsClicked: function() {
            Object.keys(this.users).forEach(user => {
                this.users[user].cellsClicked = []
            })
        },
        updateGameState: function(cell, user) {
            this.cells[cell].clickedOn = true;
            this.updateCellUserHasClicked(cell, user)
            this.toggleGo()
        },
        updateCellUserHasClicked: function(cell, user) {
           this.users[user].cellsClicked.push(cell)
        },
        storeResult: function(winner) {
            axios.post('/gamepost', {
                score: this.score,
                winner: winner
            })
        }
    },
    computed: {
        isComputerGo: function() {
            return this.currentGo === 'Computer'
        }
    }
}
</script>
