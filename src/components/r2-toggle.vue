<template>
  <div class="btn-group">
    <button type="button"
      v-for="(key, val) in values"
      @click="changeSelectVal(key)"
      :class="['button', { 'button-red': selected === key, 'button-flat': selected !== key }]"
      >{{ val }}</button>
  </div>
</template>
<script>
  export default {
    props: ['values','selected','default'],
      ready: function () {
        this.selected = this.default;
      },
      methods: {
        changeSelectVal: function(val) {
          this.selected = val;
        }
      }
  }
</script>
<style>
.button{
outline: none !important;
}
</style>
