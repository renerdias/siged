<template>
<div class="window" :style="{ width:size}">
    <div class="window__header">
        <span class="title">{{title}}</span>
        <slot name="titlebutton"></slot>
        <button class="titlebutton" @click="onclose"><span class="fa fa-close"></span></button>
    </div>
    <!-- End titlebar -->
    <div class="window__content">
        <slot></slot>
    </div>
    <!-- End window-content -->
</div>
<!-- End window -->
</template>
<script>
export default {
    props: {
        'title': {
            default: 'Título'
        },
        'size': {
            default: '800px'
        }
    },
    methods: {
        onclose() {
            this.$emit('close');
        }
    }
}
</script>
