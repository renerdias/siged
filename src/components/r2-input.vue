<template>
<input :type="type" :value="value" :name="name" :id="id || ('b_'+_uid)" :disabled="disabled" ref="input" :is="textarea?'textarea':'input'" :class="['form-control',inputClass]" :rows="rows || rowsCount" :placeholder="placeholder" @input="onInput($event.target.value)"
    @change="onChange($event.target.value)" @keyup="onKeyUp($event)" @focus="$emit('focus')" @blur="$emit('blur')" />
</template>
<!--
                <control v-model="bairro.no_bairro" :type="'text'" placeholder="Enter your name"></control>
-->
<script>
export default {

    props: {
        name: {
            type: String
        },
        id: {
            type: String
        },
        disabled: {
            type: Boolean
        },
        plain: {
            type: Boolean,
            default: false
        },
        state: {
            type: String
        },
        size: {
            type: String
        },
        type: {
            type: String
        }
    },
    computed: {
        inputClass() {
            return [
                this.size ? `form-control-${this.size}` : null,
                this.state ? `form-control-${this.state}` : null
            ];
        },
        custom() {
            return !this.plain;
        },
        rowsCount() {
            return (this.value || '').split('\n').length;
        }
    },
    methods: {
        format(value) {
            if (this.formatter) {
                const formattedValue = this.formatter(value);
                if (formattedValue !== value) {
                    value = formattedValue;
                    this.$refs.input.value = formattedValue;
                }
            }
            return value;
        },
        onInput(value) {
            if (!this.lazyFormatter) {
                value = this.format(value);
            }
            this.$emit('input', value);
        },
        onChange(value) {
            value = this.format(value);
            this.$emit('input', value);
            this.$emit('change', value);
        },
        onKeyUp(e) {
            this.$emit('keyup', e);
        }
    },
    props: {
        value: {
            default: null
        },
        type: {
            type: String,
            default: 'text'
        },
        placeholder: {
            type: String,
            default: null
        },
        rows: {
            type: Number,
            default: null
        },
        textarea: {
            type: Boolean,
            default: false
        },
        formatter: {
            type: Function
        },
        lazyFormatter: {
            type: Boolean,
            default: false
        }
    }
};
</script>
