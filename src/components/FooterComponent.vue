<script setup lang="ts">
import {RouterLink} from "vue-router";

</script>

<template>
  <div id="footerContainer">
    <p>OnlyDance</p>
    <p>2025</p>
    <p>Andreas Juchelka, Erik Weidenauer, Theodor Widmer</p>
    <nav>
      <RouterLink to="/">LandingPage</RouterLink>
      <RouterLink to="/Checklist">Checklist</RouterLink>
      <RouterLink to="/MainPage">MainPage</RouterLink>
      <RouterLink to="/EventCalendar">EventCalendar</RouterLink>
      <RouterLink to="/Imprint">Imprint</RouterLink>
      <RouterLink to="/SignUpLogin">SignUpLogin</RouterLink>
    </nav>
    <p>Contact: 1132@htl.rennweg.at</p>
  </div>
</template>

<style scoped>
</style>