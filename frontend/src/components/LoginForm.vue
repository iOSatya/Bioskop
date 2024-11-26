<template>

  <form @submit.prevent="submitLoginForm" class="flex flex-col" style="width: 30vw;">
    <h1 class="text-4xl mb-8">Login</h1>
    <input v-model="email" placeholder="E-Mail" type="text" class="form-control mb-2">
    <input v-model="password" placeholder="Password" type="password" class="form-control mb-2">
    <div class="flex flex-col justify-center items-center h-12">
      <p>{{ message }}</p>
    </div>
    <button type="submit" class="button self-end">Login</button>
  </form>

</template>

<script setup>

  import router from '@/router';
  import useAuthStore from '@/stores/auth';
  import useLoadingStore from '@/stores/loading';
  import { ref } from 'vue';

  const authStore = useAuthStore();
  const loadingStore = useLoadingStore();

  const email = ref("");
  const password = ref("");
  const message = ref("");

  function grabLoginForm() {
    return JSON.stringify({
      email: email.value,
      password: password.value,
    });
  }

  function sendLoginForm(data) {
    return fetch("http://127.0.0.1:8000/api/login", {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: data
    });
  }

  async function submitLoginForm() {
    loadingStore.startLoading();
    try {
      const response = await sendLoginForm(grabLoginForm());
      const responseData = await response.json();

      if (response.ok) {
        authStore.setToken(responseData.token);
        authStore.setAccountStatus(responseData.account_status);

        if (authStore.accountStatus == 'admin') {
          router.push({name: "admin-home"});
        } else {
          router.push({name: "home"});
        }
        
      } else {
        message.value = responseData.message;
      }
      
    } catch (error) {
      message.value = "Something Went Wrong";
      console.log(error);
    }
    loadingStore.stopLoading();
  }

</script>