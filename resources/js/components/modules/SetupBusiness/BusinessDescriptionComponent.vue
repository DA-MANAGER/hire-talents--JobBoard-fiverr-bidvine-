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
                        Describe your business to potential customers.
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
                                    Your business description will accompany
                                    every bid you send.
                                </p>
                                <p class="card-text">
                                    A great, error-free description inspires
                                    confidence.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form v-on:submit.prevent="updateBusinessDescription">
                        <label
                            class="font-weight-bold"
                            for="business-description"
                            >Business Description:</label
                        >

                        <div class="mb-3">
                            <textarea
                                id="business-description"
                                class="form-control"
                                placeholder="Describe business, give examples of your projects and give details about a typical project or customer."
                                v-model="business_description"
                            ></textarea>
                            <p class="text-muted d-block mb-0 mt-2">
                                <span
                                    class="font-weight-bold"
                                    v-text="business_description.length"
                                    >0</span
                                >
                                characters ({{
                                    min_description_length
                                }}
                                minimum).
                            </p>
                        </div>

                        <div class="text-right">
                            <button
                                class="btn btn-primary btn-lg"
                                type="submit"
                                v-bind:disabled="loading"
                            >
                                <span v-if="loading">Processing...</span>
                                <span v-else>Continue</span>
                            </button>
                        </div>
                    </form>
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

            ...mapGetters("BusinessStore", ["businesses"])
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
                /**
                 * We'll proceed by fetching the details of the business to
                 * determine if the business actually exists.
                 */
                let business = this.businesses(this.business_id);

                if (_.isEmpty(business)) {
                    business = await this.$store.dispatch(
                        "BusinessStore/fetchBusiness",
                        this.business_id
                    );
                }

                /**
                 * Finally, we'll update the component by the recent
                 * fetched business details to reflect it on the screen.
                 */
                if (!_.isEmpty(business.description)) {
                    this.business_description = business.description;
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
                page_loaded: false,

                business_description: "",
                min_description_length: 120
            };
        },

        methods: {
            /**
             * Updates the description of the business in the server.
             *
             * @returns void
             */
            async updateBusinessDescription() {
                // Remove any error from the screen and display a
                // loading state on the screen so the user could know that
                // the we've initialized the process of updating into
                // the application.
                this.resetError();
                this.loading = true;

                if (
                    this.business_description.length <
                    this.min_description_length
                ) {
                    this.showError(
                        `The description of the business must be at least ${
                            this.min_description_length
                        } characters.`,
                        "danger"
                    );

                    return;
                }

                try {
                    const data = {
                        business_id: this.business_id,
                        data: {
                            description: this.business_description
                        }
                    };

                    await this.$store.dispatch(
                        "BusinessStore/updateBusiness",
                        data
                    );

                    this.$emit("business-description-updated");
                } catch (err) {
                    this.showError(this.getFirstError(err.data), "danger");
                }

                this.loading = false;
            }
        },

        mixins: [HasErrorMixin]
    };
</script>