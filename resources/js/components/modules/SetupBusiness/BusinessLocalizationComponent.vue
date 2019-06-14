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
                                    You'll see the customers location on every request.
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
								v-for="(localization, index) in localizations"
								v-bind:key="index"
								v-bind:index="index"
								v-bind:class="{
									active:
										localizationExistsInSelections(localization) !== -1,
								}"
								@click="toggleLocalization(localization);"
							>
								{{ localization }}
								<span
									class="badge bg-white text-dark"
									v-if="
										localizationExistsInSelections(localization) !== -1
									"
								>
									<i class="fas fa-check"></i>
								</span>
							</li>
						</ul>

						<div class="text-right">
							<button
								class="btn btn-primary btn-lg"
								type="submit"
								v-bind:disabled="loading"
								@click="updateBusinessLocalization"
							>
								<span v-if="loading">Processing...</span>
								<span v-else>Continue</span>
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

		business_localizations() {
			const option = {
				key: this.option_key,
				owner: {
					id: this.business_id,
					type: "business",
				},
			};

			const localizations = this.options(option);

			return localizations.length > 0 ? localizations[0].value : [];
		},

		localizations() {
			const option = {
				key: this.option_key,
				owner: "app",
			};

			const localizations = this.options(option);

			return localizations.length > 0 ? localizations[0].value : [];
		},

		...mapGetters("OptionStore", ["options", "option_exists"]),
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
			if (this.business_localizations.length < 1) {
				await this.$store.dispatch(
					"OptionStore/fetchBusinessOptions",
					this.business_id
				);
			}

			if (this.localizations.length < 1) {
				await this.$store.dispatch("OptionStore/fetchAppOptions");
			}

			this.selected_localizations = this.business_localizations;

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

			option_key: "business_localization",
			selected_localizations: [],
		};
	},

	methods: {
		/**
		 * Determines whether the localization exists in the selection.
		 *
		 * @param   String localization
		 *
		 * @returns Number
		 */
		localizationExistsInSelections(localization) {
			return this.selected_localizations.indexOf(localization);
		},

		/**
		 * Toggles the localization in the selection.
		 *
		 * @param   String localization
		 *
		 * @returns Number
		 */
		toggleLocalization(localization) {
			const index = this.localizationExistsInSelections(localization);

			if (index !== -1) {
				this.selected_localizations.splice(index, 1);
			} else {
				this.selected_localizations.push(localization);
			}
		},

		/**
		 * Updates the localization of the business into the
		 * application.
		 *
		 * @returns void
		 */
		async updateBusinessLocalization() {
			// Remove any error from the screen and display a
			// loading state on the screen so the user could know that
			// the we've initialized the process of updating into
			// the application.
			this.resetError();
			this.loading = true;

			try {
				const option = {
					key: "business_localization",
					value: this.selected_localizations,
					owner: {
						id: this.business_id,
						type: "business",
					},
				};

				if (this.selected_localizations.length > 0) {
					await this.$store.dispatch(
						"OptionStore/registerBusinessOption",
						option
					);
				}

				this.$emit("business-localization-updated");
			} catch (err) {
				this.showError(this.getFirstError(err.data), "danger");
			}

			this.loading = false;
		},
	},

	mixins: [HasErrorMixin],
};
</script>
