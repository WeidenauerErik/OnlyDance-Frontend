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
      @click="BackToBegin"
      :disabled="BackToBeginBtnDisabled"
    >
      Retry
    </button>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const stepCounter = ref()
let danceStepCounter = ref(1)
let danceStepLength

const footHeightDifferenz = 55
const footWidthDifferenz = 25

let screenWidth
let screenHeight

let howQuick = ref(2)

let manLeftFoot
let manLeftFootHeel
let manLeftFootToes
let manLeftFootLetter

let manRightFoot
let manRightFootToes
let manRightFootHeel
let manRightFootLetter

let womanLeftFoot
let womanLeftFootHeel
let womanLeftFootToes
let womanLeftFootLetter

let womanRightFoot
let womanRightFootToes
let womanRightFootHeel
let womanRightFootLetter

let steps = [
  {
    howQuick: 1,
    woman: {
      leftFoot: {
        height: 0.4,
        width: 0.53,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.4,
        width: 0.45,
        rotate: 180,
        footToesActive: true,
        footHeelActive: true,
      },
    },
    man: {
      leftFoot: {
        height: 0.65,
        width: 0.45,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.65,
        width: 0.53,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.4,
        width: 0.6,
        rotate: 180,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.4,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.65,
        width: 0.45,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.65,
        width: 0.6,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.4,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.2,
        width: 0.55,
        rotate: 180,
        footToesActive: true,
        footHeelActive: true,
      },
    },
    man: {
      leftFoot: {
        height: 0.45,
        width: 0.55,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.65,
        width: 0.6,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.4,
        width: 0.6,
        rotate: 180,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.2,
        width: 0.55,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.45,
        width: 0.55,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.65,
        width: 0.6,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.4,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.4,
        width: 0.45,
        rotate: 180,
        footToesActive: true,
        footHeelActive: true,
      },
    },
    man: {
      leftFoot: {
        height: 0.65,
        width: 0.45,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.65,
        width: 0.6,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.4,
        width: 0.53,
        rotate: 180,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.4,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.65,
        width: 0.45,
        rotate: 0,
        footToesActive: !true,
        footHeelActive: !true,
      },
      rightFoot: {
        height: 0.65,
        width: 0.53,
        rotate: 0,
        footToesActive: !false,
        footHeelActive: !false,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.4,
        width: 0.53,
        rotate: 180,
        footToesActive: !true,
        footHeelActive: !true,
      },
      rightFoot: {
        height: 0.4,
        width: 0.37,
        rotate: 180,
        footToesActive: !false,
        footHeelActive: !false,
      },
    },
    man: {
      leftFoot: {
        height: 0.65,
        width: 0.37,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.65,
        width: 0.53,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
]

onMounted(() => {
  danceStepLength = steps.length
  stepCounter.value = 0

  manLeftFoot = document.getElementById('manLeftFoot')
  manLeftFootToes = document.getElementById('manLeftFootToes')
  manLeftFootHeel = document.getElementById('manLeftFootHeel')
  manLeftFootLetter = document.getElementById('manLeftFootLetter')

  manRightFoot = document.getElementById('manRightFoot')
  manRightFootToes = document.getElementById('manRightFootToes')
  manRightFootHeel = document.getElementById('manRightFootHeel')
  manRightFootLetter = document.getElementById('manRightFootLetter')

  womanLeftFoot = document.getElementById('womanLeftFoot')
  womanLeftFootToes = document.getElementById('womanLeftFootToes')
  womanLeftFootHeel = document.getElementById('womanLeftFootHeel')
  womanLeftFootLetter = document.getElementById('womanLeftFootLetter')

  womanRightFoot = document.getElementById('womanRightFoot')
  womanRightFootToes = document.getElementById('womanRightFootToes')
  womanRightFootHeel = document.getElementById('womanRightFootHeel')
  womanRightFootLetter = document.getElementById('womanRightFootLetter')

  resize()

  window.addEventListener('resize', () => resize())
})

const updateFeet = (step) => {
  howQuick = ref(step.howQuick)

  manLeftFoot.style.top = screenHeight * step.man.leftFoot.height - footHeightDifferenz + 'px'
  manLeftFoot.style.left = screenWidth * step.man.leftFoot.width - footWidthDifferenz + 'px'
  manLeftFoot.style.transform = `rotate(${step.man.leftFoot.rotate}deg)`
  manLeftFootToes.style.backgroundColor = step.man.leftFoot.footToesActive ? 'blue' : 'lightblue'
  manLeftFootHeel.style.backgroundColor = step.man.leftFoot.footHeelActive ? 'blue' : 'lightblue'
  manLeftFootLetter.style.color = step.man.leftFoot.footToesActive ? 'white' : 'black'

  manRightFoot.style.top = screenHeight * step.man.rightFoot.height - footHeightDifferenz + 'px'
  manRightFoot.style.left = screenWidth * step.man.rightFoot.width - footWidthDifferenz + 'px'
  manRightFoot.style.transform = `rotate(${step.man.rightFoot.rotate}deg)`
  manRightFootToes.style.backgroundColor = step.man.rightFoot.footToesActive ? 'blue' : 'lightblue'
  manRightFootHeel.style.backgroundColor = step.man.rightFoot.footHeelActive ? 'blue' : 'lightblue'
  manRightFootLetter.style.color = step.man.rightFoot.footToesActive ? 'white' : 'black'

  womanLeftFoot.style.top = screenHeight * step.woman.leftFoot.height - footHeightDifferenz + 'px'
  womanLeftFoot.style.left = screenWidth * step.woman.leftFoot.width - footWidthDifferenz + 'px'
  womanLeftFoot.style.transform = `rotate(${step.woman.leftFoot.rotate}deg)`
  womanLeftFootToes.style.backgroundColor = step.woman.leftFoot.footToesActive ? 'red' : '#FFCCCB'
  womanLeftFootHeel.style.backgroundColor = step.woman.leftFoot.footHeelActive ? 'red' : '#FFCCCB'
  womanLeftFootLetter.style.color = step.woman.leftFoot.footToesActive ? 'white' : 'black'

  womanRightFoot.style.top = screenHeight * step.woman.rightFoot.height - footHeightDifferenz + 'px'
  womanRightFoot.style.left = screenWidth * step.woman.rightFoot.width - footWidthDifferenz + 'px'
  womanRightFoot.style.transform = `rotate(${step.woman.rightFoot.rotate}deg)`
  womanRightFootToes.style.backgroundColor = step.woman.rightFoot.footToesActive ? 'red' : '#FFCCCB'
  womanRightFootHeel.style.backgroundColor = step.woman.rightFoot.footHeelActive ? 'red' : '#FFCCCB'
  womanRightFootLetter.style.color = step.woman.rightFoot.footToesActive ? 'white' : 'black'
}

const resize = () => {
  screenWidth = document.getElementById('morphDiv').offsetWidth
  screenHeight = document.getElementById('morphDiv').offsetHeight

  updateFeet(steps[stepCounter.value])
}

const BackBtn = () => {
  if (stepCounter.value > 0) {
    stepCounter.value--
    danceStepCounter.value--
    updateFeet(steps[stepCounter.value])
  }
}

const NextBtn = () => {
  if (stepCounter.value < steps.length - 1) {
    stepCounter.value++
    danceStepCounter.value++
    updateFeet(steps[stepCounter.value])
  }
}

const BackToBegin = () => {
  stepCounter.value = 0
  danceStepCounter.value = 1
  updateFeet(steps[stepCounter.value])
}

const NextBtnDisabled = computed(() => stepCounter.value >= steps.length - 1)
const BackBtnDisabled = computed(() => stepCounter.value <= 0)
const BackToBeginBtnDisabled = computed(() => stepCounter.value === 0)
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
