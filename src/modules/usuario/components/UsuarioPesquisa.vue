<template>
<window title="Pesquisar por Usuario" size="900px">
  <box direction="row" :padding="[20]" center style="background:#f1f1f1;border-bottom: 1px solid #dedede">
    <box direction="row" :padding="[0,5]" expand :margin="[10]" class=" box__is-center" style='justify-content: flex-start !important;'>
      <input v-model="termo" @keyup.enter="_pesquisarUsuarioPorNome(termo)" class="width__xs-100" type="text" placeholder="Digite o nome do município..." />
      <a style="float: right; margin-left: -30px; z-index: 2;" @click.prevent="_pesquisarUsuarioPorNome(termo)">
        <i class="fa fa-search"></i>
      </a>
    </box>
    <box v-if="__permissao.usuario.inserir" direction="row" :padding="[0,5]" class="width__xs-15 box__is-center">
      <router-link to="/usuario/novo" class="button button-blue">Novo</router-link>
    </box>
  </box>
  <box direction="row" :padding="[0]">
    <table class="w3-table w3-bordered w3-striped w3-hoverable">
      <thead>
        <tr class="w3-red">
          <th style="width: 50px;"></th>
          <th>Nome</th>
          <th style="width:120px; text-align:center">Dt. Nascimento</th>
          <th>Mãe</th>
          <th>Naturalidade</th>
          <th style="width:80px; text-align:center">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="_usuario in __listaUsuarios">
          <td class="icons">
            <i class="fa fa-check-circle" :class="[_usuario.st_registro == 'A' ? 'text__is-blue' : '']">
                            </i>
          </td>
          <td>{{_usuario.no_usuario}}</td>
          <td>{{_usuario.dt_nascimento}}</td>
          <td>{{_usuario.no_mae}}</td>
          <td>{{_usuario.no_municipio}} - {{_usuario.sg_uf}}</td>
          <td class="buttons">
            <a v-if="__permissao.usuario.visualizar" @click.prevent="$router.push('/usuario/'+ _usuario.id_usuario +'/visualizar')"><i class="fa fa-eye"></i></a>
            <a v-if="__permissao.usuario.editar" @click.prevent="$router.push('/usuario/'+ _usuario.id_usuario +'/editar')"><i class="fa fa-edit"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </box>
</window>
</template>
<script>
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Window from "../../../components/r2-window.vue";
import {
  mapActions,
  mapGetters
} from 'vuex';
export default {
  components: {
    Box,
    Infobar,
    Window
  },
  data() {
    return {
      termo: ''
    }
  },
  activated() { //Quando usar keep alive//mounted() {
    this._todosUsuarios();
  },
  methods: {
    ...mapActions('usuario', [
      '_todosUsuarios',
      '_pesquisarUsuarioPorNome'
    ])
  },
  computed: {
    ...mapGetters('usuario', [
      '__listaUsuarios'
    ]),
    ...mapGetters('usuario', [
      '__permissao'
    ])
  }
}
</script>
