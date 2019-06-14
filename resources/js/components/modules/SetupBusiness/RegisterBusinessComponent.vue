<template>
    <div class="row">
        <div class="col-md bg-white">
            <div
                class="form-wrapper d-flex align-items-center justify-content-center p-5"
            >
                <div>
                    <alert-component
                        class="my-4"
                        v-if="hasError"
                        v-bind:error="error"
                    ></alert-component>

                    <h4 class="mb-4" style="line-height: 1.6;">
                        Describe your business to potential customers.
                    </h4>

                    <form v-on:submit.prevent="registerBusiness">
                        <label class="font-weight-bold" for="business-type"
                            >Business type:</label
                        >

                        <div class="mb-3">
                            <select
                                class="custom-select d-block w-100"
                                id="business-type"
                                v-model="business_type"
                            >
                                <option value="">Choose...</option>
                                <option value="solo-trader">Solo Trader</option>
                                <option value="limited-company"
                                    >Limited Company</option
                                >
                                <option value="partnership">Partnership</option>
                                <option value="limited-liability-partnership"
                                    >Limited Liability Partnership</option
                                >
                            </select>
                        </div>

                        <div
                            class="mb-3"
                            v-if="enable_company_registration_number"
                        >
                            <label
                                class="font-weight-bold"
                                for="registration-number"
                                >Company registration number:</label
                            >

                            <div>
                                <input
                                    type="text"
                                    id="registration-number"
                                    class="form-control"
                                    placeholder=""
                                    v-model="business_registration_number"
                                />
                            </div>

                            <p class="text-muted d-block mb-0 mt-2">
                                Look up your number on
                                <span class="font-weight-bold"
                                    >Companies House</span
                                >.
                            </p>
                        </div>

                        <label class="font-weight-bold" for="business-name"
                            >Business name:</label
                        >

                        <div class="mb-3">
                            <input
                                type="text"
                                id="business-name"
                                class="form-control"
                                placeholder="Da Manager LTD."
                                v-model="business_name"
                            />
                        </div>

                        <label class="font-weight-bold" for="business-address"
                            >Business address:</label
                        >

                        <div class="mb-3">
                            <input
                                type="text"
                                id="business-address"
                                class="form-control"
                                placeholder="Zipcode"
                                v-model="business_zipcode"
                            />
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
            </div>
        </div>

        <div class="col-md bg-dark"></div>
    </div>
</template>

<script>
    import HasErrorMixin from "./../../../mixins/HasErrorMixin";

    export default {
        computed: {
            enable_company_registration_number() {
                return (
                    this.business_type === "limited-company" ||
                    this.business_type === "limited-liability-partnership"
                );
            }
        },

        data() {
            return {
                loading: false,

                business_registration_number: "",
                business_name: "",
                business_type: "",
                business_zipcode: ""
            };
        },

        methods: {
            /**
             * Registers the business into the application.
             *
             * @returns void
             */
            async registerBusiness() {
                // Remove any error from the screen and display a
                // loading state on the screen so the user could know that
                // the we've initialized the process of registration into
                // the application.
                this.resetError();
                this.loading = true;

                try {
                    const data = {
                        name: this.business_name,
                        type: this.business_type,
                        zipcode: this.business_zipcode
                    };

                    if (this.business_registration_number.length > 0) {
                        data.registration_number = this.business_registration_number;
                    }

                    const business = await this.$store.dispatch(
                        "BusinessStore/registerBusiness",
                        data
                    );

                    this.$emit("business-registered", business);
                } catch (err) {
                    this.showError(this.getFirstError(err.data), "danger");
                }

                this.loading = false;
            }
        },

        mixins: [HasErrorMixin]
    };
</script>
