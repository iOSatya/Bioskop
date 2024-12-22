<template>

  <div class="flex flex-col justify-center items-center p-4 w-32" style="border: 1px solid var(--secondary);">
    <RouterLink :to="{name: 'add-theatre'}">Theatre</RouterLink>
    <RouterLink :to="{name: 'add-movie'}">Movie</RouterLink>
  </div>


</template>

<style scoped>

  a.router-link-active {
    color: aquamarine;
  }

</style>