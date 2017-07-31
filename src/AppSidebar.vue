<template>
<!-- Init AppSidebar -->
<box direction="column" expand style="" class="sidebar width__xs-30">
  <box direction="column" class="bg__is-red">
    <box direction="row" center class="title text__is-white" style="height: 50px;">
      <img style="height: 30px; padding: 0 20px;" src="src/assets/img/archive.svg" />
      <router-link to="/" style="font-weight: bold;font-size: 25px;">SiGed</router-link>
    </box>
    <box direction="row" column-center class="text__is-white" style="height: 50px;">
      <box center :margin="[0,6,0,10]" class="bg__is-white text__is-red" style="width: 35px;height: 35px;border-radius: 50%;font-size: 18px;">
        <i class="fa fa-user-o"></i>
      </box>
      <box direction="column" expand row-center style="font: bold 1.4rem/2rem Arial,sans-serif">
        <span>{{usuarioAutenticado}}</span>
        <span style="font-size: 1.2rem">{{usuarioAutenticadoPerfil}}</span>
      </box>
      <router-link to="/perfil" style="margin: 0 10px;font-size: 20px; color:#4c0905" class="text__is-white__on-hover"> <span><i class="fa fa-cog"></i></span></router-link>
    </box>
  </box>
  <sidebar-menu :datatree="datatree">
  </sidebar-menu>
  <box direction="column" class="text__is-white dev" center style="border-top: 1px solid #222;background: #2a2a2a;">
    <img style="height: 20px; padding: 0 20px; margin: 10px 0px;" src="src/assets/img/rnr.svg" />
    <br />
    <ul>
      <li>
        <i class="fa fa-envelope" style="margin-right: 10px;"></i>renerdias@msn.com
      </li>
      <li>
        <i class="fa fa-phone" style="margin-right: 10px;"></i> (33) 98838-4122
      </li>
    </ul>
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
    ...mapGetters('usuario', [
      'usuarioAutenticado',
      'usuarioAutenticadoPerfil'
    ])
  },
  data: function() {
    return {
      datatree: [{
          name: 'Cadastro',
          class: '',
          icon: 'fa fa-file-text',
          children: [{
            name: 'Documento',
            class: '',
            icon: 'fa fa-file-text',
            link: '#/documento/'
          }, {
            name: 'Setor',
            class: '',
            icon: 'fa fa-sitemap',
            link: '#/documento/'
          }, {
            name: 'Remetente',
            class: '',
            icon: 'fa fa-envelope',
            link: '#/documento/'
          }]
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
          name: 'Arquivos',
          class: '',
          icon: 'fa fa-folder-open',
          children: [{
            name: 'Convênio',
            class: '',
            icon: 'fa fa-handshake-o',
            link: '#/backup'
          }]
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
              children: [{
                  name: 'Tipo de Documento',
                  class: '',
                  icon: 'fa fa-file-o',
                  link: '#/perfil'
                },
                {
                  name: 'Modelo',
                  class: '',
                  icon: 'fa fa-file-text',
                  link: '#/usuario'
                }
              ]
            }
          ]
        },
        {
          name: 'Sair',
          class: '',
          icon: 'fa fa-power-off',
          link: '#/logout'
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

.dev ul {
  transition: max-height 1s;
  max-height: 0;
}

.dev:hover ul {
  max-height: 500px;
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
</style>
