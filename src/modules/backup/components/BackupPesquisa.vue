<template>
<box direction="column" expand>

  <box direction="column" style="border-bottom: 1px solid #dedede">
    <box direction="row" :padding="[0]">
      <box direction="column" :padding="[0]" class="width__xs-30">
        <label>Tipo de Backup</label>
        <input type="text" />
      </box>
      <box direction="column" :padding="[0]" class="width__xs-20">
        <label>Número</label>
        <input type="text" />
      </box>
      <box direction="column" :padding="[0]" class="width__xs-20">
        <label>Ano</label>
        <input type="text" />
      </box>
      <box direction="column" :padding="[0]" class="width__xs-30">
        <label>Período</label>
        <box direction="row">
        <input class="width__is-50" type="text"/> <span>até</span><input class="width__is-50" type="text" />
        </box>
      </box>
    </box>
    <box direction="row" :padding="[0,5]">
      <box direction="column" :padding="[0,5]" class="width__xs-25">
        <label>Ementa</label>
        <input type="text" />
      </box>
      <box direction="column" :padding="[0,5]" class="width__xs-25">
        <label>Assunto</label>
        <input type="text" />
        </box>
        <box v-if="__permissao.backup.inserir" direction="row" center :padding="[0,5]" class="width__xs-15">
          <button @click.prevent.stop="$router.push('/backup/novo')" class="button button-blue"><i class="fa fa-search" style=""></i>Pesquisar</button>
        </box>
    </box>

  </box>
  <box direction="row" expand :padding="[0]" style="background:#f1f1f1;">
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
        <tr v-for="_backup in __listaBackups">
          <td class="icons">
            <i class="fa fa-check-circle" :class="[_backup.st_registro == 'A' ? 'text__is-blue' : '']">
                            </i>
          </td>
          <td>{{_backup.no_backup}}</td>
          <td>{{_backup.no_municipio}} - {{_backup.sg_uf}}</td>
          <td class="buttons">
            <a v-if="__permissao.backup.visualizar" @click.prevent="$router.push('/backup/'+ _backup.id_backup +'/visualizar')"><i class="fa fa-eye"></i></a>
            <a v-if="__permissao.backup.editar" @click.prevent="$router.push('/backup/'+ _backup.id_backup +'/editar')"><i class="fa fa-edit"></i></a>
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

  activated() { //Quando usar keep alive
    //this._obterTodosBackups();
  },
  methods: {
  /*
    ...mapActions('backup', [
      '_obterTodosBackups',
      '_pesquisarBackupPorNome'
    ])
    */
  },
  computed: {
  /*
    ...mapGetters('backup', [
      '__listaBackups'
    ]),
    */
    ...mapGetters('usuario', [
      '__permissao'
    ])
  }

}
</script>
