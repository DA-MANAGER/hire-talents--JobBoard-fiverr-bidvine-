<template>
    <div>
        <div class="row">
            <div class="col-md-3 my-3"
                v-if="show_upload_button"
                @click="$refs.file.click()">
                <div class="btn-add-media">
                    <span class="border-dashed">
                        <i class="fas fa-plus"></i>
                    </span>
                </div>

                <input
                    type="file"
                    ref="file"
                    hidden
                    v-bind:multiple="upload_multiple_files"
                    @change="handleFileChange"
                />
            </div>

            <div
                class="col-md-3 my-3"
                v-for="(media, index) in media_list"
                v-bind:index="index"
                v-bind:key="index"
            >
                <media-component
                    v-bind:src="media.src"
                    @click.native="displayModal(index)"
                >
                </media-component>
            </div>
        </div>

        <media-modal-component
			v-if="show_media_modal"
			v-bind:media_list="media_list"
            v-bind:select_media="select_media_index"
			@closeModal="show_media_modal = false"></media-modal-component>
    </div>
</template>

<script>
    import MediaComponent from "./MediaComponent.vue";
    import MediaModalComponent from "./MediaModalComponent.vue";

    export default {
        components: {
            MediaComponent,
            MediaModalComponent,
        },

        data() {
            return {
                show_media_modal: false,
                select_media_index: 0,
            }
        },

        methods: {
            /**
             * Display the modal being the image selected of the supplied
             * index.
             * 
             * @param   Number media_index
             * 
             * @returns void
             */
            displayModal(media_index) {
                this.select_media_index = media_index;
                this.show_media_modal = true;
            },

            /**
             * Passes the selected file to the parent component to handle
             * it.
             * 
             * @returns void
             */
            handleFileChange() {
                let files = this.$refs.file.files;

                if (! this.upload_multiple_files) {
                    files = files[0];
                }

                this.$emit('handleFileChange', files);
            },
        },

        props: {
            media_list: Array,
            show_upload_button: {
                default: false,
                type: Boolean,
            },
            upload_multiple_files: {
                default: false,
                type: Boolean
            }
        }
    };
</script>

<style lang="scss" scoped>
.btn-add-media {
    align-items: center;
    border: 2px dashed #f2f2f2;
    display: flex;
    height: 142px;
    justify-content: center;
}
</style>
