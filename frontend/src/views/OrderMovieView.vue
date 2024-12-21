<template>

  <div class="flex flex-col justify-center items-center">
    <OrderMovieForm :id="id" />
  </div>
  

</template>

<script setup>
  
  import OrderMovieForm from '@/components/OrderMovieForm.vue';

  const props = defineProps({
    id: String
  });

</script>