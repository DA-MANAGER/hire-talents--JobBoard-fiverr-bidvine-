<template>
    <div>
        <div class="form-group">
            <select
                class="form-control"
                @change="reactOnChange"
            >
                <option selected>Choose...</option>
                <option
                    v-for="(option, index) in options"
                    v-bind:index="index"
                    v-bind:key="index"
                    v-bind:value="option.name"
                    v-text="option.name"
                >
                </option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            reactOnChange(elm) {
                this.$emit('set-value', elm.target.value);
            }
        },

        props: {
            options: Array,
        }
    };
</script>
