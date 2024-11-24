<template>

  <div style="background-color: var(--darker); color: var(--lighter);">
    <NavigationBar class="fixed z-10" style="backdrop-filter: blur(2px);" />
    <RouterView />
  </div>

</template>

<script setup>

  import NavigationBar from '@/components/NavigationBar.vue';

</script>