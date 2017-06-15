<template>
<box direction="column" expand style="background: #dfdfdf;" :class="{'is-blocked': bloquear}">
  <box direction="row" center style="background-color: #283e4a; height:50px;">
    <box direction="row" expand center class="text__is-white" style="height:50px;">
      Perfil
    </box>
    <box direction="row" center :padding="[0,10]" style="height:50px;width:300px;">
      <button class="button button__is-blue width__xs-50">Salvar</button>
      <button @click.prevent.stop="$router.push('/perfil')" class="button width__xs-50">Cancelar</button>
    </box>
  </box>

  <box direction="column" expand>

  </box>
</box>
</template>

<script type="text/javascript">
//TODO: Modulo Perfil: PerfilCadastro, fechar/cancelar com esc
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
      perfil: {
        st_registro: 'A',
        no_perfil: ''
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
  computed: {
    ...mapGetters('usuario', [
      '__permissao'
    ])
  },
  methods: {
    ...mapActions('perfil', [
      '_pesquisarPerfilPorId',
      '_salvarPerfil'
    ]),
    initialize() {
      if (typeof this.$route.params.id !== typeof undefined) {
        if (this.__permissao.perfil.visualizar) {
          this.editar(this.$route.params.id);
          if (this.$route.params.acao == 'editar' && this.__permissao.perfil.editar) {
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

      this.perfil = {
        st_registro: 'A',
        no_perfil: ''
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
      this._pesquisarPerfilPorId(id).then((response) => {
        this.perfil = response;
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })
    },
    salvar(perfil) {

      this._salvarPerfil(perfil).then(() => {
        this.exibirBarraErro(false);
        this.$router.push('/perfil/');
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })

    },
    cancelar() {
      this.reset();
      this.exibirBarraErro(false);
      this.$router.push('/perfil/');
    }
  }
}
</script>
