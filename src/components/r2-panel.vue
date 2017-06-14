<template>
<div class="panel" :style="{ width:size}" :class="classes">
    <div class="panel-header">
        <span class="title">{{title}}</span>
        <slot name="titlebutton"></slot>
        <button class="titlebutton" @click="onclose"><span class="fa fa-close"></span></button>
    </div>
    <!-- End titlebar -->
    <div class="panel-content">
        <slot></slot>
    </div>
    <!-- End panel-content -->
</div>
<!-- End panel -->
</template>
<script>
export default {
    props: {
        'title': {
            default: 'Título'
        },
        'size': {
            default: '800px'
        },
        card: {
            Number,
            default: 1
        }
    },
    computed: {
        classes: function() {
            return this.cards();
        }
    },
    methods: {
        onclose() {
            this.$emit('close');
        },
        cards: function() {
            return this.card > 0 ? ' card-' + this.card : '';
        }
    }
}
</script>
