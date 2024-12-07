<template>

  <div>
    Movie ID: {{ id }}
  </div>

</template>

<script setup>

  defineProps({
    id: String
  });

</script>