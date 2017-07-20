<template>
<box direction="column" expand>
  <box direction="row" center class="bg__is-blue" style="
  height: 50px;
  color: #fff !important;
  text-transform: uppercase;
letter-spacing: 7px;">
    Pesquisa Por Norma
  </box>
  <box v-if="!expandResult" direction="column" :padding="[10]" style="border-bottom: 1px solid #dedede">

    <box direction="row">
      <label style="min-width: 180px;">Tipo de Norma</label>
      <select class="small">
        <<option value=""></option>>
          <option v-for="_tipo_norma in __listaTiposNormas" :value="_tipo_norma.id_tipo_norma">{{ _tipo_norma.no_tipo_norma }}</option>
      </select>
    </box>
    <box direction="row">
      <box direction="row" :padding="[5]" class="width__xs-50">
        <label style="min-width: 180px;">Número</label>
        <input type="text" class="small" />
      </box>
      <box direction="row" :padding="[5]" class="width__xs-50">
        <label>Ano</label>
        <input type="text" class="small" />
      </box>
    </box>
    <box direction="row">
      <box direction="row" :padding="[5]" class="width__xs-100">
        <label style="min-width: 180px;">Período da Norma</label>
        <box direction="row">
          <input class="width__xs-45 small" type="text" /> <span class="width__xs-10 box box__is-center">até</span><input class="width__xs-45 small" type="text" />
        </box>
      </box>
    </box>
    <box direction="row">
      <box direction="row" :padding="[5]" class="width__xs-100">
        <label style="min-width: 180px;">Período da Publicação</label>
        <box direction="row">
          <input class="width__xs-45 small" type="text" /> <span class="width__xs-10 box box__is-center">até</span><input class="width__xs-45 small" type="text" />
        </box>
      </box>
    </box>
    <box direction="row" :padding="[0]">
      <box direction="row" expand :padding="[5]">
        <label style="min-width: 180px;">Ementa</label>
        <input type="text" class="small" />
      </box>
    </box>
    <box direction="row">
      <box direction="row" expand :padding="[5]">
        <label style="min-width: 180px;">Assunto</label>
        <input type="text" class="small" />
      </box>
    </box>
    <box v-if="__permissao.norma.inserir" direction="row" reverse :padding="[5]">
      <button @click.prevent.stop="$router.push('/norma/novo')" class="button button__is-green small"><i class="fa fa-file-text" style=""></i>Novo</button>
      <button @click.prevent.stop="$router.push('/norma/resultado')" class="button button__is-blue small"><i class="fa fa-search" style=""></i>Pesquisar</button>
    </box>
  </box>
  <box direction="column" expand>
    <button direction="row" center class="text__is-white" @click="toggleResult" style="height:30px; border:none;background: #888; font-weight: bold;letter-spacing: 5px;">
      Resultado
      <i :class="['fa', {'fa-caret-up': !expandResult }, {'fa-caret-down': expandResult }]"></i>
    </button>
    <box direction="row" expand :padding="[0]" style="background:#f1f1f1;">
      <table class="w3-table w3-bordered w3-striped w3-hoverable">
        <thead>
          <tr class="w3-red">
            <th style="width: 50px;"></th>
            <th>Tipo</th>
            <th>Norma</th>
            <th style="width:130px;">Data Norma</th>
            <th style="width:150px;">Status</th>
            <th style="width:100px;" class="text__is-center">Ação</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="_norma in __listaNormas">
            <td class="icons">
              <i class="fa fa-check-circle" :class="[_norma.st_registro == 'A' ? 'text__is-blue' : '']">
                              </i>
            </td>
            <td>{{_norma.nu_norma}}</td>
            <td>{{_norma.ds_ementa}}</td>
            <td>{{_norma.dt_norma}}</td>
            <td><span class="button button__is-red xsmall">Reprovada</span>
              <span class="button button__is-green xsmall">Aprovado</span>
              <span class="button button__is-green xsmall">Finalizado</span>
              <span class="button button__is-yellow xsmall">Em processo</span>
              <span class="button button__is-blue xsmall">Em processo</span>
              <span class="button button__is-red xsmall">Cancelado</span>
            </td>
            <td class="buttons">
              <a><i class="fa fa-file-pdf-o text__is-red__on-hover"></i></a>
              <a v-if="__permissao.norma.visualizar" @click.prevent="$router.push('/norma/'+ _norma.id_norma +'/visualizar')"><i class="fa fa-eye"></i></a>
              <a v-if="__permissao.norma.editar" @click.prevent="$router.push('/norma/'+ _norma.id_norma +'/editar')"><i class="fa fa-edit"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </box>
  </box>

</box>
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
      expandResult: false,
      termo: ''
    }
  },

  activated() { //Quando usar keep alive
    //this._obterTodosNormas();
  },
  mounted() { //activated() { //Quando usar keep alive
    this._obterTodasNormas();
  },
  methods: {
    ...mapActions('norma', [
      '_obterTodasNormas'
    ]),
    toggleResult: function() {
      this.expandResult = !this.expandResult
    },
    /*
      ...mapActions('norma', [
        '_obterTodosNormas',
        '_pesquisarNormaPorNome'
      ])
      */
  },
  computed: {
    ...mapGetters('tipo_norma', [
      '__listaTiposNormas'
    ]),
    ...mapGetters('usuario', [
      '__permissao'
    ]),
    ...mapGetters('norma', [
      '__listaNormas'
    ])
  }

}
</script>
