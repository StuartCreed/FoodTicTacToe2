<template>
    <div class="flex justify-center items-center my-4">
        <div>
            <div>

            </div>
            <div :class="userClass">
                {{ userName }}
            </div>
        </div>
        <div class="pl-4">
            {{ score }}
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    name: "ScorePanel.vue",
    props: ['score', 'userName', 'currentGo'],
    computed: {
        userClass: function() {
            return this.userName === this.currentGo ? 'usersGo' : 'notUsersGo'
        }
    }
}
</script>

<style scoped>
    .usersGo {
        color: green;
        font-weight: bold;
    }
    .notUsersGo {
        color: black;
    }
</style>
