<template>
<box direction="row" expand center :margin="[20]">
  <img src="src/assets/img/robot.svg" style="height: 250px;" />
  <box direction="column" :padding="[20]">
    <strong class="text__is-red" style="font-size:40px">OOOOOPSSSS!</strong>
    <span style="color: #222;
font-weight: bold;
font-size: 17px;
">DESCULPE, NÃO ENCONTRAMOS O QUE VOCÊ PROCURA!</span>
  </box>
</box>
</template>
<script>
import Box from "./components/r2-box.vue";
export default {
  components: {
    Box
  },
  data() {
    return {}
  },
  methods: {}
}
</script>
<style>
</style>
