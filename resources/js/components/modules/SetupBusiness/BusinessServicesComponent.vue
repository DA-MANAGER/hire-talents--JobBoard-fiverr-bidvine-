<template>
    <div class="row">
        <div class="col-md bg-white">
            <div
                class="form-wrapper d-flex align-items-center justify-content-center p-5"
            >
                <div v-if="page_loaded">
                    <alert-component
                        class="my-4"
                        v-if="hasError"
                        v-bind:error="error"
                    ></alert-component>

                    <h4 class="mb-4" style="line-height: 1.6;">
                        Which of these related services do you provide?
                    </h4>

                    <div class="alert alert-warning my-4">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <i
                                    class="fas fa-info-circle mt-2"
                                    style="font-size: 48px;"
                                ></i>
                            </div>

                            <div class="col">
                                <p class="font-weight-bold">
                                    We will send you requests for the services
                                    you select.
                                </p>
                                <p class="card-text">
                                    You can change these later from your
                                    account.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <ul class="list-group mb-3">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                                v-for="(service, index) in services"
                                v-bind:key="service.id"
                                v-bind:index="index"
                                v-bind:class="{
                                    active:
                                        business_service_exists({
                                            business_id,
                                            service,
                                        }) !== -1,
                                }"
                                @click="toggleService(service);"
                            >
                                {{ service.name }}
                                <span
                                    class="badge bg-white text-dark"
                                    v-if="
								business_service_exists({
									business_id,
									service,
								}) !== -1
							"
                                >
                                    <i class="fas fa-check"></i>
                                </span>
                            </li>
                        </ul>

                        <button
                            class="btn btn-primary btn-lg btn-block"
                            type="submit"
                            @click="fetchAppServices"
                            v-if="show_load_more_services_button"
                        >
                            <span>Load more services</span>
                        </button>

                        <div class="text-right">
                            <button
                                class="btn btn-primary btn-lg"
                                type="submit"
                                v-bind:disabled="loading"
                                @click="updateBusinessServices"
                            >
                                <span>Continue</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div v-else>
                    <div class="alert alert-warning my-4">
                        <div class="row">
                            <div class="col">
                                <p class="card-text font-weight-bold">
                                    The business details are being fetched.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md bg-dark"></div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    import HasErrorMixin from "./../../../mixins/HasErrorMixin";

    export default {
        computed: {
            business_id() {
                return parseInt(this.$route.query.business_id);
            },

            show_load_more_services_button() {
                const meta = this.services_meta;

                if (
                    !meta.hasOwnProperty("current_page") ||
                    !meta.hasOwnProperty("last_page")
                ) {
                    return false;
                } else if (meta.current_page >= meta.last_page) {
                    return false;
                }

                return true;
            },

            ...mapGetters("ServiceStore", [
                "business_services",
                "business_service_exists",
                "services",
                "services_meta"
            ])
        },

        async created() {
            /**
             * We'll start by checking if the business id is supplied and
             * if not simply redirect to the error displaying page of the
             * application with an error message.
             */
            if (isNaN(this.business_id)) {
                this.$router.push({
                    name: "page-not-found",
                    query: { business: 1 }
                });

                return;
            }

            try {
                const business_services = this.business_services(this.business_id);

                if (business_services.length < 1) {
                    await this.$store.dispatch(
                        "ServiceStore/fetchBusinessServices",
                        this.business_id
                    );
                }

                if (this.services.length < 1) {
                    await this.fetchAppServices();
                }

                this.page_loaded = true;
            } catch (err) {
                err = err.response || err;

                if (err.status === 404) {
                    this.$router.push({
                        name: "page-not-found",
                        query: { business: 1 }
                    });
                }
            }
        },

        data() {
            return {
                loading: false,
                page_loaded: false
            };
        },

        methods: {
            /**
             * Fetches the app services from the server.
             *
             * @returns Promise
             */
            fetchAppServices() {
                return this.$store.dispatch("ServiceStore/fetchServices");
            },

            /**
             * Toggles the service for the business.
             *
             * @returns void
             */
            async toggleService(service) {
                // Remove any error from the screen to notify the user
                // about the any new error occured.
                this.resetError();

                try {
                    const data = {
                        business_id: this.business_id,
                        service
                    };

                    service = {
                        owner: {
                            id: this.business_id
                        },

                        ...service
                    };

                    if (this.business_service_exists(data) !== -1) {
                        await this.$store.dispatch(
                            "ServiceStore/unregisterBusinessService",
                            service
                        );
                    } else {
                        await this.$store.dispatch(
                            "ServiceStore/registerBusinessService",
                            service
                        );
                    }
                } catch (err) {
                    this.showError(this.getFirstError(err.data), "danger");
                }
            },

            /**
             * Fires the event when the services are updated on the
             * business.
             *
             * @returns void
             */
            updateBusinessServices() {
                this.$emit("business-services-updated");
            }
        },

        mixins: [HasErrorMixin]
    };
</script>