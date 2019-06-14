<template>
    <div class="service-request-bid row">
        <div class="col py-0">
            <div class="bg-white border-bottom p-3 shadow-sm">
                <div class="d-flex justify-content-start py-1">
                    <div class="mr-2 px-3">
                        <media-component
                            class="business-avatar rounded-circle"
                            src="./../../../images/avatar.png"
                        ></media-component>
                    </div>

                    <div class="px-3">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p class="font-weight-bold text-primary mb-0">Da Manager LTD.</p>
                                </div>

                                <div class="col text-right">
                                    <div class="d-flex justify-content-end">
                                        <div class="mr-4">
                                            <i class="far fa-money-bill-alt text-muted icon align-middle"></i>

                                            <span class="align-middle font-weight-bold text-primary">24 USD</span>
                                        </div>

                                        <div>
                                            <button
                                                class="btn btn-primary btn-sm"
                                                disabled
                                                v-if="is_accepted"
                                            >Accepted
                                            </button>

                                            <button
                                                class="btn btn-outline-primary btn-sm"
                                                v-else
                                            >Accept Bid
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="services">
                            <a href="#" class="badge badge-light service-item">Web Designing</a>
                            <a href="#" class="badge badge-light service-item">Web Development</a>
                            <a href="#" class="badge badge-light service-item">Web Hosting</a>
                        </div>

                        <div class="my-3">
                            <p class="text-muted">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta incidunt, dolorum ullam commodi deleniti libero qui. Labore aliquid modi odit eos? Adipisci nihil ad minima in incidunt animi totam hic!
                            </p>
                        </div>

                        <!-- <div class="mt-3">
                            <media-list-component
                                class="media-list"
                                v-bind:media_list="service_request.media"
                            ></media-list-component>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MediaComponent from "./../modules/MediaComponent.vue";
    import MediaListComponent from "./../modules/MediaListComponent.vue";

    export default {
        components: {
            MediaComponent,
            MediaListComponent
        },

        props: {
            bid: Object,
            is_accepted: {
                default: false,
                type: Boolean,
            }
        }
    };
</script>

<style lang="scss" scoped>
    .service-item {
        margin: 5px 10px 5px 0;
    }
</style>
