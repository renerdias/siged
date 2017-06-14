<template>
<box v-if="type == 'mask'" :direction="direction" :padding="padding" :margin="margin" :expand="expand" :reverse="reverse">
  <label>{{label}}</label>
  <the-mask :mask="mask" :tokens="tokens" v-model="editableValue" :placeholder="placeholder" :masked="masked" type="text" :class="{'border__is-red': hasError}"></the-mask>
  <span v-show="hasError" class="text__is-red">{{ msgError }}</span>
</box>

<box v-else-if="type == 'select'" :direction="direction" :padding="padding" :margin="margin" :expand="expand" :reverse="reverse">
  <label>{{label}}</label>
  <select ref="sel" v-model="editableValue" @input="$emit('input',$event.target.value)" :name="name" class="secret" :multiple="multiple" :required="required" :readonly="readonly" :disabled="disabled" :class="{'border__is-red': hasError}">
  <option v-if="required" value=""></option>
  <option v-for="option in options" :value="option[optionsValue]">{{ option[optionsLabel] }}</option>


</select>
  <span v-show="hasError" class="text__is-red">{{ msgError }}</span>
</box>

<box v-else :direction="direction" :padding="padding" :margin="margin" :expand="expand" :reverse="reverse">
  <label>{{label}}</label>
  <input v-model="editableValue" @input="$emit('input',$event.target.value)" :class="{'border__is-red': hasError}" :name="name" :disabled="disabled" :readonly="readonly" :required="required" type="text" :placeholder="placeholder" />
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
    value: null,
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
    options: {
      type: Array,
      default () {
        return []
      }
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
    }
  },
  computed: {
    editableValue: function() {
      return this.value
    }
  }
}
</script>
