<template>
<box direction="column" expand>
  <transition mode="out-in" name="custom-classes-transition2" enter-active-class="animated fadeInDownBig" leave-active-class="animated bounceOutRight">
    <ul class="accordion">
      <item :model="tree" v-for="tree in datatree"></item>
    </ul>
  </transition>
</box>
</template>
<script>
import Vue from 'vue';
import Box from './r2-box.vue';
Vue.component('item', {
  template: `<li>
          <a :class="hasClass" :href="model.link" @click="toggle">
            <i :class="iconClass" style="margin-left: 10px; font-size: 18px; margin-right: 15px;"></i>
            {{model.name}}
            <i v-if="isFolder" :class="['fa', {'fa-caret-down': open }, {'fa-caret-right': !open }]" style="margin-left: 8px;font-size: 16px;margin-right: 12px;"></i>
          </a>
          <ul v-if="isFolder" class="sub-menu" :class="[{'sub-menu-open': open }]">
          <item
            v-for="model in model.children"
            :model="model">
          </item>
          </ul>
        </li>`,
  props: {
    model: Object
  },
  data: function() {
    return {
      open: false
    }
  },
  computed: {
    isFolder: function() {
      return this.model.children &&
        this.model.children.length
    },
    hasClass: function() {
      return this.model.class
    },
    iconClass: function() {
      return this.model.icon
    }
  },
  methods: {
    toggle: function() {
      if (this.isFolder) {
        this.open = !this.open
      }
    }
  }
})

export default {
  components: {
    Box
  },
  props: {
    datatree: Array
  },
  data() {
    return {

    }
  }
}
</script>

<style>

</style>
