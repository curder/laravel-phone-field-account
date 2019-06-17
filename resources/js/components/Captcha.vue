<template>
    <img class="w-50" :src="image.img" @click="fetchData" alt="">
</template>
<script>
    export default {
        props: ['src'],
        data() {
            return {
                image: {},
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                axios.get(this.src).then(({data}) => {
                    this.image = data;
                    this.$emit('captcha-updated', this.image);
                });

            }
        },
    }
</script>
