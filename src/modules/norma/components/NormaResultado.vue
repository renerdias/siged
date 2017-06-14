
<template>
<box direction="column" expand>

  <box direction="column" :padding="[10]" style="border-bottom: 1px solid #dedede">
    <box direction="row">
      <box direction="column" :padding="[5]" class="width__xs-30">
        <label>Tipo de Norma</label>
        <input type="text" class="small" />
        <select class="small">
                                                    <option value="">Todos</option>

                                                        <option value="Ato">Ato das Disposições Constitucionais Transitórias</option>

                                                        <option value="Constituicao NAO Emenda">Constituição</option>

                                                        <option value="decisao NAO normativa">Decisão da Mesa</option>

                                                        <option value="Decisao ADJ normativa">Decisão Normativa da Presidência</option>

                                                        <option value="Decreto">Decreto</option>

                                                        <option value="Decreto-Lei">Decreto-Lei</option>

                                                        <option value="Deliberacao">Deliberação</option>

                                                        <option value="Emenda">Emenda à Constituição</option>

                                                        <option value="Instrucao">Instrução Normativa</option>

                                                        <option value="Lei">Lei</option>

                                                        <option value="Lei ADJ Complementar">Lei Complementar</option>

                                                        <option value="Lei ADJ Constitucional">Lei Constitucional</option>

                                                        <option value="Lei ADJ Delegada">Lei Delegada</option>

                                                        <option value="Ordem">Ordem de Serviço</option>

                                                        <option value="Portaria">Portaria</option>

                                                        <option value="Resolucao">Resolução</option>

                                                </select>
      </box>
      <box direction="column" :padding="[5]" class="width__xs-15">
        <label>Número</label>
        <input type="text" class="small" />
      </box>
      <box direction="column" :padding="[5]" class="width__xs-15">
        <label>Ano</label>
        <input type="text" class="small" />
      </box>
      <box direction="column" :padding="[5]" class="width__xs-40">
        <label>Período</label>
        <box direction="row">
          <input class="width__xs-45 small" type="text" /> <span class="width__xs-10 box box__is-center">até</span><input class="width__xs-45 small" type="text" />
        </box>
      </box>
    </box>
    <box direction="row" :padding="[0]">
      <box direction="column" expand :padding="[5]">
        <label>Ementa</label>
        <input type="text" class="small" />
      </box>
      <box direction="column" expand :padding="[5]">
        <label>Assunto</label>
        <input type="text" class="small" />
      </box>
      <box v-if="__permissao.norma.inserir" direction="column" reverse :padding="[5]" class="width__xs-15">
        <button @click.prevent.stop="$router.push('/norma/novo')" class="button button-blue small"><i class="fa fa-search" style=""></i>Pesquisar</button>
      </box>
    </box>

  </box>
  <box direction="row" expand :padding="[0]" style="background:#f1f1f1;">
    <table class="w3-table w3-bordered w3-striped w3-hoverable">
      <thead>
        <tr class="w3-red">
          <th style="width: 50px;"></th>
          <th>Tipo</th>
          <th>Norma</th>
          <th style="width:130px;">Data</th>
          <th style="width:150px;">Status</th>
          <th style="width:80px;" class="text__is-center">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="icons">
            <i class="fa fa-check-circle text__is-blue"></i>
          </td>
          <td>Lei</td>
          <td>Lei 3.658</td>
          <td>16-11-1984</td>
          <td><span class="button green xsmall">Aprovada</span></td>
          <td class="buttons">
            <a><i class="fa fa-eye"></i></a>
            <a><i class="fa fa-edit"></i></a>
          </td>
        </tr>
        <tr>
          <td class="icons">
            <i class="fa fa-check-circle text__is-blue"></i>
          </td>
          <td>Lei</td>
          <td>Lei 3.658</td>
          <td>16-11-1984</td>
          <td><span class="button red xsmall">Reprovada</span></td>
          <td class="buttons">
            <a><i class="fa fa-eye"></i></a>
            <a><i class="fa fa-edit"></i></a>
          </td>
        </tr>
        <tr>
          <td class="icons">
            <i class="fa fa-check-circle text__is-blue"></i>
          </td>
          <td>Lei</td>
          <td>Lei 3.658</td>
          <td>16-11-1984</td>
          <td><span class="button orange xsmall">Revisada</span></td>
          <td class="buttons">
            <a><i class="fa fa-eye"></i></a>
            <a><i class="fa fa-edit"></i></a>
          </td>
        </tr>
        <!--
        <tr v-for="_norma in __listaNormas">
          <td class="icons">
            <i class="fa fa-check-circle" :class="[_norma.st_registro == 'A' ? 'text__is-blue' : '']">
                            </i>
          </td>
          <td>{{_norma.no_norma}}</td>
          <td>{{_norma.no_municipio}} - {{_norma.sg_uf}}</td>
          <td class="buttons">
            <a v-if="__permissao.norma.visualizar" @click.prevent="$router.push('/norma/'+ _norma.id_norma +'/visualizar')"><i class="fa fa-eye"></i></a>
            <a v-if="__permissao.norma.editar" @click.prevent="$router.push('/norma/'+ _norma.id_norma +'/editar')"><i class="fa fa-edit"></i></a>
          </td>
        </tr>
      -->
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
    //this._obterTodosNormas();
  },
  methods: {
    /*
      ...mapActions('norma', [
        '_obterTodosNormas',
        '_pesquisarNormaPorNome'
      ])
      */
  },
  computed: {
    /*
      ...mapGetters('norma', [
        '__listaNormas'
      ]),
      */
    ...mapGetters('usuario', [
      '__permissao'
    ])
  }

}
</script>
