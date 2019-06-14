<template>
    <header id="header" class="site-header">
        <nav class="navbar navbar-expand-lg navbar-light p-0 bg-white shadow-sm">
            <div class="container-fluid">
                <div class="row w-100">
                    <div class="col">
                        <span
                            class="menu-button"
                            v-if="display_businesses_sidebar_menu"
                            @click="showBusinessesSidebar"
                        >
                            <i class="fas fa-ellipsis-h"></i>
                        </span>

                        <router-link
                            class="navbar-brand"
                            :to="{ name: 'home' }"
                        >
                            <img class="brand-logo" src="./../../../images/logo.png" v-bind:alt="$appName">
                        </router-link>
                    </div>

                    <div class="col">
                        <div v-if="has_custom_data">
                            <slot></slot>
                        </div>

                        <div v-else>
                            <button
                                type="button"
                                data-toggle="collapse"
                                data-target="#navbar-navigation"
                                aria-controls="navbar-navigation"
                                aria-expanded="false"
                                aria-label="Toggle navigation"
                                class="navbar-toggler"
                                style=""
                            >
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div
                                id="navbar-navigation"
                                class="collapse navbar-collapse"
                            >
                                <ul class="navbar-nav ml-auto" v-if="is_authenticated">
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" href="#">
                                            <i class="fa fa-comment-alt text-dark"></i>
                                        </a>
                                    </li>

                                    <div class="dropdown">
                                        <button
                                            id="profile"
                                            class="btn btn-light dropdown-toggle rounded-0"
                                            type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <img
                                                src="./../../../images/avatar.png"
                                                v-bind:alt="full_name"
                                            />

                                            <span
                                                class="font-weight-bold"
                                                v-text="full_name"
                                            ></span>
                                        </button>

                                        <div
                                            class="dropdown-menu border-0 p-0 rounded-0 shadow-sm w-100"
                                            aria-labelledby="profile"
                                        >
                                            <router-link
                                                class="dropdown-item"
                                                :to="{ name: 'administration' }"
                                            >
                                                Administration
                                            </router-link>

                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                >Settings</a
                                            >

                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                @click.prevent="logOut"
                                                >Log out</a
                                            >
                                        </div>
                                    </div>
                                </ul>

                                <ul class="navbar-nav ml-auto" v-else>
                                    <li class="nav-item">
                                        <router-link
                                            class="nav-link"
                                            :to="{ name: 'login' }"
                                            >Sign in</router-link
                                        >
                                    </li>

                                    <li class="nav-item">
                                        <router-link
                                            class="nav-link btn-register-business bg-primary font-weight-bold text-light ml-3"
                                            :to="{
                                                name: 'register',
                                                query: { setup_business: 1 },
                                            }"
                                            >Register Business</router-link
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
    import { mapGetters } from "vuex";

    export default {
        computed: {
            display_businesses_sidebar_menu() {
                return this.is_authenticated && !this.hide_businesses_sidebar_menu;
            },

            full_name() {
                if (this.auth_user !== undefined) {
                    return (
                        this.auth_user.first_name + " " + this.auth_user.last_name
                    );
                }

                return "";
            },

            has_custom_data() {
                return !!this.$slots.default;
            },

            ...mapGetters("AuthStore", ["auth_user", "is_authenticated"])
        },

        methods: {
            /**
             * Logs out the user from the application.
             *
             * @returns void
             */
            async logOut() {
                await this.$store.dispatch("AuthStore/authLogout");

                this.$router.push({ name: "login" });
            },

            /**
             * Displays the businesses sidebar on the screen.
             *
             * @returns void
             */
            showBusinessesSidebar() {
                this.$store.dispatch("OptionStore/toggleBusinessesSidebar", "show");
            }
        },

        props: {
            hide_businesses_sidebar_menu: {
                default: false,
                type: Boolean
            }
        }
    };
</script>

<style lang="scss" scoped>
    .menu-button {
        align-items: center;
        background-color: #f6f6f6;
        border-radius: 2px;
        cursor: pointer;
        display: inline-block;
        margin-top: 4px;
        padding: 8px 14px;

        &:hover {
            background-color: #f5f5f5;
        }
    }

    .brand-logo {
        height: 40px;
    }

    .navbar-nav {
        a {
            padding-bottom: 12px;
            padding-top: 12px;
        }

        #profile img {
            border-radius: 50px;
            height: 36px;
            margin-right: 8px;
            width: 36px;
        }

        .dropdown-item {
            &:not(:last-child) {
                border-bottom: 1px solid #F5F5F5;
            } 
        }
    }
</style>