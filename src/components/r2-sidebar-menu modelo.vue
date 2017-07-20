<template>
<ul>
  <item class="item" :model="datatree"></item>
</ul>
</template>

<script>
import Vue from 'vue'
Vue.component('item', {
  template: `<li>
          <div
            :class="{bold: isFolder}"
            @click="toggle"
            @dblclick="changeType">
            {{model.name}}
            <span v-if="isFolder">[{{open ? "-" : "+"}}]</span>
          </div>
          <ul v-show="open" v-if="isFolder">
            <item
              class="item"
              v-for="model in model.children"
              :model="model">
            </item>
            <li class="add" @click="addChild">+</li>
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
    }
  },
  methods: {
    toggle: function() {
      if (this.isFolder) {
        this.open = !this.open
      }
    },
    changeType: function() {
      if (!this.isFolder) {
        Vue.set(this.model, 'children', [])
        this.addChild()
        this.open = true
      }
    },
    addChild: function() {
      this.model.children.push({
        name: 'new stuff'
      })
    }
  }
})

export default {
  props: ['datatree'],
  data() {
    return {

    }
  }
}
</script>

<style scoped=''>
.item {
  color: white;
  cursor: pointer;
}

.bold {
  font-weight: bold;
}

ul {
  padding-left: 1em;
  line-height: 1.5em;
  list-style-type: dot;
}
</style>
