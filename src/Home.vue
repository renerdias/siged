<template>
<box direction="column" :padding="[20]" center expand>
  <box direction="row" :padding="[20]" center style="
  border-radius: 50%;background: #eee;height:350px; width: 350px;
  -moz-box-shadow: inset 0 0 10px #000000;
  -webkit-box-shadow: inset 0 0 10px #000000;
  box-shadow: 2px 2px 50px 5px rgba(0, 0, 0, 0.2) inset;
  ">
    <img src="src/assets/img/archive.svg" style="height: 200px;">
  </box>
  <h1>Sistema de Gestão Eletrônica de Documentos</h1>
</box>
</template>

<script>
import Box from "./components/r2-box.vue";

export default {
  components: {
    Box
  }
}
</script>
