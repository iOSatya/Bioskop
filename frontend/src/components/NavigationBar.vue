<template>

  <div class="flex flex-row justify-center items-center w-screen">
    <nav class="flex flex-row" style="width: 80vw;">
      <div class="me-auto">
        <RouterLink :to="{name: 'home'}" class="nav-button">Home</RouterLink>
      </div>
      <div>
        <RouterLink :to="{name: 'register'}" class="nav-button">Register</RouterLink>
      </div>
    </nav>
  </div>

</template>

<style scoped>

  a.router-link-active {
    border-bottom-color: var(--lighter);
  }

  .nav-button {
    font-weight: 600;
    display: inline-block;
    padding: 1rem 1.5rem;
    border-bottom: 2px solid transparent;
    box-sizing: border-box;
  }

  .nav-button:hover {
    color: var(--secondary);
  }

</style>