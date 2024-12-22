<template>

</template>

<script setup>
import { onMounted, ref } from 'vue';


  const arrayVar = ref([]);

  onMounted(() => {
    console.log(arrayVar.value);
  });

</script>