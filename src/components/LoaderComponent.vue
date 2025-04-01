<script setup lang="ts">

</script>

<template>
  <div id="loaderContainer">
    <span id="loader"></span>
    <span>Loading ...</span>
  </div>
</template>

<style lang="scss" scoped>
#loaderContainer {
  position: relative;
  height: 90vh;

  #loader {
    width: 20vh;
    height: 20vh;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }


  #loader::before {
    content: "";
    box-sizing: border-box;
    position: absolute;
    inset: 0;
    border-radius: 50%;
    border: 5px solid $colorVioletLight;
    animation: prixClipFix 1.5s linear infinite;
  }

  @keyframes rotate {
    100% {
      transform: rotate(360deg)
    }
  }

  @keyframes prixClipFix {
    0% {
      clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0)
    }
    25% {
      clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0)
    }
    50% {
      clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%)
    }
    75% {
      clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 100%)
    }
    100% {
      clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 0)
    }
  }
}
</style>