<template>
<textarea :id="id" v-model="value"></textarea>
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
    let self = this;
    //tinymce.getInstanceById(this.id).setContent(this.value);
    tinymce.init({
      selector: `#${self.id}`,
      language: `pt_BR`,
      branding: false,
      entity_encoding: "raw",
      encoding: "UTF-8",
      plugins: "nonbreaking",
      nonbreaking_force_tab: true,
      toolbar: self.toolbar,
      menubar: self.menubar,
      plugins: self.plugins,
      setup: function(editor) {

        editor.on('init', function() {
          this.fire('keyup')
          //this.setContent(ccc);
          this.setContent(self.value);
        })

        editor.on('keyup', function() {
          //self.$set(self.value, this.getContent())
          //self.value = this.getContent();
          self.$emit('input', editor.getContent());
        })
      },
      init_instance_callback: (editor) => {
        /*
        // init tinymce
        editor.on('init', function() {
          editor.setContent(self.value);
        });
*/
        /*
                editor.on('KeyUp', (e) => {
                  self.$emit('input', editor.getContent());
                });
                editor.on('Change', (e) => {
                  self.$emit('input', editor.getContent());
                  self.value = editor.getContent();
                });
        *
        editor.on('init', (e) => {
          if (self.value != undefined) tinymce.get(self.id).setContent(self.value)

          self.value = editor.getContent();
          self.$emit('input', self.value);
        });
*/
      },
      ...self.otherProps
    });
  },
  created() {
    // Sets the HTML contents of the activeEditor editor
    //  tinymce.activeEditor.setContent('<span>some</span> html');

    // Sets the raw contents of the activeEditor editor
    //tinymce.activeEditor.setContent('<span>some</span> html', {format: 'raw'});

    // Sets the content of a specific editor (my_editor in this example)
    //tinymce.get(this.id).setContent(this.value);

    // Sets the bbcode contents of the activeEditor editor if the bbcode plugin was added
    //tinymce.activeEditor.setContent('[b]some[/b] html', {format: 'bbcode'});
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
