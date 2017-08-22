<template>
<transition name="login">
  <!-- login-wrapper start -->
  <box direction="column" class="login-wrapper" style="min-height: 100vh;">
    <!-- login-header start -->
    <box direction="row" padding="-2" justify-content="center" class="bg-faded mb-xs-5" :border="['bottom-1']" border-color="default" style="height: 100px;">
      <box direction="row" :padding="['x-5']">
        <img src="src/assets/img/folder.svg" style="height: 80px;">
      </box>
      <box direction="column" justify-content="center" expand>
        <h1 class="my-sm-0" style="letter-spacing: 5px;">SIGED</h1>
        <h6 class="text-muted hidden-sm-down" style="letter-spacing: 1px;">Sistema de Gestão Eletrônica de Documentos</h6>
      </box>
    </box>
    <!-- login-header end -->
    <box v-if="$route.query.redirect" direction="row">
      <infobar type="warning" title="ATENÇÃO:" icon="true" message="Você precisa estar autenticado para acessar este conteúdo" show="true"></infobar>
    </box>
    <box direction="row">
      <infobar type="danger" icon="true" message="Falha de autenticação, credenciais inválidas!" :show="houveFalha"></infobar>
    </box>
    <!-- login-container start -->
    <box padding="-2" justify-content="center" align-items="center" expand>
      <!-- login-panel start -->
      <panel title="Acesso Restrito" size="600px" class="my-2">
        <form @submit.stop.prevent="autenticar(credencial)" class="pt-sm-5">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label font-weight-bold">CPF</label>
            <div class="col-sm-10">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Nº do CPF" aria-describedby="basic-addon1">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label font-weight-bold">Senha</label>
            <div class="col-sm-10">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
                <input type="password" v-model="credencial.senha" class="form-control" placeholder="Senha" aria-describedby="basic-addon1">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <box direction="row-reverse" class="offset-sm-2 col-sm-10">
              <button type="submit" class="btn btn-primary col-xs-12 col-sm-5">
              <i class="fa fa-sign-out" style="font-size: 20px;"></i>
              Autenticar
            </button>
            </box>
          </div>
        </form>
        <box slot="footer" direction="row" align-items="around" class="offset-md-2 col-md-10">
          <small class="col-6">
            <a href="#">
              Solicitar cadastro
            </a>
          </small>
          <small class="col-6">
            <a href="#">
              Esqueci minha senha
            </a>
          </small>
        </box>
      </panel>
      <!-- login-panel end -->
    </box>
    <!-- login-container end -->
    <!-- login-footer start -->
    <box direction="row" align-items="center" justify-content="center" :border="['top-1']" border-color="default" class="bg-faded" style="height: 25px;padding: 20px;">
      <span class="flex-order-sm-2">Desenvolvido por</span>
      <img class=" flex-order-sm-3 mx-3" style="height: 25px;" src="src/assets/img/rnr-blue.svg" />
      <span class="flex-order-sm-1 mr-3">© 2017 </span>
      <span class="flex-order-sm-4 hidden-sm-down">Todos os direitos reservados</span>
    </box>
    <!-- login-footer end -->
  </box>
  <!-- login-wrapper end -->
</transition>
</template>

<script>
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Modalloader from '../../../components/r2-modalloader.vue';
import Modal from '../../../components/r2-modal.vue';
import Panel from '../../../components/r2-panel.vue';

import {
  mapActions,
  mapGetters
} from 'vuex';

export default {
  components: {
    Box,
    Infobar,
    Modalloader,
    Modal,
    Panel
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
      console.log(this._obterTodosTiposDocumentos());
    },
    ...mapActions('usuario', [
      'autenticarUsuario'
    ]),
    ...mapActions({
      '_obterTodosTiposDocumentos': 'tipo_documento/_obterTodosTiposDocumentos'
    }),
    autenticar() {
      var vm = this;
      vm.showLoader = true;
      var minTime = 5000;
      var startTime = new Date().getTime();

      vm.autenticarUsuario(vm.credencial).then((data) => {
        var usuario = data;
        const promises = [
          vm._obterTodosTiposDocumentos(),
          new Promise(resolve => setTimeout(resolve, 0, 2))
        ];
        //vm.init()
        Promise.all(promises)
          .then(function(results) {
            //console.error('1º:' + results);
            //var profileData = results[0];
            //console.log("First handler", profileData);

            //Tipos Documentos
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
<style>
.dev .sub-footer {
  transition: max-height 1s;
  max-height: 0;
  overflow: hidden;
}

.dev:hover .sub-footer {
  max-height: 500px;
}


.login-wrapper {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff;
  display: flex !important;
  transition: opacity 0.3s ease
}

.login-container {
  transition: all 0.3s ease;
}

.login-enter {
  opacity: 0
}

.login-leave-active {
  opacity: 0
}

.login-enter .login-container,
.login-leave-active .login-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1)
}
</style>
