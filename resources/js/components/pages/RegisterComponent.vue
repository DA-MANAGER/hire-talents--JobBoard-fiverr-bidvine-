<template>
    <div>
        <header-component></header-component>

        <content-component>
            <div class="container-fluid">
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

                                <h4
                                    class="mb-4"
                                    style="line-height: 1.6;"
                                    v-html="heading">
                                </h4>

                                <form v-on:submit.prevent="registerUser">
                                    <label
                                        class="font-weight-bold"
                                        for="first-name"
                                        >Enter your contact information:</label
                                    >

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="first-name"
                                                placeholder="John"
                                                v-model="first_name"
                                            />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Smith"
                                                v-model="last_name"
                                            />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <input
                                            type="email"
                                            class="form-control"
                                            placeholder="you@example.com"
                                            v-model="email"
                                        />
                                    </div>

                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    >+44</span
                                                >
                                            </div>

                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Phone number"
                                                v-model="phone"
                                            />
                                        </div>
                                    </div>

                                    <label
                                        class="font-weight-bold"
                                        for="password"
                                        >Secure your account with a
                                        password:</label
                                    >

                                    <div class="mb-3">
                                        <input
                                            type="password"
                                            id="password"
                                            class="form-control"
                                            placeholder="password"
                                            v-model="password"
                                        />
                                    </div>

                                    <div
                                        class="custom-control custom-checkbox mb-3"
                                    >
                                        <input
                                            class="custom-control-input"
                                            id="terms"
                                            type="checkbox"
                                            v-model="terms_accepted"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="terms"
                                            >I agree to {{ $appName }}
                                            <a href="#">terms of service</a> and
                                            <a href="#">privacy policy</a
                                            >.</label
                                        >
                                    </div>

                                    <div class="text-right">
                                        <button
                                            class="btn btn-primary btn-lg"
                                            type="submit"
                                            v-bind:disabled="loading"
                                        >
                                            <span v-if="loading"
                                                >Processing...</span
                                            >
                                            <span v-else>Sign up</span>
                                    </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md bg-dark"></div>
                </div>
            </div>
        </content-component>

        <footer-component></footer-component>
    </div>
</template>

<script>
    import { USERS } from "./../../routes/api";
    import { mapGetters } from "vuex";

    import HandleServiceRequestMixin from "./../../mixins/HandleServiceRequestMixin";
    import HasErrorMixin from "./../../mixins/HasErrorMixin";
    import ContentComponent from "./../modules/ContentComponent.vue";
    import FooterComponent from "./../modules/FooterComponent.vue";
    import HeaderComponent from "./../modules/HeaderComponent.vue";

    export default {
        components: {
            ContentComponent,
            FooterComponent,
            HeaderComponent
        },

        computed: {
            heading () {
                let heading = "Create your account<br>to get great deals on services.";

                const setup_business = parseInt(
                    this.$route.query.setup_business
                );

                const process_service_request = parseInt(
                    this.$route.query.process_service_request
                );

                if (setup_business === 1) {
                    heading = "Create your account<br>and start winning your business today.";
                } else if (process_service_request === 1) {
                    heading = "Register your account now<br>to complete the request for the service.";
                }

                return heading;
            },

            ...mapGetters("AuthStore", ["auth_user"]),
        },

        data() {
            return {
                loading: false,
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                phone: "",
                terms_accepted: false
            };
        },

        methods: {
            /**
             * Registers the user into the application.
             *
             * @returns void
             */
            async registerUser() {
                // Remove any error from the screen and display a
                // loading state on the screen so the user could know that
                // the we've initialized the process of registration into
                // the application.
                this.resetError();
                this.loading = true;

                if (!this.terms_accepted) {
                    this.showError(
                        "Sorry! You need to accept our terms of service and privacy policy to proceed.",
                        "danger"
                    );

                    this.loading = false;

                    return;
                }

                try {
                    const data = {
                        first_name: this.first_name,
                        last_name: this.last_name,
                        email: this.email,
                        password: this.password,
                        phone: this.phone
                    };

                    const resp = await axios.post(USERS, data);
                    const user = resp.data.data;

                    const credentials = {
                        username: data.email,
                        password: data.password
                    };

                    await this.$store.dispatch(
                        "AuthStore/authRequest",
                        credentials
                    );

                    await this.$store.dispatch("AuthStore/setAuthUser", user);

                    const process_service_request = parseInt(
                        this.$route.query.process_service_request
                    );

                    if (process_service_request === 1) {
                        const service_request = this.recoverServiceRequest();

                        service_request.owner_id  = this.auth_user.id;
                        service_request.owner_type = "user";

                        await this.$store.dispatch("ServiceStore/registerServiceRequest", service_request);
                    }

                    const setup_business = parseInt(
                        this.$route.query.setup_business
                    );

                    let route = { name: "home" };
                    
                    if (setup_business === 1) {
                        route.name = "register-business";
                    }

                    this.$router.push(route);
                } catch (err) {
                    this.showError(this.getFirstError(err.data), "danger");
                }

                this.loading = false;
            }
        },

        mixins: [
            HandleServiceRequestMixin,
            HasErrorMixin
        ]
    };
</script>

<style lang="scss" scoped>
    .form-wrapper {
        min-height: 520px;

        > div {
            max-width: 480px;
            width: 100%;
        }
    }
</style>
