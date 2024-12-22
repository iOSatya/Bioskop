<template>

  <div class="flex flex-col justify-center items-center">
    <p class="font-bold text-5xl mb-4">Thank You!</p>
    <div>
      <span class="me-4">Your order is Successful!</span>
      <RouterLink :to="{name: 'tickets'}" class="text-blue-500 glow">See your tickets</RouterLink>
    </div>
  </div>

</template>

<script setup>
  
  import { RouterLink } from 'vue-router';

</script>

<style scoped>

  .glow:hover {
    filter: brightness(1.5);
  }

</style>