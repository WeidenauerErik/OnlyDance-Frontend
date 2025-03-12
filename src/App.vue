<script setup lang="ts">
import { RouterView } from 'vue-router'
import NavBarComponent from './components/NavBarComponent.vue';
import FooterComponent from './components/FooterComponent.vue';
</script>

<template>
  <header>
    <NavBarComponent/>
  </header>
  <RouterView />
  <footer>
    <FooterComponent/>
  </footer>
</template>

<style scoped>
</style>
