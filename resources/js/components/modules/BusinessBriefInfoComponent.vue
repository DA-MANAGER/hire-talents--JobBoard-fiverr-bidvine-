<template>
    <div class="row p-4 bg-white shadow-sm">
        <div class="col">
            <div class="row">
                <div class="col">
                    <media-component
                        src="./../../../images/avatar.png"
                    ></media-component>
                </div>

                <div class="col-md-9">
                    <div class="text-left">
                        <h4
                            class="font-weight-bold"
                            v-text="business.name"
                        ></h4>

                        <div class="mt-4">
                            <div class="my-2">
                                <i class="fas fa-link"></i>
                                <a
                                    class="text-muted ml-2"
                                    target="_blank"
                                    v-bind:href="business.website"
                                    v-text="business.website"
                                ></a>
                            </div>

                            <div class="my-2">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="text-muted ml-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                            </div>

                            <div class="my-2">
                                <i class="fas fa-mobile-alt"></i>
                                <span class="text-muted ml-2">(541) 754-3010</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MediaComponent from "./MediaComponent.vue";

    export default {
        components: {
            MediaComponent
        },

        props: {
            business: Object
        }
    };
</script>