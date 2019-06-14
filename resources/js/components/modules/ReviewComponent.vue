<template>
    <div class="review">
        <div class="mb-3 text-center">
            <div>
                 <media-component
                    class="review-avatar mx-auto rounded-circle"
                    src="./../../../images/avatar.png"
                >
                </media-component>
            </div>

            <div class="text-center">
                <p class="font-weight-bold mt-3 mb-0">John Doe</p>

                <div>
                    <star-rating
                        v-bind:inline="true"
                        v-bind:read-only="true"
                        v-bind:show-rating="false"
                        v-bind:star-size="15"
                        v-model="review.ratings"></star-rating>
                </div>
            </div>
        </div>

        <p class="text-center text-muted" v-text="review.review"></p>
    </div>
</template>

<script>
    import MediaComponent from "./MediaComponent.vue";
    import StarRating from 'vue-star-rating';

    export default {
        components: {
            MediaComponent,
            StarRating,
        },

        props: {
            review: Object
        }
    };
</script>

<style lang="scss" scoped>
    .review-avatar {
        height: 62px;
        width: 62px;
    }
</style>
