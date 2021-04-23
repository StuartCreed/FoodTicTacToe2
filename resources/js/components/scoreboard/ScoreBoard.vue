<template>
    <table id="scoreboard-table" class="display">
        <thead>
            <tr>
                <th>You</th>
                <th>Computer</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="row in rows">
                <td>{{ row.player_score }}</td>
                <td>{{ row.computer_score }}</td>
                <td>{{ row.created_at }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "ScoreBoard.vue",
        mounted() {
            $('#scoreboard-table').DataTable({
                "searching": false
            });
        },
        data: function() {
            return {
                rows: window.games
            }
        }
    }
</script>

