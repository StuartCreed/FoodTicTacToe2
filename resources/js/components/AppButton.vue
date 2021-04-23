<template>
    <div class="flex justify-center items-center">
        <button class="bg-red-400 text-white p-4 rounded">{{ text }}</button>
    </div>
</template>

<script>
export default {
    props: ['text'],
    components: {},
    name: "AppButton.vue"
}
</script>

<style scoped>
</style>
