<template>

  <div class="flex flex-col justify-center items-center">
    <div class="flex flex-row w-full min-h-96 p-12 items-center">
      <AddNavigator class="me-12 h-80 self-start" />
      <AddTheatreForm class="w-full" />
    </div>
  </div>
  
</template>

<script setup>

  import AddNavigator from '@/components/AddNavigator.vue';
  import AddTheatreForm from '@/components/AddTheatreForm.vue';

</script>