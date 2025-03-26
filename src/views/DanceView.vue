<script setup lang="ts">
import {ref, computed, onMounted, nextTick} from 'vue';
import LoaderComponent from "@/components/LoaderComponent.vue";
import {type FootStep, type Step} from "@/tsTypes/interfacesDanceView.ts";

import playIcon from '../assets/playIcon.svg';
import pauseIcon from '../assets/pauseIcon.svg';

const stepCounter = ref<number>(0);
const danceStepCounter = ref<number>(1);
const danceStepLength = ref<number>(0);
const danceName = ref<string>()

const footHeightDifferenz = 55;
const footWidthDifferenz = 25;

let screenWidth: number;
let screenHeight: number;

let breakpoint: boolean;

const howQuick = ref<number>(2);
const steps = ref<Step[]>([]);

const autoplayActive = ref<boolean>(false);
let autoplayVariable = ref<String>(playIcon);

const updateFeet = (step: Step) => {
  howQuick.value = step.howQuick;

  const updateFoot = (footId: string, footData: FootStep, toeId: string, heelId: string, letterId: string) => {
    const foot = document.getElementById(footId) as HTMLElement;
    const toes = document.getElementById(toeId) as HTMLElement;
    const heel = document.getElementById(heelId) as HTMLElement;
    const letter = document.getElementById(letterId) as HTMLElement;

    if (foot && toes && heel && letter) {
      foot.style.top = `${screenHeight * footData.height - footHeightDifferenz}px`;
      foot.style.left = `${screenWidth * footData.width - footWidthDifferenz}px`;
      foot.style.transform = `rotate(${footData.rotate}deg)`;
      toes.style.backgroundColor = footData.footToesActive ? '#73168C' : '#875595';
      heel.style.backgroundColor = footData.footHeelActive ? '#73168C' : '#875595';
    }
  };

  updateFoot('manLeftFoot', step.man.leftFoot, 'manLeftFootToes', 'manLeftFootHeel', 'manLeftFootLetter');
  updateFoot('manRightFoot', step.man.rightFoot, 'manRightFootToes', 'manRightFootHeel', 'manRightFootLetter');
  updateFoot('womanLeftFoot', step.woman.leftFoot, 'womanLeftFootToes', 'womanLeftFootHeel', 'womanLeftFootLetter');
  updateFoot('womanRightFoot', step.woman.rightFoot, 'womanRightFootToes', 'womanRightFootHeel', 'womanRightFootLetter');
};

const resize = () => {
  const morphDiv = document.getElementById('morphDiv');
  if (morphDiv) {
    screenWidth = morphDiv.offsetWidth;
    screenHeight = morphDiv.offsetHeight;
    updateFeet(steps.value[stepCounter.value]);
  }
};

onMounted(() => {
  fetch('https://onlydance.onrender.com/')
      .then((res) => res.json())
      .then((data: Step[]) => {
        steps.value = data;
        danceStepLength.value = data.length;
        danceName.value = 'Cha Cha';
        stepCounter.value = 0;
        window.addEventListener('resize', resize);
      })
      .then(async () => {
        await nextTick();
        const morphDiv = document.getElementById('morphDiv') as HTMLElement;
        const controls = document.getElementById('controlsMainContainer') as HTMLElement;
        const loader = document.getElementById('loader') as HTMLElement;

        if (morphDiv && controls && loader) {
          morphDiv.style.display = 'flex';
          controls.style.display = 'flex';
          loader.style.display = "none";
        }

        resize();
        morphDiv.scrollIntoView({behavior: "smooth", block: "start"});
      });
});

const BackBtn = () => {
  if (stepCounter.value > 0) {
    breakpoint = true;
    stepCounter.value--;
    danceStepCounter.value--;
    updateFeet(steps.value[stepCounter.value]);
  }
};

const NextBtn = () => {
  if (stepCounter.value < steps.value.length - 1) {
    breakpoint = true;
    stepCounter.value++;
    danceStepCounter.value++;
    updateFeet(steps.value[stepCounter.value]);
  }
};

const BackToBeginBtn = () => {
  breakpoint = true;
  stepCounter.value = 0;
  danceStepCounter.value = 1;
  updateFeet(steps.value[stepCounter.value]);
};

const BackToEndBtn = () => {
  breakpoint = true;
  stepCounter.value = steps.value.length - 1;
  danceStepCounter.value = steps.value.length;
  updateFeet(steps.value[stepCounter.value]);
};

const AutoplayBtn = async () => {
  if (autoplayActive.value) {
    breakpoint = true;
    autoplayVariable.value = playIcon;
    autoplayActive.value = false;
    return;
  }

  autoplayVariable.value = pauseIcon;
  autoplayActive.value = true;
  breakpoint = false;

  while (stepCounter.value < steps.value.length - 1 && autoplayActive.value) {
    stepCounter.value++;
    danceStepCounter.value++;
    updateFeet(steps.value[stepCounter.value]);
    await new Promise((resolve) => setTimeout(resolve, steps.value[stepCounter.value].howQuick * 500));
  }

  autoplayVariable.value = playIcon;
  autoplayActive.value = false;
};

