<script setup lang="ts">
import searchIcon from '@/assets/icons/searchIcon.svg';
import { type DanceTypes } from '@/tsTypes/interfacesMainPageView.ts';
import { nextTick, onMounted, ref } from "vue";
import router from "@/router";

const url = import.meta.env.VITE_ServerIP + "/dance/dances";
const dances = ref<DanceTypes[]>([]);
const stepsequences = ref<[]>([]);
const isStepsequence = ref(false);
const searchQuery = ref('');

onMounted(() => {
  fetch(url)
      .then(response => response.json())
      .then((data: DanceTypes[]) => {
        dances.value = data;
        nextTick();
      });
});

function getStepsequencesFromDance(danceId: number) {
  fetch(import.meta.env.VITE_ServerIP + `/stepsequence/dance/${danceId}`)
      .then(response => response.json())
      .then((data) => {
        stepsequences.value = data;
        nextTick();
        isStepsequence.value = true;
      });
}

function openDanceView(stepsequenceId: string) {
  router.push(`/danceView/${stepsequenceId}`);
}
</script>

<template>
  <div class="main-page">
    <!-- Search Section -->
    <div class="search-section">
      <div class="search-container">
        <input
            type="text"
            v-model="searchQuery"
            class="search-input"
            placeholder="Suchen Sie nach Tänzen..."
        >
        <button class="search-button">
          <img :src="searchIcon" alt="Suchen">
        </button>
      </div>
    </div>

    <!-- Back Button -->
    <button
        v-if="isStepsequence"
        @click="isStepsequence = false"
        class="back-button"
    >
      ← Zurück zu den Tänzen
    </button>

    <!-- Dance Grid -->
    <div class="dance-grid">
      <template v-if="!isStepsequence">
        <div
            v-for="dance in dances"
            :key="dance.id"
            class="dance-card"
            @click="getStepsequencesFromDance(dance.id)"
        >
          <h3 class="dance-title">{{ dance.name }}</h3>
          <div class="difficulty-indicator">
            <span
                v-for="index in dance.difficulty"
                :key="index"
                class="difficulty-star"
            >★</span>
          </div>
          <span class="bpm-indicator">{{ dance.defaultBPM }} BPM</span>
        </div>
      </template>

      <template v-else>
        <div
            v-for="stepsequence in stepsequences"
            :key="stepsequence.id"
            class="dance-card"
            @click="openDanceView(stepsequence.id)"
        >
          <h3 class="dance-title">{{ stepsequence.name }}</h3>
          <div class="difficulty-indicator">
            <span
                v-for="index in stepsequence.difficulty"
                :key="index"
                class="difficulty-star"
            >★</span>
          </div>
          <span class="bpm-indicator">{{ stepsequence.dance.defaultBPM }} BPM</span>
        </div>
      </template>
    </div>
  </div>
</template>

<style scoped lang="scss">
// Variables
$color-purple-primary: #8A2BE2;
$color-purple-light: #9D4EDD;
$color-purple-dark: #6A0DAD;
$color-white: #FFFFFF;
$color-gray-light: #F5F5F5;
$color-gray: #E0E0E0;
$color-text-dark: #333333;

.main-page {
  padding: 2rem;
  margin: 0 auto;
  background: linear-gradient(to bottom right, #f3e8ff, #fce7f3, #ffffff);
}

// Search Section
.search-section {
  margin-bottom: 2rem;
}

.search-container {
  position: relative;
  max-width: 600px;
  margin: 0 auto;
}

.search-input {
  width: 100%;
  height: 3rem;
  padding: 0 3rem 0 1.5rem;
  border: 2px solid $colorPurpleLight;
  border-radius: 1.5rem;
  font-size: 1rem;
  color: $color-text-dark;
  background-color: $color-white;
  transition: all 0.2s ease;

  &:focus {
    outline: none;
    border-color: $color-purple-primary;
    box-shadow: 0 0 0 3px rgba($color-purple-primary, 0.1);
  }

  &::placeholder {
    color: #999;
  }
}

.search-button {
  position: absolute;
  right: 1rem;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;

  img {
    width: 1.5rem;
    height: 1.5rem;
  }
}

// Back Button
.back-button {
  margin-bottom: 2rem;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 0.5rem;
  background-color: $colorVioletLight;
  color: $color-white;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;

  &:hover {
    background-color: $colorPurpleLight;
    transform: translateY(-1px);
  }
}

// Dance Grid
.dance-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 2rem;
  padding: 1rem;
}

.dance-card {
  background-color: $colorVioletLight;
  border-radius: 1rem;
  padding: 2rem;
  color: $color-white;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 200px;
  text-align: center;

  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background-color: $color-purple-light;
  }
}

.dance-title {
  font-size: 1.5rem;
  margin: 0 0 1rem;
  font-weight: 600;
}

.difficulty-indicator {
  margin-bottom: 1rem;

  .difficulty-star {
    color: $color-white;
    font-size: 1.2rem;
    margin: 0 0.2rem;
  }
}

.bpm-indicator {
  font-size: 1.1rem;
  font-weight: 500;
  opacity: 0.9;
}

// Responsive Design
@media (max-width: 768px) {
  .main-page {
    padding: 1rem;
  }

  .dance-grid {
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
  }

  .dance-card {
    padding: 1.5rem;
    min-height: 180px;
  }

  .dance-title {
    font-size: 1.25rem;
  }
}

@media (max-width: 480px) {
  .search-input {
    height: 2.5rem;
    font-size: 0.9rem;
  }

  .dance-grid {
    grid-template-columns: 1fr;
  }
}
</style>