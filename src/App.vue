<template>
  <div id='morphDiv'>

    <div id='leftFoot' class='foot'>
      <div id='leftFootToes' class='toe'></div>
      <div class='innerFootSpacer'></div>
      <div id='leftFootHeel' class='heel'></div>
    </div>

    <div id='rightFoot' class='foot'>
      <div id='rightFootToes' class='toe'></div>
      <div class='innerFootSpacer'></div>
      <div id='rightFootHeel' class='heel'></div>
    </div>

  </div>

  <div id='controls'>
    <button id='backButton' @click='BackBtn' :disabled='BackBtnDisabled'>Back</button>
    <div id='controlsSpacer'></div>
    <button id='nextButton' @click='NextBtn' :disabled='NextBtnDisabled'>Next</button>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const stepCounter = ref(0);
const footHeightDifferenz = 55;
const footWidthDifferenz = 25;
let leftFoot;
let rightFoot;

let leftFootToes;
let leftFootHeel;
let rightFootToes;
let rightFootHeel;

let steps = [
  { leftHeight: 0.5, leftWidth: 0.45, leftRotate: 90, leftFootToesActive: true, leftFootHeelActive:true, rightHeight: 0.2, rightWidth: 0.55, rightRotate: 90, rightFootToesActive: false, rightFootHeelActive:true },
  { leftHeight: 0.2, leftWidth: 0.55, leftRotate: -150, leftFootToesActive: false, leftFootHeelActive:true, rightHeight: 0.25, rightWidth: 0.65, rightRotate: 150, rightFootToesActive: true, rightFootHeelActive:true },
  { leftHeight: 0.2, leftWidth: 0.55, leftRotate: -150, leftFootToesActive: false, leftFootHeelActive:false, rightHeight: 0.25, rightWidth: 0.65, rightRotate: 150, rightFootToesActive: true, rightFootHeelActive:true },
  { leftHeight: 0.3, leftWidth: 0.35, leftRotate: 50, leftFootToesActive: true, leftFootHeelActive:false, rightHeight: 0.3, rightWidth: 0.45, rightRotate: 190, rightFootToesActive: false, rightFootHeelActive:false }
];

onMounted(() => {
  leftFoot = document.getElementById('leftFoot');
  leftFootToes = document.getElementById('leftFootToes');
  leftFootHeel = document.getElementById('leftFootHeel');
  rightFoot = document.getElementById('rightFoot');
  rightFootToes = document.getElementById('rightFootToes');
  rightFootHeel = document.getElementById('rightFootHeel');

  updateFeet(steps[stepCounter.value]);

  window.addEventListener('resize', () => updateFeet(steps[stepCounter.value]));
});

const updateFeet = (step) => {
  let screenWidth = document.getElementById('morphDiv').offsetWidth;
  let screenHeight = document.getElementById('morphDiv').offsetHeight;

  leftFoot.style.top = ((screenHeight * step.leftHeight - footHeightDifferenz) + 'px');
  leftFoot.style.left = ((screenWidth * step.leftWidth - footWidthDifferenz) + 'px');
  leftFoot.style.transform = `rotate(${step.leftRotate}deg)`;
  leftFootToes.style.backgroundColor = step.leftFootToesActive ? 'blue' : 'lightblue';
  leftFootHeel.style.backgroundColor = step.leftFootHeelActive ? 'blue' : 'lightblue';

  rightFoot.style.top = ((screenHeight * step.rightHeight - footHeightDifferenz) + 'px');
  rightFoot.style.left = ((screenWidth * step.rightWidth - footWidthDifferenz) + 'px');
  rightFoot.style.transform = `rotate(${step.rightRotate}deg)`;
  rightFootToes.style.backgroundColor = step.rightFootToesActive ? 'blue' : 'lightblue';
  rightFootHeel.style.backgroundColor = step.rightFootHeelActive ? 'blue' : 'lightblue';
};

const BackBtn = () => {
  if (stepCounter.value > 0) {
    stepCounter.value--;
    updateFeet(steps[stepCounter.value]);
  }
};

const NextBtn = () => {
  if (stepCounter.value < steps.length - 1) {
    stepCounter.value++;
    updateFeet(steps[stepCounter.value]);
  }
};

const NextBtnDisabled = computed(() => stepCounter.value >= steps.length - 1);
const BackBtnDisabled = computed(() => stepCounter.value <= 0);
</script>

<style scoped lang='scss'>
#morphDiv {
  width: 100%;
  height: 90vh;
  background-color: #eee;
  display: flex;

  #leftFoot, #rightFoot {
    position: absolute;
    transition: top 2s ease, left 2s ease, transform 2s ease; /* Transition für rotation hinzufügen */
  }

  .innerFootSpacer {
    height: 10px;
  }

  .toe, .heel {
    background-color: blue;
    width: 50px;
  }

  .toe {
    border-radius: 2rem 2rem 0 0;
    height: 60px;
  }

  .heel {
    border-radius: 0 0 1rem 1rem;
    height: 40px;
  }
}

#controls {
  padding: 10px;
  display: flex;
  justify-content: center;

  #controlsSpacer {
    width: 50px;
  }

  #backButton, #nextButton {
    width: 10rem;
    height: 2.5rem;
    background-color: lightblue;
    border: none;
    cursor: pointer;
  }
}
</style>
