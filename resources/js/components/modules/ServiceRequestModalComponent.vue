<template>
    <div class="project-questions-modal d-flex align-items-center justify-content-center">
        <div class="project-modal-body bg-dark rounded">
            <span class="btn-close text-white" @click="$emit('closeModal')">
                <i class="fas fa-times-circle"></i>
            </span>

            <div class="mt-4 p-5 text-white">
                <h2
                    class="mt-1 mb-4"
                    v-text="data.heading"
                ></h2>

                <div v-if="show_service_basic_details_options">
                    <div class="options">
                        <component
                            v-bind:is="optionsComponent"
                            v-bind:options="data.options"
                            v-on:set-value="setServiceBasicDetail"
                        ></component>
                    </div>
                </div>

                <div v-else>
                    <div class="options">
                        <component
                            v-bind:is="optionsComponent"
                            v-bind:options="data.options"
                            v-on:set-value="setQuestionOptionValue"
                        ></component>
                    </div>
                </div>

                <button
                    class="btn btn-lg font-weight-bold mt-4"
                    :class="{
                        'btn-primary': isFormCompleted,
                        'btn-light': ! isFormCompleted
                    }"
                    @click="processForm"
                    v-bind:disabled="loading"
                    v-text="buttonText"
                ></button>
            </div>
        </div>

        <div class="background-blur" @click="$emit('closeModal')"></div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    import HandleServiceRequestMixin from "./../../mixins/HandleServiceRequestMixin";
    import ElementLocationComponent from "./ServiceOptionTypes/ElementLocationComponent.vue";
    import ElementMediaComponent from "./ServiceOptionTypes/ElementMediaComponent.vue";
    import ElementRadioComponent from "./ServiceOptionTypes/ElementRadioComponent.vue";
    import ElementSelectComponent from "./ServiceOptionTypes/ElementSelectComponent.vue";
    import ElementTextareaComponent from "./ServiceOptionTypes/ElementTextareaComponent.vue";

    export default {
        components: {
            ElementLocationComponent,
            ElementMediaComponent,
            ElementRadioComponent,
            ElementSelectComponent,
            ElementTextareaComponent,
        },

        computed: {
            buttonText() {
                return this.loading ? "Processing..." : (this.isFormCompleted ? "Submit" : "Continue");
            },

            data() {
                let data = {
                    "heading": "Just a few questions to make sure we bring you the right pros.",
                    "options": [],
                    "visibility_type": undefined
                };

                if (this.step === -1) {
                    return data;
                } else if (this.show_service_basic_details_options) {
                    data = this.service_basic_details[this.step];
                } else {
                    data = this.questions[this.step];
                }

                return data;
            },

            isFinalQuestion() {
                return this.unansweredQuestions.length === 1;
            },

            isFinalServiceDetail() {
                return (this.step + 1) === this.service_basic_details.length;
            },

            isFormCompleted() {
                return (this.isQuestionsCompleted && this.isFinalServiceDetail);
            },

            isQuestionsCompleted() {
                return this.unansweredQuestions.length === 0;
            },

            optionsComponent() {
                if (this.data.visibility_type !== undefined) {
                    return "element-" + this.data.visibility_type + "-component";
                }
            },

            questions() {
                return this.service_request.questions;
            },

            unansweredQuestions() {
                return this.questions.filter(question => question.value === undefined);
            },

            ...mapGetters("AuthStore", ["auth_user", "is_authenticated"]),
        },

        created() {
            this.service_request = this.generateServiceRequestFromService(
                                        this.service,
                                        this.service_basic_details
                                    );
        },

        data() {
            return {
                loading: false,
                show_service_basic_details_options: false,
                step: -1,
                service_basic_details: [
                    {
                        heading: 'Enter more details about the service.',
                        options: {
                            key: 'description'
                        },
                        visibility_type: 'textarea',
                    },
                    {
                        heading: 'Select service location preference.',
                        options: {
                            key: 'location'
                        },
                        visibility_type: 'location'
                    },
                    {
                        heading: 'Do you have any images to share for the service?',
                        options: {
                            key: 'media'
                        },
                        visibility_type: 'media'
                    }
                ],
                service_request: {},
            };
        },

        methods: {
            processForm() {
                const step = this.step + 1;

                if (this.step === -1) {
                    this.setStep(step);

                    return;
                }

                // We'll set the default value of the question as null if
                // it is not set already so it gets marked as completed
                // and the "isQuestionsCompleted" property does not take
                // the question as left to ask.
                if (! this.isQuestionsCompleted && this.service_request.questions[this.step].value === undefined) {
                    this.setQuestionOptionValue(null);
                }

                if (this.isFormCompleted) {
                    this.submitForm();

                    return;
                } else if (this.isQuestionsCompleted && ! this.show_service_basic_details_options) {
                    this.show_service_basic_details_options = true;
                    this.setStep(0);

                    return;
                }

                this.setStep(step);
            },

            setQuestionOptionValue(value) {
                this.$set(this.service_request.questions[this.step], 'value', value);
            },

            setServiceBasicDetail({ key, value }) {
                this.$set(this.service_request, key, value);
            },

            setStep(step) {
                const total_steps = this.show_service_basic_details_options ?
                                        this.service_basic_details.length :
                                        this.questions.length;

                step = step > 0 ? step : 0;

                this.step = total_steps < step ? total_steps : step; 
            },

            async submitForm() {
                this.loading = true;

                const meta = [
                    {
                        key: 'locations',
                        value: this.service_request.location,
                    },
                    {
                        key: 'questions',
                        value: this.service_request.questions,
                    }
                ];

                this.$set(this.service_request, 'meta', JSON.stringify(meta));

                if (! this.is_authenticated) {
                    this.preserveServiceRequest(this.service_request);

                    this.$router.push({
                        name: 'register',
                        query: { process_service_request: 1 },
                    });

                    return;
                }

                this.$set(this.service_request, "owner_id", this.auth_user.id);
                this.$set(this.service_request, "owner_type", "user");

                const service_request = await this.$store.dispatch(
                                            "ServiceStore/registerServiceRequest",
                                            this.service_request
                                        );

                this.$router.push({
                    name: "service-request",
                    params: {
                        id: service_request.id
                    }
                });
            }
        },

        mixins: [
            HandleServiceRequestMixin
        ],

        props: {
            service: Object
        }
    };
</script>

<style lang="scss" scoped>
    .project-modal-body {
        min-height: 360px;
        position: fixed;
        left: calc(50% - 300px);
        top: 75px;
        width: 600px;
        z-index: 999;

        .btn-close {
            cursor: pointer;
            font-size: 32px;
            position: absolute;
            right: -10px;
            top: -20px;
        }
    }
</style>
