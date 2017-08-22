<template>
<div v-show="show" class="alert alert-warning col-12" role="alert" :class="[type]">
  <i v-if="icon && type == 'info'" class="fa fa-info-circle"></i>
  <i v-if="icon && type == 'warning'" class="fa fa-warning"></i>
  <i v-if="icon && type == 'danger'" class="fa fa-thumbs-down"></i>
  <i v-if="icon && type == 'success'" class="fa fa-thumbs-up"></i>
  <strong>{{title}}</strong> {{message}}
</div>
</template>
<script>
export default {
  props: [
    'type',
    'message',
    'show',
    'icon',
    'title'
  ],
  methods: {
    onclose() {
      this.$emit('close');
    }
  }
}
</script>
<style>
</style>
