<template>

  <div class="flex flex-row justify-center items-center w-screen">
    <nav class="flex flex-row" style="width: 80vw;">

      <div v-if="authStore.accountStatus !== 'admin'" class="me-auto">
        <RouterLink :to="{name: 'home'}" class="nav-button">Home</RouterLink>
      </div>

      <div v-else-if="authStore.accountStatus == 'admin'" class="me-auto">
        <RouterLink :to="{name: 'admin-home'}" class="nav-button">Home</RouterLink>
      </div>

      <div v-if="!authStore.token">
        <RouterLink :to="{name: 'login'}" class="nav-button">Login</RouterLink>
        <RouterLink :to="{name: 'register'}" class="nav-button">Register</RouterLink>
      </div>

      <form v-else @submit.prevent="handleLogout">
        <button type="submit" class="nav-button glow" style="background-color: var(--yellow); color: var(--darker); font-weight: unset;">Logout<span class="ms-2">&rarr;</span></button>
      </form>

    </nav>
  </div>

</template>

<script setup>
  
  import router from '@/router';
  import useAuthStore from '@/stores/auth';
  import useLoadingStore from '@/stores/loading';

  const authStore = useAuthStore();
  const loadingStore = useLoadingStore();

  async function handleLogout() {
    loadingStore.startLoading();
    try {
      const response = await fetch("http://127.0.0.1:8000/api/logout", {
        method: "POST",
        headers: {"Accept": "application/json", "Authorization": `Bearer ${authStore.token}`}
      });

      if (response.ok) {
        authStore.setToken(null);
        authStore.setAccountStatus(null);
        router.push({name: "home"});
      }
    } catch (error) {
      console.log(error);
    }
    loadingStore.stopLoading();
  }

</script>

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

  .glow:hover {
    filter: brightness(1.1);
  }

</style>