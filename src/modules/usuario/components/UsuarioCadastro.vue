<template>
<div>
  <window title="Cadastro de Usuario" size="600px">
    <infobar :type.sync="infobar.tipo" icon="true" :message.sync="infobar.mensagem" :show.sync="infobar.exibir"></infobar>
    <box direction="column" :padding="[0]" :class="{'is-blocked': bloquear}">
      <box direction="row" reverse :padding="[10,5]" class="width__xs-100">
        <box direction="column" :padding="[0,5]">
          <label>Status</label>
          <box direction="row" center class="width__xs-100 button-bar small">
            <div class="button-bar__item box r2-expand">
              <input type="radio" name="status" v-model="usuario.st_registro" value="A">
              <button class="button-bar__button">Ativo</button>
            </div>
            <div class="button-bar__item box r2-expand">
              <input type="radio" name="status" v-model="usuario.st_registro" value="I">
              <button class="button-bar__button">Inativo</button>
            </div>
            <!--<input v-model="usuario.st_registro" v-bind:true-value="'A'" v-bind:false-value="'I'" type="checkbox"> Ativo-->
          </box>
        </box>
      </box>
      <box direction="row" :padding="[10,5]">

        <box direction="column" :padding="[0,5]" class="width__xs-35">
          <label>CPF</label>
          <input v-model="usuario.nu_cpf" v-mask="'###.###.###-##'" placeholder="___.___.___-__" type="text" />
        </box>
        <box direction="column" :padding="[0,5]" class="width__xs-35">
          <label>Protegido</label>
          <box direction="row" center class="width__xs-100 button-bar">
            <div class="button-bar__item box r2-expand">
              <input type="radio" name="protegido" v-model="usuario.st_protegido" value="S">
              <button class="button-bar__button">Sim</button>
            </div>
            <div class="button-bar__item box r2-expand">
              <input type="radio" name="protegido" v-model="usuario.st_protegido" value="N">
              <button class="button-bar__button">Não</button>
            </div>
            <!--<input v-model="usuario.st_registro" v-bind:true-value="'A'" v-bind:false-value="'I'" type="checkbox"> Ativo-->
          </box>
        </box>
      </box>
      <box direction="row" :padding="[10,5]">
        <box direction="column" :padding="[0,5]" class="width__xs-100">
          <label>Nome</label>
          <input v-model="usuario.no_usuario" v-validate="'required|min:5|max:100'" name="no_usuario" data-vv-as="Nome" :class="{'border__is-red': errors.has('no_usuario') }" type="text" />
          <span v-show="errors.has('no_usuario')" class="text__is-red">{{ errors.first('no_usuario') }}</span>
        </box>
      </box>
      <box direction="row" :padding="[10,5]">
        <box direction="column" :padding="[0,5]" class="width__xs-50">
          <label>login</label>
          <input v-model="usuario.lg_usuario" v-validate="'required'" name="lg_usuario" data-vv-as="Login" :class="{'border__is-red': errors.has('lg_usuario') }" type="text" />
          <span v-show="errors.has('lg_usuario')" class="text__is-red">{{ errors.first('lg_usuario') }}</span>
        </box>
        <box direction="column" :padding="[0,5]" class="width__xs-50">
          <label>Senha</label>
          <input v-model="usuario.pw_usuario" v-validate="'required'" name="pw_usuario" data-vv-as="Senha" :class="{'border__is-red': errors.has('pw_usuario') }" type="password" />
          <span v-show="errors.has('pw_usuario')" class="text__is-red">{{ errors.first('pw_usuario') }}</span>
        </box>
      </box>
    </box>
    <box direction="row" reverse :padding="[5,10]" v-if="bloquear">
      <button @click="cancelar" class="button button-flat width__xs-100">Voltar</button>
    </box>
    <box v-else direction="row" reverse :padding="[5,10]">
      <button @click.prevent.stop="salvar(usuario)" class="button button-blue width__xs-50">Salvar</button> &nbsp;
      <button @click="cancelar" class="button button-flat width__xs-50">Cancelar</button>
    </box>
    <!-- End button bar-->
  </window>
</div>
</template>
<script>
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Window from "../../../components/r2-window.vue";
import {
  mapActions,
  mapGetters
}
from 'vuex';
export default {
  components: {
    Infobar,
    Window,
    Box
  },
  data() {
    return {
      usuarioService: {},
      bloquear: 'true',
      usuario: {
        st_registro: 'A',
        st_protegido: 'N'
      },
      infobar: {
        exibir: false
      }
    }
  },
  activated() { //Quando usar keep alive
    this.init();
  },
  computed: {
    ...mapGetters({
      '__permissao': 'usuario/__permissao',
      '__listaPerfis': 'sexo/__listaPerfis'
    })
  },
  methods: {
    init() {
      if (typeof this.$route.params.id !== typeof undefined) {
        if (this.__permissao.usuario.visualizar) {
          this.editar(this.$route.params.id);
          if (this.$route.params.acao == 'editar' && this.__permissao.usuario.editar) {
            this.bloquear = false;
          } else if (this.$route.params.acao == 'visualizar') {
            this.bloquear = true;
          }
        }
      } else {
        this.bloquear = false;
        this.usuario = {
          st_registro: 'A',
          st_protegido: 'N'
        }
      }

    },
    exibirBarraErro(b, str) {
      this.infobar = {
        tipo: 'error',
        mensagem: str,
        exibir: b
      }
    },
    ...mapActions('usuario', [
      '_pesquisarUsuarioPorId',
      '_salvarUsuario'
    ]),
    cancelar: function() {
      this.usuario = '';
      this.exibirBarraErro(false);
      this.errors.clear();
      this.$router.push('/usuario/');
    },
    editar: function(id) {
      this._pesquisarUsuarioPorId(id).then((response) => {
        this.usuario = response;
      }).catch((erro) => {
        this.exibirBarraErro(true, erro);
      })
    },
    salvar(usuario) {
      this.$validator.validateAll();
      if (!this.errors.any()) {
        this._salvarUsuario(usuario).then(() => {
          this.exibirBarraErro(false);
          this.$router.push('/usuario/');
        }).catch((erro) => {
          this.exibirBarraErro(true, erro);
        })
      }
    }
  }
}
</script>
