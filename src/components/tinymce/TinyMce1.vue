<template>
<textarea :id="id"></textarea>
</template>

<script>
export default {
  name: "tinymce",
  props: {
    options: Object,
    content: {
      type: String,
      default: ''
    },
    value: String,
    id: {
      type: String,
      default: 'editor'
    },
    toolbar: {
      default: ''
    },
    menubar: {
      default: ''
    },
    plugins: {
      default: ''
    },
    otherProps: {
      default: ''
    },
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
    }
  },
  data() {
    return {
      //editableValue: this.value
      mutableValue: null,
      initialized: false
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
  },
  /*
    watch: {
      value() {
        tinymce.get(this.id).setContent(this.value)
      }
    },*/
  methods: {
    initialize: function() {

      this.initialized = true;
    }
  },
  mounted() {
    tinymce.init({
      selector: `#${this.id}`,
      language: `pt_BR`,
      branding: false,
      entity_encoding: "raw",
      encoding: "UTF-8",
      plugins: "nonbreaking",
      nonbreaking_force_tab: true,
      toolbar: this.toolbar,
      menubar: this.menubar,
      plugins: this.plugins,
      init_instance_callback: (editor) => {
        editor.on('NodeChange Change KeyUp', (e) => {
          this.$emit('input', tinymce.get(this.id).getContent())
          this.$emit('change', tinymce.get(this.id), tinymce.get(this.id).getContent())
        })
        editor.on('init', (e) => {
          if (this.value != undefined) tinymce.get(this.id).setContent(this.value)
          this.$emit('input', this.value)
        })
      },
      ...this.otherProps
    });
    if (!this.initialized) {
      this.initialize();
    }
  },
  created() {
    if (!this.initialized) {
      this.initialize();
    }
  },

  destroyed() {
    tinymce.get(this.id).destroy();
  }
}
</script>
<style>
.mce-container-body.mce-stack-layout,
.mce-edit-area,
.mce-tinymce.mce-container.mce-panel {
  display: flex !important;
  flex-direction: column;
  flex: 1 1 auto;
}

.mce-tinymce iframe {
  flex: 1 1 auto;
}

.mce-container-body.mce-flow-layout {
  max-height: 35px;
}
</style>
>
