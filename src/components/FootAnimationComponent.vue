<script setup lang="ts">
import {ref, onMounted, nextTick, type Ref} from 'vue';
import {type FootStep, type Step} from "@/tsTypes/interfacesDanceView.ts";

import playIcon from '@/assets/icons/playIcon.svg';
import pauseIcon from '@/assets/icons/pauseIcon.svg';
import skipLeftIcon from '@/assets/icons/skipLeftIcon.svg';
import skipRightIcon from '@/assets/icons/skipRightIcon.svg';
import arrowLeftIcon from '@/assets/icons/arrowLeftIcon.svg';
import arrowRightIcon from '@/assets/icons/arrowRightIcon.svg';
import settingsIcon from '@/assets/icons/settingsIcon.svg';

const danceStepCounter = ref<number>(0);
const danceStepLength = ref<number>(0);
const danceName = ref<string>()

const footHeightDifferenz = 55;
const footWidthDifferenz = 25;

const morphDivRef = ref<HTMLDivElement | null>(null);
let screenWidth: number;
let screenHeight: number;

const howQuick = ref<number>(2);
const steps = ref<Step[]>([]);

const autoplayActive = ref<boolean>(false);
const autoplayVariable = ref<string>(playIcon);

let loaderIsVisible = ref<boolean>(true);

const manLeftFoot = ref<HTMLElement | null>(null);
const manRightFoot = ref<HTMLElement | null>(null);
const womanLeftFoot = ref<HTMLElement | null>(null);
const womanRightFoot = ref<HTMLElement | null>(null);

const manLeftFootToes = ref<HTMLElement | null>(null);
const manLeftFootHeel = ref<HTMLElement | null>(null);
const manLeftFootLetter = ref<HTMLElement | null>(null);

const manRightFootToes = ref<HTMLElement | null>(null);
const manRightFootHeel = ref<HTMLElement | null>(null);
const manRightFootLetter = ref<HTMLElement | null>(null);

const womanLeftFootToes = ref<HTMLElement | null>(null);
const womanLeftFootHeel = ref<HTMLElement | null>(null);
const womanLeftFootLetter = ref<HTMLElement | null>(null);

const womanRightFootToes = ref<HTMLElement | null>(null);
const womanRightFootHeel = ref<HTMLElement | null>(null);
const womanRightFootLetter = ref<HTMLElement | null>(null);

const updateFeet = (step: Step) => {
  howQuick.value = step.howQuick;

  const getFootElements = (foot: Ref<HTMLElement | null>, toes: Ref<HTMLElement | null>, heel: Ref<HTMLElement | null>, letter: Ref<HTMLElement | null>) => {
    return {foot: foot.value, toes: toes.value, heel: heel.value, letter: letter.value};
  };

  const updateFoot = (footRef: Ref<HTMLElement | null>, footData: FootStep, toesRef: Ref<HTMLElement | null>, heelRef: Ref<HTMLElement | null>, letterRef: Ref<HTMLElement | null>) => {
    const {foot, toes, heel, letter} = getFootElements(footRef, toesRef, heelRef, letterRef);

    if (foot && toes && heel && letter) {
      foot.style.transition = `top ${step.howQuick}s ease, left ${step.howQuick}s ease, transform ${step.howQuick}s ease`;
      foot.style.top = `${screenHeight * footData.height - footHeightDifferenz}px`;
      foot.style.left = `${screenWidth * footData.width - footWidthDifferenz}px`;
      foot.style.transform = `rotate(${footData.rotate}deg)`;
      toes.style.backgroundColor = footData.footToesActive ? '#73168C' : '#875595';
      heel.style.backgroundColor = footData.footHeelActive ? '#73168C' : '#875595';
    }
  };

  updateFoot(manLeftFoot, step.man.leftFoot, manLeftFootToes, manLeftFootHeel, manLeftFootLetter);
  updateFoot(manRightFoot, step.man.rightFoot, manRightFootToes, manRightFootHeel, manRightFootLetter);
  updateFoot(womanLeftFoot, step.woman.leftFoot, womanLeftFootToes, womanLeftFootHeel, womanLeftFootLetter);
  updateFoot(womanRightFoot, step.woman.rightFoot, womanRightFootToes, womanRightFootHeel, womanRightFootLetter);
};

