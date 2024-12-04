<template>

  <div style="background-color: var(--darker); color: var(--lighter);">
    <LoadingScreen v-if="isLoading.state" />
    <NavigationBar class="sticky z-10 header" style="backdrop-filter: blur(2px); top: 0;" />
    <RouterView :style="{'min-height': `calc(100vh - ${headerHeight}px)`}" />
  </div>

</template>

<script setup>

  import NavigationBar from '@/components/NavigationBar.vue';
  import LoadingScreen from './components/LoadingScreen.vue';
  import useLoadingStore from './stores/loading';
  import { onMounted, ref } from 'vue';

  const headerHeight = ref(0);

  onMounted(() => {
    headerHeight.value = document.querySelector(".header").offsetHeight;
  });

  const isLoading = useLoadingStore();

</script>