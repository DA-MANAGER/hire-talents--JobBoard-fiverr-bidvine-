<template>
    <div>
        <div class="row">
            <div class="col-md">
                <div class="custom-control custom-checkbox">
                    <input
                        type="checkbox"
                        class="custom-control-input"
                        id="element-location-remote-work"
                        v-model="remote"
                        @change="reactOnChange"
                    >
                    <label class="custom-control-label" for="element-location-remote-work">The service can be done completed over phone or internet.</label>
                </div>
            </div>
        </div>

        <div
            class="row mt-4"
            v-if="! remote"
        >
            <div class="col-md mb-3">
                <label>Country</label>

                <select
                    class="custom-select d-block w-100"
                    required=""
                    v-model="country"
                    @change="reactOnChange"
                >
                    <option value="">Choose...</option>
                    <option>United States</option>
                </select>
            </div>

            <div class="col-md mb-3">
                <label>State</label>

                <select
                    class="custom-select d-block w-100"
                    required=""
                    v-model="state"
                    @change="reactOnChange"
                >
                    <option value="">Choose...</option>
                    <option>California</option>
                </select>
            </div>

            <div class="col-md mb-3">
                <label>City</label>

                <select
                    class="custom-select d-block w-100"
                    required=""
                    v-model="city"
                    @change="reactOnChange"
                >
                    <option value="">Choose...</option>
                    <option>Kashipur</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.reactOnChange();
        },

        data() {
            return {
                remote: true,
                city: '',
                country: '',
                state: '',
            };
        },

        methods: {
            reactOnChange() {
                let location = 'remote';

                if (! this.remote) {
                    location = {
                        'city': this.city,
                        'country': this.country,
                        'state': this.state,
                    };
                }

                this.$emit('set-value', { key: this.options.key, value: location });
            },
        },

        props: {
            options: Object,
        }
    };
</script>
