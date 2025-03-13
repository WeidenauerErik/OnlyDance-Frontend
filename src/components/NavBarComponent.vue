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
      <div id="searchBarContainerNavBar">
        <input type="text" id="searchBarInputNavBar">
        <button id="searchBarButtonNavBar">
          <img src="../assets/searchIcon.png" alt="Search Icon">
        </button>
      </div>

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

    #searchBarContainerNavBar {
      position: relative;
      display: flex;
      align-items: center;
      width: 30vh;


      #searchBarInputNavBar {
        flex: 1;
        border: none;
        border-radius: 20px;
        height: 5vh;
        font-size: 15px;
        padding-left: 10px;
        color: var(--primary-color);
        box-sizing: border-box;
        padding-right: 40px;
      }

      #searchBarButtonNavBar {
        position: absolute;
        right: 5px;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;

        img {
          width: 20px;
          height: 20px;
        }
      }
    }

    /*
    #searchBarNavBar {
      border: none;
      border-radius: 20px;
      height: 5vh;
      font-size: 15px;
      padding-left: 10px;
      width: 30vh;
      color: $primary-color;

      box-sizing: border-box;
      background-size: 25px;
      background-image: url('../assets/searchIcon.png');
      background-position: bottom 50% right 3%;
      background-repeat: no-repeat;
    }

    #searchBarNavBar:focus {
      outline: none;
    }

     */

    #menuIconNavBar {
      width: 50px;
      cursor: pointer;
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