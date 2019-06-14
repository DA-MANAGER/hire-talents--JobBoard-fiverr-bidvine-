<template>
    <div>
        <content-component>
            <!-- GET STARTED. -->
            <section class="jumbotron jumbotron-fluid mb-0 pt-0 bg-dark text-light">
                <div class="container-fluid px-5">
                    <div class="row py-4 px-5">
                        <div class="col">
                            <header-component></header-component>
                        </div>
                    </div>

                    <div class="row mt-5 mb-3 pt-2 px-5">
                        <div class="col-md-7">
                            <h1 class="display-4 font-weight-bold text-dark">Hire Talented<br>Individuals &amp; Businesses.</h1>
                            <h3 class="my-4 text-secondary">Our community of experts gives you the power to find the right person for any project in minutes.</h3>

                            <form-service-proposal-component class="shadow"></form-service-proposal-component>
                        </div>

                        <div class="col">
                            <div id="clipped-background-wrapper">
                                <div id="clipped-background">
                                    <div id="background-inner-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- GET STARTED. -->

            <!-- EXPLORE SERVICES. -->
            <section id="explore-services" class="bg-white py-5">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <h2 class="font-weight-bold">Delve Into Our Pool Of Talents</h2>
                            <p class="lead">Browse through our categories and get the help you need</p>
                        </div>
                    </div>

                    <services-list-component v-bind:services="services"></services-list-component>

                    <div
                        class="row"
                        v-if="show_load_more_services_button"
                        >
                        <div class="col">
                            <div class="text-center">
                                <button
                                    class="btn btn-outline-primary font-weight-bold mt-4 text-uppercase"
                                    @click="fetchAppServices"
                                    v-bind:disabled="loading"
                                    >Show more
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- EXPLORE SERVICES. -->

            <!-- HOW IT WORKS. -->
            <section id="how-it-works" class="bg-white py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <h2 class="font-weight-bold text-capitalize my-4">How it works.</h2>

                            <ul class="how-it-works-list my-5">
                                <li class="list-item">
                                    <span class="counter">1</span>

                                    <h4 class="mb-3">Post A Job Ad</h4>
                                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id modi neque nam eos doloremque recusandae quis nihil.</p>
                                </li>

                                <li class="list-item">
                                    <span class="counter">2</span>

                                    <h4 class="mb-3">Connect With Freelancers</h4>
                                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id modi neque nam eos doloremque recusandae quis nihil.</p>
                                </li>

                                <li class="list-item">
                                    <span class="counter">3</span>

                                    <h4 class="mb-3">Seemless Collaboration</h4>
                                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id modi neque nam eos doloremque recusandae quis nihil.</p>
                                </li>

                                <li class="list-item">
                                    <span class="counter">4</span>

                                    <h4 class="mb-3">Secured Payments</h4>
                                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id modi neque nam eos doloremque recusandae quis nihil.</p>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-lg mb-5 shadow-sm">Get started</a>
                        </div>

                        <div class="col">
                            <div id="how-it-works-background">
                                <img src="./../../../images/laptop.png">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- HOW IT WORKS. -->

            <!-- REVIEWS. -->
            <section id="reviews" class="bg-white border-top py-4">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <h3 class="font-weight-bold text-capitalize text-center my-4">Client Feedback.</h3>
                                    <p class="lead text-muted">Listen to what our users (Freelancers and Buyers) say about our platform.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col my-5 text-center">
                                    <reviews-slider-component
                                        v-bind:reviews="reviews"></reviews-slider-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- REVIEWS. -->

            <!-- JOIN NOW. -->
            <section id="join-now" class="bg-primary">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="py-5 text-center text-white">
                                <h2>Join {{ $appName }} Today</h2>
                                <p class="lead">If you're a freelancer or a business owner. Then this platform is for you.</p>
                            
                                <router-link
                                    class="btn btn-light btn-lg mt-4"
                                    v-bind:to="{ name: 'register' }"
                                    >Join now
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- JOIN NOW. -->
        </content-component>

        <footer-component></footer-component>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    import ContentComponent from "./../modules/ContentComponent.vue";
    import FooterComponent from "./../modules/FooterComponent.vue";
    import FormServiceProposalComponent from "./../modules/FormServiceProposalComponent.vue";
    import HeaderComponent from "./../modules/HeaderTransparentComponent.vue";
    import ReviewsSliderComponent from "./../modules/ReviewsSliderComponent.vue";
    import ServicesListComponent from "./../modules/ServicesListComponent.vue";

    export default {
        components: {
            ContentComponent,
            FooterComponent,
            FormServiceProposalComponent,
            HeaderComponent,
            ReviewsSliderComponent,
            ServicesListComponent,
        },

        computed: {
            show_load_more_services_button() {
                const meta = this.services_meta;

                if (
                    !meta.hasOwnProperty("current_page") ||
                    !meta.hasOwnProperty("last_page")
                ) {
                    return false;
                } else if (meta.current_page >= meta.last_page) {
                    return false;
                }

                return true;
            },

            ...mapGetters("ServiceStore", [
                "services",
                "services_meta"
            ])
        },

        created() {
            this.fetchAppServices();
        },

        data() {
            return {
                loading: false,

                reviews: [
                    {
                        ratings: 5,
                        review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid.'
                    },
                    {
                        ratings: 4,
                        review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid.'
                    },
                    {
                        ratings: 5,
                        review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid.'
                    },
                    {
                        ratings: 5,
                        review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid.'
                    },
                    {
                        ratings: 4,
                        review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid.'
                    },
                    {
                        ratings: 5,
                        review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid.'
                    },
                    {
                        ratings: 5,
                        review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid.'
                    },
                ],
            };
        },

        methods: {
            /**
             * Fetches the app services from the server.
             *
             * @returns void
             */
            async fetchAppServices() {
                this.loading = true;

                await this.$store.dispatch("ServiceStore/fetchServices");

                this.loading = false;
            }
        }
    };
