<template>
<!-- Init Box -->
<div class="box" :class="classes" :style="css">
  <slot></slot>
  <!-- End Box -->
</div>
</template>

<script>
export default {
  name: 'r2-box',
  props: {
    direction: {
      type: String,
      default: 'row'
    },
    // multiple possible types
    radius: [String, Array],
    margin: [String, Array],
    padding: [Array, String],
    card: {
      Number,
      default: 0
    },
    vExpand: Boolean,
    hExpand: Boolean,
    expand: Boolean,
    rowCenter: Boolean,
    columnCenter: Boolean,
    reverse: Boolean,
    center: Boolean
  },
  data: function() {
    return {

    }
  },
  computed: {
    css: function() {
      return (this.radiusCSS() + this.marginCSS() + this.paddingCSS());
    },
    classes: function() {
      return this.directions() + this.cards() + this.expanded() + this.centered();
    }
  },
  methods: {
    coerce: function(val) {
      return (typeof val === 'string' ? (val === 'false' || val === 'null' || val === 'undefined' ? false : val === 'true' ? true : val) : val);
    },
    expanded: function() {
      return (this.vExpand ? ' r2-vexpand ' : '') + (this.hExpand ? ' r2-hexpand ' : '') + (this.expand ? ' box__is-expand ' : '');
    },
    centered: function() {
      return (this.center ? ' box__is-center ' : '') + (this.rowCenter ? ' box__is-row-center ' : '') + (this.columnCenter ? ' box__is-column-center ' : '');
    },
    directions: function() {
      return (this.direction == 'row' || this.direction == null ? ' box__is-row ' : ' box__is-column ') + (this.reverse ? (this.direction == 'row' ? ' box__is-row-reverse ' : ' box__is-column-reverse ') : '');;
    },
    cards: function() {
      return this.card > 0 ? ' card-' + this.card : '';
    },
    radiusCSS: function() {
      if (!this.radius) {
        return '';
      } else {
        if (this.isArray(this.radius)) {
          let quantidade = this.radius.length;
          let _radius = '';
          if (quantidade > 0 && quantidade < 5) {
            for (var key in this.radius) {
              if (this.radius.hasOwnProperty(key)) {
                _radius = _radius + ' ' + this.radius[key] + 'px';
              }
            }
            return ' border-radius:' + _radius + ';';
          }
        } else if (typeof this.radius == 'string') {
          this.radiusClass = 'w3-round-' + this.radius;
        }
      }
    },
    marginCSS: function() {
      if (!this.margin) {
        return '';
      } else {
        if (this.isArray(this.margin)) {
          let quantidade = this.margin.length;
          let _margin = '';
          if (quantidade > 0 && quantidade < 5) {
            for (var key in this.margin) {
              if (this.margin.hasOwnProperty(key)) {
                _margin = _margin + this.margin[key] + 'px ';
              }
            }
            return ' margin:' + _margin + ';';
          }
        } else if (typeof this.margin == 'string') {
          this.marginClass = 'w3-margin-' + this.margin;
        }
      }
    },
    paddingCSS: function() {
      if (!this.padding) {
        return '';
      } else {
        if (this.isArray(this.padding)) {
          let quantidade = this.padding.length;
          let _padding = '';
          if (quantidade > 0 && quantidade < 5) {
            for (var key in this.padding) {
              if (this.padding.hasOwnProperty(key)) {
                _padding = _padding + this.padding[key] + 'px ';
              }
            }
            return ' padding:' + _padding + ';';
          }
        } else if (typeof this.padding == 'string') {
          this.paddingClass = 'w3-padding-' + this.padding;
        }
      }
    },
    isArray: function(obj) {
      //Verifica se e uma array
      if (Object.prototype.toString.call(obj) === '[object Array]') {
        return true;
      } else {
        return;
      }
    }
  }
}
</script>

<style>
/*
.r2-border {//Adds borders (top, right, bottom, left) to an element

}
.r2-border-top {//Adds a top border to an element
}
.r2-border-right {//Adds a right border to an element
}
.r2-border-bottom {//Adds a bottom border to an element
}
.r2-border-left {//Adds a left border to an element
}
.r2-border-0 {//Removes all borders
}
.r2-border-color {//Displays the border in a specified color (like red, blue, etc)
}
.r2-hover-border-color {//Adds a hoverable border color
}
.r2-bottombar {//Adds a thick bottom border to an element
}
.r2-leftbar {//Adds a thick left border to an element
}
.r2-rightbar {//Adds a thick right border to an element
}
.r2-topbar{
}
*/
</style>
