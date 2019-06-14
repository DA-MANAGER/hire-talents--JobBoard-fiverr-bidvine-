<template>
    <div>
        <form
            class="bg-white p-4 rounded shadow-sm"
            @submit.prevent="processBid"
        >
            <div class="form-group">
                <label for="bid-form-description">Description</label>
                <textarea
                    id="bid-form-description"
                    class="form-control"
                    placeholder="Enter the description for the bid..."
                    v-model="description"
                ></textarea>
            </div>

            <div class="media-list-wrapper mb-2">
                <media-list-with-preview-component
                    v-bind:show_upload_button="true"
                    v-bind:upload_multiple_files="true"
                    @handleFileChange="handleFileChange"
                ></media-list-with-preview-component>
            </div>

            <div class="d-flex align-items-center justify-content-end">
                <div>
                    <div class="btn-group dropup mr-3">
                        <button
                            type="button"
                            class="business-avatar border-primary btn btn-white dropdown-toggle rounded-0"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <img
                                src="./../../../images/avatar.png"
                            />

                            <span
                                class="font-weight-bold mr-2"
                                v-text="selected_business.name"
                            ></span>
                        </button>

                        <div class="dropdown-menu border-0 p-0 rounded-0 shadow-sm w-100">
                            <a
                                class="dropdown-item p-3"
                                href="#"
                                v-for="(business, index) in businesses_by_user_id(auth_user.id)"
                                v-bind:index="index"
                                v-bind:key="index"
                                v-text="business.name"
                                @click.prevent="selectBusiness(business.id)"
                            ></a>
                        </div>
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                        v-bind:disabled="loading"
                    >Submit</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    import MediaListWithPreviewComponent from "./MediaListWithPreviewComponent.vue";

    export default {
        components: {
            MediaListWithPreviewComponent
        },

        computed: {
            selected_business() {
                return this.businesses(this.business_id);
            },

            ...mapGetters("AuthStore", ["auth_user"]),

            ...mapGetters("BusinessStore", ["businesses", "businesses_by_user_id"]),
        },

        created() {
            const business = this.businesses_by_user_id(this.auth_user.id)[0];

            this.selectBusiness(business.id);
        },

        data() {
            return {
                loading: false,

                business_id: undefined,
                description: '',
                media: [],
            };
        },

        methods: {
            handleFileChange(files) {
                this.media = files;
            },

            async processBid() {
                this.loading = true;

                const bid = {
                    business_id: this.business_id,
                    description: this.description,
                    media: this.media,
                };

                try {
                    await this.$store.dispatch("ServiceStore/bidOnServiceRequest", bid);
                } catch (err) {
                    err = err.response || err;

                    console.log(err);
                }
            },

            selectBusiness(business_id) {
                this.business_id = business_id;
            },
        },

        props: {
            service_request: Object
        }
    };
</script>

<style lang="scss" scoped>
    .business-avatar img {
        border-radius: 50px;
        height: 28px;
        margin-right: 8px;
        width: 28px;
    }

    .media-list-wrapper {
        max-width: 600px;
    }

    .dropdown-item {
        &:not(:first-child) {
            border-top: 1px solid #F5F5F5;
        } 
    }
</style>