const resize = () => {
  if (morphDivRef.value) {
    screenWidth = morphDivRef.value.offsetWidth;
    screenHeight = morphDivRef.value.offsetHeight;
    updateFeet(steps.value[danceStepCounter.value]);
  }
};

onMounted(() => {
  fetch('https://onlydance.onrender.com/')
      .then((res) => res.json())
      .then((data: Step[]) => {
        steps.value = data;
        danceStepLength.value = data.length;
        danceStepCounter.value = 0;
        danceName.value = 'Cha Cha';
        window.addEventListener('resize', resize);
      })
      .then(async () => {
        await nextTick();
        loaderIsVisible.value = false;
        await nextTick();
        resize();
      });
});

const BackBtn = () => {
  autoplayActive.value = false;

  if (danceStepCounter.value > 0) {
    danceStepCounter.value--;
    updateFeet(steps.value[danceStepCounter.value]);
  }
};

const NextBtn = () => {
  autoplayActive.value = false;

  if (danceStepCounter.value < steps.value.length - 1) {
    danceStepCounter.value++;
    updateFeet(steps.value[danceStepCounter.value]);
  }
};

const BackToBeginBtn = () => {
  autoplayActive.value = false;
  danceStepCounter.value = 0;
  updateFeet(steps.value[danceStepCounter.value]);
};

const BackToEndBtn = () => {
  autoplayActive.value = false;
  danceStepCounter.value = steps.value.length - 1;
  updateFeet(steps.value[danceStepCounter.value]);
};

const AutoplayBtn = async () => {
  if (danceStepCounter.value === steps.value.length - 1) {
    danceStepCounter.value = 0;
  }
  if (autoplayActive.value) {
    autoplayVariable.value = playIcon;
    autoplayActive.value = false;
    return;
  }

  autoplayVariable.value = pauseIcon;
  autoplayActive.value = true;

  while (danceStepCounter.value < steps.value.length - 1 && autoplayActive.value) {
    if (autoplayActive.value) {
      danceStepCounter.value++;
      updateFeet(steps.value[danceStepCounter.value]);
      await new Promise((resolve) => setTimeout(resolve, steps.value[danceStepCounter.value].howQuick * 500));
    } else {
      return;
    }
  }

  autoplayVariable.value = playIcon;
  autoplayActive.value = false;
};
</script>