</script>

<style lang="scss" scoped>
    .jumbotron {
        background-image: url('./../../../images/icons-background.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;

        &::before {
            background-color: rgba(255, 255, 255, 0.4);
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
        }

        h3 {
            line-height: 1.75;
        }

        #clipped-background {
            background-image: url('./../../../images/smiling-young-lady-working-on-laptop-at-cafe.jpg');
            background-position: center left;
            background-repeat: no-repeat;
            background-size: cover;
            -webkit-clip-path: circle(65% at 70% 30%);
            clip-path: circle(65% at 70% 30%);
            height: 650px;
            position: absolute;
            right: -81px;
            top: -200px;
            width: 650px;

            &::after {
                background-color: #328F28;
                content: '';
                display: block;
                -moz-opacity: 0.5;
                -khtml-opacity: 0.5;
                opacity: 0.5;
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                top: 0;
            }

            #background-inner-circle {
                background-color: #328F28;
                -webkit-clip-path: circle(60% at 70% 30%);
                clip-path: circle(60% at 70% 30%);
                height: 550px;
                -moz-opacity: 0.6;
                -khtml-opacity: 0.6;
                opacity: 0.6;
                position: absolute;
                right: 0;
                width: 550px;
            }
        }
    }

    #how-it-works {
        overflow: hidden;

        .how-it-works-list {
            border-left: 1px solid #F2F2F2;
            list-style-type: none;
            padding-left: 50px;

            .list-item {
                margin-bottom: 30px;
                position: relative;

                .counter {
                    background-color: #FFF;
                    border: 1px solid #F2F2F2;
                    border-radius: 50px;
                    font-size: 18px;
                    padding: 6px 18px;
                    position: absolute;
                    left: -75px;
                    top: -8px;
                }
            }
        }

        img {
            position: absolute;
            right: -200px;
            top: 120px;
            transform: scale(1.5);
            width: 100%;
        }
    }
</style>
