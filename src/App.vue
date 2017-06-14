<template>
<!-- Init App -->
<div id="app" class="box-app box__is-row">
  <app-sidebar></app-sidebar>
  <!-- Page content -->
  <box expand direction="column">
    <template v-if="$route.matched.length">
          <router-view></router-view>
      </template>
  </box>
</div>
</template>

<script>
import Box from "./components/r2-box.vue";
import AppSidebar from "./AppSidebar.vue";
import AppFooter from "./AppFooter.vue";

export default {
  name: 'app',
  components: {
    Box,
    AppSidebar,
    AppFooter
  }
}
</script>
