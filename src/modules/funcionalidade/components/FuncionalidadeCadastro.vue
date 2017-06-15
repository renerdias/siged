<template>
<window title="Cadastro de Funcionalidade" size="600px">
  <infobar :type.sync="infobar.tipo" icon="true" :message.sync="infobar.mensagem" :show.sync="infobar.exibir"></infobar>
  <box direction="column" :class="{'is-blocked': bloquear}">
    <box direction="row" reverse :padding="[10,5]" class="width__xs-100">
      <box direction="column" :padding="[0,5]">
        <label>Status</label>
        <box direction="row" class="width__xs-100 button-bar small">
          <div class="button-bar__item">
            <input type="radio" name="status" v-model="funcionalidade.st_registro" value="A">
            <button class="button-bar__button">Ativo</button>
          </div>
          <div class="button-bar__item">
            <input type="radio" name="status" v-model="funcionalidade.st_registro" value="I">
            <button class="button-bar__button">Inativo</button>
          </div>
        </box>
      </box>
    </box>

    <box direction="row" :padding="[10,5]">
      <field label="Nome" type="text" v-model="funcionalidade.no_funcionalidade" direction="column" :padding="[0,5]" class="width__xs-100" :has-error="validation.hasError('funcionalidade.no_funcionalidade')" :msg-error="validation.firstError('funcionalidade.no_funcionalidade')"></field>
    </box>
  </box>
  <!-- Init button bar-->
  <box direction="row" reverse :padding="[5,10]" v-if="bloquear">
    <button @click="cancelar" class="button button-flat width__xs-100">Voltar</button>
  </box>
  <box v-else direction="row" reverse :padding="[5,10]">
    <button @click.prevent.stop="salvar(funcionalidade)" class="button button__is-blue width__xs-50">Salvar</button> &nbsp;
    <button @click="cancelar" class="button button-flat width__xs-50">Cancelar</button>
  </box>
  <!-- End button bar-->
</window>
</template>

<script type="text/javascript">
//TODO: Modulo Funcionalidade: FuncionalidadeCadastro, fechar/cancelar com esc
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Window from "../../../components/r2-window.vue";
import Field from "../../../components/r2-field.vue";

import {
  mapActions,
  mapGetters
} from 'vuex';
module.exports = {
  components: {
    Field,
    Infobar,
    Window,
    Box
  },
  data: function() {
    return {
      funcionalidade: {
        st_registro: 'A',
        no_funcionalidade: ''
      },

      bloquear: 'true',
      infobar: {
        exibir: false
      }
    }
  },
  activated() { //Quando usar keep alive
    this.initialize();
  },
  mounted() {
    //
  },
  computed: {
    ...mapGetters('usuario', [
      '__permissao'
    ])
  },
  methods: {
    ...mapActions('funcionalidade', [
      '_pesquisarFuncionalidadePorId',
      '_salvarFuncionalidade'
    ]),
    initialize() {
      if (typeof this.$route.params.id !== typeof undefined) {
        if (this.__permissao.funcionalidade.visualizar) {
          this.editar(this.$route.params.id);
          if (this.$route.params.acao == 'editar' && this.__permissao.funcionalidade.editar) {
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

      this.funcionalidade = {
        st_registro: 'A',
        no_funcionalidade: ''
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
      this._pesquisarFuncionalidadePorId(id).then((response) => {
        this.funcionalidade = response;
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })
    },
    salvar(funcionalidade) {

      this._salvarFuncionalidade(funcionalidade).then(() => {
        this.exibirBarraErro(false);
        this.$router.push('/funcionalidade/');
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })

    },
    cancelar() {
      this.reset();
      this.exibirBarraErro(false);
      this.$router.push('/funcionalidade/');
    }
  }
}
</script>
