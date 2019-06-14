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
                        Profile Enhancement Kick-off.
                    </h4>

                    <form v-on:submit.prevent="updateBusinessProfile">
                        <label class="font-weight-bold" for="founding-year"
                            >Year of founding company:</label
                        >

                        <div class="mb-3">
                            <input
                                type="number"
                                id="founding-year"
                                class="form-control"
                                v-model="founding_year"
                            />
                        </div>

                        <label class="font-weight-bold" for="company-website"
                            >Company Website (optional):</label
                        >

                        <div class="mb-3">
                            <input
                                type="url"
                                id="company-website"
                                class="form-control"
                                placeholder="https://www.example.com"
                                v-model="website"
                            />
                        </div>

                        <div
                            v-for="(data, index) in questions"
                            v-bind:key="index"
                            v-bind:index="index"
                        >
                            <label
                                class="font-weight-bold"
                                v-bind:for="'question-' + index"
                                >{{ data.question }}
                                <span v-if="data.optional"
                                    >(Optional)</span
                                ></label
                            >

                            <div class="mb-3">
                                <textarea
                                    v-bind:id="'question-' + index"
                                    class="form-control"
                                    v-model="data.answer"
                                ></textarea>
                                <p class="text-muted d-block mb-0 mt-2">
                                    <span
                                        class="font-weight-bold"
                                        v-text="data.answer.length"
                                    ></span>
                                    characters ({{
                                        min_answer_length
                                    }}
                                    minimum).
                                </p>
                            </div>
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

            ...mapGetters("BusinessStore", ["businesses"]),

            ...mapGetters("OptionStore", ["options", "option_exists"])
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
                 * Next, we'll fetch all the questions associated with the
                 * business.
                 */
                const option = {
                    key: "business_questions",
                    owner: {
                        id: this.business_id,
                        type: "business"
                    }
                };

                let business_questions = this.options(option);

                if (business_questions.length < 1) {
                    await this.$store.dispatch(
                        "OptionStore/fetchBusinessOptions",
                        this.business_id
                    );

                    business_questions = this.options(option);
                }

                /**
                 * Finally, we'll wrap it up by actually updating the
                 * component with the recent fetched details of the
                 * business to reflect it on the screen.
                 */
                if (!_.isEmpty(business.founding_year)) {
                    this.founding_year = business.founding_year;
                }

                if (!_.isEmpty(business.website)) {
                    this.website = business.website;
                }

                if (business_questions.length > 0) {
                    const questions = business_questions[0].value;

                    questions.forEach(data => {
                        const index = this.questions.findIndex(
                            _data => _data.question === data.question
                        );

                        this.questions[index].answer = data.answer;
                    });
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

                founding_year: 1998,
                website: "",
                questions: [
                    {
                        question:
                            "What differentiates your company from others offering the same service?",
                        answer: "",
                        optional: false
                    },
                    {
                        question:
                            "What does offering great service mean to you?",
                        answer: "",
                        optional: true
                    },
                    {
                        question:
                            "If a customer likes your bid, what are the typical next steps to get hired and complete the work?",
                        answer: "",
                        optional: false
                    },
                    {
                        question:
                            "Under what circumstances would you offer the discounts?",
                        answer: "",
                        optional: true
                    }
                ],

                min_answer_length: 120
            };
        },

        methods: {
            /**
             * Updates the profile of the business.
             *
             * @returns void
             */
            async updateBusinessProfile() {
                // Remove any error from the screen and display a
                // loading state on the screen so the user could know that
                // the we've initialized the process of updating into
                // the application.
                this.resetError();
                this.loading = true;

                const invalid_answers = this.questions.filter(
                    _data =>
                        (_data.optional === false &&
                            _data.answer.length < this.min_answer_length) ||
                        (_data.answer.length > 0 &&
                            _data.answer.length < this.min_answer_length)
                );

                if (invalid_answers.length > 0) {
                    this.showError(
                        `Please write at least ${
                            this.min_answer_length
                        } characters for: <span class="font-weight-bold">${
                            invalid_answers[0].question
                        }</span>`,
                        "danger"
                    );

                    this.loading = false;

                    return;
                }

                try {
                    /**
                     * Next, we'll update the basic details of the
                     * business into server.
                     */
                    const data = {
                        business_id: this.business_id,
                        data: {
                            founding_year: this.founding_year,
                            website: this.website
                        }
                    };

                    await this.$store.dispatch(
                        "BusinessStore/updateBusiness",
                        data
                    );

                    /**
                     * Finally, we'll finish it by storing extra
                     * information about the business into the server.
                     */
                    const business_questions = this.questions.map(_data => {
                        return {
                            question: _data.question,
                            answer: _data.answer
                        };
                    });

                    const option = {
                        key: "business_questions",
                        value: business_questions,
                        owner: {
                            id: this.business_id,
                            type: "business"
                        }
                    };

                    await this.$store.dispatch(
                        "OptionStore/registerBusinessOption",
                        option
                    );

                    this.$emit("business-profile-updated");
                } catch (err) {
                    this.showError(this.getFirstError(err.data), "danger");
                }

                this.loading = false;
            }
        },

        mixins: [HasErrorMixin]
    };
</script>
