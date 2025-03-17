<script setup lang="ts">
import {RouterLink} from "vue-router";

</script>

<template>
  <div id="footerContainer">

    <div>
      <img src="../assets/logo.svg" id="logoNavBar" alt="Logo of OnlyDance">
    </div>

    <div id="visionContainerFooter">
      <span id="visionTextFooter">"Know what to dance!"</span>
      <span>- OnlyDance 2025</span>
    </div>

    <nav id="linksContainerFooter">
      <span>Quicklinks:</span>
      <RouterLink to="/signup" class="linksFooter">SignUp</RouterLink>
      <RouterLink to="/login" class="linksFooter">Login</RouterLink>
      <RouterLink to="/mainpage" class="linksFooter">MainPage</RouterLink>
      <RouterLink to="/checklist" class="linksFooter">Checkliste</RouterLink>
      <RouterLink to="/events" class="linksFooter">EventKalendar</RouterLink>
      <RouterLink to="/imprint" class="linksFooter">Impressum</RouterLink>
    </nav>
  </div>
</template>

<style scoped lang="scss">


#footerContainer {
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-items: center;
  height: 35vh;
  background-color: $tertiary-color;
  color: $basic-white;

  img {
    width: 100px;
    height: 100px;
  }

  #visionContainerFooter {
    display: flex;
    flex-direction: column;

    #visionTextFooter {
      font-size: 35px;
    }
  }

  #linksContainerFooter {
    display: flex;
    flex-direction: column;
    align-items: center;

    .linksFooter {
      text-decoration: none;
      color: $basic-white;
    }

    .linksFooter:hover {
      text-decoration-line: underline;
    }
  }
}


</style>