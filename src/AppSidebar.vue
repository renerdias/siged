<template>
<!-- Init AppSidebar -->
<box direction="column" expand style="" class="sidebar width__xs-30">
  <box direction="row" center :padding="[0,20]" class="title text__is-white" style="height: 50px;">
    <img style="height: 30px" src="src/assets/img/pasta.svg" />
    <router-link to="/">SiGed</router-link>
  </box>
  <sidebar-menu :datatree="datatree">
  </sidebar-menu>
  <box direction="row" center :padding="[0,20]" class="title text__is-white" style="height: 30px;">
    <i class="fa fa-user-o"></i>
    <router-link to="/logout"><i class="fa fa-power-off"></i></router-link>
  </box>
</box>
<!-- End AppSidebar -->
</template>
<script>
import Box from "./components/r2-box.vue";
import SidebarMenu from "./components/r2-sidebar-menu.vue";
import {
  mapGetters
} from 'vuex';

export default {
  components: {
    Box,
    SidebarMenu
  },
  computed: {
    ...mapGetters([
      'usuarioAutenticado'
    ])
  },
  data: function() {
    return {
      datatree: [{
          name: 'Documento',
          class: '',
          icon: 'fa fa-file-text',
          link: '#/norma/'
          //title: 'fa fa-user'
          //icon: 'fa fa-user'
          //action: 'fa fa-user'
          //el: 'fa fa-user'
          //style: 'fa fa-user'
          //link: 'fa fa-user'
          //click: 'fa fa-user'
          /*
                  path: { type: String, required: true },
  title: { type: String, required: true },
  icon: { type: String, default: 'fa fa-link' },
  isExact: { type: Boolean, default: fal
  */
        },
        {
          name: 'Ferramentas',
          class: '',
          icon: 'fa fa-wrench',
          children: [{
              name: 'Backup',
              class: '',
              icon: 'fa fa-database',
              link: '#/backup'
            },
            {
              name: 'Controle de Acesso',
              class: '',
              icon: 'fa fa-lock',
              children: [{
                  name: 'Perfil',
                  class: '',
                  icon: 'fa fa-users',
                  link: '#/perfil'
                },
                {
                  name: 'Usuário',
                  class: '',
                  icon: 'fa fa-user',
                  link: '#/usuario'
                }
              ]
            },
            {
              name: 'Configurações',
              class: '',
              icon: 'fa fa-cog',
              link: '#/configuracao'
            }
          ]
        }
      ]
    }
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
























































/* Demo Navigation */

.sidebar .title {
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
