<script setup lang="ts">
import {RouterLink} from "vue-router";

</script>

<template>
  <div id="footerContainer">

   <img src="../assets/logo.svg" id="logoNavBar" alt="Logo of OnlyDance">
    <div id="visionContainer">
      <span id="visionText">"Know what to dance!"</span>
      - OnlyDance 2025
    </div>

    <nav id="linkContainer">
      Quicklinks:
      <ul>
        <li>
          <RouterLink to="/">LandingPage</RouterLink>
        </li>
        <li>
          <RouterLink to="/Checklist">Checklist</RouterLink>
        </li>
        <li>
          <RouterLink to="/MainPage">MainPage</RouterLink>
        </li>
        <li>
          <RouterLink to="/EventCalendar">EventCalendar</RouterLink>
        </li>
        <li>
          <RouterLink to="/Imprint">Imprint</RouterLink>
        </li>
        <li>
          <RouterLink to="/SignUpLogin">SignUpLogin</RouterLink>
        </li>
      </ul>
    </nav>
    <div id="contactInfoContainer">
      <span>Contact: </span>
      <span>Andreas Juchelka</span>
      <span>1132@htl.rennweg.at</span>
    </div>
  </div>
</template>

<style scoped lang="scss">


#footerContainer {
  display: flex;
  align-items: center;
  flex-direction: row;
  justify-content: space-between;
  background-color: $tertiary-color;
  color: white;

  #linkContainer{
    align-items: center;
    justify-content: center;
    font-size: 15px;
  }


  #logoNavBar {
    width: 50px;
  }

  #visionContainer {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-size: 25px;

    #visionText {
      font-size: 40px;
    }
  }

  #contactInfoContainer {
    display: flex;
    flex-direction: column;
  }
}



</style>