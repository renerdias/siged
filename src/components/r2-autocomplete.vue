<template>
<div style="position: relative" class="width__xs-100" :class="{open:showDropdown}">
  <p class="box r2-row box__is-center width__xs-100" style='justify-content: flex-start !important;'>
    <!--
    <input readonly type="hidden" :placeholder="placeholder" @input="$emit('input',$event.target.value)" v-model="editableValue" :name="name" :class="{'border__is-red': haserror}" />
    <input v-model="display" :class="{'border__is-red': haserror}" class="width__xs-100" type="text" readonly placeholder="Tecle enter para abrir o formulário de pesquisa" @keyup.enter.stop="onsearch()" />
  -->
    <input readonly type="hidden" @input="$emit('input',$event.target.value)" v-model="keyValue" />
    <input autocomplete="off" v-model="displayValue" :placeholder="placeholder" type="text" @input="onInput($event.target.value)" @blur="showDropdown = false" @keydown.down.prevent="down" @keydown.enter="onSelect" @keydown.esc="reset" @keydown.up.prevent="up"
    />
    <i class="fa fa-search" style="float:right;margin-left: -30px; z-index:2;"></i>
  </p>
  <ul class="options-list card-1" style="width: 100%" ref="dropdown">
    <li v-for="(item, i) in items" :class="{highlighted: isActive(i)}" @mousedown.prevent="onSelect" @mousemove="setActive(i)">
      <component :is="templateComp" :item="item"></component>
    </li>
  </ul>
</div>
</template>

