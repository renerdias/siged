<template>
<transition mode="out-in" name="custom-classes-transition2" enter-active-class="animated fadeInDownBig" leave-active-class="animated bounceOutRight">
    <keep-alive>
        <router-view></router-view>
    </keep-alive>
</transition>
</template>
