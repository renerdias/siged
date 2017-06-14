<template>
<div :class="{'tab-bordered': bordered}">
  <div class="tab-nav box box__is-row">
    <label v-for="tab in tablist" @click.stop.prevent="setActive(tab)" :class="{active: tab.active}">
        {{tab.title}}
      </label>
  </div>
  <div class="tab-content">
    <slot></slot>
  </div>
</div>
</template>
<script>
export default {
  props: {
    bordered: Boolean,
  },
  data() {
    return {
      activeTab: {},
      tablist: []
    };
  },
  mounted: function() {
    //O maior detalhe deste componente é como deveremos preencher o array tablist com as abas a serem criadas. Fazemos isso com o uso da propriedade this.$children, nativa do Vue, que retorna um conjunto de elementos que estão presentes no <slot></slot> do componente.
    //Utilizando this.$children podemos saber quantos filhos o componente Tags possui, e quais suas propriedades. Dessa forma, podemos montar a lista de <li> preenchendo o array tablist:
    this.$children.forEach(c => {
      this.tablist.push({
        "name": c.name,
        "title": c.title,
        "active": c.active
      });
    })
    this.setActive(this.tablist[0]);
  },
  methods: {
    setActive: function(tab) {
      document.getElementById(tab.name).checked = true;


      var self = this;
      tab.active = true;
      this.activeTab = tab;
      //this.activeTab.active = true;
      /*  console.log("activeTab name=" + this.activeTab.name);*/
      this.tablist.forEach(function(tab) {
        //console.log("TAB => " + tab);
        //console.log("activeTab id => " + self.activeTab.name);
        //console.log("tab name=" + tab.name);

        if (tab.name !== self.activeTab.name) {
          tab.active = false;
        }
      });

    }
  }
}
</script>
<style>
.tab-nav {
  //background-color: #eeeeee;
  //border: 1px solid #ddd;
}

.tab-bordered {
  border-top-left-radius: 6px;
  border-top-right-radius: 6px;
  border: 1px solid #ddd;
}

.tab-content {
  color: #000000;
  background-color: #ffffff;
  margin-top: -1px;
}

.tab-nav>label:first-of-type:not(:last-of-type) {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.tab-nav>label:not(:first-of-type):not(:last-of-type) {
  border-radius: 0;
}

.tab-nav>label:last-of-type:not(:first-of-type) {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.tab-nav>label.active {
  background-color: #fff;
  box-shadow: 0 -1px 0 #fff inset;
  cursor: default;
}

.tab-nav>label.active:hover {
  box-shadow: 0 -1px 0 #fff inset;
  background-color: #fff;
}


/*
.tab-radius {
    border-radius: 6px 6px 0 0;
}
*/

.tab-nav>label {
  box-shadow: 0 -1px 0 #eee inset;
  border-radius: 6px 6px 0 0;
  cursor: pointer;
  display: block;
  font-weight: bold;
  text-decoration: none;
  color: #555;
  -webkit-box-flex: 3;
  -webkit-flex-grow: 3;
  -ms-flex-positive: 3;
  flex-grow: 3;
  text-align: center;
  background-color: #f2f2f2;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  text-align: center;
  -webkit-transition: 0.3s background-color ease, 0.3s box-shadow ease;
  transition: 0.3s background-color ease, 0.3s box-shadow ease;
  height: 50px;
  box-sizing: border-box;
  padding: 15px;
}

.tab-nav>label:hover {
  background-color: #f9f9f9;
  box-shadow: 0 1px 0 #f4f4f4 inset;
}
</style>
