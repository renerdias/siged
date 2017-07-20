<template>
<modal>
  <box direction="column" center :padding="[50]" :radius="[5]" class="bg__is-dark text__is-white">
    <b style="font-size: 1.6rem;margin-bottom: 15px;">Por favor aguarde...</b>
    <box direction="row" center>
      <spinner show="true"> </spinner>
      <span style="margin-left: 20px;">...processando</span>
    </box>
  </box>
</modal>
</template>

<script>
import Box from "./r2-box.vue";
import Modal from './r2-modal.vue';
import Spinner from './r2-spinner.vue';

export default {
  components: {
    Box,
    Modal,
    Spinner
  }
};
</script>
