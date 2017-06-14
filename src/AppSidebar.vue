<template>
<!-- Init AppSidebar -->
<box direction="column" expand style="" class="sidebar width__xs-30">
  <box direction="row" center :padding="[0,20]" class="title" style="
  height: 50px;
  background-color: #4D90FE;
  background-image: -webkit-linear-gradient(top, #4d90fe, #4787ed);
  background-image: -moz-linear-gradient(top, #4d90fe, #4787ed);
  background-image: -ms-linear-gradient(top, #4d90fe, #4787ed);
  background-image: -o-linear-gradient(top, #4d90fe, #4787ed);
  background-image: linear-gradient(top, #4d90fe, #4787ed);
  color: #fff !important;">
    <img style="height: 30px" src="src/assets/img/siged_logo.svg" />
    <router-link to="/">
      SiGed
    </router-link>
  </box>
  <ul class="nav">
    <li>
      <router-link to="/regimento"><i class="fa fa-book"></i>Regimento Interno</router-link>
    </li>
    <li>
      <router-link to="/norma"><i class="fa fa-book"></i>Norma</router-link>
    </li>
    <li>
      <router-link to="/norma/novo"><i class="fa fa-book"></i>Norma Novo</router-link>
    </li>
    <li>
      <router-link to="/backup"><i class="fa fa-database"></i>Backup</router-link>
    </li>
    <li>
      <router-link to="/configuracao"><i class="fa fa-cog"></i>Configuração</router-link>
    </li>
  </ul>
</box>
<!-- End AppSidebar -->
</template>
<script>
import Box from "./components/r2-box.vue";
import {
  mapGetters
} from 'vuex';

export default {
  components: {
    Box
  },
  computed: {
    ...mapGetters([
      'usuarioAutenticado'
    ])
  },
  methods: {
    abrir(URL) {
      var width = screen.width;

      var height = screen.height;

      var left = 0;

      var top = 0;

      window.open(URL, 'janela', 'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left + ', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=yes');

    },
    popupCalendario() {
      var ano = prompt("Qual o ano do calendário?", '');
      if (ano != null) {
        this.abrir('server/sys/srv/relatorio/calendario.php?ano=' + ano);
      }

    }
  }
}
</script>
<style>
.sidebar {
  min-width: 220px;
  max-width: 220px;
  background: #333;
}

.content {
  padding: 30px;
  /*background: #eee;*/
}














/* Demo Navigation */

.title {
  font-size: 16px;
  line-height: 50px;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 7px;
  color: #eee;
  border-bottom: 1px solid #222;
  background: #2a2a2a;
}

.nav li a {
  position: relative;
  display: block;
  padding: 15px 15px 15px 25px;
  font-size: 14px;
  color: #eee;
  border-bottom: 1px solid #222;
  cursor: pointer;
}

.nav li a i {
  margin-right: 10px;
  font-size: 16px;
}

.nav li a:hover {
  background: #444;
  box-shadow: inset 5px 0 0 rgba(18, 114, 224, 0.77), inset 6px 0 0 #222;
}

.nav li a:hover i {
  color: rgba(18, 114, 224, 0.77);
}

.nav li a.active {
  box-shadow: inset 5px 0 0 rgba(18, 114, 224, 0.77), inset 6px 0 0 #222;
  background: #444;
}
</style>
