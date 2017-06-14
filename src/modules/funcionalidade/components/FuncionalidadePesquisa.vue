<template>
<window title="Pesquisar por Funcionalidade" size="800px">
  <box direction="row" :padding="[20]" center style="background:#f1f1f1;border-bottom: 1px solid #dedede">
    <box direction="row" :padding="[0,5]" center expand :margin="[10]" style='justify-content: flex-start !important;'>
      <input class="width__xs-100" type="text" placeholder="Procurar por..." v-model="termo" @input="_pesquisarFuncionalidadePorNome(termo)" />
      <i class="fa fa-search" style="float:right;margin-left: -30px; z-index:2;"></i>
    </box>
    <box direction="row" :padding="[0,5]" class="width__xs-15 box__is-center">
      <button @click.prevent.stop="$router.push('/funcionalidade/novo')" class="button button-blue">Novo</button>
    </box>
  </box>
  <box direction="row" :padding="[0]">
    <table class="w3-table w3-bordered w3-striped w3-hoverable">
      <thead>
        <tr class="w3-red">
          <th style="width: 50px;"></th>
          <th>Nome</th>
          <th>Município</th>
          <th style="width:80px;" class="text__is-center">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="_funcionalidade in __listaFuncionalidades">
          <td class="icons">
            <i class="fa fa-check-circle" :class="[_funcionalidade.st_registro == 'A' ? 'text__is-blue' : '']">
                            </i>
          </td>
          <td>{{_funcionalidade.sg_tipo_funcionalidade}}: {{_funcionalidade.no_funcionalidade}}</td>
          <td>{{_funcionalidade.no_municipio}} - {{_funcionalidade.sg_uf}}</td>
          <td class="buttons">
            <a v-if="__permissao.funcionalidade.visualizar" @click.prevent="$router.push('/funcionalidade/'+ _funcionalidade.id_funcionalidade +'/visualizar')"><i class="fa fa-eye"></i></a>
            <a v-if="__permissao.funcionalidade.editar" @click.prevent="$router.push('/funcionalidade/'+ _funcionalidade.id_funcionalidade +'/editar')"><i class="fa fa-edit"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </box>
</window>
</template>
<script>
import Box from "../../../components/r2-box.vue";
import Window from "../../../components/r2-window.vue";
import {
  mapActions,
  mapGetters
} from 'vuex';
export default {
  components: {
    Box,
    Window
  },
  data() {
    return {
      termo: ''
    }
  },
  activated() { //Quando usar keep alive
    this._obterTodosFuncionalidades();
  },
  methods: {
    ...mapActions('funcionalidade', [
      '_obterTodosFuncionalidades',
      '_pesquisarFuncionalidadePorNome'
    ])
  },
  computed: {
    ...mapGetters('funcionalidade', [
      '__listaFuncionalidades'
    ]),
    ...mapGetters('usuario', [
      '__permissao'
    ])
  }
}
</script>
