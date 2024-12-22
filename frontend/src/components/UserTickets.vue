<template>

  <div v-for="(ticket, ticketIndex) in tickets">
    {{ ticket["title"] }} {{ ticket["theatre_name"] }}
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