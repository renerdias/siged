<template>
<modal v-if="showModal" @close="showModal = false" class="svg-background">
  <box direction="column" card="1" :padding="[15]" style="background: #fff; width: 450px;height: auto;
min-height: 500px;padding: 48px 40px 36px;">
    <box direction="row" row-center :padding="[20,20,30,20]">
      <box direction="row" :padding="[0,15]" column-center>
        <router-link to="/" class="box r2-text-hover-blue-600 box__is-center" style="padding: 0 10px;">
          <img src="src/assets/img/logo-siged.svg" style="height:40px" class="box"></img>
        </router-link>
      </box>
    </box>
    <box v-if="$route.query.redirect" direction="row">
      <infobar type="warn" icon="true" message="Você precisa estar autenticado para acessar este conteúdo" show="true" style="position: fixed; right: 0; left: 0; top:0; z-index: 1030;"></infobar>
    </box>
    <infobar type="error" icon="true" message="Falha de autenticação, credenciais inválidas!" :show="houveFalha" style="position: fixed; right: 0; left: 0; top:0; z-index: 1030;"></infobar>
    <form @submit.stop.prevent="autenticar(credencial)">

      <box direction="column" expand>
        <box direction="column" expand>
          <box direction="column" :padding="[5]">
            <label><strong>Usuário</strong></label>
            <input v-model="credencial.nome" placeholder="usuario" class="big" type="text">
          </box>
          <box direction="column" :padding="[5]">
            <label><strong>Senha</strong></label>
            <input v-model="credencial.senha" placeholder="senha" class="big" type="password">
          </box>
        </box>
        <box direction="row" reverse>
          <button class="button button__is-blue width__xs-100" type="submit">
                                <i class="fa fa-sign-out" style="padding: 0 10px;font-size: 20px;"></i>
                                Autenticar
                            </button>
        </box>
      </box>
    </form>
  </box>
  <modal v-if="showLoader">
    <box direction="column" center :padding="[50]" :radius="[5]" style="background: #333">
      <spinner show="true"> </spinner>
      <span class="text__is-white">...aguarde</span>
    </box>
  </modal>
</modal>
</template>

<script>
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Window from "../../../components/r2-window.vue";
import Modal from '../../../components/r2-modal.vue';
import Spinner from '../../../components/r2-spinner.vue';

import {
  mapActions,
  mapGetters
} from 'vuex';

export default {
  components: {
    Box,
    Infobar,
    Window,
    Modal,
    Spinner
  },
  data() {
    return {
      showModal: true,
      showLoader: false,
      credencial: {
        nome: 'renerdias',
        senha: 'renerdias'
      }
    }
  },
  methods: {
    init() {
      this._todosTiposNormas();
    },
    ...mapActions('usuario', [
      'autenticarUsuario'
    ]),
    ...mapActions({
      '_todosTiposNormas': 'tipo_norma/_todos'
    }),
    autenticar() {
      this.showLoader = true;
      let minTime = 10000;
      let startTime = new Date().getTime();
      this.autenticarUsuario(this.credencial).then(() => {
        this.init()
        setTimeout(() => {
          this.$router.replace(this.$route.query.redirect || '/');
          this.showLoader = false;
        }, minTime - (new Date().getTime() - startTime));
      }).catch((erro) => {
        setTimeout(() => {
          console.log('Tela de Autenticação: ' + erro)
          this.showLoader = false;
        }, minTime - (new Date().getTime() - startTime));
      })
    }
  },
  computed: {
    ...mapGetters('usuario', [
      'estaAutenticado',
      'totalFalhasAutenticacao'
    ]),
    houveFalha() {
      return !this.estaAutenticado && (this.totalFalhasAutenticacao > 0);
    }
  }
};
</script>
<style>

</style>
