<template>
    <div>
        <media-list-with-preview-component
            v-bind:show_upload_button="true"
            v-bind:upload_multiple_files="true"
            @handleFileChange="handleFileChange"
        ></media-list-with-preview-component>
    </div>
</template>

<script>
    import MediaListWithPreviewComponent from "./../MediaListWithPreviewComponent.vue";

    export default {
        components: {
            MediaListWithPreviewComponent
        },

        created() {
            this.$emit('set-value', { key: 'media', value: [] });
        },

        methods: {
            handleFileChange(files) {
                this.$emit('set-value', { key: 'media', value: files });
            },
        },

        props: {
            options: Object
        }
    };
</script>
