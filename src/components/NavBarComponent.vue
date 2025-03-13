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
      <input type="text" id="searchBarNavBar">
      <RouterLink to="/SignUpLogin" class="routerLinksNavBar" id="loginNavBar">Login</RouterLink>
      <RouterLink to="/SignUpLogin" class="routerLinksNavBar" id="signUpNavBar">SignUp</RouterLink>

      <img src="../assets/menuIcon.png" id="menuIconNavBar" alt="Menu button">
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
  justify-content: space-between;
  align-items: center;
  width: 100%;
  background-color: $primary-color;

  #logoContainerNavBar {
    display: flex;
    flex-direction: row;
    margin-left: 20px;

    #logoNavBar {
      width: 50px;
    }

    #titleNavBar {
      font-size: 35px;
      color: $basic-white;
    }
  }

  #linksContainerNavBar {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-right: 20px;

    #signUpNavBar {
      border: $basic-white 1px solid;
      padding: 10px;
      border-radius: 10px;
      margin: 0 20px 0 20px;
    }

    #loginNavBar {
      margin-left: 20px;
    }

    #searchBarNavBar {
      border: none;
      border-radius: 20px;
      height: 7vh;
      font-size: 20px;
    }

    #searchBarNavBar:focus {
      outline: none;
    }

    #menuIconNavBar {
      width: 50px;
    }

    .routerLinksNavBar {
      color: $basic-white;
      text-decoration: none;
    }

    .routerLinksNavBar:hover {
      color: $primary-color;
    }
  }
}

</style>