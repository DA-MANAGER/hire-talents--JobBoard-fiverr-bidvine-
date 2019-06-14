<template>
    <div class="row">
        <div class="col-md bg-white">
            <div
                class="form-wrapper d-flex align-items-center justify-content-center p-5"
            >
                <div v-if="page_loaded && auth_user !== undefined">
                    <h4 style="line-height: 1.6;">
                        We're checking for matching job leads.
                    </h4>

					<p class="text-muted">In the meantime, there are two things you need to do:</p>

                    <div class="alert alert-warning my-4">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <i
                                    class="fas fa-info-circle mt-2"
                                    style="font-size: 48px;"
                                ></i>
                            </div>

                            <div class="col">
                                <p class="font-weight-bold">Confirm your email</p>
                                <p class="card-text">
                                    To ensure you receive all customer requests; follow the instruction that we sent to:
									<span
										class="font-weight-bold"
										v-text="auth_user.email"
									></span>
                                </p>
                            </div>
                        </div>
                    </div>

					<div class="alert alert-warning my-4">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <i
                                    class="fas fa-info-circle mt-2"
                                    style="font-size: 48px;"
                                ></i>
                            </div>

                            <div class="col">
                                <p class="font-weight-bold">Complete the profile of your business.</p>
                                <p class="card-text">
                                    You need a complete profile to respond to your customer
									requests. You need a great profile to win business.
									Invest the time in a great profile.
                                </p>
                            </div>
                        </div>
                    </div>

					<div class="text-right">
						<button
							class="btn btn-primary btn-lg"
							type="submit"
							@click="$emit('business-account-confirmation-updated')"
						>
							<span>Continue</span>
						</button>
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

    export default {
        computed: {
            business_id() {
                return parseInt(this.$route.query.business_id);
            },

            ...mapGetters("AuthStore", ["auth_user"]),

            ...mapGetters("BusinessStore", ["businesses"]),
        },

        async created() {
            /**
             * We'll start by checking if the business id is supplied and
             * if not simply redirect to the error displaying page of the
             * application with an error message.
             */
            if (isNaN(this.business_id)) {
                return this.$router.push({ name: "register-business" });
            }

            /**
             * We'll proceed by fetching the details of the business to
             * determine if the business actually exists.
             */
            try {
                let business = this.businesses(this.business_id);

                if (_.isEmpty(business)) {
                    business = await this.$store.dispatch(
                        "BusinessStore/fetchBusiness",
                        this.business_id
                    );
                }

                this.page_loaded = true;
            } catch (err) {
                err = err.response || err;

                if (err.status === 404) {
                    this.$router.push({
                        name: "register-business",
                        query: { "business-not-found": 1 },
                    });
                }
            }
        },

        data() {
            return {
                page_loaded: false,
            };
        },
    };
</script>
