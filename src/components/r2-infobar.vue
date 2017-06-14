<template>
    <div v-show="show" class="infobar" :class="[type]">
        <i v-if="icon && type == 'info'" class="fa fa-info-circle"></i>
        <i v-if="icon && type == 'warn'" class="fa fa-warning"></i>
        <i v-if="icon && type == 'error'" class="fa fa-thumbs-down"></i>
        <i v-if="icon && type == 'success'" class="fa fa-thumbs-up"></i>
        <label class="message">{{message}}</label>
        <button class="closebutton" @click="onclose"><span class="fa fa-close"></span></button>
    </div>
</template>
<script>
    export default {
        props: [
            'type',
            'message',
            'show',
            'icon'
        ],
      methods: {
          onclose() {
              this.$emit('close');
          }
      }
    }
</script>
<style>
</style>
