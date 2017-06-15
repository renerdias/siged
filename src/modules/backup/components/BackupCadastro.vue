<template>
<box direction="column" expand style="background: #dfdfdf;" :class="{'is-blocked': bloquear}">
  <box direction="row" center style="background-color: #283e4a; height:50px;">
    <box direction="row" expand center class="text__is-white" style="height:50px;">
      titulo
    </box>
    <box direction="row" center :padding="[0,10]" style="height:50px;width:300px;">
      <button class="button button__is-blue width__xs-50">Salvar</button>
      <button @click.prevent.stop="$router.push('/backup')" class="button width__xs-50">Cancelar</button>
    </box>
  </box>

  <box direction="column" expand>
    <tiny-mce id="descriptionLong" v-model="descriptionLong" :plugins="'advlist autolink lists link image charmap hr anchor pagebreak searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking save table contextmenu directionality template paste textcolor colorpicker textpattern imagetools codesample toc'"
      :menubar="'edit insert view format table'" :toolbar="'undo redo | styleselect | fontselect fontsizeselect bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent'"></tiny-mce>
  </box>
</box>
</template>

<script type="text/javascript">
import TinyMce from '../../../components/tinymce'

import SimpleVueValidation from 'simple-vue-validator';
var Validator = SimpleVueValidation.Validator;
//TODO: Modulo Backup: BackupCadastro, fechar/cancelar com esc
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Window from "../../../components/r2-window.vue";
import MunicipioPesquisa from "../../municipio/components/MunicipioPesquisa.vue";
import Field from "../../../components/r2-field.vue";

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
    MunicipioPesquisa
  },
  data: function() {
    return {
      backup: {
        st_registro: 'A',
        no_backup: '',
        id_municipio: ''
      },
      municipioBackup: {
        id_municipio: '',
        no_municipio: ''
      },
      bloquear: 'true',
      telaModalAtiva: '',
      infobar: {
        exibir: false
      }
    }
  },
  validators: {
    'backup.no_backup': function(value) {
      return Validator.value(value).required('Preenchimento obrigatório.').regex("^[A-Za-zÇçáàãâäÁÀÃÂÄéèêëÉÈÊËíìîïÍÌÎÏóòõôöÓÒÕÔÖúùûüÚÙÛÜñÑ -]*$", 'Apenas letras, espaço e/ou traço.');
    },
    'backup.id_municipio': function(value) {
      return Validator.value(value).required('Preenchimento obrigatório.').integer();
    },
    'municipioBackup.no_municipio': function(value) {
      return Validator.value(value).required('Preenchimento obrigatório.').regex("^[A-Za-zÇçáàãâäÁÀÃÂÄéèêëÉÈÊËíìîïÍÌÎÏóòõôöÓÒÕÔÖúùûüÚÙÛÜñÑ -]*$", 'Apenas letras, espaço e/ou traço.');
    }
  },
  activated() { //Quando usar keep alive
    this.initialize();
  },
  computed: {
    ...mapGetters('usuario', [
      '__permissao'
    ])
  },
  methods: {
    ...mapActions('backup', [
      '_pesquisarBackupPorId',
      '_salvarBackup'
    ]),
    ...mapActions({
      '_pesquisarMunicipioPorId': 'municipio/_pesquisarMunicipioPorId'
    }),
    initialize() {
      if (typeof this.$route.params.id !== typeof undefined) {
        if (this.__permissao.backup.visualizar) {
          this.editar(this.$route.params.id);
          if (this.$route.params.acao == 'editar' && this.__permissao.backup.editar) {
            this.bloquear = false;
          } else if (this.$route.params.acao == 'visualizar') {
            this.bloquear = true;
          }
        }
      } else {
        this.bloquear = false;
        this.reset();
      }
    },
    reset: function() {
      this.municipioBackup = {
        id_municipio: '',
        no_municipio: ''
      };
      this.backup = {
        st_registro: 'A',
        no_backup: '',
        id_municipio: ''
      };
    },
    exibirBarraErro(b, str) {
      this.infobar = {
        tipo: 'error',
        mensagem: str,
        exibir: b
      }
    },
    definirTelaModalAtiva(tela) {
      this.telaModalAtiva = tela;
    },
    definirMunicipioBackup(municipio) {
      this.municipioBackup = {
        id_municipio: municipio.id_municipio,
        no_municipio: municipio.no_municipio + ' - ' + municipio.sg_uf
      }
    },
    editar(id) {
      this._pesquisarBackupPorId(id).then((response) => {
        this.backup = response;
        this._pesquisarMunicipioPorId(this.backup.id_municipio).then((response) => {
          this.definirMunicipioBackup(response);
        }).catch((erro) => {
          this.exibirBarraErro(true, erro);
        })
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })
    },
    salvar(backup) {
      this.$validate()
        .then(function(success) {
          if (success) {
            this._salvarBackup(backup).then(() => {
              this.exibirBarraErro(false);
              this.definirTelaModalAtiva('');
              this.$router.push('/backup/');
            }).catch((erro) => {
              this.exibirBarraErro(true, erro);
            })
          }
        }.bind(this));
    },
    cancelar() {
      this.reset();
      this.exibirBarraErro(false);
      this.validation.reset();
      this.$router.push('/backup/');
    }
  }
}
</script>
