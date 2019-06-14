<template>
    <form action="" method="GET">
        <div class="row no-gutters">
            <div class="col-md-5" style="position: relative;">
                <input
                    type="text"
                    class="form-control form-control-lg border-bottom-0 border-left-0 border-top-0 rounded-0"
                    placeholder="What service do you need?"
                    required=""
                    v-model="service"
                    @blur="hidePopularServices"
                    @focus="show_popular_services = true"
                />

                <div class="popular-services bg-white w-100"
                    v-show="show_popular_services">
                    <div class="services-header">
                        <span class="font-weight-bold">Popular Services</span>
                    </div>

                    <div class="services-body">
                        <ul class="services">
                            <li class="list-item"
                                v-for="(service, index) in popular_services"
                                v-bind:index="index"
                                v-bind:key="index"
                                v-text="service.name"
                                @click="selectService(service)"></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <input
                    type="text"
                    class="form-control form-control-lg border-0 rounded-0"
                    placeholder="Enter postcode"
                    required=""
                />
            </div>

            <div class="col-md">
                <button
                    type="submit"
                    class="btn-primary form-control form-control-lg border-0 rounded-0"
                >
                    Get Started
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import debounce from "lodash.debounce";

    export default {
        data() {
            return {
                popular_services: [
                    {
                        name: "Domestic Cleaning",
                    },
                    {
                        name: "Interior Painting",
                    },
                    {
                        name: "Man with a Van",
                    },
                    {
                        name: "Personal Training",
                    },
                    {
                        name: "Piano Lessons",
                    },
                ],
                show_popular_services: false,

                service: '',
            };
        },

        methods: {
            hidePopularServices: debounce(function () {
                this.show_popular_services = false;
            }, 150),

            selectService(service) {
                this.service = service.name;
                
                this.hidePopularServices();
            }
        }
    };
</script>

<style lang="scss" scoped>
    .popular-services {
        box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        position: absolute;
        z-index: 99;

        .services-header {
            background-color: #DDD;
            color: #333;
            padding: 5px 10px;
        }

        .services-body .services {
            margin: 0;
            padding: 0;

            .list-item {
                color: #333;
                cursor: pointer;
                list-style-type: none;
                padding: 5px 10px;

                &:not(:last-child) {
                    border-bottom: 1px solid #F2F2F2;
                }

                &:hover {
                    background-color: #F2F2F2;
                }
            }
        }
    }
</style>

