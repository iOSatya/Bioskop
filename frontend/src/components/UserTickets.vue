<template>

  <div v-for="(ticket, ticketIndex) in tickets" class="flex flex-row w-full mb-4 p-8" style="border: 1px var(--lighter) solid;">
    <div class="flex flex-col w-1/2">
      <p>Ticket ID : {{ ticket["id"] }}</p>
      <hr class="mt-4 mb-4">
      <p>{{ ticket["title"] }}</p>
      
    </div>
    <div class="flex flex-col w-1/2 items-end">
      <p class="font-semibold text-xl">{{ ticket["theatre_name"] }}</p>
      <p class="font-bold text-5xl">{{ ticket["seat"] }}</p>
    </div>
  </div>

</template>

<script setup>

  import useAuthStore from '@/stores/auth';
  import useLoadingStore from '@/stores/loading';
  import { onMounted, ref } from 'vue';

  const authStore = useAuthStore();
  const loadingStore = useLoadingStore();

  onMounted(() => {
    getUserTickets();
  });

  const tickets = ref([]);

  async function getUserTickets() {
    loadingStore.startLoading();
    const response = await fetch("http://127.0.0.1:8000/api/tickets-user", {
      method: "POST",
      headers: {"Accept": "application/json", "Authorization": `Bearer ${authStore.token}`}
    });
    const responseData = await response.json();
    tickets.value = responseData["tickets"];
    loadingStore.endLoading();
  }

  

</script>