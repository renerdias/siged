<template>
<!-- panel start -->
<div class="card w-100" :style="{'max-width':size}" :class="classes">
  <!-- panel-header start -->
  <h6 class="card-header text-center">
    {{title}}
  </h6>
  <!-- panel-header end -->
  <!-- panel-content start -->
  <div class="card-block">
    <slot></slot>
  </div>
  <!-- panel-content end -->
  <!-- panel-footer start -->
  <div class="card-footer text-muted">
    <slot name="footer"></slot>
  </div>
  <!-- panel-footer end -->
</div>
<!-- panel end -->
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
      default: 0
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
