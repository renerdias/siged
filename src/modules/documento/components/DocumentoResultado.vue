
<template>
<box direction="column" expand>
  <box direction="row" center class="bg__is-blue text__is-white" style="height:50px; font-weight: bold;">
    <router-link to="/documento/" style="width:50px;height:50px; font-size: 30px;" class="box box__is-center bg__is-white__on-hover text__is-blue__on-hover"><i class="fa fa-angle-left text__is-red__on-hover"></i></router-link>
    <box expand center>Pesquisa Documento - Resultado</box>
  </box>
  <box direction="row" expand :padding="[0]" style="background:#f1f1f1;">
    <table class="w3-table w3-bordered w3-striped w3-hoverable">
      <thead>
        <tr class="w3-red">
          <th style="width: 50px;"></th>
          <th>Tipo</th>
          <th>Documento</th>
          <th style="width:130px;">Data Documento</th>
          <th style="width:150px;">Status</th>
          <th style="width:100px;" class="text__is-center">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="_documento in __listaDocumentos">
          <td class="icons">
            <i class="fa fa-check-circle" :class="[_documento.st_registro == 'A' ? 'text__is-blue' : '']">
                            </i>
          </td>
          <td>{{_documento.nu_documento}}</td>
          <td>{{_documento.ds_ementa}}</td>
          <td>{{_documento.dt_documento}}</td>
          <td><span class="button button__is-red xsmall">Reprovada</span>
            <span class="button button__is-green xsmall">Aprovado</span>
            <span class="button button__is-green xsmall">Finalizado</span>
            <span class="button button__is-yellow xsmall">Em processo</span>
            <span class="button button__is-blue xsmall">Em processo</span>
            <span class="button button__is-red xsmall">Cancelado</span>
          </td>
          <td class="buttons">
            <a><i class="fa fa-file-pdf-o text__is-red__on-hover"></i></a>
            <a v-if="__permissao.documento.visualizar" @click.prevent="$router.push('/documento/'+ _documento.id_documento +'/visualizar')"><i class="fa fa-eye"></i></a>
            <a v-if="__permissao.documento.editar" @click.prevent="$router.push('/documento/'+ _documento.id_documento +'/editar')"><i class="fa fa-edit"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
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
      termo: ''
    }
  },
  mounted() { //activated() { //Quando usar keep alive
    this._obterTodasDocumentos();
  },
  methods: {
    ...mapActions('documento', [
      '_obterTodasDocumentos'
    ])
  },
  computed: {
    ...mapGetters('documento', [
      '__listaDocumentos'
    ]),
    ...mapGetters('usuario', [
      '__permissao'
    ])
  }

}
</script>
