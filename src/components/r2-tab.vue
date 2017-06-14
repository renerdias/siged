<template>
<div>
  <input type="radio" class="tab-radio" name="tab" :id="name" />
  <div class="tab-pane box box__is-column">
    <slot></slot>
  </div>
</div>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    active: {
      type: [Boolean, String],
      default: false
    },
    name: {
      type: String,
      required: true
    }
  }
}
</script>
<style>
.tab-radio {
  position: absolute;
  opacity: 0;
}

[type=radio]:checked~.tab-pane {
  display: flex;
}

.tab-pane {
  display: none;
}

.tab-pane {
  -webkit-animation: fadeInScale 0.7s ease-in-out;
  -moz-animation: fadeInScale 0.7s ease-in-out;
  animation: fadeInScale 0.7s ease-in-out;
}

@keyframes fadeInScale {
  0% {
    transform: scale(0.9);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
</style>
