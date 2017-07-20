<template>
<modal v-if="showModal" @close="showModal = false" class="svg-background">
  <box direction="column" card="1" :padding="[15]" style="background: #fff; width: 450px;height: auto;min-height: 500px;padding: 48px 40px 36px;">
    <box direction="row" row-center :padding="[20,20,30,20]">
      <box direction="row" :padding="[0,15]" center class="text__is-blue" style="
        padding: 0px 15px;
        font-size: 60px;
        font-weight: bold;
        letter-spacing: 15px;">
        SIGED
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
  <modalloader v-if="showLoader"></modalloader>
</modal>
</template>

<script>
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Modalloader from '../../../components/r2-modalloader.vue';
import Modal from '../../../components/r2-modal.vue';

import {
  mapActions,
  mapGetters
} from 'vuex';

export default {
  components: {
    Box,
    Infobar,
    Modalloader,
    Modal
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
      console.log(this._todosTiposNormas());
    },
    ...mapActions('usuario', [
      'autenticarUsuario'
    ]),
    ...mapActions({
      '_todosTiposNormas': 'tipo_norma/_todosTiposNormas'
    }),
    autenticar() {
      var vm = this;
      vm.showLoader = true;
      var minTime = 5000;
      var startTime = new Date().getTime();

      vm.autenticarUsuario(vm.credencial).then((data) => {
        var usuario = data;
        const promises = [
          vm._todosTiposNormas(),
          new Promise(resolve => setTimeout(resolve, 0, 2))
        ];
        //vm.init()
        Promise.all(promises)
          .then(function(results) {
            //console.error('1º:' + results);
            //var profileData = results[0];
            //console.log("First handler", profileData);

            //Tipos Normas
            if (results[0] == true) {
              notyf.confirm('Olá ' + usuario.nome + ', seja bem-vindo(a)!');
              setTimeout(function() {
                notyf.confirm('Tenha um bom trabalho!');
              }, 5000);
              setTimeout(() => {
                vm.$router.replace(vm.$route.query.redirect || '/');
                vm.showLoader = false;
              }, minTime - (new Date().getTime() - startTime));
            } else {
              return Promise.reject();
            }
          })
          .then(function(results) {
            console.log("Second handler", results);
          });
      }).catch((erro) => {
        setTimeout(() => {
          console.log('Tela de Autenticação: ' + erro)
          vm.showLoader = false;
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
