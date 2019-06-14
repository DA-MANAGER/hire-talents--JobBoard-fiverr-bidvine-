<template>
    <div class="row">
        <div
            class="col-md-3 my-3"
            v-for="(service, index) in services"
            v-bind:key="index"
            v-bind:index="index"
        >
            <service-component
                class="service-item"
                v-bind:service="service"
            ></service-component>
        </div>
    </div>
</template>

<script>
    import ServiceComponent from "./ServiceComponent.vue";

    export default {
        components: {
            ServiceComponent
        },

        props: {
            services: Array
        }
    };
</script>

<style lang="scss" scoped>
    .service-item {
        transition: all 0.15s cubic-bezier(.77,0,.18,1);

        &:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            color: #328f28;
            transform: scale(1.1);
        }
    }
</style>
