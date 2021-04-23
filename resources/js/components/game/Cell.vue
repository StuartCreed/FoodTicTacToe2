<template>
    <div
        class="flex border-2 border-black justify-items-center rounded-xl"
        @click="cellClickedOn"
    >
        <div class="w-32 h-32 flex justify-center items-center p-2">
            <img class="w-full" v-show="this.cell.value !== 'empty'" :src="imgDir"/>
        </div>
    </div>
</template>

<script>
export default {
    props: ['cell', 'currentGo', 'clickedOn'],
    name: "Cell.vue",
    emits: ['cellClickedOn'],
    methods: {
        cellClickedOn: function() {
            if (!this.clickedOn) {
                this.$emit('cellClickedOn', this.cell.id, this.currentGo)
            }
        }
    },
    computed: {
        imgDir: function() {
            return './images/' + this.cell.value + '.svg'
        }
    }
}
</script>
