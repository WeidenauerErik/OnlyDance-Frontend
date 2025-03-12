<script setup lang="ts">
import {RouterLink} from "vue-router";
</script>

<template>
  <div id="containerNavBar">
    <div id="logoContainerNavBar">
      <img src="../assets/logo.svg" id="logoNavBar" alt="Logo of OnlyDance">
      <h1 id="titleNavBar">OnlyDance</h1>
    </div>

    <nav id="linksContainerNavBar">
      <input type="text" id="SearchBarNavBar">
      <RouterLink to="/SignUpLogin" class="routerLinksNavBar">Login</RouterLink>
      <RouterLink to="/SignUpLogin" class="routerLinksNavBar">SignUp</RouterLink>

      <p>Burger</p>
      <!--
      <RouterLink to="/" class="routerLinksNavBar">LandingPage</RouterLink>
      <RouterLink to="/Checklist" class="routerLinksNavBar">Checklist</RouterLink>
      <RouterLink to="/MainPage" class="routerLinksNavBar">MainPage</RouterLink>
      <RouterLink to="/EventCalendar" class="routerLinksNavBar">EventCalendar</RouterLink>
      -->
    </nav>
  </div>
</template>

<style scoped lang="scss">
#containerNavBar {
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-items: center;
  width: 100%;
  background-color: $primary-color;

  #logoContainerNavBar {
    display: flex;
    flex-direction: row;

    #logoNavBar {
      width: 50px;
    }

    #titleNavBar {
      font-size: 35px;
    }
  }

  #linksContainerNavBar {
    width: 100%;

    .routerLinksNavBar {
      color: $secondary-color;
      text-decoration: none;
    }

    .routerLinksNavBar:hover {
      color: $primary-color;
    }
  }
}

</style>