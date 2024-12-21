<template>

  <form @submit.prevent="submitRegisterForm" class="flex flex-col" style="width: 30vw;">
    <h1 class="text-4xl mb-8">Register</h1>
    <input v-model="name" placeholder="Name" type="text" class="form-control mb-2">
    <input v-model="email" placeholder="E-Mail" type="text" class="form-control mb-2">
    <input v-model="password" placeholder="Password" type="password" class="form-control mb-2">
    <input v-model="password_confirmation" placeholder="Password Confirmation" type="password" class="form-control mb-2">
    <div class="flex flex-col justify-center items-center h-12">
      <p>{{ message }}</p>
    </div>
    <button type="submit" class="button self-end">Register</button>
  </form>

</template>

<script setup>

  import useLoadingStore from '@/stores/loading';
  import { ref } from 'vue';

  const name = ref("");
  const email = ref("");
  const password = ref("");
  const password_confirmation = ref("");
  const message = ref("");

  const loadingStore = useLoadingStore();

  function grabRegisterForm() {
    return JSON.stringify({
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value
    });
  }

  function sendRegisterForm(data) {
    return fetch("http://127.0.0.1:8000/api/register", {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: data
    });
  }

  async function submitRegisterForm() {
    loadingStore.startLoading();
    try {
      const response = await sendRegisterForm(grabRegisterForm());
      const responseData = await response.json()
      message.value = responseData.message;
    } catch (error) {
      message.value = "Something Went Wrong";
      console.log(error);
    }
    loadingStore.endLoading();
  }

</script>