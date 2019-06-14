<template>
		<div>
			<header-component></header-component>

			<content-component>
				<div class="container-fluid">
                    <div v-if="page_loaded">
                        <div class="row bg-primary">
                            <div class="col">
                                <div class="primary-blank-header">
                                </div>
                            </div>
                        </div>

                        <div class="row bg-white">
                            <div class="col">
                                <div class="container">
                                    <div class="row profile-navigation py-2">
                                        <div class="col">
                                            <media-component
                                                class="profile-avatar rounded-circle"
                                                src="./../../../images/avatar.png"></media-component>

                                            <div class="business-info">
                                                <span class="business-name" v-text="business.name"></span>
                                                <span class="badge badge-pill badge-warning text-capitalize" v-text="business.level"></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-overview-tab" data-toggle="pill" href="#pills-overview" role="tab" aria-controls="pills-overview" aria-selected="true">Overview</a>
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-faqs-tab" data-toggle="pill" href="#pills-faqs" role="tab" aria-controls="pills-faqs" aria-selected="false">FAQs</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col">
                                            <div class="text-right">
                                                <a href="#" class="btn btn-light">
                                                    <i class="fa fa-cogs"></i> Settings
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row mt-2 mb-4">
                                                        <div class="col">
                                                            <div class="card border-0 px-3 pt-3 pb-0 shadow-sm">
                                                                <div class="card-header bg-white border-0">
                                                                    <p class="card-text font-weight-bold">Bio</p>
                                                                </div>
                                                                
                                                                <div class="card-body pt-0 text-muted">
                                                                    <p>
                                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum nostrum suscipit doloremque non veritatis inventore reprehenderit sapiente iure debitis eius fugiat, iste recusandae quo pariatur voluptates, laboriosam at ex id.
                                                                    </p>

                                                                    <p>
                                                                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.    
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-4">
                                                        <div class="col">
                                                            <div class="card border-0 px-3 pt-3 pb-0 shadow-sm">
                                                                <div class="card-header bg-white border-0">
                                                                    <p class="card-text font-weight-bold">Media <span class="text-muted">({{ media_list(owner).length }})</span></p>
                                                                </div>
                                                                
                                                                <div class="card-body pt-0">
                                                                    <media-list-component
                                                                        v-bind:media_list="media_list(owner)"
                                                                        v-bind:show_upload_button="true"
                                                                        @handleFileChange="handleUploadMedia"></media-list-component>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-4">
                                                        <div class="col">
                                                            <div class="card border-0 px-3 pt-3 pb-0 shadow-sm">
                                                                <div class="card-header bg-white border-0">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <p class="card-text font-weight-bold">Reviews <span class="text-muted">({{ reviews.length }})</span></p>
                                                                        </div>

                                                                        <div class="col">
                                                                            <div class="text-right">
                                                                                <a href="#" class="btn btn-outline-primary btn-sm">Submit Review</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="card-body pt-0">
                                                                    <reviews-slider-component
                                                                        v-bind:reviews="reviews"></reviews-slider-component>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="card border-0 mt-2 p-3 shadow-sm">
                                                        <div class="card-body text-muted">
                                                            <div>
                                                                <span class="badge badge-pill badge-warning text-capitalize" v-text="business_type"></span>

                                                                <div class="my-2">
                                                                    <i class="fa fa-envelope mr-2 text-dark"></i> prakashabhishek6262@gmail.com
                                                                </div>

                                                                <div class="my-2" v-if="business.website !== null">
                                                                    <i class="fa fa-link mr-2 text-dark"></i> <a v-bind:href="business.website" v-text="business.website"></a>
                                                                </div>

                                                                <div class="my-2">
                                                                    <i class="fa fa-phone mr-2 text-dark"></i> +91 9557002551
                                                                </div>

                                                                <div class="my-2">
                                                                    <i class="fa fa-compass mr-2 text-dark"></i> Lorem ipsum dolor sit amet.
                                                                </div>

                                                                <div class="my-2" v-if="business.founding_year !== null">
                                                                    <i class="fa fa-calendar-plus mr-2 text-dark"></i> {{ business.founding_year }}
                                                                </div>
                                                            </div>

                                                            <div class="mt-4">
                                                                <p class="font-weight-bold text-dark">Services Offered</p>

                                                                <div class="services">
                                                                    <a href="#" class="badge badge-light service-item"
                                                                        v-for="(service, index) in business.services"
                                                                        v-bind:index="index"
                                                                        v-bind:key="index"
                                                                        v-text="service.name"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pills-faqs" role="tabpanel" aria-labelledby="pills-faqs-tab">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">    
                                                    <div class="card border-0 mt-2 p-3 shadow-sm">
                                                        <div class="card-body text-muted">
                                                            <div class="mb-4">
                                                                <h5 class="text-dark mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id quis?</h5>
                                                                <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi itaque nihil commodi corporis voluptatem rem earum eaque neque. Fugiat cupiditate quam repellendus nam culpa amet facilis quaerat maxime. Quibusdam, sunt!</p>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h5 class="text-dark mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id quis?</h5>
                                                                <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi itaque nihil commodi corporis voluptatem rem earum eaque neque. Fugiat cupiditate quam repellendus nam culpa amet facilis quaerat maxime. Quibusdam, sunt!</p>
                                                            </div>
                                                            
                                                            <div class="mb-4">
                                                                <h5 class="text-dark mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id quis?</h5>
                                                                <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi itaque nihil commodi corporis voluptatem rem earum eaque neque. Fugiat cupiditate quam repellendus nam culpa amet facilis quaerat maxime. Quibusdam, sunt!</p>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h5 class="text-dark mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id quis?</h5>
                                                                <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi itaque nihil commodi corporis voluptatem rem earum eaque neque. Fugiat cupiditate quam repellendus nam culpa amet facilis quaerat maxime. Quibusdam, sunt!</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                The business details are being fetched.
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

