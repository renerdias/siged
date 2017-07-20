<template>
<box direction="column" expand>
  <box direction="column">

    <infobar type="warn" icon="true" message="Realize backup's periodicamente, a segurança de suas informações pode depender disso!" show="true"></infobar>
    <infobar :type="infobar.tipo" icon="true" :message="infobar.mensagem" :show="infobar.exibir"></infobar>
  </box>
  <modalloader v-if="showLoader"></modalloader>
  <box direction="row" :padding="[0]">
    <table class="w3-table w3-bordered w3-striped w3-hoverable">
      <thead>
        <tr class="w3-red">
          <th>Nome</th>
          <th>Data</th>
          <th>Tamanho</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="_backup in __listaBackups">
          <td>{{_backup.no_arquivo}}</td>
          <td>{{_backup.dt_arquivo}}</td>
          <td>{{_backup.tm_arquivo}}</td>
          <td>{{ _backup.link }}</td>
        </tr>
      </tbody>
    </table>
  </box>
  <box direction="row" reverse :padding="[5,10]">
    <button @click="executar()" class="button button__is-red width__xs-40">
            <i class="fa fa-cog"></i> Executar
        </button>
  </box>
</box>
</template>
<script>
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Modalloader from '../../../components/r2-modalloader.vue';
import * as backupService from "../BackupService";

import {
  mapActions,
  mapGetters
} from 'vuex';

export default {
  components: {
    Box,
    Infobar,
    Modalloader
  },
  data() {
    return {
      infobar: {
        exibir: false
      },
      showLoader: false,
      backupList: [{
          st_registro: 'A',
          data: 'Data',
          inicio: '16:00',
          termino: '17:00',
          duracao: '01:00',
          tamanho: '30m',
          detalhes: 'Realizado por: Rener Dias<br>Perfil: Detalhes'
        },
        {
          st_registro: 'A',
          data: 'Data',
          inicio: '16:00',
          termino: '17:00',
          duração: '01:00',
          tamanho: '30m',
          detalhes: '<th>Detalhes</th>'
        },
        {
          st_registro: 'A',
          data: 'Data',
          inicio: '16:00',
          termino: '17:00',
          duração: '01:00',
          tamanho: '30m',
          detalhes: '<th>Detalhes</th>'
        },
        {
          st_registro: 'A',
          data: 'Data',
          inicio: '16:00',
          termino: '17:00',
          duração: '01:00',
          tamanho: '30m',
          detalhes: '<th>Detalhes</th>'
        },
        {
          st_registro: 'A',
          data: 'Data',
          inicio: '16:00',
          termino: '17:00',
          duração: '01:00',
          tamanho: '30m',
          detalhes: '<th>Detalhes</th>'
        }
      ]
    }
  },
  mounted() { //Quando usar keep alive//mounted() {
    this._obterTodosBackups();
  },
  computed: {
    ...mapGetters('backup', [
      '__listaBackups'
    ]),
    ...mapGetters('usuario', [
      '__permissao'
    ])
  },
  methods: {
    ...mapActions('backup', [
      '_obterTodosBackups'
    ]),
    executar() {
      this.showLoader = true;
      let minTime = 5000;
      let startTime = new Date().getTime();
      backupService.executar()
        .then((response, erro) => {
          let resultado = response.data;
          if (resultado.execucao == "sucesso") {
            setTimeout(() => {
              this.showLoader = false;
              this.exibirBarra('success', true, resultado.mensagem);
              notyf.confirm(resultado.mensagem);
            }, minTime - (new Date().getTime() - startTime));
          } else if (resultado.execucao == "erro") {
            setTimeout(() => {
              this.showLoader = false;
              this.exibirBarra('error', true, resultado.mensagem);
              notyf.alert(resultado.mensagem);
              console.error(resultado.log);
            }, minTime - (new Date().getTime() - startTime));
          }
        })
        .catch((erro) => {
          setTimeout(() => {
            this.showLoader = false;
            notyf.alert('Ocorreu um erro desconchecido!');
            console.error('Módulo Backup: ' + erro);
            this.exibirBarra('error', true, erro);
          }, minTime - (new Date().getTime() - startTime));
        })

    },
    exibirBarra(t, b, str) {
      this.infobar = {
        tipo: t,
        mensagem: str,
        exibir: b
      }
    }
  }
}
</script>
<style>

</style>
