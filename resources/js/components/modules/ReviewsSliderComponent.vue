<template>
    <div class="owl-carousel owl-theme">
        <review-component
            class="carousel-block my-3 p-3"
            v-for="(review, index) in reviews"
            v-bind:index="index"
            v-bind:key="index"
            v-bind:review="review"></review-component>
    </div>
</template>

<script>
    import ReviewComponent from "./ReviewComponent.vue";

    export default {
        components: {
            ReviewComponent,
        },

        mounted() {
            $(".owl-carousel").owlCarousel({
                autoWidth: true,
                loop: true,
                margin: 10,
                nav: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 3,
                    },
                    1000: {
                        items: 5,
                    }
                }
            });
        },

        props: {
            reviews: Array
        }
    };
</script>

<style lang="scss" scoped>
    .carousel-block {
        max-width: 320px;
        width: 100%;
    }
</style>