<script>
import {
  delayer,
  getJSON
} from '../utils/utils.js'
import * as util from '../utils/removerAcentos.js'
var DELAY = 300
export default {
  props: {
    async: {
      type: String
    },
    data: {
      type: Array
    },
    delay: {
      type: Number,
      default: DELAY
    },
    asyncKey: {
      type: String,
      default: null
    },
    limit: {
      type: Number,
      default: 4
    },
    minChar: {
      type: Number,
      default: 3
    },
    matchCase: {
      type: Boolean,
      default: false
    },
    matchStart: {
      type: Boolean,
      default: false
    },
    onHit: {
      type: Function,
      default (item) {
        return item
      }
    },
    placeholder: {
      type: String
    },
    template: {
      type: String
    },
    type: {
      type: String,
      default: 'text'
    },
    value: {
      type: [String, Number],
      default: ''
    },
    displayValue: {
      String,
      default: ''
    }
  },
  data() {
    return {
      //asign: '',
      showDropdown: false,
      noResults: true,
      current: -1,
      items: [],
      //val: this.value,
      keyValue: '',
      //displayValue: '',
      selected: false
    }
  },
  computed: {
    editableValue: function() {
      console.warn(1);
      return this.value
    },
    templateComp() {
      console.warn(2);
      //OK
      return {
        template: typeof this.template === 'string' ? '<span>' + this.template + '</span>' : '<strong v-html="item"></strong>',
        props: {
          item: {
            default: null
          }
        }
      }
    }
  },
  watch: {
    /*
    //Código original, precisa ser estudado
    val(val, old) {
      if (val.length >= this.minChar) {
        this.$emit('input', val)
        if (val !== old && val !== this.asign) this.__update()
      }
    },
    value(val) {
      if (this.val !== val) {
        this.val = val
      }
    }
    */
    /*
    value(val) {
      if (this.keyValue !== val) {
        console.warn(3);
        this.keyValue = val
      }
    },
    display(val) {
      if (this.displayValue !== val) {
        console.warn(4);
        this.dispĺayValue = val
      }
    }
    */
  },
  methods: {
    filterItems() {
      console.warn(5);
      if (this.async) {
        this.items = this.asyncKey ? this.data[this.asyncKey] : this.data
        this.items = this.items.slice(0, this.limit)
      } else {
        this.items = (this.data || []).filter(value => {
          /*
          if (typeof value === 'object') {
            return true
          }
          value = this.matchCase ? value : value.toLowerCase()
          var query = this.matchCase ? this.val : this.val.toLowerCase()
          return this.matchStart ? value.indexOf(query) === 0 : value.indexOf(query) !== -1
          */
          //Verifica se o valor e um objeto
          if (typeof value === 'object') {
            var obj = value;
            for (var key in obj) {
              if (obj.hasOwnProperty(key)) {
                var vlr = obj[key];
                //Transforma o valor em string
                vlr = vlr.toString();
                //Verifica se o valor e uma string
                if (typeof vlr === 'string') {
                  //Retira espaço em branco no inicio e fim, transforma e minúsculo, remove acentos
                  const s = util.removerAcentos(vlr.trim().toLowerCase());
                  //Retira espaço em branco no inicio e fim, transforma e minúsculo, remove acentos
                  const t = util.removerAcentos(this.displayValue.trim().toLowerCase());
                  if (s.indexOf(t) >= 0) {
                    return true;
                  }
                }
              }
            }
            return false;
          } else {
            vlr = value.toString();
            //Verifica se o valor e uma string
            if (typeof vlr === 'string') {
              //Retira espaço em branco no inicio e fim, transforma e minúsculo, remove acentos
              const s = util.removerAcentos(vlr.trim().toLowerCase());
              //Retira espaço em branco no inicio e fim, transforma e minúsculo, remove acentos
              const t = util.removerAcentos(this.displayValue.trim().toLowerCase());
              if (s.indexOf(t) >= 0) {
                return true;
              }
            }
          }
        }).slice(0, this.limit)
      }
      if (this.items.length < 1) {
        console.warn(6);
        this.reset()
      }
    },

    setValue(selectedOption) {
      console.warn(7);
      if (typeof selectedOption === 'object') {
        this.displayValue = selectedOption['no_municipio'] + ' - ' + selectedOption['sg_uf'];
        this.keyValue = selectedOption['id_municipio'];
      } else {
        this.displayValue = selectedOption;
        this.keyValue = selectedOption;
      }
      this.showDropdown = false
    },
    reset() {
      this.displayValue = null
      this.keyValue = null
    },
    onInput(value) {
      this.current = 0
      this.showDropdown = !!value
      if (!this.selected) {
        if (value.length >= this.minChar) {
          this.filterItems()
        }
      }
      this.selected = false
    },
    onSelect(e) {
      this.$emit('id', 111);
      //Interrompe qualquer evento padrão do elemento
      e.preventDefault()
      let selectedOption = this.items[this.current];
      this.setValue(selectedOption);
      this.selected = true
    },
    setActive(index) {
      //OK
      this.current = index
    },
    isActive(index) {
      //OK
      return this.current === index
    },
    up() {
      //OK
      if (this.current > 0) {
        this.current--
      } else {
        this.current = this.items.length - 1
      }
    },
    down() {
      //OK
      if (this.current < this.items.length - 1) {
        this.current++
      } else {
        this.current = 0
      }
    }
  },
  created() {
    /*
    //Código original, precisa ser estudado
    this.__update = delayer(function() {
      if (!this.val) {
        this.reset()
        return
      }
      this.asign = ''
      if (this.async) {
        getJSON(this.async + this.val).then(data => {
          this.filterItems(data)
        })
      } else if (this.data) {
        this.filterItems(this.data)
      }
    }, 'delay', DELAY)
    this.__update()
    */
  }
}
</script>

<style>
.open ul.options-list {
  display: flex;
}

ul.options-list {
  z-index: 20;

  display: none;
  flex-direction: column;
  border-radius: 0 0 3px 3px;
  position: absolute;
  overflow: hidden;
}

ul.options-list li {
  width: 100%;
  flex-wrap: wrap;
  background: white;
  margin: 0;
  border-bottom: 1px solid #eee;
  color: #363636;
  padding: 7px;
  cursor: pointer;
}

ul.options-list li.highlighted {
  /*background: #f8f8f8*/
  background-color: #e0e0e0;
  background-image: -webkit-linear-gradient(#f0f0f0, #e0e0e0);
  box-shadow: inset rgba(0, 0, 0, 0.2) 0 1px 2px;
}
</style>
