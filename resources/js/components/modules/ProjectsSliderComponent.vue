<template>
    <div class="owl-carousel owl-theme">
        <div
            class="carousel-block my-3 p-3 rounded text-muted"
            v-for="(project, index) in projects"
            v-bind:index="index"
            v-bind:key="index">
            <span class="badge badge-pill badge-danger mb-3 text-capitalize" v-text="project.service"></span>
            <p class="card-text" v-text="project.description"></p>
        </div>
    </div>
</template>

<script>
    export default {
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
            projects: Array
        }
    };
</script>

<style lang="scss" scoped>
    .carousel-block {
        border: 1px solid #F5F5F5;
        max-width: 320px;
        width: 100%;
    }
</style>
