<script setup lang="ts">
import searchIcon from '@/assets/icons/searchIcon.svg';
import {type DanceTypes} from '@/tsTypes/interfacesMainPageView.ts';
import {nextTick, onBeforeMount, onMounted, type Ref, ref} from "vue";

const url = import.meta.env.VITE_ServerIP + "/dance/dances"
let dances = ref<DanceTypes[]>([]);

onMounted(() => {
  fetch(url)
      .then(response => response.json())
      .then((data: DanceTypes) => {
        dances.value = data;
        console.log(dances);
        nextTick();
      });
})
</script>

<template>
  <div id="filterBarMainPage">
    <div id="searchBarContainerMainPage">
      <input type="text" id="searchBarInputMainPage">
      <button id="searchBarButtonMainPage">
        <img :src="searchIcon" alt="Search Icon">
      </button>
    </div>
  </div>
  <div id="danceContainerMainPage">
    <div class="danceInfoOverContainerMainPage" v-for="dance in dances">
      <div class="danceInfoContainerMainPage">
        <h3>{{ dance.name }}</h3>
        <div>
          <span v-for="index in dance.difficulty" key="index">x</span>
        </div>
        <span>{{ dance.defaultBPM }} BPM</span>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
#filterBarMainPage {
  display: flex;
  justify-content: center;

  #searchBarContainerMainPage {
    margin-top: 2vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    width: 40%;

    #searchBarInputMainPage {
      flex: 1;
      border: 1px solid $colorVioletDark;
      border-radius: 20px;
      height: 6vh;
      font-size: 15px;
      color: var(--primary-color);
      box-sizing: border-box;
      outline: none;
      padding-left: 5px;
    }

    #searchBarButtonMainPage {
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
}

#danceContainerMainPage {
  padding: 20px;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;

  .danceInfoOverContainerMainPage {
    padding: 20px;
    .danceInfoContainerMainPage {
      display: flex;
      flex-direction: column;
      align-items: center;

      border-radius: 20px;
      width: 20vh;
      height: 20vh;
      color: $colorWhite;
      background-color: $colorVioletLight;
    }
  }
}
</style>
