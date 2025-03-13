<script setup lang="ts">
import {ref} from "vue";
import {RouterLink} from "vue-router";

const showMenu = ref(false);
</script>

<template>
  <div id="containerNavBar">
    <RouterLink to="/" id="logoContainerNavBar">
      <img src="../assets/logo.svg" id="logoNavBar" alt="Logo of OnlyDance">
      <h1 id="titleNavBar">OnlyDance</h1>
    </RouterLink>

    <nav id="linksContainerNavBar">
      <div id="searchBarContainerNavBar">
        <input type="text" id="searchBarInputNavBar">
        <button id="searchBarButtonNavBar">
          <img src="../assets/searchIcon.png" alt="Search Icon">
        </button>
      </div>

      <RouterLink to="/login" class="routerLinksNavBar" id="loginNavBar">Login</RouterLink>
      <RouterLink to="/signup" class="routerLinksNavBar" id="signUpNavBar">SignUp</RouterLink>

      <img src="../assets/menuIcon.png" id="menuIconNavBar" alt="Menu button" @click="showMenu = !showMenu">

      <div v-if="showMenu" id="menuDropdown">
        <RouterLink to="/checklist" class="routerLinksMenuNavBar">Checklist</RouterLink>
        <RouterLink to="/mainpage" class="routerLinksMenuNavBar">MainPage</RouterLink>
        <RouterLink to="/events" class="routerLinksMenuNavBar">EventCalendar</RouterLink>
      </div>
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
  background-color: $tertiary-color;

  #logoContainerNavBar {
    display: flex;
    flex-direction: row;
    margin-left: 20px;
    text-decoration: none;

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
    position: relative;

    .routerLinksNavBar {
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      color: $basic-white;
    }

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
      width: 40vh;

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
        outline: none;
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
          width: 25px;
          height: 25px;
        }
      }
    }

    #menuIconNavBar {
      width: 50px;
      cursor: pointer;
    }

    #menuDropdown {
      position: absolute;
      top: 110%;
      right: 0;
      background-color: $basic-white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      padding: 15px;
      gap: 10px;

      .routerLinksMenuNavBar {
        text-decoration: none;
        color: $tertiary-color;
      }
    }
  }
}
</style>
