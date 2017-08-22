<template>
<box v-if="type == 'mask'" :direction="direction" :padding="padding" :margin="margin" :expand="expand" :reverse="reverse">
  <label>{{label}}</label>
  <the-mask :mask="mask" :tokens="tokens" v-model="value" :placeholder="placeholder" :masked="masked" type="text" :class="{'border__is-red': hasError}"></the-mask>
  <span v-show="hasError" class="text__is-red">{{ msgError }}</span>
</box>
<box v-else-if="type == 'toggle-bar'" :direction="direction" :padding="padding" :margin="margin" :expand="expand" :reverse="reverse">
  <label>{{label}}</label>
  <box direction="row" center class="width__xs-100 button-bar" :class="[size, themed]">
    <div v-for="option in options" class="button-bar__item box">
      <input :value="getOptionValue(option)" type="radio" v-model="value" @input="$emit('input',$event.target.value)" :name="name" :required="required" :readonly="readonly" :disabled="disabled" :class="{'border__is-red': hasError}">
      <button class="button-bar__button">{{ getOptionLabel(option) }}</button>
    </div>
  </box>
  <span v-show="hasError" class="text__is-red">{{ msgError }}</span>
</box>
<box v-else-if="type == 'select'" :direction="direction" :padding="padding" :margin="margin" :expand="expand" :reverse="reverse">
  <label>{{label}}</label>
  <select ref="sel" v-model="value" @input="$emit('input',$event.target.value)" :name="name" class="secret" :multiple="multiple" :required="required" :readonly="readonly" :disabled="disabled" :class="{'border__is-red': hasError}">
  <option value=""></option>
  <option v-for="option in options" :value="getOptionValue(option)">{{ getOptionLabel(option) }}</option>
</select>
  <span v-show="hasError" class="text__is-red">{{ msgError }}</span>
</box>
<box v-else-if="type == 'textarea'" :direction="direction" :padding="padding" :margin="margin" :expand="expand" :reverse="reverse">
  <label>{{label}}</label>
  <textarea v-model="value" @input="$emit('input',$event.target.value)" :name="name" :required="required" :readonly="readonly" :disabled="disabled" :class="{'border__is-red': hasError}">
</textarea>
  <span v-show="hasError" class="text__is-red">{{ msgError }}</span>
</box>
<box v-else :direction="direction" :padding="padding" :margin="margin" :expand="expand" :reverse="reverse">
  <label>{{label}}</label>
  <input v-model="value" @input="$emit('input',$event.target.value)" :class="[{'border__is-red': hasError}, size]" :name="name" :disabled="disabled" :readonly="readonly" :required="required" type="text" :placeholder="placeholder" />
  <span v-show="hasError" class="text__is-red">{{ msgError }}</span>
</box>
</template>

<script>
import TheMask from 'vue-the-mask';
import Box from './r2-box.vue';

export default {
  extends: { // The Magic is happening right here
    props: {
      ...TheMask.props,
      ...Box.props
    }
  },
  components: {
    TheMask,
    Box
  },
  props: {
    /**
     * An optional callback function that is called each time the selected
     * value(s) change. When integrating with Vuex, use this callback to trigger
     * an action, rather than using :value.sync to retreive the selected value.
     * @type {Function}
     * @default {null}
     */
    onChange: {
      type: Function,
      default: function(val) {
        this.$emit('input', val)
      }
    },
    /**
     * Callback to generate the label text. If {option}
     * is an object, returns option[this.label] by default.
     * @param  {Object || String} option
     * @return {String}
     */
    getOptionLabel: {
      type: Function,
      default (option) {
        if (typeof option === 'object') {
          if (this.optionsLabel && option[this.optionsLabel]) {
            return option[this.optionsLabel]
          }
        }
        return option;
      }
    },
    /**
     * Callback to generate the label text. If {option}
     * is an object, returns option[this.label] by default.
     * @param  {Object || String} option
     * @return {String}
     */
    getOptionValue: {
      type: Function,
      default (option) {
        if (typeof option === 'object') {
          if (this.optionsValue && option[this.optionsValue]) {
            return option[this.optionsValue]
          }
        }
        return option;
      }
    },
    /*
    label: String,
    mask: String,
    placeholder: String,
    type: String,
    value: [String, Number],
    name: String,
    tokens: String,
    hasError: Boolean,
    msgError: String,
    */
    //Controle
    //value: [String, Number],
    /**
     * Contains the currently selected value. Very similar to a
     * `value` attribute on an <input>. You can listen for changes
     * using 'change' event using v-on
     * @type {Object||String||null}
     */
    value: {
      default: null
    },
    /**
     * An array of strings or objects to be used as dropdown choices.
     * If you are using an array of objects, vue-select will look for
     * a `label` key (ex. [{label: 'This is Foo', value: 'foo'}]). A
     * custom label key can be set with the `label` prop.
     * @type {Object}
     */
    options: {
      type: Array,
      default () {
        return []
      },
    },
    //name: String,
    name: {
      type: String,
      default: null
    },
    disabled: {
      type: Boolean,
      default: false
    },
    readonly: {
      type: Boolean,
      default: null
    },
    required: {
      type: Boolean,
      default: null
    },
    size: {
      type: String,
      default: ''
    },
    theme: {
      type: String,
      default: ''
    },
    //Controle

    label: String,
    //Input
    //type: String,
    type: {
      type: String,
      default: 'text'
    },
    placeholder: {
      type: String,
      default: null
    },
    //Input


    //Mascara
    mask: String,
    tokens: String,
    //Mascara
    //Validação
    hasError: Boolean,
    msgError: String,
    //Validação

    //Somente para select
    multiple: {
      type: Boolean,
      default: false
    },
    optionsLabel: {
      type: String,
      default: 'label'
    },
    optionsValue: {
      type: String,
      default: 'value'
    }
    //Somente para select
  },
  data() {
    return {
      //editableValue: this.value
      mutableValue: null,
    }
  },
  computed: {
    /*editableValue: function() {
      this.onChange(this.value);
      return this.value
    }
    */
    themed() {
      return 'button-bar__is-' + this.theme
    }
  },
  watch: {
    /**
     * When the value prop changes, update
     * the internal mutableValue.
     * @param  {mixed} val
     * @return {void}
     */
    value(val) {
      this.mutableValue = val
    },
    /**
     * Maybe run the onChange callback.
     * @param  {string|object} val
     * @param  {string|object} old
     * @return {void}
     */
    mutableValue(val, old) {
      this.onChange && val !== old ? this.onChange(val) : null
    }
  }
}
</script>