<template>

  <span v-if="loaderIsVisible">Loading ...</span>

  <div id="morphDiv" ref="morphDivRef" v-if="!loaderIsVisible">

    <div id="morphDiv" ref="morphDivRef" v-if="!loaderIsVisible">
      <div id="infoCounterDisplayCounter">
        <span id="infoCounterDisplay"> {{ danceStepCounter + 1  }} / {{ danceStepLength }}</span>
      </div>

      <div id="manLeftFoot" class="foot" ref="manLeftFoot">
        <div id="manLeftFootToes" class="manToe" ref="manLeftFootToes">
          <span id="manLeftFootLetter" class="footLetter" ref="manLeftFootLetter">L1</span>
        </div>
        <div class="innerFootSpacer"></div>
        <div id="manLeftFootHeel" class="manHeel" ref="manLeftFootHeel"></div>
      </div>

      <div id="manRightFoot" class="foot" ref="manRightFoot">
        <div id="manRightFootToes" class="manToe" ref="manRightFootToes">
          <span id="manRightFootLetter" class="footLetter" ref="manRightFootLetter">R1</span>
        </div>
        <div class="innerFootSpacer"></div>
        <div id="manRightFootHeel" class="manHeel" ref="manRightFootHeel"></div>
      </div>

      <div id="womanLeftFoot" class="foot" ref="womanLeftFoot">
        <div id="womanLeftFootToes" class="womanToe" ref="womanLeftFootToes">
          <span id="womanLeftFootLetter" class="footLetter" ref="womanLeftFootLetter">L2</span>
        </div>
        <div class="innerFootSpacer"></div>
        <div class="womanHeelContainer">
          <div id="womanLeftFootHeel" class="womanHeel" ref="womanLeftFootHeel"></div>
        </div>
      </div>

      <div id="womanRightFoot" class="foot" ref="womanRightFoot">
        <div id="womanRightFootToes" class="womanToe" ref="womanRightFootToes">
          <span id="womanRightFootLetter" class="footLetter" ref="womanRightFootLetter">R2</span>
        </div>
        <div class="innerFootSpacer"></div>
        <div class="womanHeelContainer">
          <div id="womanRightFootHeel" class="womanHeel" ref="womanRightFootHeel"></div>
        </div>
      </div>
    </div>
  </div>


  <div id="controlsMainContainer" v-if="!loaderIsVisible">

    <div class="controlsContainerElement">

      <h1 id="infoTextDisplay"> {{ danceName }}</h1>

    </div>

    <div id="controlsContainer" class="controlsContainerElement">

      <button id="nextButton" class="controlsElement" @click="BackToBeginBtn">

        <img :src="skipLeftIcon" alt="Zurück zum Anfang">

      </button>

      <button id="backButton" class="controlsElement" @click="BackBtn">

        <img :src="arrowLeftIcon" alt="Einen Schritt nach vorne">

      </button>

      <button id="autoplayButton" class="controlsElement" @click="AutoplayBtn">

        <img :src="autoplayVariable" alt="Autoplay Funktion" id="autoplayImage">

      </button>

      <button id="nextButton" class="controlsElement" @click="NextBtn">

        <img :src="arrowRightIcon" alt="Einen Schritt weiter">

      </button>

      <button id="nextButton" class="controlsElement" @click="BackToEndBtn">

        <img :src="skipRightIcon" alt="Zum Ende">

      </button>

    </div>

    <div class="controlsContainerElement" id="controlsSettingsContainer">

      <img :src="settingsIcon" alt="Einstellungen" id="settingsIcon">

    </div>
  </div>
</template>

<style scoped lang="scss">
#morphDiv {
  width: 100%;
  height: 80vh;
  position: relative;

  #infoCounterDisplayCounter {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-top: 1vh;
  }

  #manLeftFoot,
  #manRightFoot,
  #womanLeftFoot,
  #womanRightFoot {
    position: absolute;
    z-index: 10;

    .footLetter {
      color: $colorWhite;
      display: flex;
      justify-content: center;
      padding: 10px;
    }
  }

  #manLeftFoot,
  #manRightFoot {
    .innerFootSpacer {
      height: 10px;
    }
  }

  #womanLeftFoot,
  #womanRightFoot {
    .innerFootSpacer {
      height: 30px;
    }
  }

  .manToe,
  .manHeel {
    width: 50px;
  }

  .womanToe {
    width: 30px;
  }

  .womanToe,
  .manToe {
    border-radius: 2rem 2rem 0 0;
  }

  .manToe {
    height: 60px;
  }

  .womanToe {
    height: 40px;
  }

  .manHeel {
    border-radius: 0 0 1rem 1rem;
    height: 40px;
  }

  .womanHeelContainer {
    display: flex;
    justify-content: center;

    .womanHeel {
      height: 25px;
      width: 25px;
      border-radius: 50%;
    }
  }
}

#controlsMainContainer {
  height: 8vh;
  display: flex;
  padding: 10px;
  justify-content: space-between;
  align-items: center;
  margin: 0 2.5rem 0 2.5rem;

  .controlsContainerElement {
    min-width: 30%;
  }

  #controlsSettingsContainer {
    display: flex;
    justify-content: end;
  }

  #controlsContainer {
    background-color: $colorPurpleLight;
    width: 30%;
    height: 7vh;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    border-radius: 20px;

    .controlsElement {
      cursor: pointer;
      border: none;
      border-radius: 50%;
      width: 6vh;
      height: 6vh;
      background-color: $colorPurpleLight;

      &:hover {
        background-color: $colorVioletLight;
      }
    }
  }

  #settingsIcon {
    cursor: pointer;
    width: 30px;
    height: 30px;
  }

  #nextStepsequence {
    text-decoration: none;
  }
}
</style>