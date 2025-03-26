<script setup lang="ts">
import {RouterView} from 'vue-router'
import NavBarComponent from './components/NavBarComponent.vue';
import FooterComponent from './components/FooterComponent.vue';
</script>

<template>
  <div id="pageContainer">

    <div id="contentWrap">
      <header>
        <NavBarComponent/>
      </header>
      <RouterView/>
    </div>

    <footer id="footer">
      <FooterComponent/>
    </footer>
  </div>
</template>

<style scoped lang="scss">
#pageContainer {
  position: relative;
  min-height: 100vh;
  background-color: $backgroundColorWhite;

  #contentWrap {
    padding-bottom: 2.5rem; /* Footer height */
  }

  #footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 2.5rem; /* Footer height */
  }
}

</style>
