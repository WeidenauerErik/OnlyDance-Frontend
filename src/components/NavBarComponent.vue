<script setup lang="ts">
import {ref, onMounted, onUnmounted} from "vue";
import {RouterLink, useRouter} from "vue-router";

import logoIcon from '@/assets/icons/logoIcon.svg';
import searchIcon from '@/assets/icons/searchIcon.svg';
import menuIcon from '@/assets/icons/menuIcon.svg';

const router = useRouter();
const showMenu = ref(false);

const closeMenu = (event: MouseEvent) => {
  const menu = document.getElementById("menuDropdown");
  const menuIcon = document.getElementById("menuIconNavBar");
  if (menu && menuIcon && !menu.contains(event.target as Node) && !menuIcon.contains(event.target as Node)) showMenu.value = false;
};

onMounted(() => {
  document.addEventListener("click", closeMenu);
});

onUnmounted(() => {
  document.removeEventListener("click", closeMenu);
});
</script>

<template>
  <div id="containerNavBar">
    <RouterLink to="/" id="logoContainerNavBar">
      <img :src="logoIcon" id="logoNavBar" alt="Logo of OnlyDance">
      <h1 id="titleNavBar">OnlyDance</h1>
    </RouterLink>

    <nav id="linksContainerNavBar">
      <div id="searchBarContainerNavBar" v-if="!(router.currentRoute.value.path === '/mainpage')">
        <input type="text" id="searchBarInputNavBar">
        <button id="searchBarButtonNavBar">
          <img :src="searchIcon" alt="Search Icon">
        </button>
      </div>

      <div id="loginSignUpContainer">

        <RouterLink to="/login" class="routerLinksNavBar" id="loginNavBar">Anmelden</RouterLink>
        <RouterLink to="/signup" class="routerLinksNavBar" id="signUpNavBar">Registrieren</RouterLink>

      </div>

      <img :src="menuIcon" id="menuIconNavBar" alt="Menu button" @click="showMenu = !showMenu">

      <div v-if="showMenu" id="menuDropdown">
        <RouterLink to="/login" class="routerLinksMenuNavBar" id="loginMenuBar">Login</RouterLink>
        <RouterLink to="/signup" class="routerLinksMenuNavBar" id="signUpMenuBar">SignUp</RouterLink>
        <RouterLink to="/checklist" class="routerLinksMenuNavBar">Checkliste</RouterLink>
        <RouterLink to="/mainpage" class="routerLinksMenuNavBar">MainPage</RouterLink>
        <RouterLink to="/events" class="routerLinksMenuNavBar">Event Kalendar</RouterLink>
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
  background-color: $colorVioletLight;
  height: 10vh;

  #logoContainerNavBar {
    display: flex;
    flex-direction: row;
    margin-left: 20px;
    text-decoration: none;
    width: 20%;

    #logoNavBar {
      width: 50px;
      margin-right: 5px;
    }

    #titleNavBar {
      font-size: 35px;
      color: $colorWhite;
    }
  }

  #linksContainerNavBar {
    display: flex;
    flex-direction: row;
    align-items: center;
    position: relative;
    justify-content: end;
    margin-right: 1rem;
    width: 80%;

    .routerLinksNavBar {
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      color: $colorWhite;
    }

    #signUpNavBar {
      border: $colorWhite 1px solid;
      padding: 10px;
      border-radius: 10px;
      margin-right: 2rem;
    }

    #loginNavBar {
      margin-left: 3rem;
    }

    #searchBarContainerNavBar {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      width: 30%;

      #searchBarInputNavBar {
        border: none;
        border-radius: 20px;
        height: 5.5vh;
        font-size: 15px;
        color: $colorVioletDark;
        box-sizing: border-box;
        outline: none;
        padding-left: 5px;
        width: 300px;
      }

      #searchBarButtonNavBar {
        position: absolute;
        right: 5px;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        justify-content: end;
        align-items: center;

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
      z-index: 99;
      top: 110%;
      right: 3%;
      background-color: $colorWhite;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      padding: 15px;
      gap: 10px;

      .routerLinksMenuNavBar {
        text-decoration: none;
        color: $colorVioletLight;
      }

      #signUpMenuBar, #loginMenuBar {
        display: none;
      }
    }
  }
}

@media only screen and (max-width: 800px) {
  #titleNavBar {
    display: none;
  }

  #signUpMenuBar, #loginMenuBar {
    display: flex !important;
  }

  #signUpNavBar, #loginNavBar {
    display: none;
  }
}
</style>