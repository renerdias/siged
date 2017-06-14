<template>
<box direction="column" expand>
  <box direction="row" center style="
  height: 50px;
  background-color: #4D90FE;
  background-image: -webkit-linear-gradient(top, #4d90fe, #4787ed);
  background-image: -moz-linear-gradient(top, #4d90fe, #4787ed);
  background-image: -ms-linear-gradient(top, #4d90fe, #4787ed);
  background-image: -o-linear-gradient(top, #4d90fe, #4787ed);
  background-image: linear-gradient(top, #4d90fe, #4787ed);
  color: #fff !important;
  text-transform: uppercase;
letter-spacing: 7px;">
    Pesquisar
  </box>
  <box direction="column" :padding="[10]" style="border-bottom: 1px solid #dedede">

    <box direction="row">
      <label style="min-width: 180px;">Tipo de Norma</label>
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
      <button @click.prevent.stop="$router.push('/norma/novo')" class="button button-blue small"><i class="fa fa-search" style=""></i>Pesquisar</button>
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
