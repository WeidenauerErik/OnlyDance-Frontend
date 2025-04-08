<script setup lang="ts">
import {nextTick, onMounted, type Ref, ref, watch} from "vue";
import FootAnimationComponent from "@/components/FootAnimationComponent.vue";
import type {Step} from "@/tsTypes/interfacesDanceView.ts";

import playIcon from "@/assets/icons/playIcon.svg";
import pauseIcon from "@/assets/icons/pauseIcon.svg";

const steps = ref<Step[]>([]);
const autoplayActive = ref<boolean>(false);

const autoplayVariable = ref<string>(playIcon);

//for properties
const currentStep = ref<Step | null>(null);
const loaderIsVisible = false;
const danceStepCounter = ref<number>(0);
const danceStepLength = ref<number>(0);
const danceName = ref<string>("");

const showInputs = ref<boolean>(false);

const howQuick = ref<Number>(0);
const m1_x = ref<number>(0);
const m1_y = ref<number>(0)
const m1_rotate = ref<number>(0);
const m1_toe = ref<number>(0);
const m1_heel = ref<number>(0);

const m2_x = ref<number>(0);
const m2_y = ref<number>(0)
const m2_rotate = ref<number>(0);
const m2_toe = ref<number>(0);
const m2_heel = ref<number>(0);

const w1_x = ref<number>(0);
const w1_y = ref<number>(0)
const w1_rotate = ref<number>(0);
const w1_toe = ref<number>(0);
const w1_heel = ref<number>(0);

const w2_x = ref<number>(0);
const w2_y = ref<number>(0)
const w2_rotate = ref<number>(0);
const w2_toe = ref<number>(0);
const w2_heel = ref<number>(0);

const makeCurrentStep = (): Step => {
  return {
    howquick: howQuick.value,
    m1_x: m1_x.value,
    m1_y: m1_y.value,
    m1_rotate: m1_rotate.value,
    m1_toe: m1_toe.value,
    m1_heel: m1_heel.value,
    m2_x: m2_x.value,
    m2_y: m2_y.value,
    m2_rotate: m2_rotate.value,
    m2_toe: m2_toe.value,
    m2_heel: m2_heel.value,
    w1_x: w1_x.value,
    w1_y: w1_y.value,
    w1_rotate: w1_rotate.value,
    w1_toe: w1_toe.value,
    w1_heel: w1_heel.value,
    w2_x: w2_x.value,
    w2_y: w2_y.value,
    w2_rotate: w2_rotate.value,
    w2_toe: w2_toe.value,
    w2_heel: w2_heel.value,
  };
};

watch([howQuick,m1_x,m1_y,m1_rotate,m1_toe,m1_heel,m2_x,m2_y,m2_rotate,m2_toe,m2_heel,w1_x,w1_y,w1_rotate,w1_toe,w1_heel,w2_x,w2_y,w2_rotate,w2_toe,w2_heel], () => currentStep.value = makeCurrentStep());

onMounted(() => {
  currentStep.value = makeCurrentStep()
  console.log(currentStep.value)
});

const backToBeginBtn = () => {
  autoplayActive.value = false;
  danceStepCounter.value = 0;
  currentStep.value = steps.value[danceStepCounter.value];
};

const backBtn = () => {
  autoplayActive.value = false;

  if (danceStepCounter.value > 0) {
    danceStepCounter.value--;
    currentStep.value = steps.value[danceStepCounter.value];
  }
};

const nextBtn = () => {
  autoplayActive.value = false;

  if (danceStepCounter.value < steps.value.length - 1) {
    danceStepCounter.value++;
    currentStep.value = steps.value[danceStepCounter.value];
  }
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
      currentStep.value = steps.value[danceStepCounter.value];
      await new Promise((resolve) => setTimeout(resolve, steps.value[danceStepCounter.value].howquick * 500));
    } else {
      return;
    }
  }

  autoplayVariable.value = playIcon;
  autoplayActive.value = false;
};

const backToEndBtn = () => {
  autoplayActive.value = false;
  danceStepCounter.value = steps.value.length - 1;
  currentStep.value = steps.value[danceStepCounter.value];
};

const showEdits = () => {
  if (showInputs.value) showInputs.value = false;
  else showInputs.value = true;
}
</script>

<template>
  <FootAnimationComponent :loaderIsVisible='loaderIsVisible' :danceStepCounter='danceStepCounter'
                          :danceStepLength='danceStepLength' :currentStep='currentStep || null'
                          :autoplayVariable='autoplayVariable' :danceName='danceName' :showEditBtn='true' @backToBeginBtn="backToBeginBtn"
                          @backBtn="backBtn" @AutoplayBtn="AutoplayBtn" @nextBtn="nextBtn"
                          @backToEndBtn="backToEndBtn" @showEdits="showEdits" />

  <div v-if="showInputs" class="overlay">
    <div class="popup">
      <label>howQuick: <input v-model="howQuick" type="number" step="0.1" /></label>

      <label>m1_x: <input v-model="m1_x" type="range" min="0" max="1" step="0.01" /></label>
      <label>m1_y: <input v-model="m1_y" type="range" min="0" max="1" step="0.01" /></label>
      <label>m1_rotate: <input v-model="m1_rotate" type="number" /></label>
      <label>m1_toe: <input v-model="m1_toe" type="number" /></label>
      <label>m1_heel: <input v-model="m1_heel" type="number" /></label>

      <label>m2_x: <input v-model="m2_x" type="range" min="0" max="1" step="0.01" /></label>
      <label>m2_y: <input v-model="m2_y" type="range" min="0" max="1" step="0.01" /></label>
      <label>m2_rotate: <input v-model="m2_rotate" type="number" /></label>
      <label>m2_toe: <input v-model="m2_toe" type="number" /></label>
      <label>m2_heel: <input v-model="m2_heel" type="number" /></label>

      <label>w1_x: <input v-model="w1_x" type="range" min="0" max="1" step="0.01" /></label>
      <label>w1_y: <input v-model="w1_y" type="range" min="0" max="1" step="0.01" /></label>
      <label>w1_rotate: <input v-model="w1_rotate" type="number" /></label>
      <label>w1_toe: <input v-model="w1_toe" type="number" /></label>
      <label>w1_heel: <input v-model="w1_heel" type="number" /></label>

      <label>w2_x: <input v-model="w2_x" type="range" min="0" max="1" step="0.01" /></label>
      <label>w2_y: <input v-model="w2_y" type="range" min="0" max="1" step="0.01" /></label>
      <label>w2_rotate: <input v-model="w2_rotate" type="number" /></label>
      <label>w2_toe: <input v-model="w2_toe" type="number" /></label>
      <label>w2_heel: <input v-model="w2_heel" type="number" /></label>
    </div>
  </div>
</template>

<style scoped>
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 998;
}

.popup {
  background: #fff;
  padding: 1.5rem;
  border-radius: 1rem;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.25);
  width: 300px;
  max-height: 90vh;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.popup label {
  display: flex;
  flex-direction: column;
  font-size: 0.9rem;
  color: #333;
}

.popup input[type="range"] {
  accent-color: #007bff;
}

.popup input[type="number"],
.popup input[type="range"] {
  margin-top: 0.25rem;
}
</style>
