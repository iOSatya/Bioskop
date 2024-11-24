<template>

  <div style="background-color: var(--darker); color: var(--lighter);">
    <LoadingScreen v-if="isLoading.loading" />
    <NavigationBar class="fixed z-10" style="backdrop-filter: blur(2px);" />
    <RouterView />
  </div>

</template>

<script setup>

  import NavigationBar from '@/components/NavigationBar.vue';
  import LoadingScreen from './components/LoadingScreen.vue';
  import useLoadingStore from './stores/loading';

  const isLoading = useLoadingStore();

</script>