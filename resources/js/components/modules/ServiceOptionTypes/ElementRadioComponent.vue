<template>
    <div>
        <div
            class="form-check"
            v-for="(option, index) in options"
            v-bind:index="index"
            v-bind:key="index"
        >
            <label>
                <input
                    type="radio"
                    class="form-check-input"
                    name="element"
                    v-bind:value="option.name"
                    @change="reactOnChange"
                > {{ option.name }}
            </label>
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
