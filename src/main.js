/*
 * Importa dependências básicas
 */
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import VueResource from 'vue-resource';
Vue.use(VueResource);

//Moment é necessário para validação de data no vee-validate
import moment from 'moment';
window.moment = moment;


import SimpleVueValidation from 'simple-vue-validator';
Vue.use(SimpleVueValidation);


/**
 *
 */
import store from './vuex';

//Vue.config.debug = true;
//Vue.config.silent = false;
/*
Vue.http.options.xhr = {
    withCredentials: true
}
Vue.http.headers.common['Access-Control-Allow-Origin'] = '*';
Vue.http.headers.common['Access-Control-Request-Method'] = '*';
*/

/**
 * Intercepta o acesso a uma rota e verifica se o operador está logado e se
 * tem permissão de acesso a ela
 * @param {type} to
 * @param {type} from
 * @param {type} next
 * @returns {undefined}
 */
function requererAutenticacao(to, from, next) {
  if (!store.state.usuario.autenticacao.autenticado) {
    next({
      path: '/autenticar',
      query: {
        redirect: to.fullPath
      }
    });
  } else {
    next();
  }
}
const router = new VueRouter({
  routes: [{
      path: '/autenticar',
      component: require('./modules/usuario/components/Autenticacao.vue')
    },
    {
      path: '/logout',
      beforeEnter(to, from, next) {
        store.dispatch('usuario/sairSistema');
        next('/autenticar');
      }
    },
    {
      path: '/',
      component: require('./Home.vue'),
      beforeEnter: requererAutenticacao
    },
    {
      path: '/norma',
      component: require('./modules/norma/components/Norma.vue'),
      beforeEnter: requererAutenticacao,
      children: [{
          path: '',
          component: require('./modules/norma/components/NormaResultado.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: 'novo',
          component: require('./modules/norma/components/NormaCadastro.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: 'novo',
          component: require('./modules/norma/components/NormaResultado.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: ':id/:acao(editar|visualizar)',
          component: require('./modules/norma/components/NormaCadastro.vue'),
          beforeEnter: requererAutenticacao
        }
        /*,
                        {
                            path: ':id/visualizar',
                            component: require('./modules/norma/components/NormaCadastro.vue'),
                            beforeEnter: requererAutenticacao
                        }
                        */
      ]
    },
    {
      path: '/backup',
      component: require('./modules/backup/components/Backup.vue'),
      beforeEnter: requererAutenticacao
    },
    {
      path: '/funcionalidade',
      component: require('./modules/funcionalidade/components/Funcionalidade.vue'),
      beforeEnter: requererAutenticacao,
      children: [{
          path: '',
          component: require('./modules/funcionalidade/components/FuncionalidadePesquisa.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: 'novo',
          component: require('./modules/funcionalidade/components/FuncionalidadeCadastro.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: ':id/:acao(editar|visualizar)',
          component: require('./modules/funcionalidade/components/FuncionalidadeCadastro.vue'),
          beforeEnter: requererAutenticacao
        }
      ]
    },
    {
      path: '/perfil',
      component: require('./modules/perfil/components/Perfil.vue'),
      beforeEnter: requererAutenticacao,
      children: [{
          path: '',
          component: require('./modules/perfil/components/PerfilPesquisa.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: 'novo',
          component: require('./modules/perfil/components/PerfilCadastro.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: ':id/:acao(editar|visualizar)',
          component: require('./modules/perfil/components/PerfilCadastro.vue'),
          beforeEnter: requererAutenticacao
        }
      ]
    },
    {
      path: '/usuario',
      component: require('./modules/usuario/components/Usuario.vue'),
      beforeEnter: requererAutenticacao,
      children: [{
          path: '',
          component: require('./modules/usuario/components/UsuarioPesquisa.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: 'novo',
          component: require('./modules/usuario/components/UsuarioCadastro.vue'),
          beforeEnter: requererAutenticacao
        },
        {
          path: ':id/:acao(editar|visualizar)',
          component: require('./modules/usuario/components/UsuarioCadastro.vue'),
          beforeEnter: requererAutenticacao
        }
      ]
    },
    {
      path: '/sobre',
      component: require('./Sobre.vue'),
      beforeEnter: requererAutenticacao
    },
    {
      path: '/sugestao',
      component: require('./Sugestao.vue'),
      beforeEnter: requererAutenticacao
    },
    // catch all redirect
    {
      path: '/NotFound',
      component: require('./NotFound.vue'),
      beforeEnter: requererAutenticacao
    },
    {
      path: '*',
      redirect: '/NotFound'
    }
  ]
});

import App from './App.vue';
new Vue({
  store,
  router,
  el: '#app',
  render: h => h(App)
});
/*
{path: '/quadro-informativo', component: require('./modules/quadro-informativo/components/QuadroInformativo.vue'), beforeEnter: requererAutenticacao,
    children: [
        // UserHome will be rendered inside User's <router-view>
        // when /perfil/:id is matched
        {path: '', component: require('./modules/quadro-informativo/components/QuadroInformativoPesquisa.vue'), beforeEnter: requererAutenticacao},

        // UserProfile will be rendered inside User's <router-view>
        // when /perfil/:id/register is matched
        //{path: 'register/(new|edit)/:id(\\d+)?', component: require('./views/perfil/register.vue'), beforeEnter: requererAutenticacao}
        {path: 'novo', component: require('./modules/quadro-informativo/components/QuadroInformativoCadastro.vue'), beforeEnter: requererAutenticacao},
        {path: ':id/editar', component: require('./modules/quadro-informativo/components/QuadroInformativoCadastro.vue'), beforeEnter: requererAutenticacao}
        //{ path: '/optional-group/(foo/)?bar' }
    ]
},
*/
