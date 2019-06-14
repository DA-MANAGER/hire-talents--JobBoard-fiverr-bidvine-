<template>
    <div>
        <media-list-component
            v-bind:show_upload_button="show_upload_button"
            v-bind:upload_multiple_files="upload_multiple_files"
            v-bind:media_list="previews"
            @handleFileChange="handleFileChange"
        ></media-list-component>
    </div>
</template>

<script>
    import MediaListComponent from "./MediaListComponent.vue";

    export default {
        components: {
            MediaListComponent
        },

        data() {
            return {
                previews: [],
            };
        },

        methods: {
            handleFileChange(files) {
                this.$emit('handleFileChange', [...files]);

                this.$set(this, 'previews', []);

                $.each(files, (index, file) => {
                    this.generatePreview(file);
                });
            },

            generatePreview(file) {
                var reader = new FileReader();

                const _this = this;

                reader.addEventListener("load", function () {
                    var image = new Image();

                    image.src = this.result;

                    _this.previews.push(image);
                }, false);

                reader.readAsDataURL(file);
            }
        },

        props: {
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
