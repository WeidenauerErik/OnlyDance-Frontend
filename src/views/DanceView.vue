<script setup lang="ts">
import {ref, onMounted, nextTick} from 'vue';
import LoaderComponent from "@/components/LoaderComponent.vue";
import {type FootStep, type Step} from "@/tsTypes/interfacesDanceView.ts";

import playIcon from '@/assets/icons/playIcon.svg';
import pauseIcon from '@/assets/icons/pauseIcon.svg';
import skipLeftIcon from '@/assets/icons/skipLeftIcon.svg';
import skipRightIcon from '@/assets/icons/skipRightIcon.svg';
import arrowLeftIcon from '@/assets/icons/arrowLeftIcon.svg';
import arrowRightIcon from '@/assets/icons/arrowRightIcon.svg';

const stepCounter = ref<number>(0);
const danceStepCounter = ref<number>(1);
const danceStepLength = ref<number>(0);
const danceName = ref<string>()

const footHeightDifferenz = 55;
const footWidthDifferenz = 25;

let screenWidth: number;
let screenHeight: number;

const howQuick = ref<number>(2);
const steps = ref<Step[]>([]);

const autoplayActive = ref<boolean>(false);
let autoplayVariable = ref<string>(playIcon);

const updateFeet = (step: Step) => {
  howQuick.value = step.howQuick;

  const updateFoot = (footId: string, footData: FootStep, toeId: string, heelId: string, letterId: string) => {
    const foot = document.getElementById(footId) as HTMLElement;
    const toes = document.getElementById(toeId) as HTMLElement;
    const heel = document.getElementById(heelId) as HTMLElement;
    const letter = document.getElementById(letterId) as HTMLElement;

    if (foot && toes && heel && letter) {
      foot.style.transition = `top ${step.howQuick}s ease, left ${step.howQuick}s ease, transform ${step.howQuick}s ease`;
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
      });
});

const BackBtn = () => {
  autoplayActive.value = false;
  if (stepCounter.value > 0) {
    stepCounter.value--;
    danceStepCounter.value--;
    updateFeet(steps.value[stepCounter.value]);
  }
};

const NextBtn = () => {
  autoplayActive.value = false;
  if (stepCounter.value < steps.value.length - 1) {
    stepCounter.value++;
    danceStepCounter.value++;
    updateFeet(steps.value[stepCounter.value]);
  }
};

const BackToBeginBtn = () => {
  autoplayActive.value = false;
  stepCounter.value = 0;
  danceStepCounter.value = 1;
  updateFeet(steps.value[stepCounter.value]);
};

const BackToEndBtn = () => {
  autoplayActive.value = false;
  stepCounter.value = steps.value.length - 1;
  danceStepCounter.value = steps.value.length;
  updateFeet(steps.value[stepCounter.value]);
};

const AutoplayBtn = async () => {
  if (stepCounter.value === steps.value.length - 1) {
    stepCounter.value = 0;
    danceStepCounter.value = 0;
  }
  if (autoplayActive.value) {
    autoplayVariable.value = playIcon;
    autoplayActive.value = false;
    return;
  }

  autoplayVariable.value = pauseIcon;
  autoplayActive.value = true;

  while (stepCounter.value < steps.value.length - 1 && autoplayActive.value) {
    if (autoplayActive.value === true) {
      stepCounter.value++;
      danceStepCounter.value++;
      updateFeet(steps.value[stepCounter.value]);
      await new Promise((resolve) => setTimeout(resolve, steps.value[stepCounter.value].howQuick * 500));
    } else {
      return;
    }
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

    <div id="infoCounterDisplayCounter">

      <span id="infoCounterDisplay"> {{ danceStepCounter }} / {{ danceStepLength }}</span>

    </div>

    <div id="manLeftFoot" class="foot">

      <div id="manLeftFootToes" class="manToe">

        <span id="manLeftFootLetter" class="footLetter">L1</span>

      </div>

      <div class="innerFootSpacer"></div>
      <div id="manLeftFootHeel" class="manHeel"></div>

    </div>

    <div id="manRightFoot" class="foot">

      <div id="manRightFootToes" class="manToe">

        <span id="manRightFootLetter" class="footLetter">R1</span>

      </div>

      <div class="innerFootSpacer"></div>
      <div id="manRightFootHeel" class="manHeel"></div>

    </div>

    <div id="womanLeftFoot" class="foot">

      <div id="womanLeftFootToes" class="womanToe">

        <span id="womanLeftFootLetter" class="footLetter">L2</span>

      </div>

      <div class="innerFootSpacer"></div>

      <div class="womanHeelContainer">

        <div id="womanLeftFootHeel" class="womanHeel"></div>

      </div>

    </div>

    <div id="womanRightFoot" class="foot">

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

    <div>

      <h1 id="infoTextDisplay"> {{ danceName }}</h1>

    </div>

    <div id="controlsContainer">

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

    <div>

      <RouterLink to="/mainpage">Nächste Schrittfolge</RouterLink>

    </div>
  </div>
</template>

<style scoped lang="scss">
#morphDiv {
  width: 100%;
  height: 80vh;
  position: relative;
  display: none;

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
    z-index: 99;

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
  display: none;
  padding: 10px;
  justify-content: space-between;
  align-items: center;
  margin: 0 2.5rem 0 2.5rem;

  #controlsContainer {
    background-color: $backgroundColorPurple;
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
      border-radius: 50%;
      width: 6vh;
      height: 6vh;
      background-color: $backgroundColorPurple;

      &:hover {
        background-color: $backgroundColorViolet;
      }
    }

    #autoplayButton {
      width: 6.5vh;
      height: 6.5vh;
    }
  }
}
</style>