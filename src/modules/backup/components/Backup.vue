<template>
<box direction="column" expand>
  <box direction="row" center class="bg__is-yellow text__is-white" style="height:50px; font-weight: bold; text-transform: uppercase; letter-spacing: 7px;">
    <router-link v-if="bloquear" to="/documento/" style="width:50px;height:50px; font-size: 30px;" class="box box__is-center bg__is-white__on-hover text__is-red__on-hover"><i class="fa fa-angle-left text__is-red__on-hover"></i></router-link>
    <box expand center>Backup</box>
  </box>
  <box direction="column">
    <infobar type="warn" icon="true" message="Realize backup's periodicamente, a segurança de suas informações pode depender disso!" show="true"></infobar>
    <infobar :type="infobar.tipo" icon="true" :message="infobar.mensagem" :show="infobar.exibir"></infobar>
  </box>
  <modalloader v-if="showLoader"></modalloader>
  <box direction="row" :padding="[0]">
    <table class="w3-table w3-bordered w3-striped w3-hoverable">
      <thead>
        <tr class="w3-red">
          <th style="width: 30px;">Status</th>
          <th style="width: 200px;">Data Inicio</th>
          <th style="width: 200px;">Data Conclusão</th>
          <th style="width: 100px;">Duração</th>
          <th style="width: 100px;">Tamanho</th>
          <th>Responsável</th>
          <th style="width: 50px;"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="_backup in __listaBackups">
          <td class="icons">
            <i class="fa" :class="[_backup.st_registro == 'A' ? 'fa-check-circle text__is-blue' : 'fa-close text__is-red']">
                            </i>
          </td>
          <td>{{_backup.dt_inicio}}</td>
          <td>{{_backup.dt_conclusao}}</td>
          <td>{{_backup.tp_duracao}}</td>
          <td>{{_backup.ds_tamanho}}</td>
          <td>CPF: {{_backup.nu_cpf}} | {{_backup.no_usuario}}</td>
          <td><a v-show="_backup.st_registro == 'A'" :href="_backup.link"><i class="fa fa-download"></i></a></td>
        </tr>
      </tbody>
    </table>
  </box>
  <box direction="row" reverse :padding="[5,10]">
    <button @click="executar()" class="button button__is-yellow width__xs-40">
            <i class="fa fa-cog"></i> Executar
        </button>
    <button class="button button__is-default width__xs-40">
                <i class="fa fa-trash"></i> Limpar
            </button>
  </box>
</box>
</template>
<script>
//TODO: Criar timer para exibição de mensagem de sucesso
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
      showLoader: false
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
              this._obterTodosBackups();
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
