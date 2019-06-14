<template>
    <div class="media">
        <div class="thumbnail">
            <img class="img-fluid" v-bind:src="src">
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            src: String
        }
    };
</script>

<style lang="scss" scoped>
    .media {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 2px;
        height: 100%;
        overflow: hidden;
        position: relative;

        .thumbnail {
            height: 100%;

            img {
                height: 100%;
                object-fit: cover;
            }
        }
    }
</style>
