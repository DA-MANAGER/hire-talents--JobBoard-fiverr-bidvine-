<template>
    <div>
        <header-component></header-component>

        <content-component>
            <div class="container">
                <div v-if="page_loaded">
                    <div class="row my-3">
                        <div class="col-md-10 mx-auto">
                            <div class="row my-3">
                                <div class="col-md-8">
                                    <div class="bg-white rounded shadow-sm">
                                        <div class="px-4 pt-4 pb-2">
                                            <div class="mb-3">
                                                <p class="lead d-inline align-middle">Service Request Description</p>
                                                <span class="badge badge-primary align-middle ml-2" v-text="service_request.status"></span>
                                            </div>

                                            <p class="text-muted mb-0" v-text="service_request.description"></p>
                                        </div>

                                        <div class="px-4 pt-4 pb-2">
                                            <div
                                                v-for="(question, index) in questions"
                                                v-bind:index="index"
                                                v-bind:key="index"
                                                v-if="question.value !== null"
                                            >
                                                <p
                                                    class="font-weight-bold"
                                                    v-text="question.heading"
                                                ></p>

                                                <p v-text="question.value"></p>
                                            </div>
                                        </div>

                                        <div
                                            class="px-4 service-request-media-list"
                                            v-if="service_request.media.length > 0"
                                        >
                                            <p class="lead mb-1">Service Request Images</p>

                                            <media-list-component
                                                class="media-list"
                                                v-bind:media_list="service_request.media"
                                            ></media-list-component>
                                        </div>

                                        <div class="border-top d-flex align-items-center px-4 py-3 mt-2">
                                            <i class="fas fa-map-marker-alt icon text-danger"></i>

                                            <span class="text-primary" v-text="location"></span>
                                        </div>

                                        <div class="border-top p-4">
                                            <div class="row service-request-meta">
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <i class="fas fa-briefcase icon text-muted"></i>

                                                    <span class="font-weight-bold" v-text="service_request.service.name"></span>
                                                </div>

                                                <div
                                                    class="col-md-6 d-flex align-items-center"
                                                    v-if="service_request.accepted_bid !== null"
                                                >
                                                    <i class="far fa-money-bill-alt text-muted icon"></i>

                                                    <span
                                                        class="text-primary service-request-amount"
                                                    >24 USD</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-white px-4 pt-3 py-4 rounded shadow-sm">
                                        <div class="text-center">
                                            <media-component
                                                class="owner-avatar rounded-circle mx-auto my-3"
                                                src="./../../../images/avatar.png"
                                            ></media-component>

                                            <span class="badge badge-primary">Owner</span>
                                            <p
                                                class="font-weight-bold my-2"
                                                v-text="owner_name"
                                            ></p>
                                        </div>

                                        <div class="text-center">
                                            <div
                                                class="d-flex align-items-center my-2"
                                                v-if="service_request.owner.address !== null"
                                            >
                                                <i class="fas fa-map-marker-alt d-inline align-middle mr-2 text-danger"></i>

                                                <span
                                                    class="align-middle text-truncate"
                                                    v-text="service_request.owner.address"
                                                ></span>
                                            </div>

                                            <div class="d-flex align-items-center my-2">
                                                <i class="fas fa-envelope d-inline align-middle mr-2 text-muted"></i>

                                                <a
                                                    v-bind:href="'mailto:' + service_request.owner.email"
                                                    class="align-middle text-primary text-truncate"
                                                    v-text="service_request.owner.email"
                                                ></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="row my-4"
                                v-if="service_request.accepted_bid !== null"
                            >
                                <div class="col">
                                    <p class="font-weight-bold text-muted">
                                        Accepted Bid
                                    </p>

                                    <div class="bg-white border border-primary rounded shadow-sm">
                                        <bid-component
                                            v-bind:bid="service_request.accepted_bid"
                                            v-bind:is_accepted="true"
                                        ></bid-component>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="row my-4"
                                v-else
                            >
                                <div class="col">
                                    <p class="font-weight-bold text-muted">
                                        Bid On The Project
                                    </p>

                                    <div
                                        class="row"
                                        v-if="! is_authenticated"
                                    >
                                        <div class="col-md-6 mx-auto">
                                            <div class="alert alert-warning my-4">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text font-weight-bold">
                                                            You must sign in to bid on this project.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="row"
                                        v-else-if="businesses_by_user_id(auth_user.id).length < 1"
                                    >
                                        <div class="col-md-6 mx-auto">
                                            <div class="alert alert-warning my-4">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text font-weight-bold">
                                                            You must have a registered business to bid on this project.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <bid-form-component
                                        v-bind:service_request="service_request"
                                        v-else
                                    ></bid-form-component>
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col">
                                    <p class="font-weight-bold text-muted">
                                        More Bids
                                    </p>

                                    <div class="bg-white rounded shadow-sm">
                                        <bid-component
                                            v-for="index in 2"
                                            v-bind:index="index"
                                            v-bind:key="index"
                                        >
                                        </bid-component>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else>
                    <div class="row my-4">
                        <div class="col-md-6 mx-auto">
                            <div class="alert alert-warning my-4">
                                <div class="row">
                                    <div class="col">
                                        <p class="card-text font-weight-bold">
                                            The service request details are being fetched.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </content-component>

        <footer-component></footer-component>

        <businesses-sidebar-component
            v-if="display_businesses_sidebar"
        ></businesses-sidebar-component>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    import BidComponent from "./../modules/BidComponent.vue";
    import BidFormComponent from "./../modules/BidFormComponent.vue";
    import BusinessesSidebarComponent from "./../modules/BusinessesSidebarComponent.vue";
    import ContentComponent from "./../modules/ContentComponent.vue";
    import FooterComponent from "./../modules/FooterComponent.vue";
    import HeaderComponent from "./../modules/HeaderComponent.vue";
    import MediaComponent from "./../modules/MediaComponent.vue";
    import MediaListComponent from "./../modules/MediaListComponent.vue";

    export default {
        components: {
            BidComponent,
            BidFormComponent,
            BusinessesSidebarComponent,
            ContentComponent,
            FooterComponent,
            HeaderComponent,
            MediaComponent,
            MediaListComponent,
        },

        computed: {
            location() {
                let location = this.service_request.meta.find(meta => meta.key === 'locations').value;

                if (_.isObject(location)) {
                    location = `${ _.capitalize(location.city) }, ${ _.capitalize(location.state) }, ${ _.capitalize(location.country) }`;
                } else {
                    location = _.capitalize(location);
                }

                return location;
            },

            owner_name() {
                return this.service_request.owner.first_name + ' ' + this.service_request.owner.last_name;
            },

            questions() {
                return this.service_request.meta.find(meta => meta.key === 'questions').value;
            },

            service_request_id() {
                return parseInt(this.$route.params.id);
            },

            ...mapGetters("AuthStore", ["auth_user", "is_authenticated"]),

            ...mapGetters("BusinessStore", ["businesses_by_user_id"]),

            ...mapGetters("OptionStore", ["display_businesses_sidebar"]),

            ...mapGetters("ServiceStore", ["service_request_by_id"]),
        },

        async created() {
            /**
             * We'll start by checking if the service request id is
             * supplied and if not simply redirect to the error displaying
             * page of the application with an error message.
             */
            if (isNaN(this.service_request_id)) {
                this.$router.push({
                    name: "page-not-found",
                    query: { service_request: 1 }
                });

                return;
            }

            if (this.is_authenticated) {
                if (this.auth_user === undefined) {
                    const user = await this.$store.dispatch("AuthStore/authUser");

                    this.$store.dispatch("AuthStore/setAuthUser", user);
                }
            }

            /**
             * Finally, we'll determine if the service request exists with
             * the supplied service request id otherwise we'll redirect
             * the user to a page to display them the error.
             */
            try {
                this.service_request = this.service_request_by_id(this.service_request_id);

                if (_.isEmpty(this.service_request)) {
                    this.service_request = await this.$store.dispatch(
                                                "ServiceStore/fetchServiceRequestById",
                                                this.service_request_id
                                            );
                }

                this.page_loaded = true;
            } catch (err) {
                err = err.response || err;

                if (err.status === 404) {
                    this.$router.push({
                        name: "page-not-found",
                        query: { service_request: 1 }
                    });
                }
            }
        },

        data() {
            return {
                page_loaded: false,

                service_request: {},
            };
        }
    };
</script>

<style lang="scss" scoped>
    .icon {
        font-size: 22px;
        margin-right: 12px;
    }

    .service-request-meta .service-request-amount {
        font-size: 18px;
    }

    .business-avatar {
        height: 52px;
        margin: 5px auto 0;
        width: 52px;
    }

    .owner-avatar {
        height: 88px;
        width: 88px;
    }
</style>