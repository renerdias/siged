<template>
<box direction="column" expand style="background: #dfdfdf;">
  <box direction="row" center class="bg__is-red text__is-white" style="height:50px; font-weight: bold; text-transform: uppercase; letter-spacing: 7px;">
    <router-link v-if="bloquear" to="/documento/" style="width:50px;height:50px; font-size: 30px;" class="box box__is-center bg__is-white__on-hover text__is-red__on-hover"><i class="fa fa-angle-left text__is-red__on-hover"></i></router-link>
    <box expand center>{{operacaoEmAndamento}} Documento</box>
  </box>
  <box direction="row" center class="text__is-white" style="height:30px;background: #888; font-weight: bold;letter-spacing: 5px;">
    Detalhes
  </box>
  <box direction="column" expand :class="{'is-blocked': bloquear}">
    <modal v-if="showLoader">
      <box direction="row" center :padding="[0]">
        <spinner show="true"> </spinner>
        <span>...carregando dados básicos.</span>
      </box>
    </modal>
    <box direction="column" v-if="openDetail">
      <box direction="row" :padding="[10,5]">
        <field label="Tipo de Documento" type="select" v-model="documento.id_tipo_documento" :options="__listaTiposDocumentos" options-value="id_tipo_documento" options-label="no_tipo_documento" direction="column" :padding="[0,5]" class="width__xs-100"></field>
      </box>
      <box direction="row" :padding="[10,5]">
        <field label="Nº da Documento" type="text" v-model="documento.nu_documento" direction="column" :padding="[0,5]" class="width__xs-100"></field>
        <field label="Data da Documento" type="text" v-model="documento.dt_documento" direction="column" :padding="[0,5]" class="width__xs-100"></field>
        <field label="Data de Aprovação" type="text" v-model="documento.dt_aprovacao" direction="column" :padding="[0,5]" class="width__xs-100"></field>
      </box>
      <box direction="row" :padding="[10,5]">
        <field label="Ementa" type="textarea" v-model="documento.ds_ementa" direction="column" :padding="[0,5]" class="width__xs-100"></field>
      </box>
    </box>
    <button class="text__is-white" @click="toggleDetail" style="height:30px;  border:none;background: #999; font-weight: bold;letter-spacing: 3px;">
      Redação
      <i :class="['fa', {'fa-caret-up': openDetail }, {'fa-caret-down': !openDetail }]"></i>
    </button>
    <box direction="column" expand>
      <tiny-mce id="tinymce" v-model="documento.ds_redacao" :plugins="'autoresize advlist autolink lists link image charmap hr anchor pagebreak searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking save table contextmenu directionality template paste textcolor colorpicker textpattern imagetools codesample toc'"
        :menubar="'edit insert view format table'" :toolbar="'undo redo | styleselect | fontselect fontsizeselect bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent'"></tiny-mce>
    </box>
  </box>
  <box direction="row" reverse center style="height:50px;">
    <box direction="row" reverse center :padding="[0,10]" style="height:50px;width:600px;" v-if="bloquear">
      <button @click="cancelar" class="button button-flat width__xs-100">Voltar</button>
    </box>
    <box v-else direction="row" reverse center :padding="[0,10]" style="height:50px;width:600px;">
      <button @click.prevent.stop="salvar(documento)" class="button button__is-red width__xs-65">Salvar</button>
      <button @click="cancelar" class="button width__xs-35">Cancelar</button>
    </box>

  </box>
</box>
</template>

<script type="text/javascript">
import TinyMce from '../../../components/tinymce'

//TODO: Modulo Documento: DocumentoCadastro, fechar/cancelar com esc
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
      operacaoEmAndamento: '',
      openDetail: false,
      documento: {
        st_registro: 'A',
        id_tipo_documento: '',
        nu_documento: '',
        dt_documento: '',
        dt_aprovacao: '',
        ds_ementa: '',
        ds_redacao: 'Redija aqui a sua documento.'
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
    ]),
    ...mapGetters('tipo_documento', [
      '__listaTiposDocumentos'
    ])
  },

  methods: {
    toggleDetail: function() {
      this.openDetail = !this.openDetail
    },
    ...mapActions('documento', [
      '_pesquisarDocumentoPorId',
      '_salvarDocumento'
    ]),
    ...mapActions({
      '_pesquisarMunicipioPorId': 'municipio/_pesquisarMunicipioPorId'
    }),
    initialize() {
      if (typeof this.$route.params.id !== typeof undefined) {
        if (this.__permissao.documento.visualizar) {
          this.editar(this.$route.params.id);
          if (this.$route.params.acao == 'editar' && this.__permissao.documento.editar) {
            this.operacaoEmAndamento = 'Editando'
            this.bloquear = false;
          } else if (this.$route.params.acao == 'visualizar') {
            this.operacaoEmAndamento = 'Visualizando'
            this.bloquear = true;
          }
        }
      } else {
        this.bloquear = false;
        this.reset();
        this.operacaoEmAndamento = 'Criando'
      }
      this.showLoader = false;
    },
    reset: function() {
      this.documento = {
        st_registro: 'A',
        id_tipo_documento: '',
        nu_documento: '',
        dt_documento: '',
        dt_aprovacao: '',
        ds_ementa: '',
        ds_redacao: 'Redija aqui a sua documento.'
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
      this._pesquisarDocumentoPorId(id).then((response) => {
        this.documento = response;
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })
    },
    salvar(documento) {

      this._salvarDocumento(documento).then(() => {
        this.exibirBarraErro(false);
        this.$router.push('/documento/');
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })

    },
    cancelar() {
      this.reset();
      this.exibirBarraErro(false);
      this.$router.push('/documento/');
    }
  }
}
</script>
