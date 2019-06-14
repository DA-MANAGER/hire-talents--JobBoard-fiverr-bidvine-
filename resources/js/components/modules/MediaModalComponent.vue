<template>
    <div class="media-modal">
        <span class="btn-close" @click="$emit('closeModal')">
            <i class="fas fa-times-circle"></i>
        </span>

        <div class="media-modal-body">
            <div class="single-thumbnail">
                <media-component
                    v-bind:src="selected_media.src"
                ></media-component>
            </div>
        </div>

        <div class="media-modal-footer">
            <div class="media-thumbnails-container owl-carousel owl-theme">
                <media-component
                    class="media-thumbnail d-inline-block mr-2"
                    v-for="(media, index) in media_list"
                    v-bind:index="index"
                    v-bind:key="index"
                    v-bind:src="media.src"
                    v-bind:class="{'is-selected': selected_media_index === index}"
                    @click.native="changeSelectedMedia(index)"
                >
                </media-component>
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

        computed: {
            selected_media() {
                return this.media_list[this.selected_media_index];
            }
        },

        created() {
            this.selected_media_index = this.select_media;
        },

        data() {
            return {
                key: "is_selected",
                selected_media_index: 0,
            };
        },

        methods: {
            /**
             * Display the media on the screen of the supplied index.
             *
             * @param   Number index
             *
             * @returns void
             */
            changeSelectedMedia(index) {
                this.selected_media_index = index;
            }
        },

        mounted() {
            $(".owl-carousel").owlCarousel({
                autoWidth: true,
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }
            });
        },

        props: {
            media_list: Array,
            select_media: {
                type: Number,
                default: 0,
            }
        }
    };
</script>

<style lang="scss" scoped>
    .media-thumbnail {
        height: 120px;
        width: 120px;

        &:not(.is-selected)::before {
            background-color: rgba(0, 0, 0, 0.5);
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
        }
    }

    .btn-close {
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        font-size: 28px;
        position: absolute;
        right: 20px;
        top: 15px;
        text-align: right;
    }

    .media-modal {
        background-color: #111;
        display: flex;
        flex-direction: column;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 999;

        .media-modal-body {
            align-items: center;
            display: flex;
            flex: 2;
            justify-content: center;

            .single-thumbnail {
                background-color: #1f1f21;
                border-radius: 2px;
                height: 400px;
                width: 400px;
            }
        }

        .media-modal-footer {
            border-top: 2px solid #1f1f21;
            height: 160px;

            .media-thumbnails-container {
                padding: 20px;
            }
        }
    }
</style>
