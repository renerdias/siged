<template>
<box direction="column" expand>
  <box direction="row" center class="bg__is-purple text__is-white" style="height:50px; font-weight: bold; text-transform: uppercase; letter-spacing: 7px;">
    <router-link v-if="bloquear" to="/documento/" style="width:50px;height:50px; font-size: 30px;" class="box box__is-center bg__is-white__on-hover text__is-red__on-hover"><i class="fa fa-angle-left text__is-red__on-hover"></i></router-link>
    <box expand center>Tipo de Documento</box>
  </box>
  <box>

  </box>
  <box direction="row" :padding="[0]">
    <table class="w3-table w3-bordered w3-striped w3-hoverable">
      <thead>
        <tr class="w3-red">
          <th style="">Campo</th>
          <th style="text-align: center;">Disponível</th>
          <th style="text-align: center;">Obrigatório</th>
          <th style="text-align: center;">Pesquisa</th>
          <th style="text-align: center;">Título</th>
          <th style="text-align: center;">Ordem</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>signatario</td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>Signatário</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>setor</td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>Setor</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>data do documento</td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>Data do Documento</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>assunto</td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>Assunto</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>referencia</td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>Referência</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>destinatario</td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>Destinatário</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>teste</td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>fsd</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" theme="purple" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>analise</td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>fsd</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>analise</td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>fsd</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" theme="purple" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>analise</td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>fsd</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" theme="purple" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
        <tr>
          <td>analise</td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>
            <field type="toggle-bar" size="small" theme="purple" v-model="tipo_documento.opcao" :options='[{label: "Sim", value: "S"}, {label: "Não", value: "N"}]' :options-label="'label'" :options-value="'value'" direction="column" :padding="[0,5]"></field>
          </td>
          <td>fsd</td>
          <td align="center">
            <field type="text" v-model="tipo_documento.ordem" direction="column" :padding="[0,5]" size="small" theme="purple" style="width: 50px;text-align: center;"></field>
          </td>
        </tr>
      </tbody>
    </table>
  </box>
  <box direction="row" reverse :padding="[5,10] ">
    <button @click="executar() " class="button button__is-purple width__xs-40 ">
            <i class="fa fa-cog "></i> Executar
        </button>
    <button class="button button__is-default width__xs-40 ">
                <i class="fa fa-trash "></i> Limpar
            </button>
  </box>
</box>
</template>
<script>
import Box from "../../../components/r2-box.vue";
import Field from "../../../components/r2-field.vue";

import {
  mapActions,
  mapGetters
} from 'vuex';

export default {
  components: {
    Box,
    Field
  },
  data() {
    return {
      tipo_documento: {
        opcao: "",
        ordem: ""
      },
      lista: [{
        label: "teste1",
        value: 1
      }, {
        label: "teste2",
        value: 2
      }, {
        label: "teste3",
        value: 3
      }]
    }
  }
}
</script>
