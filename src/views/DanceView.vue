<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';

export interface FootStep {
  height: number;
  width: number;
  rotate: number;
  footToesActive: boolean;
  footHeelActive: boolean;
}

export interface Step {
  howQuick: number;
  man: {
    leftFoot: FootStep;
    rightFoot: FootStep;
  };
  woman: {
    leftFoot: FootStep;
    rightFoot: FootStep;
  };
}

const stepCounter = ref<number>(0);
const danceStepCounter = ref<number>(1);
const danceStepLength = ref<number>(0);

const footHeightDifferenz = 55;
const footWidthDifferenz = 25;

let screenWidth: number;
let screenHeight: number;

const howQuick = ref<number>(2);
const steps = ref<Step[]>([]);

const updateFeet = (step: Step) => {
  howQuick.value = step.howQuick;

  const updateFoot = (
      footId: string,
      footData: FootStep,
      toeId: string,
      heelId: string,
      letterId: string,
      activeColor: string,
      inactiveColor: string
  ) => {
    const foot = document.getElementById(footId) as HTMLElement;
    const toes = document.getElementById(toeId) as HTMLElement;
    const heel = document.getElementById(heelId) as HTMLElement;
    const letter = document.getElementById(letterId) as HTMLElement;

    if (foot && toes && heel && letter) {
      foot.style.top = `${screenHeight * footData.height - footHeightDifferenz}px`;
      foot.style.left = `${screenWidth * footData.width - footWidthDifferenz}px`;
      foot.style.transform = `rotate(${footData.rotate}deg)`;
      toes.style.backgroundColor = footData.footToesActive ? activeColor : inactiveColor;
      heel.style.backgroundColor = footData.footHeelActive ? activeColor : inactiveColor;
      letter.style.color = footData.footToesActive ? 'white' : 'black';
    }
  };

  updateFoot('manLeftFoot', step.man.leftFoot, 'manLeftFootToes', 'manLeftFootHeel', 'manLeftFootLetter', 'blue', 'lightblue');
  updateFoot('manRightFoot', step.man.rightFoot, 'manRightFootToes', 'manRightFootHeel', 'manRightFootLetter', 'blue', 'lightblue');
  updateFoot('womanLeftFoot', step.woman.leftFoot, 'womanLeftFootToes', 'womanLeftFootHeel', 'womanLeftFootLetter', 'red', '#FFCCCB');
  updateFoot('womanRightFoot', step.woman.rightFoot, 'womanRightFootToes', 'womanRightFootHeel', 'womanRightFootLetter', 'red', '#FFCCCB');
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
        stepCounter.value = 0;
        resize();
        window.addEventListener('resize', resize);
      });
});

const BackBtn = () => {
  if (stepCounter.value > 0) {
    stepCounter.value--;
    danceStepCounter.value--;
    updateFeet(steps.value[stepCounter.value]);
  }
};

const NextBtn = () => {
  if (stepCounter.value < steps.value.length - 1) {
    stepCounter.value++;
    danceStepCounter.value++;
    updateFeet(steps.value[stepCounter.value]);
  }
};

const BackToBeginBtn = () => {
  stepCounter.value = 0;
  danceStepCounter.value = 1;
  updateFeet(steps.value[stepCounter.value]);
};

const AutoplayBtn = async () => {
  while (stepCounter.value < steps.value.length - 1) {
    stepCounter.value++;
    danceStepCounter.value++;
    updateFeet(steps.value[stepCounter.value]);
    await new Promise((resolve) => setTimeout(resolve, steps.value[stepCounter.value].howQuick * 500));
  }
};

const NextBtnDisabled = computed(() => stepCounter.value >= steps.value.length - 1);
const AutoplayBtnDisabled = computed(() => stepCounter.value >= steps.value.length - 1);
const BackBtnDisabled = computed(() => stepCounter.value <= 0);
const BackToBeginBtnDisabled = computed(() => stepCounter.value === 0);
</script>

<template>
  <div id="morphDiv">
    <div
        id="manLeftFoot"
        class="foot"
        :class="{ quickMovement: howQuick === 2, slowMovement: howQuick === 1 }"
    >
      <div id="manLeftFootToes" class="manToe">
        <span id="manLeftFootLetter" class="footLetter">L</span>
      </div>
      <div class="innerFootSpacer"></div>
      <div id="manLeftFootHeel" class="manHeel"></div>
    </div>

    <div
        id="manRightFoot"
        class="foot"
        :class="{ quickMovement: howQuick === 2, slowMovement: howQuick === 1 }"
    >
      <div id="manRightFootToes" class="manToe">
        <span id="manRightFootLetter" class="footLetter">R</span>
      </div>
      <div class="innerFootSpacer"></div>
      <div id="manRightFootHeel" class="manHeel"></div>
    </div>

    <div
        id="womanLeftFoot"
        class="foot"
        :class="{ quickMovement: howQuick === 2, slowMovement: howQuick === 1 }"
    >
      <div id="womanLeftFootToes" class="womanToe">
        <span id="womanLeftFootLetter" class="footLetter">L</span>
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
        <span id="womanRightFootLetter" class="footLetter">R</span>
      </div>
      <div class="innerFootSpacer"></div>
      <div class="womanHeelContainer">
        <div id="womanRightFootHeel" class="womanHeel"></div>
      </div>
    </div>
  </div>

  <div id="controls">
    <div class="controlsElement">
      <span> {{ danceStepCounter }} / {{ danceStepLength }}</span>
    </div>
    <div class="controlsSpacer"></div>
    <button id="backButton" class="controlsElement" @click="BackBtn" :disabled="BackBtnDisabled">
      Back
    </button>
    <div class="controlsSpacer"></div>
    <button id="nextButton" class="controlsElement" @click="NextBtn" :disabled="NextBtnDisabled">
      Next
    </button>
    <div class="controlsSpacer"></div>
    <button
        id="nextButton"
        class="controlsElement"
        @click="BackToBeginBtn"
        :disabled="BackToBeginBtnDisabled"
    >
      Retry
    </button>
    <div class="controlsSpacer"></div>
    <button
        id="autoplayButton"
        class="controlsElement"
        @click="AutoplayBtn"
        :disabled="AutoplayBtnDisabled"
    >
      Autoplay
    </button>
  </div>
</template>

<style scoped lang="scss">
#morphDiv {
  width: 100%;
  height: 90vh;
  background-color: #eee;
  display: flex;
  position: relative;
  overflow: hidden;

  #manLeftFoot,
  #manRightFoot,
  #womanLeftFoot,
  #womanRightFoot {
    position: absolute;

    .footLetter {
      display: flex;
      justify-content: center;
      padding: 10px;
    }
  }

  .quickMovement {
    transition:
        top 0.5s ease,
        left 0.5s ease,
        transform 0.5s ease;
  }

  .slowMovement {
    transition:
        top 4s ease,
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

#controls {
  padding: 10px;
  display: flex;
  justify-content: center;

  .controlsSpacer {
    width: 50px;
  }

  .controlsElement {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 10rem;
    height: 2.5rem;
    background-color: lightblue;
    border: none;
    cursor: pointer;
  }
}
</style>