</script>

<template>

  <div id="loader">

    <LoaderComponent/>

  </div>

  <div id="morphDiv">

    <div id="infoDisplay">

      <div>

        <h1 id="infoTextDisplay"> {{ danceName }}:</h1>

      </div>

      <div>

        <span id="infoCounterDisplay"> {{ danceStepCounter }} / {{ danceStepLength }}</span>

      </div>

    </div>

    <div id="manLeftFoot" class="foot" :class="{ quickMovement: howQuick === 2, slowMovement: howQuick === 1 }">

      <div id="manLeftFootToes" class="manToe">

        <span id="manLeftFootLetter" class="footLetter">L1</span>

      </div>

      <div class="innerFootSpacer"></div>
      <div id="manLeftFootHeel" class="manHeel"></div>

    </div>

    <div id="manRightFoot" class="foot" :class="{ quickMovement: howQuick === 2, slowMovement: howQuick === 1 }">

      <div id="manRightFootToes" class="manToe">

        <span id="manRightFootLetter" class="footLetter">R1</span>

      </div>

      <div class="innerFootSpacer"></div>
      <div id="manRightFootHeel" class="manHeel"></div>

    </div>

    <div id="womanLeftFoot" class="foot" :class="{ quickMovement: howQuick === 2, slowMovement: howQuick === 1 }">

      <div id="womanLeftFootToes" class="womanToe">

        <span id="womanLeftFootLetter" class="footLetter">L2</span>

      </div>

      <div class="innerFootSpacer"></div>
      <div class="womanHeelContainer">

        <div id="womanLeftFootHeel" class="womanHeel"></div>

      </div>

    </div>

    <div
        id="womanRightFoot"
        class="foot"
        :class="{ quickMovement: howQuick === 2, slowMovement: howQuick === 1 }"
    >

      <div id="womanRightFootToes" class="womanToe">

        <span id="womanRightFootLetter" class="footLetter">R2</span>

      </div>

      <div class="innerFootSpacer"></div>
      <div class="womanHeelContainer">

        <div id="womanRightFootHeel" class="womanHeel"></div>

      </div>

    </div>

  </div>

  <div id="controlsMainContainer">
    <div id="controlsContainer">
      <button id="nextButton" class="controlsElement" @click="BackToBeginBtn">
        <img src="../assets/skipLeftIcon.svg" alt="Zurück zum Anfang">
      </button>

      <button id="backButton" class="controlsElement" @click="BackBtn">
        <img src="../assets/arrowLeftIcon.svg" alt="Einen Schritt nach vorne">
      </button>

        <button id="autoplayButton" class="controlsElement" @click="AutoplayBtn">
          <img :src="autoplayVariable" alt="Autoplay Funktion" id="autoplayImage">
        </button>

      <button id="nextButton" class="controlsElement" @click="NextBtn">
        <img src="../assets/arrowRightIcon.svg" alt="Einen Schritt weiter">
      </button>

      <button id="nextButton" class="controlsElement" @click="BackToEndBtn">
        <img src="../assets/skipRightIcon.svg" alt="Zum Ende">
      </button>
    </div>
  </div>

</template>

<style scoped lang="scss">
#morphDiv {
  width: 100%;
  height: 80vh;
  position: relative;
  display: none;

  #infoDisplay {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    margin: 0 10px 0 10px;

    #infoCounterDisplay, #infoTextDisplay {
      position: relative;
      top: 1%;
      margin: 0;
      height: 5vh;
      display: flex;
      align-items: center;
    }
  }

  #manLeftFoot,
  #manRightFoot,
  #womanLeftFoot,
  #womanRightFoot {
    position: absolute;
    z-index: 99;

    .footLetter {
      color: $colorWhite;
      display: flex;
      justify-content: center;
      padding: 10px;
    }
  }


  .quickMovement {
    transition: top 0.5s ease,
    left 0.5s ease,
    transform 0.5s ease;
  }

  .slowMovement {
    transition: top 4s ease,
    left 4s ease,
    transform 4s ease;
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
  height: 10vh;
  display: none;
  padding: 10px;
  justify-content: center;

  #controlsContainer {
    background-color: $buttonColorPrimary;
    width: 30%;
    height: 8vh;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    border-radius: 20px;

    .controlsElement {
      cursor: pointer;
      border: none;
      background-color: $buttonColorPrimary;
    }

    #autoplayButton {
      background-color: $backgroundColorViolet;
      width: 6vh;
      height: 6vh;
      border-radius: 50%;
    }
  }
}
</style>