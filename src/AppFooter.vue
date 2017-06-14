<template>
<!-- Footer -->
<box direction="row" class="footer bar-wrap" center>
  <router-link to="/sobre"><i class="fa fa-hand-o-right hand-animate shake"></i>Rener Dias</router-link>
  <div class="copyright"> © 2017</div>
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
<style>
.footer {
  background-color: #1E2629;
  padding: 20px 0;
  font-size: 14px;
}

.footer a {
  float: left;
  list-style: none outside none;
  position: relative;
  margin-right: 10px;
  color: #778888;
}

.footer a:hover {
  color: #FFFFFF;
}

.footer i {
  margin: 0 15px;
  font-size: 16px;
}

.copyright {
  color: #778888;
}

.hand-animate {
  -webkit-animation-duration: 3s;
  animation-duration: 3s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite
}

@-webkit-keyframes shake {
  0%,
  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
  }
  10%,
  30%,
  50%,
  70%,
  90% {
    -webkit-transform: translateX(-5px);
    transform: translateX(-5px);
  }
  20%,
  40%,
  60%,
  80% {
    -webkit-transform: translateX(5px);
    transform: translateX(5px);
  }
}

@keyframes shake {
  0%,
  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
  }
  10%,
  30%,
  50%,
  70%,
  90% {
    -webkit-transform: translateX(-5px);
    transform: translateX(-5px);
  }
  20%,
  40%,
  60%,
  80% {
    -webkit-transform: translateX(5px);
    transform: translateX(5px);
  }
}

.shake {
  -webkit-animation-name: shake;
  animation-name: shake;
}
</style>
