<template>
  <div id="morphDiv">
    <div id="manLeftFoot" class="foot">
      <div id="manLeftFootToes" class="menToe"></div>
      <div class="innerFootSpacer"></div>
      <div id="manLeftFootHeel" class="menHeel"></div>
    </div>

    <div id="manRightFoot" class="foot">
      <div id="manRightFootToes" class="menToe"></div>
      <div class="innerFootSpacer"></div>
      <div id="manRightFootHeel" class="menHeel"></div>
    </div>

    <div id="womanLeftFoot" class="foot">
      <div id="womanLeftFootToes" class="womanToe"></div>
      <div class="innerFootSpacer"></div>
      <div id="womanLeftFootHeel" class="womanHeel"></div>
    </div>

    <div id="womanRightFoot" class="foot">
      <div id="womanRightFootToes" class="womanToe"></div>
      <div class="innerFootSpacer"></div>
      <div id="womanRightFootHeel" class="womanHeel"></div>
    </div>
  </div>

  <div id="controls">
    <button id="backButton" @click="BackBtn" :disabled="BackBtnDisabled">Back</button>
    <div id="controlsSpacer"></div>
    <button id="nextButton" @click="NextBtn" :disabled="NextBtnDisabled">Next</button>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const stepCounter = ref(0);
const footHeightDifferenz = 55;
const footWidthDifferenz = 25;
let manLeftFoot;
let manLeftFootHeel;
let manLeftFootToes;
let manRightFoot;
let manRightFootToes;
let manRightFootHeel;
let womanLeftFoot;
let womanLeftFootHeel;
let womanLeftFootToes;
let womanRightFoot;
let womanRightFootToes;
let womanRightFootHeel;

let steps = [
  {
    woman: {
      leftFoot: {
        height: 0.1,
        width: 0.6,
        rotate: 180,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.1,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.8,
        width: 0.45,
        rotate: 0,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.8,
        width: 0.6,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    woman: {
      leftFoot: {
        height: 0.2,
        width: 0.6,
        rotate: 180,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.1,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.8,
        width: 0.45,
        rotate: 0,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.9,
        width: 0.6,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    woman: {
      leftFoot: {
        height: 0.2,
        width: 0.6,
        rotate: 180,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.2,
        width: 0.45,
        rotate: 270,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.9,
        width: 0.45,
        rotate: -90,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.9,
        width: 0.6,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
]

onMounted(() => {
  manLeftFoot = document.getElementById('manLeftFoot')
  manLeftFootToes = document.getElementById('manLeftFootToes')
  manLeftFootHeel = document.getElementById('manLeftFootHeel')
  manRightFoot = document.getElementById('manRightFoot')
  manRightFootToes = document.getElementById('manRightFootToes')
  manRightFootHeel = document.getElementById('manRightFootHeel')
  womanLeftFoot = document.getElementById('womanLeftFoot')
  womanLeftFootToes = document.getElementById('womanLeftFootToes')
  womanLeftFootHeel = document.getElementById('womanLeftFootHeel')
  womanRightFoot = document.getElementById('womanRightFoot')
  womanRightFootToes = document.getElementById('womanRightFootToes')
  womanRightFootHeel = document.getElementById('womanRightFootHeel')

  updateFeet(steps[stepCounter.value])

  window.addEventListener('resize', () => updateFeet(steps[stepCounter.value]))
})

const updateFeet = (step) => {
  let screenWidth = document.getElementById('morphDiv').offsetWidth
  let screenHeight = document.getElementById('morphDiv').offsetHeight

  manLeftFoot.style.top = screenHeight * step.man.leftFoot.height - footHeightDifferenz + 'px'
  manLeftFoot.style.left = screenWidth * step.man.leftFoot.width - footWidthDifferenz + 'px'
  manLeftFoot.style.transform = `rotate(${step.man.leftFoot.rotate}deg)`
  manLeftFootToes.style.backgroundColor = step.man.leftFoot.footToesActive ? 'blue' : 'lightblue'
  manLeftFootHeel.style.backgroundColor = step.man.leftFoot.footHeelActive ? 'blue' : 'lightblue'
  manRightFoot.style.top = screenHeight * step.man.rightFoot.height - footHeightDifferenz + 'px'
  manRightFoot.style.left = screenWidth * step.man.rightFoot.width - footWidthDifferenz + 'px'
  manRightFoot.style.transform = `rotate(${step.man.rightFoot.rotate}deg)`
  manRightFootToes.style.backgroundColor = step.man.rightFoot.footToesActive ? 'blue' : 'lightblue'
  manRightFootHeel.style.backgroundColor = step.man.rightFoot.footHeelActive ? 'blue' : 'lightblue'

  womanLeftFoot.style.top = screenHeight * step.woman.leftFoot.height - footHeightDifferenz + 'px'
  womanLeftFoot.style.left = screenWidth * step.woman.leftFoot.width - footWidthDifferenz + 'px'
  womanLeftFoot.style.transform = `rotate(${step.woman.leftFoot.rotate}deg)`
  womanLeftFootToes.style.backgroundColor = step.woman.leftFoot.footToesActive ? 'red' : '#FFCCCB'
  womanLeftFootHeel.style.backgroundColor = step.woman.leftFoot.footHeelActive ? 'red' : '#FFCCCB'
  womanRightFoot.style.top = screenHeight * step.woman.rightFoot.height - footHeightDifferenz + 'px'
  womanRightFoot.style.left = screenWidth * step.woman.rightFoot.width - footWidthDifferenz + 'px'
  womanRightFoot.style.transform = `rotate(${step.woman.rightFoot.rotate}deg)`
  womanRightFootToes.style.backgroundColor = step.woman.rightFoot.footToesActive ? 'red' : '#FFCCCB'
  womanRightFootHeel.style.backgroundColor = step.woman.rightFoot.footHeelActive ? 'red' : '#FFCCCB'
}

const BackBtn = () => {
  if (stepCounter.value > 0) {
    stepCounter.value--
    updateFeet(steps[stepCounter.value])
  }
}

const NextBtn = () => {
  if (stepCounter.value < steps.length - 1) {
    stepCounter.value++
    updateFeet(steps[stepCounter.value])
  }
}

const NextBtnDisabled = computed(() => stepCounter.value >= steps.length - 1)
const BackBtnDisabled = computed(() => stepCounter.value <= 0)
</script>

<style scoped lang="scss">
#morphDiv {
  width: 100%;
  height: 90vh;
  background-color: #eee;
  display: flex;

  #manLeftFoot,
  #manRightFoot,
  #womanLeftFoot,
  #womanRightFoot{
    position: absolute;
    transition:
      top 2s ease,
      left 2s ease,
      transform 2s ease;
  }

  .innerFootSpacer {
    height: 10px;
  }

  .womanToe,
  .womanHeel {
    background-color: red;
    width: 50px;
  }

  .menToe,
  .womanHeel {
    background-color: blue;
    width: 50px;
  }

  .womanToe, .menToe {
    border-radius: 2rem 2rem 0 0;
    height: 60px;
  }

  .womanHeel, .menHeel {
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

  #backButton,
  #nextButton {
    width: 10rem;
    height: 2.5rem;
    background-color: lightblue;
    border: none;
    cursor: pointer;
  }
}
</style>
