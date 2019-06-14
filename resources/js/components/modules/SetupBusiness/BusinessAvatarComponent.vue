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

                    <div class="alert alert-warning my-4">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <i
                                    class="fas fa-info-circle mt-2"
                                    style="font-size: 48px;"
                                ></i>
                            </div>

                            <div class="col">
                                <p class="font-weight-bold card-text">
                                    Add a brand avatar of your business so customers can identify it.
                                </p>
                            </div>
                        </div>
                    </div>

					<div class="w-50 mx-auto">
						<form v-on:submit.prevent="updateBusinessAvatar">
							<div class="mb-4 mx-auto">
								<media-component
									src="./../../../../images/avatar.png"
								></media-component>
							</div>

							<button
								class="btn btn-light btn-lg btn-block"
								type="submit"
								v-bind:disabled="loading"
							>Update Business Avatar</button>
						</form>

						<button
							class="btn btn-primary btn-lg btn-block mt-2"
							v-bind:disabled="loading"
							@click="$emit('business-avatar-updated')">
							<span v-if="loading">Processing...</span>
							<span v-else>Continue</span>
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

	import HasErrorMixin from "./../../../mixins/HasErrorMixin";
	import MediaComponent from "./../MediaComponent.vue";

	export default {
		components: {
			MediaComponent
		},

		computed: {
			business_id() {
				return parseInt(this.$route.query.business_id);
			},

			...mapGetters("BusinessStore", ["businesses"]),
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
					query: { business: 1 },
				});

				return;
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
						name: "page-not-found",
						query: { business: 1 },
					});
				}
			}
		},

		data() {
			return {
				loading: false,
				page_loaded: false,
			};
		},

		methods: {
			/**
			 * Updates the avatar of the business into the server.
			 *
			 * @returns void
			 */
			updateBusinessAvatar() {
				this.loading = true;

				this.$emit("business-avatar-updated");
			},
		},

		mixins: [HasErrorMixin],
	};
</script>