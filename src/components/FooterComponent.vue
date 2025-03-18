<script setup lang="ts">
import {RouterLink} from "vue-router";

</script>

<template>
  <div id="footerMainContainer">

    <div id="footerUpperContainer">

      <div>

        <img src="../assets/logo.svg" id="logoNavBar" alt="Logo of OnlyDance">

      </div>

      <div id="visionContainerFooter">

        <span id="visionTextFooter">"Know what to dance!"</span>
        <span>- OnlyDance 2025</span>

      </div>

    </div>

    <nav id="footerLinksContainer">

      <div id="innerFooterLinksContainer">

        <RouterLink to="/signup" class="linksFooter">SignUp</RouterLink>
        <span>|</span>
        <RouterLink to="/login" class="linksFooter">Login</RouterLink>
        <span>|</span>
        <RouterLink to="/mainpage" class="linksFooter">MainPage</RouterLink>
        <span>|</span>
        <RouterLink to="/checklist" class="linksFooter">Checkliste</RouterLink>
        <span>|</span>
        <RouterLink to="/events" class="linksFooter">EventKalendar</RouterLink>
        <span>|</span>
        <RouterLink to="/imprint" class="linksFooter">Impressum</RouterLink>

      </div>

    </nav>

  </div>
</template>

<style scoped lang="scss">

#footerMainContainer {
  background-color: $backgroundColorPrimary;
  color: $fontColorWhite;

  #footerUpperContainer {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    height: 35vh;

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
  }

  #footerLinksContainer {
    padding-bottom: 20px;
    width: 100%;
    display: flex;
    justify-content: center;

    #innerFooterLinksContainer {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-around;
      width: 80%;

      .linksFooter {
        text-decoration: none;
        color: $fontColorWhite;
      }

      .linksFooter:hover {
        text-decoration-line: underline;
      }
    }
  }
}
</style>