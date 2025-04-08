<script setup lang="ts">
import FootAnimationComponent from "@/components/FootAnimationComponent.vue";
import {nextTick, onMounted, ref} from "vue";
import type {FootStep, Step} from "@/tsTypes/interfacesDanceView.ts";

import playIcon from "@/assets/icons/playIcon.svg";
import pauseIcon from "@/assets/icons/pauseIcon.svg";

const url = import.meta.env.VITE_ServerIP + '/stepsequence/get/1';

const steps = ref<Step[]>([]);
const autoplayActive = ref<boolean>(false);

const autoplayVariable = ref<string>(playIcon);

//for properties
let currentStep = ref<FootStep | null>(null);
let loaderIsVisible = ref<boolean>(true);
const danceStepCounter = ref<number>(0);
const danceStepLength = ref<number>(0);
const danceName = ref<string>("");

onMounted(() => {
  fetch(url)
      .then((res) => res.json())
      .then((data: Step) => {
        steps.value = data.steps;
        danceStepLength.value = data.steps.length;
        danceStepCounter.value = 0;
        currentStep.value = steps.value[danceStepCounter.value];
        danceName.value = data.name;
      })
      .then(async () => {
        await nextTick();
        loaderIsVisible.value = false;
        await nextTick();
      });
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
      await new Promise((resolve) => setTimeout(resolve, steps.value[danceStepCounter.value].howQuick * 500));
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
</script>

<template>

<FootAnimationComponent :loaderIsVisible='loaderIsVisible' :danceStepCounter='danceStepCounter' :danceStepLength='danceStepLength' :currentStep='currentStep || null' :autoplayVariable='autoplayVariable' :danceName='danceName' :showEditBtn='false' @backToBeginBtn="backToBeginBtn" @backBtn="backBtn" @AutoplayBtn="AutoplayBtn" @nextBtn="nextBtn" @backToEndBtn="backToEndBtn"/>

</template>


