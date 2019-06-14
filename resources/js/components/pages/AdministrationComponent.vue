<template>
    <div>
        <header-component></header-component>

		<content-component>
			<div class="container py-4">
                <div class="row my-3">
                    <div class="col text-center">
                        <h3>Administration Page</h3>
                        <p class="lead text-muted">A Centralized Place To Manage Your Account.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 mx-auto">
                        <p class="text-muted">Businesses</p>

                        <div class="mb-4">
                            <div class="row"
                                v-for="(business, b_index) in businesses"
                                v-bind:index="b_index"
                                v-bind:key="b_index">
                                <div class="col py-0">
                                    <div class="bg-white border-bottom p-3 shadow-sm">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <media-component
                                                    class="business-avatar rounded-circle"
                                                    src="./../../../images/avatar.png"></media-component>
                                            </div>

                                            <div class="col-md pl-0">
                                                <div class="mb-2">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <p class="d-inline font-weight-bold align-middle" v-text="business.name"></p>
                                                            <span class="badge badge-warning d-inline align-middle ml-2" v-text="business.level"></span>
                                                        </div>

                                                        <div class="col">
                                                            <div class="owners d-flex align-items-center justify-content-end">
                                                                <media-component
                                                                    class="owner-avatar rounded-circle d-inline"
                                                                    src="./../../../images/avatar.png"
                                                                    v-for="(owner, o_index) in 3"
                                                                    v-bind:index="o_index"
                                                                    v-bind:key="o_index"></media-component>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="services">
                                                    <a href="#" class="badge badge-light service-item"
                                                        v-for="(service, s_index) in business.services"
                                                        v-bind:index="s_index"
                                                        v-bind:key="s_index"
                                                        v-text="service.name">
                                                    </a>
                                                </div>

                                                <div class="mt-3">
                                                    <router-link
                                                        class="btn btn-outline-primary btn-sm"
                                                        :to="{
                                                            name: 'single-business',
                                                            params: { id: business.id },
                                                        }"
                                                    >Check out</router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="text-muted">More Settings</p>

                        <div class="row mb-4 settings">
                            <div class="col-md-4">
                                <div class="setting py-5 px-2 bg-primary shadow-sm text-center text-light">
                                    <i class="far fa-user icon"></i>

                                    <p class="font-weight-bold card-text">Account Settings</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="setting py-5 px-2 bg-white shadow-sm text-center text-primary">
                                    <i class="far fa-bell text-muted icon"></i>

                                    <p class="font-weight-bold card-text">Notifications</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="setting py-5 px-2 bg-white shadow-sm text-center text-primary">
                                    <i class="far fa-money-bill-alt text-muted icon"></i>

                                    <p class="font-weight-bold card-text">Credits</p>
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

    export default {
        components: {
            BusinessesSidebarComponent,
            ContentComponent,
            FooterComponent,
            HeaderComponent,
            MediaComponent,
        },

        computed: {
            businesses() {
                if (this.auth_user === undefined) {
                    return [];
                }

                return this.businesses_by_user_id(this.auth_user.id);
            },

            ...mapGetters("AuthStore", ["auth_user"]),

            ...mapGetters("BusinessStore", ["businesses_by_user_id"]),

            ...mapGetters("OptionStore", ["display_businesses_sidebar"]),
        },

        async created() {
            let user = this.auth_user;

            if (user === undefined) {
                user = await this.$store.dispatch("AuthStore/authUser");

                this.$store.dispatch("AuthStore/setAuthUser", user);
            }

            await this.$store.dispatch(
                "BusinessStore/fetchBusinessByUserId",
                user.id
            );
        },
    };
</script>

<style lang="scss" scoped>
    .business-avatar {
        height: 52px;
        margin: 5px auto 0;
        width: 52px;
    }

    .service-item {
        margin: 5px 10px 5px 0;
    }

    .owner-avatar {
        border: 2px solid #FFF;
        display: inline-block;
        height: 32px;
        margin-left: -8px;
        width: 32px;
    }
    
    .settings {
        .setting {
            border: 1px solid transparent;
            cursor: pointer;

            &:hover {
                border-color: #328f28;
            }
        }

        .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    }
</style>
