<template>
    <div>
        <header-component></header-component>

        <content-component>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md bg-white">
                        <div class="form-wrapper d-flex align-items-center justify-content-center p-5">
                            <div>
                                <alert-component
                                    class="my-4"
                                    v-if="hasError"
                                    v-bind:error="error"
                                ></alert-component>

                                <h4 class="mb-4">Log in</h4>

                                <form v-on:submit.prevent="requestLogin">
                                    <div class="mb-3">
                                        <input
                                            type="email"
                                            class="form-control form-control-lg"
                                            placeholder="you@example.com"
                                            v-model="username"
                                        />
                                    </div>

                                    <div class="mb-3">
                                        <input
                                            type="password"
                                            id="password"
                                            class="form-control form-control-lg"
                                            placeholder="password"
                                            v-model="password"
                                        />
                                    </div>

                                    <div class="text-right">
                                        <button
                                            class="btn btn-primary btn-lg"
                                            type="submit"
                                            v-bind:disabled="loading"
                                        >
                                            <span v-if="loading">Processing...</span>
                                            <span v-else>Sign in</span>
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

        data() {
            return {
                loading: false,
                username: "",
                password: ""
            };
        },

        methods: {
            /**
             * Logs in the user into the application.
             *
             * @returns void
             */
            async requestLogin() {
                // Remove any error from the screen and display a
                // loading state on the screen so the user could know that
                // the we've initialized the process of log in into the
                // application.
                this.resetError();
                this.loading = true;

                try {
                    const data = {
                        username: this.username,
                        password: this.password
                    };

                    // Next, We'll proceed by trying to generate the access
                    // token for the user so they could interact with the
                    // server using that token.
                    await this.$store.dispatch("AuthStore/authRequest", data);

                    // Finally, we'll wrap it up by fetching the newly
                    // authenticated user details from the server and
                    // storing them into the store and redirecting them to
                    // their desired location.
                    const user = await this.$store.dispatch(
                        "AuthStore/authUser"
                    );

                    this.$store.dispatch("AuthStore/setAuthUser", user);

                    const path = this.$route.query.redirect;

                    if (path !== undefined) {
                        this.$router.push({ path });
                    } else {
                        this.$router.push({ name: "administration" });
                    }
                } catch (err) {
                    this.showError(this.getFirstError(err.data), "danger");
                }

                this.loading = false;
            }
        },

        mixins: [HasErrorMixin]
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
