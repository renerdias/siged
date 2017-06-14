<template>
<window title="Sugestões">
  <box direction="row" :padding="[20]" center>
    <img src="src/assets/img/pagina-construcao.svg"></img>
  </box>
</window>
</template>

<script>
import Box from "./components/r2-box.vue";
import Window from "./components/r2-window.vue";
export default {
  components: {
    Box,
    Window
  }
}
</script>
