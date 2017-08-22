<template>
<!--
BOX Props:
Direction [
  row,
  row-reverse,
  column,
  column-reverse,
  sm-row,
  sm-row-reverse,
  sm-column,
  sm-column-reverse,
  md-row,
  md-row-reverse,
  md-column,
  md-column-reverse,
  lg-row,
  lg-row-reverse,
  lg-column,
  lg-column-reverse,
  xl-row,
  xl-row-reverse,
  xl-column,
  xl-column-reverse
],
Justify-Content[
    start,
    end,
    center,
    between,
    around,
    sm-start,
    sm-end,
    sm-center,
    sm-between,
    sm-around,
    md-start,
    md-end,
    md-center,
    md-between,
    md-around,
    lg-start,
    lg-end,
    lg-center,
    lg-between,
    lg-around,
    xl-start,
    xl-end,
    xl-center,
    xl-between,
    xl-around
],
align-items[
    start,
    end,
    center,
    baseline,
    stretch,
    sm-start,
    sm-end,
    sm-center,
    sm-baseline,
    sm-stretch,
    md-start,
    md-end,
    md-center,
    md-baseline,
    md-stretch,
    lg-start,
    lg-end,
    lg-center,
    lg-baseline,
    lg-stretch,
    xl-start,
    xl-end,
    xl-center,
    xl-baseline,
    xl-stretch
],
align-self[
    start,
    end,
    center,
    baseline,
    stretch,
    sm-start,
    sm-end,
    sm-center,
    sm-baseline,
    sm-stretch,
    md-start,
    md-end,
    md-center,
    md-baseline,
    md-stretch,
    lg-start,
    lg-end,
    lg-center,
    lg-baseline,
    lg-stretch,
    xl-start,
    xl-end,
    xl-center,
    xl-baseline,
    xl-stretch
],
align-content[
    start,
    end,
    center,
    around,
    stretch,
    sm-start,
    sm-end,
    sm-center,
    sm-around,
    sm-stretch,
    md-start,
    md-end,
    md-center,
    md-around,
    md-stretch,
    lg-start,
    lg-end,
    lg-center,
    lg-around,
    lg-stretch,
    xl-start,
    xl-end,
    xl-center,
    xl-around,
    xl-stretch
],
wrap[
    nowrap,
    wrap,
    wrap-reverse,
    sm-nowrap,
    sm-wrap,
    sm-wrap-reverse,
    md-nowrap,
    md-wrap,
    md-wrap-reverse,
    lg-nowrap,
    lg-wrap,
    lg-wrap-reverse,
    xl-nowrap,
    xl-wrap,
    xl-wrap-reverse
]
order[
    first,
    last,
    unordered,
    sm-first,
    sm-last,
    sm-unordered,
    md-first,
    md-last,
    md-unordered,
    lg-first,
    lg-last,
    lg-unordered,
    xl-first,
    xl-last,
    xl-unordered,
],
rounded[
rounded
rounded-top
rounded-right
rounded-bottom
rounded-left
rounded-circle
rounded-0
],
border[
  -0,
  top-0,
  right-0,
  bottom-0,
  left-0,
],
border-color[
  dark,
  muted,
  primary,
  success,
  info,
  warning,
  danger,
  white
],
text[
/*text-colors*/
text-muted
text-primary
text-success
text-info
text-warning
text-danger
/*text-alignment*/
text-justify
text-left
text-center
text-right
text-sm-left
text-md-left
text-lg-left
text-xl-left
text-sm-right
text-md-right
text-lg-right
text-xl-right
text-sm-center
text-md-center
text-lg-center
text-xl-center
/*text-trasnform*/
text-lowercase
text-uppercase
text-capitalize
]
-->
<!-- box start -->
<div class="d-flex" :class="classes" :style="css">
  <slot></slot>
</div>
<!-- box end -->
</template>

<script>
export default {
  name: 'r2-box',
  props: {
    /*
    display:{
        .d - flex
        .d - inline - flex
        .d - sm - flex
        .d - sm - inline - flex
        .d - md - flex
        .d - md - inline - flex
        .d - lg - flex
        .d - lg - inline - flex
        .d - xl - flex
        .d - xl - inline - flex
    }
    */
    /**
     *
     *
     *
     */

    direction: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    justifyContent: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    alignItems: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    alignSelf: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    alignContent: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    wrap: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    expand: Boolean,
    /**
     *
     *
     *
     */
    order: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    margin: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    padding: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    rounded: {
      type: [Boolean, String, Array]
    },
    /**
     *
     *
     *
     */
    border: {
      type: [String, Array]
    },
    /**
     *
     *
     *
     */
    bordered: {
      type: Boolean
    },
    /**
     *
     *
     *
     */
    borderColor: {
      type: String
    },
    /**
     *
     *
     *
     */
    text: {
      type: [String, Array]
    },
  },
  data: function() {
    return {

    }
  },
  computed: {
    css: function() {
      //
    },
    classes: function() {
      return this._class(' flex-', this.direction) +
        this._class(' justify-content-', this.justifyContent) +
        this._class(' align-items-', this.alignItems) +
        this._class(' align-self-', this.alignSelf) +
        this._class(' align-content-', this.alignContent) +
        this._class(' flex-', this.wrap) +
        this._class(' flex-', this.order) +
        (this.expand ? ' flex-expand ' : '') +
        this._class(' m', this.margin) +
        this._class(' p', this.padding) +
        (this.rounded == false ? ' rounded' : this._class(' rounded-', this.rounded)) +
        this._class(' border-', this.border) +
        (this.bordered ? ' bordered ' : '') +
        this._class(' border-color-', this.borderColor) +
        this._class(' text-', this.text)
    }
  },
  methods: {
    isArray: function(obj) {
      //Verifica se e uma array
      if (Object.prototype.toString.call(obj) === '[object Array]') {
        return true;
      } else {
        return;
      }
    },
    _class: function(subclass, value) {
      if (!value) {
        return '';
      } else {
        if (this.isArray(value)) {
          let result = '';
          for (var key in value) {
            if (value.hasOwnProperty(key)) {
              result = result + subclass + value[key] + ' ';
            }
          }
          return result;
        } else if (typeof value == 'string') {
          return subclass + value;
        }
      }
    }
  }
}
</script>
