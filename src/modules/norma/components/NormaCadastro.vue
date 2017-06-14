<template>
<box direction="column" expand style="background: #dfdfdf;" :class="{'is-blocked': bloquear}">
  <modal v-if="showLoader">
    <box direction="row" center :padding="[0]">
      <spinner show="true"> </spinner>
      <span>...carregando dados básicos.</span>
    </box>
  </modal>
  <box direction="row" center style="background-color: #283e4a; height:50px;">
    <box direction="row" expand center class="text__is-white" style="height:50px;">
      titulo
    </box>
    <box direction="row" center :padding="[0,10]" style="height:50px;width:300px;">
      <button class="button button-blue width__xs-50">Salvar</button>
      <button @click="cancelar" class="button width__xs-50">Cancelar</button>
    </box>
  </box>

  <box direction="column" expand>
    <tiny-mce id="tinymce" v-model="norma.ds_norma" :plugins="'advlist autolink lists link image charmap hr anchor pagebreak searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking save table contextmenu directionality template paste textcolor colorpicker textpattern imagetools codesample toc'"
      :menubar="'edit insert view format table'" :toolbar="'undo redo | styleselect | fontselect fontsizeselect bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent'"></tiny-mce>
  </box>
</box>
</template>

<script type="text/javascript">
import TinyMce from '../../../components/tinymce'

//TODO: Modulo Norma: NormaCadastro, fechar/cancelar com esc
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Window from "../../../components/r2-window.vue";
import Field from "../../../components/r2-field.vue";
import Modal from '../../../components/r2-modal.vue';
import Spinner from '../../../components/r2-spinner.vue';

import {
  mapActions,
  mapGetters
} from 'vuex';
module.exports = {
  components: {
    TinyMce,
    Field,
    Infobar,
    Window,
    Box,
    Modal,
    Spinner
  },
  data: function() {
    return {
      norma: {
        st_registro: 'A',
        no_norma: '',
        ds_norma: 'Redija aqui a sua norma.'
      },
      bloquear: 'true',
      infobar: {
        exibir: false
      },
      showLoader: false
    }
  },
  created() {
    this.showLoader = true;
  },
  //activated() { //Quando usar keep alive
  mounted() {

    this.initialize();
  },
  computed: {
    ...mapGetters('usuario', [
      '__permissao'
    ])
  },
  methods: {
    ...mapActions('norma', [
      '_pesquisarNormaPorId',
      '_salvarNorma'
    ]),
    ...mapActions({
      '_pesquisarMunicipioPorId': 'municipio/_pesquisarMunicipioPorId'
    }),
    initialize() {
      if (typeof this.$route.params.id !== typeof undefined) {
        if (this.__permissao.norma.visualizar) {
          this.editar(this.$route.params.id);
          if (this.$route.params.acao == 'editar' && this.__permissao.norma.editar) {
            this.bloquear = false;
          } else if (this.$route.params.acao == 'visualizar') {
            this.bloquear = true;
          }
        }
      } else {
        this.bloquear = false;
        this.reset();
      }
      this.showLoader = false;
    },
    reset: function() {
      this.norma = {
        st_registro: 'A',
        no_norma: '',
        ds_norma: 'Redija aqui a sua norma.'
      };
    },
    exibirBarraErro(b, str) {
      this.infobar = {
        tipo: 'error',
        mensagem: str,
        exibir: b
      }
    },
    editar(id) {
      this._pesquisarNormaPorId(id).then((response) => {
        this.norma = response;
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })
    },
    salvar(norma) {

      this._salvarNorma(norma).then(() => {
        this.exibirBarraErro(false);
        this.$router.push('/norma/');
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })

    },
    cancelar() {
      this.reset();
      this.exibirBarraErro(false);
      this.$router.push('/norma/');
    }
  }
}
</script>