import BusinessesSidebarComponent from "./../modules/BusinessesSidebarComponent.vue";
import ContentComponent from "./../modules/ContentComponent.vue";
import FooterComponent from "./../modules/FooterComponent.vue";
import HeaderComponent from "./../modules/HeaderComponent.vue";
import MediaComponent from "./../modules/MediaComponent.vue";
import MediaListComponent from "./../modules/MediaListComponent.vue";
import ReviewsSliderComponent from "./../modules/ReviewsSliderComponent.vue";

export default {
    components: {
		BusinessesSidebarComponent,
        ContentComponent,
        FooterComponent,
        HeaderComponent,
        MediaComponent,
        MediaListComponent,
		ReviewsSliderComponent,
    },

    computed: {
        business_id() {
            return parseInt(this.$route.params.id);
        },

        business() {
            return this.businesses(this.business_id);
        },

        business_type() {
            return this.business.type.replace(/-/g, " ");;
        },

        owner() {
            return {
                id: this.business_id,
                type: 'business',
            }
        },

        ...mapGetters("BusinessStore", ["businesses"]),

        ...mapGetters("MediaStore", ["media_list"]),

        ...mapGetters("OptionStore", ["display_businesses_sidebar"]),
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

        /**
         * Finally, we'll determine if the business exists with the
         * supplied business id otherwise we'll redirect the user to
         * a page to display them the error.
         */
        try {
            const business = this.businesses(this.business_id);

            if (_.isEmpty(business)) {
                await this.$store.dispatch(
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
                    query: { business: 1 }
                });
            }
        }

        await this.$store.dispatch('MediaStore/fetchMedia', this.owner);
    },

    data() {
        return {
            page_loaded: false,

			reviews: [
                {
                    review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid, quos molestias dicta sint nulla velit magnam sed accusantium autem cumque reiciendis rem unde adipisci?',
                    ratings: 4,
                },
                {
                    review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid, quos molestias dicta sint nulla velit magnam sed accusantium autem cumque reiciendis rem unde adipisci?',
                    ratings: 4,
                },
                {
                    review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid, quos molestias dicta sint nulla velit magnam sed accusantium autem cumque reiciendis rem unde adipisci?'
                },
                {
                    review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid, quos molestias dicta sint nulla velit magnam sed accusantium autem cumque reiciendis rem unde adipisci?'
                },
                {
                    review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid, quos molestias dicta sint nulla velit magnam sed accusantium autem cumque reiciendis rem unde adipisci?'
                },
                {
                    review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid, quos molestias dicta sint nulla velit magnam sed accusantium autem cumque reiciendis rem unde adipisci?'
                },
                {
                    review: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quibusdam, voluptatem natus, mollitia voluptate aliquid, quos molestias dicta sint nulla velit magnam sed accusantium autem cumque reiciendis rem unde adipisci?'
                },
            ]
        };
    },

    methods: {
        /**
         * Uploads the media file to the server on behalf of the business.
         * 
         * @param   File file
         * 
         * @returns void
         */
        handleUploadMedia(file) {
            const form_data = new FormData;

            form_data.append('id', this.business_id);
            form_data.append('media', file);
            form_data.append('type', 'business');

            this.$store.dispatch('MediaStore/registerMedia', form_data);
        }
    }
};
</script>

<style lang="scss" scoped>
    .primary-blank-header {
        padding: 70px 0;
    }

    .profile-navigation {
        position: relative;

        .profile-avatar {
            border: 3px solid #FFF;
            height: 120px;
            position: absolute;
            left: 0;
            top: -80px;
            width: 120px;
            z-index: 99;
        }

        .business-info {
            margin-left: 130px;
            position: absolute;
            top: -50px;

            .business-name {
                color: #FFF;
                font-size: 22px;
                font-weight: bold;
                margin-right: 8px;
                vertical-align: middle;
            }
        }
    }

    .service-item {
        margin: 5px 10px 5px 0;
    }
</style>
