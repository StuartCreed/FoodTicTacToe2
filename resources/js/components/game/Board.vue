<template>
    <div class="w-full flex justify-center items-center">
        <div class="board grid grid-cols-3 gap-6 w-96">
            <cell
                v-for="cell in cells"
                :cell="cell"
                :currentGo="currentGo"
                :clickedOn="cell.clickedOn"
                @cellClickedOn="cellClickedOn">
            </cell>
        </div>
    </div>
</template>

<script>
import Cell from './Cell.vue';
export default {
    components: {Cell},
    name: "Board.vue",
    props: ['currentGo', 'cells', 'users', 'cellSelectedByComp', 'allGoesTaken', 'gameWon'],
    data: function () {
        return {
            winningConditions: [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                [0, 4, 8],
                [2, 4, 6]
            ],
            computerGoDelay: 300,
            gameFinished: false
        }
    },
    methods: {
        cellClickedOn: function(cell, user) {
            this.$emit('cellClickedOn', cell, user)
            this.cells[cell].value = user;
            this.checkBoard();

            if (this.currentGo === 'Player' && !this.gameFinished) {
                this.takeComputerTurn()
            }
            // Reset gameFinished property
            if (this.gameFinished) this.gameFinished = false
        },
        checkBoard: async function() {
            let status = []
            // Check if winning condition has been met by either user
            Object.keys(this.users).forEach(user => {
                const won = this.winningConditions.some(cond => {
                    let checkCondAccumulator = []
                    this.users[user].cellsClicked.some(cell => {
                        if (cond.some(cellTest => cellTest === cell)) {
                            checkCondAccumulator.push(cell)
                        }
                    })
                    return checkCondAccumulator.length === 3
                })
                status.push(won)
                if (won) {
                    this.$emit('gameWon', user);
                    this.gameFinished = true
                }
            })
            if (this.allCellsClickedOn && !this.gameWon) {
                this.$emit('allGoesTaken')
                this.$swal("Gameover. Let's start a new game shall we!");
                this.gameFinished = true
            }
        },
        takeComputerTurn: function() {
            setTimeout(() => {
                const cellsLeft = this.cells.filter(cell => cell.value === 'empty');
                const cellToSelect = cellsLeft[this.getRandomInt(0, cellsLeft.length - 1)]
                this.cellClickedOn(cellToSelect.id, 'Computer');
            }, this.computerGoDelay)
        },
        getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    },
    computed: {
        totalCellsClicked: function() {
            let cellsAccumulator = []
            Object.keys(this.users).forEach(user => {
                cellsAccumulator = [...cellsAccumulator, ...this.users[user].cellsClicked]
            })
            return cellsAccumulator
        },
        isUsersGo: function() {
            return this.currentGo === 'Player'
        },
        allCellsClickedOn: function() {
            return this.totalCellsClicked.length === 9
        }
    },

}
</script>
