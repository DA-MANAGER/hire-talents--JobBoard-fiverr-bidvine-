<template>
    <div>
        <div class="form-group">
            <textarea
                class="form-control"
                rows="3"
                placeholder="Enter some text area..."
                @change="reactOnChange"></textarea>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            reactOnChange(elm) {
                const value = elm.target.value;

                if (_.isObject(this.options) && _.has(this.options, 'key')) {
                    this.$emit('set-value', {
                        key: this.options.key,
                        value: value,
                    });
                } else {
                    this.$emit('set-value', value);
                }
            }
        },

        props: {
            options: Object
        }
    };
</script>
