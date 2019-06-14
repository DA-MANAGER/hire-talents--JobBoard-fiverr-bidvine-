import AlertComponent from "./../components/modules/AlertComponent.vue";

export default {
	components: {
		AlertComponent,
	},

	computed: {
		/**
		 * Determines whether the error is being shown on the screen.
		 *
		 * @return Boolean
		 */
		hasError() {
			return this.error.message.length > 0;
		},
	},

	data() {
		return {
			error: {
				message: "",
				type: "",
			},
		};
	},

	methods: {
		/**
		 * Returns the first error message out of the data provided.
		 *
		 * @param  Object data
		 *
		 * @return Object
		 */
		getFirstError(data) {
			let error = data.message;

			if (data.hasOwnProperty("errors")) {
				const errors = data.errors;
				const key = Object.keys(errors)[0];

				error = errors[key][0];
			}

			return error;
		},

		/**
		 * Displays the error message on the screen.
		 *
		 * @param  String message
		 * @param  String type
		 *
		 * @return void
		 */
		showError(message, type) {
			this.error.message = message;
			this.error.type = type;
		},

		/**
		 * Hides the error message from the screen.
		 *
		 * @return void
		 */
		resetError() {
			this.error.message = "";
			this.error.type = "";
		},
	},
};
