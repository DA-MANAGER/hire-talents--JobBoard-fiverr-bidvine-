<template>
    <div>
        <div
            class="service bg-white border h-100 py-5 px-3 text-center"
            @click="show_request_modal = true">
            <img
                class="mx-auto"
                v-bind:src="service.media.src"
                v-bind:alt="service.name"
            >

            <span class="d-block font-weight-bold mt-3 text-uppercase" v-text="service.name"></span>
        </div>

        <service-request-modal-component
            v-bind:service="service"
            @closeModal="show_request_modal = false"
            v-if="show_request_modal"></service-request-modal-component>
    </div>
</template>

<script>
    import ServiceRequestModalComponent from "./ServiceRequestModalComponent.vue";

    export default {
        components: {
            ServiceRequestModalComponent,
        },

        data() {
            return {
                show_request_modal: false,
            };
        },

        props: {
            service: Object
        }
    };
</script>

<style lang="scss" scoped>
    .service {
        cursor: pointer;

        &:hover {
            border-color: #328f28 !important;
        }

        img {
            height: 45px;
            width: 45px;
        }
    }
</style>
