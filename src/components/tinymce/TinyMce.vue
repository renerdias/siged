<template>
<textarea :id="id" :value="value"></textarea>
</template>

<script>
export default {
  name: 'tiny-mce',
  props: {
    id: {
      type: String,
      default: 'editor'
    },
    value: {
      type: String,
      default: ''
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
  },
  mounted() {
    tinymce.init({
      selector: `#${this.id}`,
      language: `pt_BR`,
      branding: false,
      entity_encoding: "raw",
      encoding: "UTF-8",
      toolbar: this.toolbar,
      menubar: this.menubar,
      plugins: this.plugins,
      init_instance_callback: (editor) => {
        editor.on('KeyUp', (e) => {
          this.$emit('input', editor.getContent());
        });

        editor.on('Change', (e) => {
          this.$emit('input', editor.getContent());
        });
      },
      ...this.otherProps
    })
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
